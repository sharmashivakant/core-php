<?php
class VacanciesModel extends Model
{
    public $version = 7; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `vacancies` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(200) NOT NULL,
                `ref` varchar(200) DEFAULT NULL,
                `contract_type` enum('permanent', 'temporary', 'contract') DEFAULT 'permanent',
                `salary_value` varchar(200) DEFAULT NULL,
                `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `meta_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `meta_keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `meta_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `package` varchar(255) NOT NULL DEFAULT '',
                `image` varchar(100) DEFAULT NULL,
                `slug` varchar(200) NOT NULL DEFAULT '',
                `deleted` enum('no','yes') DEFAULT 'no',
                `views` int(10) unsigned DEFAULT 0,
                `time_expire` int(10) unsigned NOT NULL,
                `time` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`),
                INDEX (`slug`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `vacancies_sectors` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `vacancy_id` int(10) unsigned NOT NULL,
                `sector_id` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `vacancies_locations` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `vacancy_id` int(10) unsigned NOT NULL,
                `location_id` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `vacancies_functions` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `vacancy_id` int(10) unsigned NOT NULL,
                `function_id` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",
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
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `consultant_id` int(10) unsigned DEFAULT 0 AFTER `package`;";

            case '1':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `content_short` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `content`;";

            case '2':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `tech_stack` varchar(255) DEFAULT '' AFTER `consultant_id`;";

            case '3':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `microsite_id` int(10) unsigned DEFAULT 0 AFTER `package`;";

            case '4':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `image` varchar(100) DEFAULT NULL AFTER `package`";
            case '5':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `expire_reason` varchar(255) DEFAULT '' AFTER `views`;";
            case '6':
                $queries[] = "ALTER TABLE `vacancies` ADD COLUMN `postcode` varchar(20) DEFAULT null AFTER `package`;";
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
            FROM `vacancies`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        $vacancy = self::fetch(self::query($sql));

        if ($vacancy) {
            // Sectors
            $vacancy->sector_ids = array();
            $vacancy->sectors = array();
            $sectors = self::getVacancySectors($vacancy->id);

            if (is_array($sectors) && count($sectors)) {
                foreach ($sectors as $sector) {
                    $vacancy->sector_ids[] = $sector->sector_id;
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

            // Functions
            $vacancy->function_ids = array();
            $vacancy->functions = array();
            $functions = self::getVacancyFunctions($vacancy->id);

            if (is_array($functions) && count($functions)) {
                foreach ($functions as $function) {
                    $vacancy->function_ids[] = $function->function_id;
                    $vacancy->functions[] = $function;
                }
            }
        }

        return $vacancy;
    }

    public static function getLocationWhere($lid, $sid = false, $cid= false, $sector_type = false)
    {
        $sql = "
            SELECT COUNT(DISTINCT vacancies.id) as counter FROM vacancies 
            LEFT JOIN vacancies_locations ON vacancies.id = vacancies_locations.vacancy_id 
            LEFT JOIN vacancies_sectors ON vacancies.id = vacancies_sectors.vacancy_id 
            LEFT JOIN sectors ON vacancies_sectors.sector_id = sectors.id
            WHERE `vacancies`.`deleted` = 'no'
            AND (`vacancies`.`time_expire` > '" . (time() - 180) . "' OR `vacancies`.`time_expire` = 0)
            AND vacancies_locations.location_id = '$lid'";

        if ($sector_type) {
            $sql .= "AND sectors.sector_type = '$sector_type'";
        }
        if ($sid){
            $sids = "'" . implode( "' ,'" , $sid) . "'";
            $sql .= "AND vacancies_sectors.sector_id IN ($sids)";
        }
        if ($cid){
            $cids = "'" . implode( "' ,'" , $cid) . "'";
            $sql .= "AND vacancies.contract_type IN ($cids)";
        }


        $jobs =  self::fetchAll(self::query($sql));
        $jobs[0]->location_id = $lid;
        return $jobs;
    }

    public static function getLocationsWhere($where = false)
    {
        $sql = "
            SELECT *,
            (SELECT COUNT(*) FROM vacancies_locations WHERE location_id = locations.id) AS total
            FROM `locations` 
            WHERE `deleted` = 'no'
        ";
        if ($where)
            $sql .= " AND $where";

        $sql .= " ORDER BY `name` ASC";

        return self::fetchAll(self::query($sql));
    }



    public static function getTypeWhere($type, $sid = false, $lid= false, $sector_type = false)
    {
        $sql = "
            SELECT COUNT(DISTINCT vacancies.id) as counter FROM vacancies 
            LEFT JOIN vacancies_locations ON vacancies.id = vacancies_locations.vacancy_id 
            LEFT JOIN vacancies_sectors ON vacancies.id = vacancies_sectors.vacancy_id 
            LEFT JOIN sectors ON vacancies_sectors.sector_id = sectors.id
            WHERE `vacancies`.`deleted` = 'no'
            AND (`vacancies`.`time_expire` > '" . (time() - 180) . "' OR `vacancies`.`time_expire` = 0)
            AND vacancies.contract_type = '$type'";

        if ($sector_type) {
            $sql .= "AND sectors.sector_type = '$sector_type'";
        }
        if ($sid){
            $sids = "'" . implode( "' ,'" , $sid) . "'";
            $sql .= "AND vacancies_sectors.sector_id IN ($sids)";
        }
        if ($lid){
            if (is_array($type)) { // by array of types
                $lids = "'" . implode("' ,'", $lid) . "'";
                $sql .= "AND vacancies_locations.location_id IN ($lids)";
            } else {
                $sql .= "AND vacancies_locations.location_id = '$lid'";
            }
        }

        $jobs =  self::fetchAll(self::query($sql));
        $jobs[0]->contract_type = $type;
        return $jobs;
    }

    /**
     * Get all
     * @return array
     */
    public static function getAll($microsite_id = false, $limit = false, $where = false, $status = 'no')
    {
        $sql = "
           SELECT *,
            (SELECT COUNT(`id`) FROM `cv_library` cl WHERE cl.`vacancy_id` = v.`id`) as 'applications'
            FROM `vacancies` v
            WHERE v.`deleted` = '$status'
        ";

        if ($microsite_id !== false)
            $sql .= " AND `microsite_id` = '$microsite_id'";

        if ($where !== false)
            $sql .=  $where;

        $sql .= " ORDER BY `time` DESC, `id` DESC";

        if (is_numeric($limit))
            $sql .= " LIMIT $limit";

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

                // Consultant
                if ($vacancy->consultant_id)
                    $vacancy->consultant = self::getVacancyConsultant($vacancy->consultant_id);
            }
        }

        return $vacancies;
    }


    public static function getLatest($limit = 6)
    {
        $sql = "
            SELECT *
            FROM `vacancies`
            WHERE `deleted` = 'no'
            ORDER BY `time` DESC
            LIMIT $limit
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getVacanciesBySectorType($sector_type, $keywords = false, $type = false, $sector = false, $location= false, $orderBy = false, $limit = false)
    {
        $output = [];
        $sectors = self::getSectorsBySectorType($sector_type);

        foreach ($sectors as $item)
        {
            $vacancy = self::getVacanciesBySector($item->id, $keywords, $type, $sector, $location, $orderBy, $limit);
            if ($vacancy){
                foreach ($vacancy as $v) {
                    $v->sector_name = $item->name;
                    $output[$v->id] = $v;
                }
            }
        }

        return $output;
    }

    public static function getSectorsBySectorType($sector_type)
    {
        $sql = "
            SELECT * 
            FROM `sectors`
            WHERE `sector_type` = '$sector_type'
        ";

        return self::fetchAll(self::query($sql));
    }


    public static function getVacanciesBySector($sector_id, $keywords = false, $type = false, $sector = false, $location = false, $orderBy = false, $limit = false)
    {
        $sql = "
            SELECT `vacancies`.*
            FROM `vacancies`
            LEFT JOIN `vacancies_sectors` ON `vacancies`.id = `vacancies_sectors`.vacancy_id
            WHERE `vacancies_sectors`.sector_id = '$sector_id'
            AND `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
        ";

