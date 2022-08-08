<?php
class TalentsModel extends Model
{
    public $version = 1;

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {
        $queries = array(

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
                $queries[] = "CREATE TABLE `talent_password_protection` (
                              `id` int(11) NOT NULL AUTO_INCREMENT,
                              `areas`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `password` varchar (255) NOT NULL,
                              `protection` tinyint(1) DEFAULT 0,
                               PRIMARY KEY (`id`)
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 COLLATE=utf8mb4_unicode_ci ;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    public static function getUserByEmail($email)
    {
        $sql = "
            SELECT *
            FROM `talent_users`
            WHERE `email` = '$email' 
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

}

/* End of file */