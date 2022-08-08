<?php
class Case_studiesModel extends Model
{
    public $version = 4; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `case_studies` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `title` varchar(200) NOT NULL,
                `subtitle` varchar(200) DEFAULT NULL,
                `image` varchar(60) DEFAULT NULL,
                `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                `meta_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `meta_keywords` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `meta_desc` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                `slug` varchar(200) NOT NULL DEFAULT '',
                `posted` enum('no','yes') DEFAULT 'yes',
                `deleted` enum('no','yes') DEFAULT 'no',
                `time` int(10) unsigned NOT NULL,
                PRIMARY KEY (`id`),
                INDEX (`slug`)
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
                $queries[] = "ALTER TABLE `case_studies` ADD COLUMN `subtitle2` varchar(200) DEFAULT NULL AFTER `subtitle`;";

            case '1':
                $queries[] = "ALTER TABLE `case_studies` ADD COLUMN `content_before` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL AFTER `content`;";

            case '2':
                $queries[] = "ALTER TABLE `case_studies` ADD COLUMN `sector` int(10) unsigned DEFAULT NULL AFTER `content_before`;";

            case '3':
                $queries[] = "ALTER TABLE `case_studies` ADD COLUMN `posted` enum('no','yes') DEFAULT 'yes' AFTER `slug`;";

            case '4':
                $queries[] = "ALTER TABLE `case_studies` ADD COLUMN `consultant_id` int(10) unsigned DEFAULT NULL AFTER `title`;";
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
            FROM `case_studies`
            WHERE `id` = '$id'
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
            FROM `case_studies`
            WHERE `deleted` = 'no'
        ";

        return self::fetchAll(self::query($sql));
    }
}

/* End of file */