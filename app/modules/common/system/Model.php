<?php
class CommonModel extends Model
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

     /**
     * Get recent team
     * @return array
     */
     public static function getTeam($limit = false)
     {
        if ($limit) {
            $sql = "
            SELECT *
            FROM `users`
            WHERE `deleted` = 'no' AND role='moder' AND id != '9' order by sort LIMIT $limit
            ";
        }
        else {
            $sql = "
            SELECT *
            FROM `users`
            WHERE `deleted` = 'no' AND role='moder' AND id != '9'  order by sort
            ";
        }

        return self::fetchAll(self::query($sql));
    }

     /**
     * @param $slug
     * @return array|object|null
     */
     public static function getMemberBySlug($slug)
     {
        $sql = "
        SELECT *
        FROM `users`
        WHERE `slug` = '$slug'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getCaseStudies($limit = false, $current_slug = false)
    {
        if ($limit && $current_slug) {
            $sql = "
            SELECT *
            FROM `case_studies`
            WHERE `deleted` = 'no' and slug != '$current_slug' LIMIT $limit
            ";
        }
        else if ($limit && !$current_slug) {
            $sql = "
            SELECT *
            FROM `case_studies`
            WHERE `deleted` = 'no' LIMIT $limit
            ";
        }
        else if (!$limit && $current_slug) {
            $sql = "
            SELECT *
            FROM `case_studies`
            WHERE `deleted` = 'no' and slug != '$current_slug'
            ";
        }
        else {
            $sql = "
            SELECT *
            FROM `case_studies`
            WHERE `deleted` = 'no'
            ";
        }

        return self::fetchAll(self::query($sql));
    }

    /**
     * @param $slug
     * @return array|object|null
     */
    public static function getBySlug($slug)
    {
        $sql = "
        SELECT *
        FROM `case_studies`
        WHERE `slug` = '$slug' AND `deleted` = 'no' AND `posted` = 'yes'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getUserJobs($id, $limit = false)
    {
        if ($limit) {
            $sql = "
            SELECT *
            FROM `vacancies`
            WHERE `deleted` = 'no' and consultant_id = $id and (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0) ";
        }
        else {
           $sql = "
           SELECT *
           FROM `vacancies`
           WHERE `deleted` = 'no' and consultant_id = $id and (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0) ";
       }

    

       $sql .= "LIMIT $limit";

       $vacancies = self::fetchAll(self::query($sql));

       if (is_array($vacancies) && count($vacancies)) {
        foreach ($vacancies as $vacancy) {

            // Sectors
                $vacancy->sector_ids = array();
                $vacancy->sectors = array();
                $sectors = self::getVacancySectors($vacancy->id);

                if (is_array($sectors) && count($sectors)) {
                    foreach ($sectors as $sector) {
                        $vacancy->sector_ids[] = $sector->id;
                        $vacancy->sectors[] = $sector;
                    }
                }

            // Locations
            $vacancy->location_ids = array();
            $vacancy->locations = array();
            $locations = self::getVacancyLocations($vacancy->id);

            if (is_array($locations) && count($locations)) {
                foreach ($locations as $location) {
                    $vacancy->location_ids[] = $location->location_id;
                    $vacancy->locations[] = $location;
                }
            }
        }
    }
    return $vacancies;
}

public static function getVacancyLocations($vid)
{
    $sql = "
    SELECT `vacancies_locations`.*, `locations`.`name` as `location_name`
    FROM `vacancies_locations`
    LEFT JOIN `locations` ON `locations`.`id` = `vacancies_locations`.`location_id`
    WHERE `vacancies_locations`.`vacancy_id` = '$vid'
    ";

    return self::fetchAll(self::query($sql));
}


public static function getVacancySectors($vid)
{
    $sql = "
    SELECT `vacancies_sectors`.*, `sectors`.`name` as `sector_name`
    FROM `vacancies_sectors`
    LEFT JOIN `sectors` ON `sectors`.`id` = `vacancies_sectors`.`sector_id`
    WHERE `vacancies_sectors`.`vacancy_id` = '$vid'
    ";

    return self::fetchAll(self::query($sql));
}
  public static function getAlltestimonials()
    {
        $sql = "
            SELECT *
            FROM `testimonials`
            WHERE `deleted` = 'no'
        ";

        return self::fetchAll(self::query($sql));
    }
}
/* End of file */