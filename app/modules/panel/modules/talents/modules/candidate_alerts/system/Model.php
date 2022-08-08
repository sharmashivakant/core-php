<?php
class Candidate_alertsModel extends Model
{
    public $version = 0; // increment it for auto-update

    /**
     * Method module_install start automatically if it not exist in `modules` table at first importing of model
     */
    public function module_install()
    {

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
     * Get user by $id
     * @param $id
     * @return array|object|null
     */
    public static function get($id)
    {
        $sql = "
            SELECT *
            FROM `talent_candidate_alerts`
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
            FROM `talent_candidate_alerts`
            WHERE `deleted` = 'no'
        ";

        $candidate_alerts=self::fetchAll(self::query($sql));
        if($candidate_alerts){
             foreach ($candidate_alerts as $requestsitem) {
             $profile = self::getopenprofile($requestsitem->area_id);
              $requestsitem->openprofile = $profile;
            
        }
        }
        
        return $candidate_alerts;
}
 public static function getopenprofile($id)
    {
        $sql = "
            SELECT *
            FROM `talent_open_profiles`
            WHERE `id` = '$id'
            LIMIT 1
        ";
        
      $profile=self::fetch(self::query($sql));
        return $profile->job_title;;
    }
}

/* End of file */