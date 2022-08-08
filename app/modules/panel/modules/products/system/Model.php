<?php
class productsModel extends Model
{
    public $version = 7; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    
    public function module_update($version)
    {
        $queries = array();

        switch ($version) {
            case '0':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `consultant_id` int(10) unsigned DEFAULT 0 AFTER `package`;";

            case '1':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `content_short` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `content`;";

            case '2':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `tech_stack` varchar(255) DEFAULT '' AFTER `consultant_id`;";

            case '3':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `microsite_id` int(10) unsigned DEFAULT 0 AFTER `package`;";

            case '4':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `image` varchar(100) DEFAULT NULL AFTER `package`";
            case '5':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `expire_reason` varchar(255) DEFAULT '' AFTER `views`;";
            case '6':
                $queries[] = "ALTER TABLE `products` ADD COLUMN `postcode` varchar(20) DEFAULT null AFTER `package`;";
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
            FROM `products`
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
            SELECT COUNT(DISTINCT products.id) as counter FROM products 
            LEFT JOIN products_locations ON products.id = products_locations.vacancy_id 
            LEFT JOIN products_sectors ON products.id = products_sectors.vacancy_id 
            LEFT JOIN sectors ON products_sectors.sector_id = sectors.id
            WHERE `products`.`deleted` = 'no'
            AND (`products`.`time_expire` > '" . (time() - 180) . "' OR `products`.`time_expire` = 0)
            AND products_locations.location_id = '$lid'";

        if ($sector_type) {
            $sql .= "AND sectors.sector_type = '$sector_type'";
        }
        if ($sid){
            $sids = "'" . implode( "' ,'" , $sid) . "'";
            $sql .= "AND products_sectors.sector_id IN ($sids)";
        }
        if ($cid){
            $cids = "'" . implode( "' ,'" , $cid) . "'";
            $sql .= "AND products.contract_type IN ($cids)";
        }


        $jobs =  self::fetchAll(self::query($sql));
        $jobs[0]->location_id = $lid;
        return $jobs;
    }

    public static function getLocationsWhere($where = false)
    {
        $sql = "
            SELECT *,
            (SELECT COUNT(*) FROM products_locations WHERE location_id = locations.id) AS total
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
            SELECT COUNT(DISTINCT products.id) as counter FROM products 
            LEFT JOIN products_locations ON products.id = products_locations.vacancy_id 
            LEFT JOIN products_sectors ON products.id = products_sectors.vacancy_id 
            LEFT JOIN sectors ON products_sectors.sector_id = sectors.id
            WHERE `products`.`deleted` = 'no'
            AND (`products`.`time_expire` > '" . (time() - 180) . "' OR `products`.`time_expire` = 0)
            AND products.contract_type = '$type'";

        if ($sector_type) {
            $sql .= "AND sectors.sector_type = '$sector_type'";
        }
        if ($sid){
            $sids = "'" . implode( "' ,'" , $sid) . "'";
            $sql .= "AND products_sectors.sector_id IN ($sids)";
        }
        if ($lid){
            if (is_array($type)) { // by array of types
                $lids = "'" . implode("' ,'", $lid) . "'";
                $sql .= "AND products_locations.location_id IN ($lids)";
            } else {
                $sql .= "AND products_locations.location_id = '$lid'";
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
            FROM `products` v
            WHERE v.`deleted` = '$status'
        ";

        if ($microsite_id !== false)
            $sql .= " AND `microsite_id` = '$microsite_id'";

        if ($where !== false)
            $sql .=  $where;

        $sql .= " ORDER BY `time` DESC, `id` DESC";

        if (is_numeric($limit))
            $sql .= " LIMIT $limit";

        $products = self::fetchAll(self::query($sql));

        if (is_array($products) && count($products)) {
            foreach ($products as $vacancy) {
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

        return $products;
    }


    public static function getLatest($limit = 6)
    {
        $sql = "
            SELECT *
            FROM `products`
            WHERE `deleted` = 'no'
            ORDER BY `time` DESC
            LIMIT $limit
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getproductsBySectorType($sector_type, $keywords = false, $type = false, $sector = false, $location= false, $orderBy = false, $limit = false)
    {
        $output = [];
        $sectors = self::getSectorsBySectorType($sector_type);

        foreach ($sectors as $item)
        {
            $vacancy = self::getproductsBySector($item->id, $keywords, $type, $sector, $location, $orderBy, $limit);
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


    public static function getproductsBySector($sector_id, $keywords = false, $type = false, $sector = false, $location = false, $orderBy = false, $limit = false)
    {
        $sql = "
            SELECT `products`.*
            FROM `products`
            LEFT JOIN `products_sectors` ON `products`.id = `products_sectors`.vacancy_id
            WHERE `products_sectors`.sector_id = '$sector_id'
            AND `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
        ";

        if ($keywords)
            $sql .= " AND (`products`.`title` LIKE '%$keywords%' OR `products`.`content` LIKE '%$keywords%' OR `products`.`ref` LIKE '%$keywords%')";

        // Search by contract type
        if ($type) {
            if (is_array($type)) // by array of types
                $sql .= " AND `products`.`contract_type` IN ('" . implode("','", $type) . "')";
            else // by once type
                $sql .= " AND `products`.`contract_type` = '$type'";
        }

        // Search by sectors
        if ($sector) {
            if (is_array($sector)) // by array of ids
                $sql .= " AND (`products`.`id` IN (SELECT `vacancy_id` FROM `products_sectors` WHERE `sector_id` IN ('" . implode("','", $sector) . "')))";
            else // by id
                $sql .= " AND (`products`.`id` IN (SELECT `vacancy_id` FROM `products_sectors` WHERE `sector_id` = '$sector'))";
        }

        // Search by location
        if ($location) {
            if (is_array($location)) // by array of ids
                $sql .= " AND (`products`.`id` IN (SELECT `vacancy_id` FROM `products_locations` WHERE `location_id` IN ('" . implode("','", $location) . "')))";
            else // by id
                $sql .= " AND (`products`.`id` IN (SELECT `vacancy_id` FROM `products_locations` WHERE `location_id` = '$location'))";
        }

        if ($orderBy = 'DESC')
            $sql .= " ORDER BY `products`.`id` DESC";

        if ($limit)
            $sql .= " LIMIT $limit";

        $products = self::fetchAll(self::query($sql));

        if (is_array($products) && count($products)) {
            foreach ($products as $vacancy) {
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

        return $products;
    }

    public static function getSectors()
    {
        $sql = "
            SELECT *,  (SELECT COUNT(*) FROM products_sectors WHERE sector_id = sectors.id) AS total
            FROM `sectors`
            WHERE `deleted` = 'no'
            ORDER BY `name` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getSectorWhere($sid, $lid = false, $cid= false)
    {
        $sql = "
            SELECT COUNT(DISTINCT products.id) as counter FROM products 
            LEFT JOIN products_sectors ON products.id = products_sectors.vacancy_id 
            LEFT JOIN products_locations ON products.id = products_locations.vacancy_id 
            WHERE `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
            AND products_sectors.sector_id = '$sid'";
        if ($lid){
            $lids = "'" . implode( "' ,'" , $lid) . "'";
            $sql .= "AND products_locations.location_id IN ($lids)";
        }
        if ($cid){
            $cids = "'" . implode( "' ,'" , $cid) . "'";
            $sql .= "AND products.contract_type IN ($cids)";
        }

        $jobs =  self::fetchAll(self::query($sql));
        $jobs[0]->sector_id = $sid;

        return $jobs;

    }

    public static function getVacancySectors($vid)
    {
        $sql = "
            SELECT `products_sectors`.*, `sectors`.`name` as `sector_name`
            FROM `products_sectors`
            LEFT JOIN `sectors` ON `sectors`.`id` = `products_sectors`.`sector_id`
            WHERE `products_sectors`.`vacancy_id` = '$vid'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getVacancyLocations($vid)
    {
        $sql = "
            SELECT `products_locations`.*, `locations`.`name` as `location_name`
            FROM `products_locations`
            LEFT JOIN `locations` ON `locations`.`id` = `products_locations`.`location_id`
            WHERE `products_locations`.`vacancy_id` = '$vid'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getVacancyFunctions($vid)
    {
        $sql = "
            SELECT `products_functions`.*, `functions`.`name` as `function_name`
            FROM `products_functions`
            LEFT JOIN `functions` ON `functions`.`id` = `products_functions`.`function_id`
            WHERE `products_functions`.`vacancy_id` = '$vid'
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
            FROM `products_sectors` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function removeLocations($vid)
    {
        $sql = "
            DELETE 
            FROM `products_locations` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function removeFunctions($vid)
    {
        $sql = "
            DELETE 
            FROM `products_functions` 
            WHERE `vacancy_id` = '$vid'
        ";

        return self::query($sql);
    }

    public static function getproductsByConsultant($consultant_id, $limit = null)
    {
        $sql = "
            SELECT * from `products` 
            WHERE `consultant_id` = '$consultant_id'
            ORDER BY `time` DESC, `id` DESC
        ";

        if(is_numeric($limit))
            $sql .= " LIMIT $limit ";

        return self::fetchAll(self::query($sql));
    }
}

/* End of file */