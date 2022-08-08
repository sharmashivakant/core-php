<?php
class JobsModel extends Model
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

    public static function get($slug)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `slug` = '$slug'
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

    public static function getNotThis($slug, $id)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `slug` = '$slug'
        AND `id` != '$id'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getNotThisRef($ref, $id)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `ref` = '$ref'
        AND `id` != '$id'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getByRef($ref)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `ref` = '$ref'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));

    }

    public static function search($keywords = false, $type = false, $sector = false, $location = false, $orderBy = false, $limit = false, $is_featured = 0, $vacancy_id = false, $salary = false, $offset = 0)
    {
        $sql = "
        SELECT *
        FROM `vacancies`
        WHERE `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
        ";

        if ($keywords)
            $sql .= " AND (`title` LIKE '%$keywords%' OR `content` LIKE '%$keywords%' OR `ref` LIKE '%$keywords%')";

        if ($type){
           
            if(is_array($type)) {
                $type = implode("','", $type);
                $sql .= " AND `contract_type` IN ('$type')";
            } else {
                $sql .= " AND `contract_type` = '$type'";
            }
        }
         if ($salary) {
            // echo "<pre>"; print_r($salary); die;
            $salary_range = $salary;
            $raw_where = '(';
            foreach ($salary_range as $key => $range) {
                list($salary_from, $salary_to) = explode('-', $range);
                $salary_from = (int) $salary_from;
                $salary_to = (int) $salary_to;

                $raw_where .= "(
                   (salary_value BETWEEN $salary_from AND $salary_to)
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


    public static function getSectors($where = false, $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM `sectors` WHERE `deleted` = 'no' ";

        if ($where)
            $sql .= $where;

        $sql .= "ORDER BY `name` ASC ";

        if ($limit)
            $sql .= " LIMIT $offset, $limit";

        return self::fetchAll(self::query($sql));
    }

    public static function getLocations($where = false, $limit = null, $offset = 0)
    {
        $sql = "SELECT * FROM `locations` WHERE `deleted` = 'no' ";
        
        if ($where)
            $sql .= $where;

        $sql .= "ORDER BY `name` ASC ";

        if ($limit)
            $sql .= " LIMIT $offset, $limit";

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get user by id
     * @param $id
     * @return array|object|null
     */
    public static function getUser($id)
    {
        $sql = "
        SELECT *
        FROM `users`
        WHERE `id` = '$id'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * Get user by email
     * @param $id
     * @return array|object|null
     */
    public static function getUserByEmail($email)
    {
        $sql = "
        SELECT *
        FROM `users`
        WHERE `email` = '$email'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getTestimonials($type="candidate", $user_id=false)
    {
        if($type=="user") {
            $sql = "
            SELECT *
            FROM `testimonials`
            WHERE `type` = '$type' and `user_image` = '$user_id' and  `deleted` = 'no'
            ORDER BY `name` ASC
            ";
        }
        else {
            $sql = "
            SELECT *
            FROM `testimonials`
            WHERE `type` = '$type' and  `deleted` = 'no'
            ORDER BY `name` ASC
            ";
        }

        return self::fetchAll(self::query($sql));
    }
    public static function getallTestimonials()
    {

        $sql = "
        SELECT *
        FROM `testimonials`
        WHERE `deleted` = 'no'
        ORDER BY `name` ASC
        ";   


        return self::fetchAll(self::query($sql));
    }
    
    public static function getclientLogos()  
    {
        $sql = "
        SELECT *
        FROM `client_logos`
        WHERE `deleted` = 'no'";

        return self::fetchAll(self::query($sql));
    }
    public static function getEmployerpagelogos()
    {
        $sql = "
        SELECT *
        FROM `employer_page_logos`
        WHERE `deleted` = 'no'";

        return self::fetchAll(self::query($sql));
    }
    public static function getRelatedjobs($sector)
    {

     $sql = "
     SELECT *
     FROM `vacancies`
     WHERE `deleted` = 'no' AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)
     ";
     if(is_array($sector)) {
        $sector = implode(",", $sector);
        $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` IN ('$sector') ))";
    } else {
        $sql .= " AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` = '$sector'))";
    }
    return self::fetchAll(self::query($sql));
}

public static function getVacanydetails($vid)
    {

        $sql = "
        SELECT ref, title
        FROM `vacancies`
        where `id` = '$vid' LIMIT 1
        ";
        return self::fetch(self::query($sql));
    }
}



/* End of file */