        if ($keywords)
            $sql .= " AND (`vacancies`.`title` LIKE '%$keywords%' OR `vacancies`.`content` LIKE '%$keywords%' OR `vacancies`.`ref` LIKE '%$keywords%')";

        // Search by contract type
        if ($type) {
            if (is_array($type)) // by array of types
                $sql .= " AND `vacancies`.`contract_type` IN ('" . implode("','", $type) . "')";
            else // by once type
                $sql .= " AND `vacancies`.`contract_type` = '$type'";
        }

        // Search by sectors
        if ($sector) {
            if (is_array($sector)) // by array of ids
                $sql .= " AND (`vacancies`.`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` IN ('" . implode("','", $sector) . "')))";
            else // by id
                $sql .= " AND (`vacancies`.`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` = '$sector'))";
        }

        // Search by location
        if ($location) {
            if (is_array($location)) // by array of ids
                $sql .= " AND (`vacancies`.`id` IN (SELECT `vacancy_id` FROM `vacancies_locations` WHERE `location_id` IN ('" . implode("','", $location) . "')))";
            else // by id
                $sql .= " AND (`vacancies`.`id` IN (SELECT `vacancy_id` FROM `vacancies_locations` WHERE `location_id` = '$location'))";
        }

        if ($orderBy = 'DESC')
            $sql .= " ORDER BY `vacancies`.`id` DESC";

