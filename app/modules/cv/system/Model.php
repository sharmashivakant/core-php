<?php
class CvModel extends Model
{
    public $version = 1;

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `cv_library` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `vacancy_id` int(10) unsigned DEFAULT 0,
               `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
               `email` varchar(60) NOT NULL,
               `tel` varchar(30) default NULL,
               `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
               `linkedin` varchar(150) DEFAULT NULL,
               `job_spec` varchar(50) DEFAULT NULL,
               `cv` varchar(50) DEFAULT NULL,
               `time` int(10) unsigned,
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
            case '0':
                $queries[] = "ALTER TABLE `cv_library` ADD COLUMN `deleted` enum('no', 'yes') DEFAULT 'no' AFTER `time`;";
        }

        foreach ($queries as $query)
            self::query($query);
    }


    /**
     * @param $id
     * @return array|object|null
     */
    public static function get($id)
    {
        $sql = "
            SELECT *
            FROM `cv_library`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
    
    // Get all CV //
    public static function getAll()
    {
        $sql = "
        SELECT *
        FROM `cv_library` where `time` >  UNIX_TIMESTAMP(NOW() - INTERVAL 5 MINUTE) and `deleted` = 'no'";

        $cvs = self::fetchAll(self::query($sql)); 
        return $cvs;
    }
}

/* End of file */