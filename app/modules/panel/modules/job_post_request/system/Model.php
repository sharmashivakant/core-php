<?php
class Job_post_requestModel extends Model
{
    public $version = 1; // increment it for auto-update

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
                $queries[] = "CREATE TABLE IF NOT EXISTS `talent_pool_cv` (
                  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `cv` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
                  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                  `deleted` enum('no','yes') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
                  `time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '',
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * @param $id
     * @return array|object|null
     */
    public static function get($id)
    {
        $sql = "
            SELECT *
            FROM `posted_jobs`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getWhere($where = false)
    {
        $sql = "
            SELECT *
            FROM `posted_jobs`
            WHERE `deleted` = 'no'
        ";
        if ($where)
            $sql .= " AND $where";

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
            FROM `posted_jobs`
            WHERE `deleted` = 'no'
        ";   

        return self::fetchAll(self::query($sql));
    }

    public static function getCv($id)
    {
        $sql = "
            SELECT *
            FROM `talent_pool_cv`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
}

/* End of file */