<?php
class TalentModel extends Model
{
    public $version = 0;

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(

        );

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Method module_update start automatically if current $version != version in `modules` table, and start from "case 'i'", where i = prev version in modules` table
     * @param int $version
     */
    public function module_update($version)
    {
        $queries = array();

        switch ($version) {
//            case '0':
//                $queries[] = "ALTER TABLE `modules` ADD COLUMN `image` varchar(100) DEFAULT NULL AFTER `time`;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    public static function getopenprofiles($keywords=false,$distance=false,$postcode=false,$latitude=false,$longitude=false,$contract=false ,$limit = false,$offset = 0)
    {
        $sql = "
            SELECT *
            FROM `talent_open_profiles`
            WHERE `deleted` = 'no'
        "; 
        if ($keywords)
            $sql .= " AND (`job_title` LIKE '%$keywords%' OR `keywords` LIKE '%$keywords%' OR `sports` LIKE '%$keywords%')";
        /*if ($postcode)
            $sql .= " AND (`postcode` = '$postcode')";*/
         if ($location) {

            if(is_array($location)) {
                $location = implode(",", $location);
                $sql .= " AND (`id` IN (SELECT `open_profile_id` FROM `talent_open_profiles_locations` WHERE `location_id` IN ($location) ))";
            } else {
                $sql .= " AND (`id` IN (SELECT `open_profile_id` FROM `talent_open_profiles_locations` WHERE `location_id` IN  ($location) ))";
            }
        }
         if($contract!=''){
              $sql .= " AND `contract` = '$contract'";
         }

        if ($postcode) { //todo check postcode
            if (str_replace(' (all)', '', $postcode) === $postcode) {

                $coordinates = Model::fetch(Model::select('postcodelatlng', " `postcode` = '$postcode'"));
/*echo '<pre>';
                print_r($coordinates);
                die;*/
                if ($coordinates) {
                    $latitude = $coordinates->latitude;
                    $longitude = $coordinates->longitude;
                    $distance=1000000;
                /*$sql .= " AND (`talent_open_profiles`.`relocate` = 'yes' 
                OR (((acos(sin((" . $latitude . "*pi()/180)) * sin(((SELECT `postcodelatlng`.`latitude` FROM `postcodelatlng` 
                WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1)*pi()/180))+cos((" . $latitude . "*pi()/180)) 
                * cos(((SELECT `postcodelatlng`.`latitude` FROM `postcodelatlng` 
                WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1)*pi()/180)) 
                * cos(((" . $longitude . " - (SELECT `postcodelatlng`.`longitude` FROM `postcodelatlng` 
                WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1))*pi()/180))))*180/pi())*60*1.1515)
                *(IF(`talent_open_profiles`.`distance_type` = 'MILES', 1.609344, 1)) <= `talent_open_profiles`.`radius`)";*/
                

                
            if ($latitude && $longitude && $distance) {
            $postcodes = self::getPostcodeAndDistance($latitude, $longitude, $distance);
           /* echo '<pre>';
            print_r($postcodes);
            die;*/
            $postcodesdata=array();
             $raw_where = '(';
             $i=1;
            foreach($postcodes as $postcodesdataitem){
                //$postcodesdata[]=$postcodesdataitem->postcode;
                if($postcodesdataitem->postcode){
                    if($i!=1){
                    $raw_where .= " OR ";
                     }
                  }
                  $raw_where .= "`postcode` = '$postcodesdataitem->postcode' AND `radius` > '$postcodesdataitem->distance'";
                  
                  
                
             $i++; }
             $raw_where .= ')';  
      $sql .= " AND $raw_where";
            
        }
                }else{
                  $sql .= " AND `postcode` = '$postcode'";  
                }
            } else {

                $outcode = str_replace(' (all)', '', $postcode);
                $coordinates = self::get_coordinates_by_outcode($outcode);
                if ($coordinates) {
                    $latitude = $coordinates->latitude;
                    $longitude = $coordinates->longitude;

                    $fix = self::get_radius_fix_by_outcode($outcode, $latitude, $longitude);

                    $sql .= " AND (`talent_open_profiles`.`relocate` = 'yes' 
                    OR (((acos(sin((" . $latitude . "*pi()/180)) * sin(((SELECT `postcodelatlng`.`latitude` 
                    FROM `postcodelatlng` WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1)
                    *pi()/180))+cos((" . $latitude . "*pi()/180)) * cos(((SELECT `postcodelatlng`.`latitude` FROM `postcodelatlng` 
                    WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1)*pi()/180))        
                    * cos(((" . $longitude . " - (SELECT `postcodelatlng`.`longitude` FROM `postcodelatlng` 
                    WHERE `postcodelatlng`.`postcode` = `talent_open_profiles`.`postcode` LIMIT 1))*pi()/180))))*180/pi())*60*1.1515)
                    *(IF(`talent_open_profiles`.`distance_type` = 'KM', 1.609344, 1)) <= (`talent_open_profiles`.`radius` " . ($fix ? " + " . $fix->fix : "") . "))";
                }
            }
        } 
          $sql .= " order by id desc";
          if ($limit)
            $sql .= " LIMIT $offset, $limit";
         //$profiles = self::fetchAll(self::query($sql));
       /*  echo $sql;
         die;*/
      $allprofiles = self::fetchAll(self::query($sql)); 

        if ($allprofiles) {
        foreach($allprofiles as $profile){   

            //Languages
            $profile->languages = [];
            $languages = self::getLanguages($profile->id);
            if (is_array($languages) && count($languages) > 0) {
                foreach ($languages as $lang) {
                    $profile->languages[] = $lang;
                }
            }

            //locations
            $profile->locations = [];
            $locations = self::getLocations($profile->id);
            if (is_array($locations) && count($locations) > 0) {
                foreach ($locations as $loc) {
                    $profile->locations[] = $loc;
                }
            }

            //consultant
            $consultant = self::getConsultant($profile->consultant_id);
            if ($consultant)
                $profile->consultant = $consultant;

        }
        }
        
        return $allprofiles;
    }  
        public static function get_radius_fix_by_outcode($outcode,  $center_latitude, $center_longitude)
    {
        $sql = "
        SELECT
            (
                (
                    (
                        acos(
                            sin(
                                (" . $center_latitude . "*pi()/180)
                            ) * sin(
                                (
                                    (
                                        SELECT `postcodelatlng`.`latitude` FROM `postcodelatlng` WHERE `postcodelatlng`.`postcode` = `postcodes1`.`postcode` LIMIT 1
                                    )*pi()/180
                                )
                            ) + cos(
                                (" . $center_latitude . "*pi()/180)
                            ) * cos(
                                (
                                    (
                                        SELECT `postcodelatlng`.`latitude` FROM `postcodelatlng` WHERE `postcodelatlng`.`postcode` = `postcodes1`.`postcode` LIMIT 1
                                    )*pi()/180
                                )
                            ) * cos(
                                (
                                    (" . $center_longitude . " - (
                                        SELECT `postcodelatlng`.`longitude` FROM `postcodelatlng` WHERE `postcodelatlng`.`postcode` = `postcodes1`.`postcode` LIMIT 1
                                    ))*pi()/180
                                )
                            )
                        )
                    )*180/pi()
                )*60*1.1515
            ) AS `fix`
        FROM
            `postcodelatlng` `postcodes1`
        WHERE
            `postcodes1`.`outcode` = '" . $outcode . "'
        ORDER BY
            `fix` DESC
        LIMIT
            1";

        return self::fetch(self::query($sql));

    }
    public static function getLanguages($id)
    {

        $sql = "
            SELECT `talent_open_profiles_languages`.*, `talent_languages`.`name` as `language_name`
            FROM `talent_open_profiles_languages`
            LEFT JOIN `talent_languages` ON `talent_languages`.`id` = `talent_open_profiles_languages`.`language_id`
            WHERE `talent_open_profiles_languages`.`open_profile_id` = '$id'
        ";

        return self::fetchAll(self::query($sql));
    }
     public static function checkvalidpostcode($postcode)
    {
        //$trimpostcode=str_replace(" ","",$postcode);
        $sql = "
            SELECT *
            FROM `postcodelatlng`
            WHERE `postcode` = '$postcode'
        ";
       
       $data=self::fetch(self::query($sql));
      if(!empty($data)){
       return 'valid';
      }else{
      return 'notvalid';
      }
        
    } 

    public static function getSkills($id)
    {

        $sql = "
            SELECT `talent_open_profiles_skills`.*, `talent_skills`.`name` as `skill_name`
            FROM `talent_open_profiles_skills`
            LEFT JOIN `talent_skills` ON `talent_skills`.`id` = `talent_open_profiles_skills`.`skill_id`
            WHERE `talent_open_profiles_skills`.`open_profile_id` = '$id'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getLocations($id)
    {

        $sql = "
            SELECT `talent_open_profiles_locations`.*, `talent_locations`.`name` as `location_name`
            FROM `talent_open_profiles_locations`
            LEFT JOIN `talent_locations` ON `talent_locations`.`id` = `talent_open_profiles_locations`.`location_id`
            WHERE `talent_open_profiles_locations`.`open_profile_id` = '$id'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getConsultant($id)
    {
        $sql = "
            SELECT *
            FROM `users`
            WHERE `id` = '$id'
        ";

        return self::fetch(self::query($sql));
    } 
    public static function getallLocations($where = false, $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM `locations` WHERE `deleted` = 'no' ";
        
        if ($where)
            $sql .= $where;

        $sql .= "ORDER BY `name` ASC ";

        if ($limit)
            $sql .= " LIMIT $offset, $limit";

        return self::fetchAll(self::query($sql));
    }  
 public static function getPostcodeAndDistance($lat, $long, $distance) {

$sql = "select replace(postcode, ' ', '') as postcode, 
               ( 3959 * acos( cos( radians($lat) ) 
                      * cos( radians( postcodelatlng.latitude ) ) 
                      * cos( radians( postcodelatlng.longitude ) - radians($long) ) 
                      + sin( radians($lat) ) 
                      * sin( radians( postcodelatlng.latitude ) ) ) ) AS distance 
        from postcodelatlng having distance <= $distance ORDER BY distance LIMIT 1000";
        //echo $sql
        /*$sql = "
        select replace(postcode, ' ', '') as postcode, 
               ( 3959 * acos( cos( radians($lat) ) 
                      * cos( radians( postcodelatlng.latitude ) ) 
                      * cos( radians( postcodelatlng.longitude ) - radians($long) ) 
                      + sin( radians($lat) ) 
                      * sin( radians( postcodelatlng.latitude ) ) ) ) AS distance 
        from postcodelatlng
        having distance <= $distance ORDER BY distance LIMIT 100;
        ";*/
        
        
       /* $query = $this->db->query($sql);
        return $query->result_array();*/
         return self::fetchAll(self::query($sql));
    }


 public static function getallpostcode($postcode)
    {
 /*$this->db->select('postcode, latitude, longitude')->limit(10)->where("replace(postcode, ' ', '') LIKE '%$postcode%'")->get('postcodelatlng')->result();*/
        $sql = "
            SELECT  `postcodelatlng`.`id`,`postcodelatlng`.`postcode`, `postcodelatlng`.`latitude`, `postcodelatlng`.`longitude`
            FROM `postcodelatlng`
            WHERE `postcodelatlng`.`postcode` LIKE '%$postcode%'
        ";

        return self::fetchAll(self::query($sql));
    }
     public static function getlatlong($id)
    {
        $sql = "
            SELECT *
            FROM `postcodelatlng`
            WHERE `id` = '$id'
        ";
        return self::fetch(self::query($sql));
    } 
}

/* End of file */