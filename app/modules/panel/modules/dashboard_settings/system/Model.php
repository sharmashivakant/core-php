<?php
class Dashboard_settingsModel extends Model
{
    public $version = 1; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `dashboard_settings` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `table` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `where` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `status` enum('active','inactive') DEFAULT 'active',
                `deleted` enum('no','yes') DEFAULT 'no',
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
                $queries[] = "INSERT INTO `dashboard_settings` (`id`, `title`, `table`, `where`, `status`, `deleted`) VALUES
                    (1, 'Jobs Listed', 'vacancies', '', 'inactive', 'no'),
                    (2, 'Blog Posts', 'blog', '', 'active', 'no'),
                    (3, 'Uploaded Vacancies', 'cv_library', '`deleted` = &#039;no&#039; AND `vacancy_id` = &#039;0&#039;', 'active', 'no'),
                    (4, 'Email subscribers', 'subscribers', '', 'active', 'no'),
                    (5, 'Team', 'users', '', 'active', 'no'),
                    (6, 'Job Applications', 'cv_library', '`deleted` = &#039;no&#039; AND `vacancy_id` != &#039;0&#039;', 'active', 'no');";
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
            FROM `dashboard_settings`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * Get all
     * @return array
     */
    public static function getAll($status = false, $limit = false)
    {
        if ($status && $status != 'inactive')
            $status = 'active';

        $sql = "
            SELECT *
            FROM `dashboard_settings`
            WHERE `deleted` = 'no'
        ";

        if ($status)
            $sql .= " AND `status` = '$status'";

        if ($limit)
            $sql .= " LIMIT $limit";

        $result = self::fetchAll(self::query($sql));

        if (is_array($result) && count($result))
            foreach ($result as $item) {
                $item->count = self::count($item->table, '*', reFilter($item->where));
            }

        return $result;
    }
}

/* End of file */