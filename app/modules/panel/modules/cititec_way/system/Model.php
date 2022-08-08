<?php
class Cititec_wayModel extends Model
{
    public $version = 1; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        // $queries = array(
        //     "CREATE TABLE IF NOT EXISTS `client_logos` (
        //         `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
        //         `name` varchar(200) NOT NULL,
        //         `image` varchar(60) DEFAULT NULL,
        //         `book_link` varchar(200) NOT NULL,
        //         `site_link` varchar(200) NOT NULL,
        //         `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
        //         `deleted` enum('no','yes') DEFAULT 'no',
        //         PRIMARY KEY (`id`)
        //     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;"
        // );

        // foreach ($queries as $query)
        //     self::query($query);
    }  

    /**
     * Method module_update start automatically if current $version != version in `modules` table, and start from "case 'i'", where i = prev version in modules` table
     * @param int $version
     */
    public function module_update($version)
    {
        // $queries = array();

        // switch ($version) {
        //     case '0':
        //         $queries[] = "ALTER TABLE `testimonials` MODIFY `book_link` varchar(200) DEFAULT NULL AFTER `image`;";
        //         $queries[] = "ALTER TABLE `testimonials` MODIFY `site_link` varchar(200) DEFAULT NULL AFTER `book_link`;";
        // }

        // foreach ($queries as $query)
        //     self::query($query);
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
            FROM `cititec_way`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        $event = self::fetch(self::query($sql));

        return $event;
    }

    /**
     * Get all
     * @return array
     */
    public static function getAll()
    {
        $sql = "
            SELECT *
            FROM `cititec_way`
            WHERE `deleted` = 'no'
        ";

        return self::fetchAll(self::query($sql));
    }

}

/* End of file */