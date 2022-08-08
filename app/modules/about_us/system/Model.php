<?php
class About_usModel extends Model
{
    public $version = 1;

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array();

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

        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * @return array
     */
    public static function getUsers($where)
    {
        $sql = "
            SELECT *
            FROM `users`
            WHERE `deleted` = 'no'
        ";

        if ($where)
            $sql .= $where;

        return self::fetchAll(self::query($sql));
    }
 
    public static function getUser($slug)
    {
        $sql = "
            SELECT *
            FROM `users`
            WHERE `slug` = '$slug' AND `deleted` = 'no'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getUserByID($id)
    {
        $sql = "
            SELECT *
            FROM `users`
            WHERE `id` = '$id' AND `deleted` = 'no'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
     public static function getcititecbenefits()
    {
        $sql = "
            SELECT *
            FROM `cititec_benefits`
            WHERE  `deleted` = 'no'
        ";

         return self::fetchAll(self::query($sql));
    }
       public static function search($keywords = false, $type = false, $sector = false, $location = false, $orderBy = false, $limit = false, $is_featured = 0, $vacancy_id = false, $salary = false, $offset = 0)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `deleted` = 'no' AND `internal_job` = '1'  AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
        ";

        if ($keywords)
            $sql .= " AND (`title` LIKE '%$keywords%' OR `content` LIKE '%$keywords%' OR `ref` LIKE '%$keywords%')";

        if ($type)
            $sql .= " AND `contract_type` = '$type'";

        if ($salary) {
            // echo "<pre>"; print_r($salary); die;
            $salary_range = $salary;
            $raw_where = '(';
            foreach ($salary_range as $key => $range) {
                list($salary_from, $salary_to) = explode('-', $range);
                $salary_from = (int) $salary_from;
                $salary_to = (int) $salary_to;

                $raw_where .= "(
                    (salary_from >= $salary_from AND salary_from <= $salary_to)
                    OR
                    (salary_to >= $salary_from AND salary_to <= $salary_to)
                )";
                $raw_where .= $key + 1 < count($salary_range) ? ' OR ' : ''; 
            }
            $raw_where .= ')';

            $sql .= " AND $raw_where";
        }

        if ($sector && $vacancy_id){
            if(is_array($sector)) {
                $sector = implode(",", $sector);
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` IN ($sector) AND `vacancy_id` !=$vacancy_id))";
            } else {
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` = '$sector' AND `vacancy_id` !=$vacancy_id))";
            }
        }

        if ($sector && !$vacancy_id) {

            if(is_array($sector)) {
                $sector = implode(",", $sector);
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` IN ($sector) ))";
            } else {
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` = '$sector'))";
            }

        }

        if ($location) {

            if(is_array($location)) {
                $location = implode(",", $location);
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_locations` WHERE `location_id` IN ($location) ))";
            } else {
                $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_locations` WHERE `location_id` IN  ($location) ))";
            }

        }

        if ($is_featured==1)
            $sql .= " AND `is_featured` = 1";

        if ($orderBy = 'DESC')
            $sql .= " ORDER BY `id` DESC";

        $total_vacancies = self::fetchAll(self::query($sql));
        $vacancies_count = count($total_vacancies);

        if ($limit)
            $sql .= " LIMIT $offset, $limit";

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

        $data['count'] = $vacancies_count;
        $data['vacancies'] = $vacancies;
        return $data;
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
    public static function getTeam($limit = false)
     {
        if ($limit) {
            $sql = "
            SELECT *
            FROM `users`
            WHERE `deleted` = 'no' AND is_featured = '1' AND id != '9' order by sort LIMIT $limit
            ";
        }
        else {
            $sql = "
            SELECT *
            FROM `users`
            WHERE `deleted` = 'no' AND is_featured = '1' AND id != '9'  order by sort
            ";
        }

        return self::fetchAll(self::query($sql));
    }
    
}

/* End of file */