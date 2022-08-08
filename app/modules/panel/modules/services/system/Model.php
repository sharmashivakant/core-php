<?php
class ServicesModel extends Model
{
    public $version = 6;

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

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Get user by $id
     * @param $id
     * @return array|object|null
     */
    public static function getService($id)
    {
        $sql = "
            SELECT *
            FROM `services`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }



    /**
     * Get all users
     * @return array
     */
    public static function getAllServices()
    {
        $sql = "
            SELECT *
            FROM `services`;
        ";

        return self::fetchAll(self::query($sql));
    }



    public static function countServices($where = false)
    {
        $sql = "
            SELECT COUNT(`id`)
            FROM `services`
        ";

        if ($where)
            $sql .= "WHERE " . $where;

        return self::fetch(self::query($sql), 'row')[0];
    }


    public static function getServiceImage($id)
    {
        $sql = "
            SELECT *
            FROM `image`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }


    public static function removeService($sid)
    {
        $sql = "
            DELETE 
            FROM `services` 
            WHERE `id` = '$sid'
        ";

        return self::query($sql);
    }
}

/* End of file */