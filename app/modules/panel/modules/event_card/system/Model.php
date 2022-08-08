<?php
class Event_cardModel extends Model
{
    public $version = 1; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(
            "CREATE TABLE IF NOT EXISTS `event_card` (
                `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                `name` varchar(200) NOT NULL,
                `image` varchar(60) DEFAULT NULL,
                `book_link` varchar(200) NOT NULL,
                `site_link` varchar(200) NOT NULL,
                `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
                $queries[] = "ALTER TABLE `testimonials` MODIFY `book_link` varchar(200) DEFAULT NULL AFTER `image`;";
                $queries[] = "ALTER TABLE `testimonials` MODIFY `site_link` varchar(200) DEFAULT NULL AFTER `book_link`;";
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
            FROM `event_card`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        $event = self::fetch(self::query($sql));
        if ($event) {
            // Users
            $event->user_ids = array();
            $event->users = array();
            $users = self::getEventUsers($event->id);

            if (is_array($users) && count($users)) {
                foreach ($users as $user) {
                    $event->user_ids[] = $user->user_id;
                    $event->users[] = $user;
                }
            }
        }

        return $event;
    }

    public static function getEventUsers($vid)
    {
        $sql = "
            SELECT `event_speakers`.*, `users`.`firstname` as `user_name`
            FROM `event_speakers`
            LEFT JOIN `users` ON `users`.`id` = `event_speakers`.`user_id`
            WHERE `event_speakers`.`event_id` = '$vid'
        ";

        return self::fetchAll(self::query($sql));
    }
    /**
     * Get all
     * @return array
     */
    public static function getAll()
    {
        $sql = "
            SELECT *
            FROM `event_card`
            WHERE `deleted` = 'no'
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function removeEventUsers($vid)
    {
        $sql = "
            DELETE 
            FROM `event_speakers` 
            WHERE `event_id` = '$vid'
        ";

        return self::query($sql);
    }
}

/* End of file */