        if ($limit)
            $sql .= " LIMIT $limit";

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

                // Consultant
                if ($vacancy->consultant_id)
                    $vacancy->consultant = self::getVacancyConsultant($vacancy->consultant_id);
            }
        }

        return $vacancies;
    }

    public static function getSectors()
    {
        $sql = "
            SELECT *,  (SELECT COUNT(*) FROM vacancies_sectors WHERE sector_id = sectors.id) AS total
            FROM `sectors`
            WHERE `deleted` = 'no'
            ORDER BY `name` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getSectorWhere($sid, $lid = false, $cid= false)
    {
        $sql = "
            SELECT COUNT(DISTINCT vacancies.id) as counter FROM vacancies 
            LEFT JOIN vacancies_sectors ON vacancies.id = vacancies_sectors.vacancy_id 
            LEFT JOIN vacancies_locations ON vacancies.id = vacancies_locations.vacancy_id 
            WHERE `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
            AND vacancies_sectors.sector_id = '$sid'";
        if ($lid){
            $lids = "'" . implode( "' ,'" , $lid) . "'";
            $sql .= "AND vacancies_locations.location_id IN ($lids)";
        }
        if ($cid){
            $cids = "'" . implode( "' ,'" , $cid) . "'";
            $sql .= "AND vacancies.contract_type IN ($cids)";
        }

        $jobs =  self::fetchAll(self::query($sql));
        $jobs[0]->sector_id = $sid;

        return $jobs;

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

    public static function getVacancyFunctions($vid)
    {
        $sql = "
            SELECT `vacancies_functions`.*, `functions`.`name` as `function_name`
            FROM `vacancies_functions`
            LEFT JOIN `functions` ON `functions`.`id` = `vacancies_functions`.`function_id`
            WHERE `vacancies_functions`.`vacancy_id` = '$vid'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getVacancyConsultant($uid)
    {
        $sql = "
            SELECT * from `users` WHERE `id` = '$uid'
        ";

        return self::fetch(self::query($sql));
    }

    public static function removeSectors($vid)
    {
        $sql = "
            DELETE 
            FROM `vacancies_sectors` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function removeLocations($vid)
    {
        $sql = "
            DELETE 
            FROM `vacancies_locations` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function removeFunctions($vid)
    {
        $sql = "
            DELETE 
            FROM `vacancies_functions` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function getVacanciesByConsultant($consultant_id, $limit = null)
    {
        $sql = "
            SELECT * from `vacancies` 
            WHERE `consultant_id` = '$consultant_id'
            ORDER BY `time` DESC, `id` DESC
        ";

        if(is_numeric($limit))
            $sql .= " LIMIT $limit ";

        return self::fetchAll(self::query($sql));
    }
}

/* End of file */