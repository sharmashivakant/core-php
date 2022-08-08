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
    public static function getopenprofiles($keywords=false,$location=false,$type=false,$limit=false,$offset = 0)
    {            
        $sql = "
            SELECT *   
            FROM `talent_open_profiles`
            WHERE `deleted` = 'no'
        "; 
        if ($keywords)
            $sql .= " AND (`job_title` LIKE '%$keywords%' OR `keywords` LIKE '%$keywords%' OR `sports` LIKE '%$keywords%')";
        if ($postcode)
            $sql .= " AND (`postcode` = '$postcode')";
         if ($location) {

            if(is_array($location)) {
                $location = implode(",", $location);
                $sql .= " AND (`id` IN (SELECT `open_profile_id` FROM `talent_open_profiles_locations` WHERE `location_id` IN ($location) ))";
            } else {
                $sql .= " AND (`id` IN (SELECT `open_profile_id` FROM `talent_open_profiles_locations` WHERE `location_id` IN  ($location) ))";
            }
        }
           if ($type){         
             if(is_array($type)) {    
                $type = implode("','", $type);
                $sql .= " AND `contract` IN ('$type')";
            } else {
                $sql .= " AND `contract` = '$type'";
            }      
        }
        $total_profiles = self::fetchAll(self::query($sql));
        $profiles_count = count($total_profiles);
        
        if($limit)
            $sql .= " LIMIT $offset, $limit";
     
   /*   echo $sql;
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

         $data['count'] = $profiles_count;
        $data['allprofiles'] = $allprofiles;
        return $data;
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
 

}

/* End of file */