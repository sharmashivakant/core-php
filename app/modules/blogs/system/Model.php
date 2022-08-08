<?php
class BlogsModel extends Model
{
    public $version = 0;

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

        switch ($version) {
        }

        foreach ($queries as $query)
            self::query($query);
    }

    /**
     * @param $slug
     * @return array|object|null
     */
    public static function getBySlug($slug)
    {
        $sql = "
        SELECT  `blog`.*,`users`.`firstname`,`users`.`lastname`
        FROM `blog`
        LEFT JOIN `users` ON `users`.`id` = `blog`.`consultant_id`
        WHERE `blog`.`slug` = '$slug' AND `blog`.`deleted` = 'no' AND `blog`.`posted` = 'yes'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getPrevBlog($id)
    {
        $sql = "
        SELECT *
        FROM `blog`
        WHERE `id` < '$id' AND `deleted` = 'no' AND `posted` = 'yes'
        ORDER BY `id` DESC
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    public static function getNextBlog($id)
    {
        $sql = "
        SELECT *
        FROM `blog`
        WHERE `id` > '$id' AND `deleted` = 'no' AND `posted` = 'yes'
        ORDER BY `id` DESC
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }



    public static function getAll($offset = 0, $is_featured = '0', $limit = 6, $keywords = false, $orderBy = 'DESC', $orderColumn = false)
    {
        $sql = "
             SELECT  `blog`.* FROM `blog` WHERE  `blog`.`deleted` = 'no' AND  `blog`.`posted` = 'yes'  AND  `blog`.`is_featured` = $is_featured";

        if ($orderBy = 'DESC' && $orderColumn)
            $sql .= " ORDER BY `$orderColumn` $orderBy";
        else
            $sql .= " ORDER BY `blog`.`id` DESC";

        if ($limit) {
            $sql .= " LIMIT $offset, $limit";
        }
//  echo $sql;
//  die;

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get recent blogs with limit
     * @return array
     */
    public static function getRecentBlogs($limit = 3)
    {
        $sql = "
        SELECT  `blog`.*,`blog_categories`.`name`,`blog_categories`.`color_code`
        FROM `blog`
        LEFT JOIN `blog_categories` ON `blog_categories`.`id` = `blog`.`sector`   
        WHERE `blog`.`deleted` = 'no' AND `blog`.`posted` = 'yes'
        ORDER BY `blog`.`id` DESC LIMIT $limit   
        ";

        return self::fetchAll(self::query($sql));
    }

    public static function getFeaturedBlogs($limit = 1)
    {
        $sql = "
        SELECT  `blog`.* FROM `blog` WHERE `blog`.`deleted` = 'no' AND `blog`.`posted` = 'yes' AND `blog`.`is_featured` = '1'
        ORDER BY `blog`.`time` DESC LIMIT $limit   
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * Get recent events with limit
     * @return array
     */
    public static function getRecentEvents($limit = 4)
    {
        $sql = "
        SELECT *
        FROM `event_card`
        WHERE `deleted` = 'no'
        ORDER BY `id` DESC LIMIT $limit
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * @param $slug
     * @return array|object|null
     */
    public static function getEventBySlug($slug)
    {
        $sql = "
        SELECT *
        FROM `event_card`
        WHERE `slug` = '$slug' AND `deleted` = 'no'
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
        SELECT `event_speakers`.*, `users`.`firstname`, `users`.`lastname`, `users`.`image`, `users`.`job_title`, `users`.`slug`
        FROM `event_speakers`
        LEFT JOIN `users` ON `users`.`id` = `event_speakers`.`user_id`
        WHERE `event_speakers`.`event_id` = '$vid'
        ";

        return self::fetchAll(self::query($sql));
    }

    /**
     * @param $slug
     * @return array|object|null
     */
    public static function getUserBySlug($slug)
    {
        $sql = "
        SELECT *
        FROM `users`
        WHERE `slug` = '$slug' AND `deleted` = 'no'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }

    /**
     * @param $slug
     * @return array|object|null
     */
    public static function getLocationById($id)
    {
        $sql = "
        SELECT name
        FROM `locations`
        WHERE `id` = '$id' AND `deleted` = 'no'
        LIMIT 1
        ";

        return self::fetch(self::query($sql));
    }


    public static function search($start = false, $from = false, $categories = false)
    {
        $sql = "
        SELECT *
        FROM `blog`
        WHERE `deleted` = 'no' AND `posted` = 'yes'
        ";

        if ($categories) {
            $categories = implode(",", $categories);
            $sql .= " AND `sector` IN ($categories)";
        }

        if ($from)
            $sql .= " AND `id` < $from";

        $sql .= " ORDER BY `time` DESC";

        if ($start) {
            $sql .= " LIMIT $start";
        }

        return self::fetchAll(self::query($sql));
    }


    /**
     * Get all
     * @return array
     */
    public static function getAllEvent($offset = 0, $sector = '')
    {

        if ($sector) {
            $sql = "
            SELECT *
            FROM `event_card`
            WHERE `deleted` = 'no' AND `sector` IN ($sector) ORDER BY `time` DESC LIMIT $offset, 4
            ";
        } else {
            $sql = "
            SELECT *
            FROM `event_card`
            WHERE `deleted` = 'no' ORDER BY `time` DESC LIMIT $offset, 4
            ";
        }

        return self::fetchAll(self::query($sql));
    }
}

/* End of file */