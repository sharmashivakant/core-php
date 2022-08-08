<?php
class Content_pagesModel extends Model
{
    public $version = 6; // increment it for auto-update

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
                $queries[] = "ALTER TABLE `content_pages_tree` MODIFY `type` enum('input','textarea','image', 'meta') NOT NULL DEFAULT 'textarea';";
            case '1':
                $queries[] = "ALTER TABLE `content_pages_tree` ADD COLUMN `image_width` varchar(200) DEFAULT NULL AFTER `type`;";
                $queries[] = "ALTER TABLE `content_pages_tree` ADD COLUMN `image_height` varchar(200) DEFAULT NULL AFTER `type`;";
            case '2':
                $queries[] = "ALTER TABLE `content_pages_tree` MODIFY `type` enum('input','textarea','image', 'meta', 'color') NOT NULL DEFAULT 'textarea';";
            case '3':
                $queries[] = "ALTER TABLE `content_pages_tree` MODIFY `type` enum('input','textarea','image','video', 'meta', 'color') NOT NULL DEFAULT 'textarea';";
            case '4':
                $queries[] = "ALTER TABLE `content_pages_tree` ADD COLUMN `video_type` varchar(200) DEFAULT 'youtube' AFTER `type`;";
            case '5':
                $queries[] = "ALTER TABLE `content_pages_tree` ADD COLUMN `lang` varchar(20) DEFAULT 'en' AFTER `type`;";
        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * Get content page by $id
     * @param $id
     * @return array|object|null
     */
    public static function get($id)
    {
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `id` = '$id'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * @return array
     */
    public static function getModules()
    {
        $sql = "
            SELECT DISTINCT `module` 
            FROM `content_pages_tree`
            ORDER BY `module` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getPages($module)
    {
        $sql = "
            SELECT DISTINCT `page`  
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `type` != 'meta' AND `type` != 'color'
            ORDER BY `page` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get all
     * @param bool $module
     * @param bool $page
     * @return array
     */
    public static function getBlocks($module = false, $page = false, $lang = false, $mode = 'object')
    {
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `type` != 'meta' 
        ";

        if ($lang && $lang !== false)
            $sql .= " AND `lang` = '$lang'";

        $sql .= " ORDER BY `position` ASC";

        return self::fetchAll(self::query($sql), $mode);
    }

    public static function getBlock($module = false, $page = false, $name = false, $lang = false)
    {
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `name` = '$name' AND `lang` = '$lang'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
    /**
     * @param $name
     * @return array|object|null
     */
    public static function getBlockByName($name)
    {
        $sql = "
            SELECT *
            FROM `content_blocks`
            WHERE `name` = '$name'
            LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }
}

/* End of file */