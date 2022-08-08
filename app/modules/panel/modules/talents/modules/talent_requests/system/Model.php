<?php
class Talent_requestsModel extends Model
{
    public $version = 0; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `talent_requests` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `file` varchar(200) NOT NULL,
                `time` int(10) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;"
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
//                $queries[] = "ALTER TABLE `locations` ADD COLUMN `subtitle` varchar(200) DEFAULT NULL AFTER `subtitle`;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Get user by $id
     * @param $id
     * @return array|object|null
     */
    public static function get($id)
    {
        $sql = "
            SELECT *
            FROM `talent_requests`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function get_requests($type)
    {
        $sql = "
            SELECT *
            FROM `talent_requests`
            where `request_type`='$type'
            AND `deleted`='no'
            ORDER BY `id` DESC
        ";
        $requests=self::fetchAll(self::query($sql));
        if($requests){
             foreach ($requests as $requestsitem) {
             $profile = self::getopenprofile($requestsitem->profile_id);
              $requestsitem->openprofile = $profile;
            
        }
        }
        
        return $requests;
    }
    public static function getopenprofile($id)
    {
        $sql = "
            SELECT *
            FROM `talent_open_profiles`
            WHERE `id` = '$id'
            LIMIT 1
        ";
        
      $profile=self::fetch(self::query($sql));
        return $profile->job_title;;
    }

}

/* End of file */