<?php
class PageModel extends Model
{
    public $version = 3;

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `modules` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
               `version` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
               `time` int(10) unsigned NOT NULL,
               PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `guests` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `ip` varchar(30) DEFAULT NULL,
               `browser` varchar(255) DEFAULT NULL,
               `referer` varchar(255) DEFAULT NULL,
               `count` int(11) NOT NULL DEFAULT '0',
               `time` int(11) UNSIGNED NOT NULL,
               PRIMARY KEY (`id`),
               UNIQUE KEY (`ip`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `logs` (
               `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
               `user_id` int(10) unsigned DEFAULT 0,
               `where` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
               `error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
               `status` enum('mysql','php') DEFAULT 'mysql',
               `time` varchar(20) DEFAULT '',
               PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;",

            "CREATE TABLE IF NOT EXISTS `users` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `email` varchar(60) NOT NULL,
                `password` varchar(60) DEFAULT '',
                `role` enum('unconfirmed','user','moder','admin') DEFAULT 'unconfirmed',
                `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `title` varchar(100) DEFAULT NULL DEFAULT '',
                `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `tel` varchar(30) NOT NULL DEFAULT '',
                `skype` varchar(100) NOT NULL DEFAULT '',
                `twitter` varchar(100) NOT NULL DEFAULT '',
                `linkedin` varchar(150) NOT NULL DEFAULT '',
                `image` varchar(100) NOT NULL DEFAULT '',
                `slug` varchar(100) NOT NULL DEFAULT '',
                `deleted` enum('no','yes') DEFAULT 'no',
                `reg_time` int(10) unsigned NOT NULL,
                `last_time` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY (`email`)
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
                $queries[] = "INSERT INTO `users` (`id`, `email`, `password`, `role`, `firstname`, `lastname`, `title`, `slug`, `deleted`, `reg_time`, `last_time`) VALUES
                    (1, 'sb@gmail.com', 'e4cdb80ed5c4a1b345bdc4ffc97c42e2', 'admin', 'Bohdan', 'Shloser', 'PHP Developer', 'bohdan-shloser', 'no', 1581189342, 1585141182);";

            case '1':
                $queries[] = "CREATE TABLE IF NOT EXISTS `subscribers` (
                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                   `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                   `time` varchar(20) DEFAULT '',
                   PRIMARY KEY (`id`),
                   UNIQUE KEY (`email`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;";

            case '2':
                $queries[] = "CREATE TABLE IF NOT EXISTS `content_pages_tree` (
                   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                   `module` varchar(100) NOT NULL,
                   `page` varchar(50) NOT NULL,
                   `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                   `alias` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                   `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                   `type` enum('input','textarea','image') NOT NULL DEFAULT 'textarea',
                   `position` int(10) unsigned DEFAULT '0',
                   `time` int(10) unsigned NOT NULL,
                   PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    public static function getAllServices()
    {
        $sql = "
            SELECT *
            FROM `services` ORDER BY id DESC";

        return self::fetchAll(self::query($sql));
    }

    public static function getAllPermanentServices($id)
    {
        $sql = "
            SELECT *
            FROM `services`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getSectors()
    {
        $sql = "
            SELECT *
            FROM `sectors`
            WHERE `deleted` = 'no'
            ORDER BY `id` ASC
        ";

        $sectors = self::fetchAll(self::query($sql));

        if (is_array($sectors) && count($sectors)) {
            foreach ($sectors as $sector) {
                // Vacancies
                $sector->vacancies = array();
                $vacancies = self::getSectorVacancies($sector->id);

                if (is_array($vacancies) && count($vacancies))
                    foreach ($vacancies as $vacancy)
                        $sector->vacancies[] = $vacancy;
            }
        }

        return $sectors;
    }

    public static function getSectorVacancies($sid)
    {
        $sql = "
            SELECT *
            FROM `vacancies`
            WHERE `deleted` = 'no' AND (`id` IN (SELECT `vacancy_id` FROM `vacancies_sectors` WHERE `sector_id` = '$sid'))
            LIMIT 5
        ";

        $vacancies = self::fetchAll(self::query($sql));

        if (is_array($vacancies) && count($vacancies)) {
            foreach ($vacancies as $vacancy) {
                // Locations
                $vacancy->locations = array();
                $locations = self::getVacancyLocations($vacancy->id);

                if (is_array($locations) && count($locations))
                    foreach ($locations as $location)
                        $vacancy->locations[] = $location;
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


   public static function checkContentPage($name = false, $module = CONTROLLER, $page = ACTION ,$lang= false)
    {
       
        if($lang!=''){   
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `name` = '$name' AND `lang`='$lang'
            LIMIT 1
        ";
        }else {
         $sql = "    
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `name` = '$name'
            LIMIT 1
        ";   
        }
        return self::fetch(self::query($sql));
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
     * @param $email
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

    /**
     * Get guest by id
     * @param $id
     * @return array|object|null
     */
    public static function getGuestByID($id)
    {
        $sql = "
            SELECT *
            FROM `guests`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
    public static function getClientlogos()
    {
        $sql = "
            SELECT *
            FROM `client_logos`
            WHERE `deleted` = 'no'
            ORDER BY `id` DESC
        ";

        return self::fetchAll(self::query($sql));
    }
    public static function getHomeimages()
    {
        $sql = "
            SELECT *
            FROM `home_page_images`
            WHERE `deleted` = 'no'
            ORDER BY `id` ASC
        ";

        return self::fetchAll(self::query($sql));
    }
    public static function getcititec_way()
    {
        $sql = "
            SELECT *
            FROM `cititec_way`
            WHERE `deleted` = 'no'
            ORDER BY `id` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get guest by ip
     * @param $ip
     * @return array|object|null
     */
    public static function getGuestByIP($ip)
    {
        $sql = "
            SELECT *
            FROM `guests`
            WHERE `ip` = '$ip'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * Update last visit time & etc.. in preDispatch
     * @param $id
     * @param $data
     * @return string
     */
    public static function updateUserByID($id, $data)
    {
        return self::update('users', $data, "`id` = '$id' LIMIT 1");
    }
    public static function getComunities()
    {
        $sql = "
            SELECT *
            FROM `communities`
            WHERE `deleted` = 'no'
            ORDER BY `id` ASC
        ";

        return self::fetchAll(self::query($sql));
    }
}

/* End of file */