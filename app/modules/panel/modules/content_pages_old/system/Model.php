<?php
class Content_pagesModel extends Model
{
    public $version = 3; // increment it for auto-update

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
                $queries[] = "ALTER TABLE `content_pages_tree` ADD COLUMN `video_type` varchar(200) DEFAULT 'youtube' AFTER `type`;";
            case '2':
                $queries[] = "ALTER TABLE `content_pages_tree` MODIFY `type` enum('input','textarea','image', 'meta', 'page_name') NOT NULL DEFAULT 'textarea';";
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
            WHERE `module` = '$module' AND `type` != 'meta'
            ORDER BY `page` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getPagesNames($module)
    {
        $sql = "
            SELECT `page`, `name`, `content`  
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `type` != 'meta'
            AND `name` = 'page_name'
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get all
     * @param bool $module
     * @param bool $page
     * @return array
     */
    public static function getBlocks($module = false, $page = false)
    {
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `type` != 'meta' AND `type` != 'page_name'
            ORDER BY `position` ASC
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getBlock($module = false, $page = false, $name = false)
    {
        $sql = "
            SELECT *
            FROM `content_pages_tree`
            WHERE `module` = '$module' AND `page` = '$page' AND `name` = '$name'
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