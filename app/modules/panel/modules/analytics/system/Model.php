<?php
class AnalyticsModel extends Model
{
    public $version = 1; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `settings`(
                `name` VARCHAR(150) NOT NULL,
                `title` VARCHAR(150) NOT NULL,
                `value` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY(`name`)
            ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ;"
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
                $queries[] = "CREATE TABLE IF NOT EXISTS `refer_friend` (
                  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `friend_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `friend_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `tel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `friend_tel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `deleted` enum('no','yes') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
                  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `time` int UNSIGNED NOT NULL DEFAULT 0,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Get setting by $name
     * @param $name
     * @return array|object|null
     */
    public static function get($name)
    {
        $sql = "
            SELECT *
            FROM `settings`
            WHERE `name` = '$name'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * Get all
     * @return array
     */
    public static function getAll()
    {
        $sql = "
            SELECT *
            FROM `settings`
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * @param bool $name
     * @param string $countField
     * @return mixed
     */
    public static function count_rows($name = false, $countField = '*')
    {
        if ($countField === '*')
            $countFieldPart = $countField;
        else
            $countFieldPart = '`'.$countField.'`';

        $sql = "
            SELECT COUNT($countFieldPart)
            FROM `settings`
        ";

        if ($name)
            $sql .= "WHERE `name` = '$name'";

        return self::fetch(self::query($sql), 'row')[0];
    }
}

/* End of file */