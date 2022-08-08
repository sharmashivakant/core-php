<?php
class PanelModel extends Model
{
    public $version = 0;

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
//            case '0':
//                $queries[] = "ALTER TABLE `modules` ADD COLUMN `image` varchar(100) DEFAULT NULL AFTER `time`;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Get user by $id
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

    public static function getValues($table, $column)
    {
        $sql = "
            SELECT `$column`
            FROM `$table`
        ";

        $result =  self::fetchAll(self::query($sql));
        $values = [];
        if ($result)
            foreach ($result as $v)
            {
                $values[] = $v->$column;
            }
        return $values;
    }

    public static function dataInsert( $table, $columns, $fields)
    {
        if (is_array($columns)) {
            $columnsString = '`' . implode("`, `", $columns) . '`';
        } else {
            $columnsString = $columns;
        }
        $fieldsString = '';
        foreach ($fields as $k => $field){
            if ($k == array_key_last($fields))
                $fieldsString .= "('" . implode("', '", $field) . "')";
            else
                $fieldsString .= "('" . implode("', '", $field) . "'), ";
        }

        $query = "INSERT INTO `$table` ($columnsString) VALUES $fieldsString;";

        self::query($query);
        return self::errno();


    }

    public static function getUsersOnline($minutes = 10)
    {
        $sql = "
            SELECT `id`, `nickname`, `email`, `role`, `last_time`
            FROM `users`
            WHERE `last_time` >= '" . (time() - $minutes * 60) . "'
        ";

        return self::query($sql);
    }

    // COUNTERS

    public static function countUsers($where = false)
    {
        $sql = "
            SELECT COUNT(`id`)
            FROM `users`
        ";

        if ($where)
            $sql .= "WHERE ".$where;

        return self::fetch(self::query($sql), 'row')[0];
    }


    /*---------- Guests ----------*/

    public static function countGuests($where = false)
    {
        $sql = "
            SELECT COUNT(`id`)
            FROM `guests`
        ";

        if ($where)
            $sql .= "WHERE ".$where;

        return self::fetch(self::query($sql), 'row')[0];
    }

    public static function getGuests($field, $search)
    {
        // TODO make count() instead select *
        $sql = "
            SELECT *
            FROM `guests`
        ";

        if ($field && $search)
            $sql .= "WHERE `$field` LIKE '%$search%'";

        return self::query($sql);
    }

    public static function getGuestsOnline($minutes = 10)
    {
        $sql = "
            SELECT INET_NTOA(`ip`) AS 'ip', `browser`, `referer`, `count`, `time`
            FROM `guests`
            WHERE `time` >= '" . (time() - $minutes * 60) . "'
        ";

        return self::query($sql);
    }
}

/* End of file */