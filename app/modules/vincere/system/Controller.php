<?php

class VincereController extends Controller
{
    protected $vincere_api_key      = "dda3ea6d-5859-4056-a1f5-7b21f5a417ed"; // API key - MANDATORY
    protected $vincere_client_id    = "8684ac0b-42d3-45d0-bd1d-10c87772a765"; // API Client ID - MANDATORY
    protected $vincere_domain       = "initi8"; // Domain name without .vincere.io - MANDATORY
    protected $vincere_login        = "aaron@boldidentities.com"; // OPTIONAL
    protected $vincere_password     = "U4eF60fHLK24"; // OPTIONAL

    // redirect_uri = https://amsource.io/dev/vincere

    public function indexAction()
    {
        if (!get('code')) {
            $params = array(
                "client_id" => $this->vincere_client_id,
                "state" => substr(md5(time()), 0, 10),
                "redirect_uri" => "https://bolddev7.co.uk/initi8/jobs",
                "response_type" => "code"
            );

            redirect("https://id.vincere.io/oauth2/authorize?" . http_build_query($params));
        } else {
            $params = array(
                "client_id" => $this->vincere_client_id,
                "code" => get('code'),
                "grant_type" => "authorization_code"
            );

            $access_token = get_contents('https://id.vincere.io/oauth2/token', NULL, $params);
            if ($access_token) {
                $json = json_decode($access_token);
                if ($json) {

                    $result = Model::insert('vincere_integration', array(
                        "access_token" => $json->access_token,
                        "refresh_token" => $json->refresh_token,
                        "id_token" => $json->id_token,
                        "expires_in" => $json->expires_in,
                        "time" => time()
                    ));
                    $insertID = Model::insertID();

                    if (!$result && $insertID)
                        echo "Website authorized, you can close this window";
                }
            }
            exit;
        }
    }

    public function cronjobAction()
    {

        header("Content-type:text/plain");

        $access_token = VincereModel::get([], "time", "DESC");

        if ($access_token && (time() > ($access_token->expires_in + $access_token->time))) {
            echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), trying to refresh token." . "\n";
            $params = array(
                "client_id" => $this->vincere_client_id,
                "grant_type" => "refresh_token",
                "refresh_token" => $access_token->refresh_token
            );

            $access_token_raw = get_contents("https://id.vincere.io/oauth2/token", NULL, $params);

            if ($access_token_raw) {
                $access_token_json = json_decode($access_token_raw);
                if ($access_token_json) {
                    echo "New access token received." . "\n";

                    $result = Model::insert('vincere_integration', array(
                        "access_token" => $access_token_json->access_token,
                        "refresh_token" => isset($access_token_json->refresh_token) && $access_token_json->refresh_token ? $access_token_json->refresh_token : $access_token->refresh_token,
                        "id_token" => $access_token_json->id_token,
                        "expires_in" => $access_token_json->expires_in,
                        "time" => time()
                    ));
                    $insertID = Model::insertID();

                    if (!$result && $insertID)
                        $access_token = VincereModel::get(array(), "time", "DESC");
                }
            }
        }

        if ($access_token && (time() < ($access_token->expires_in + $access_token->time))) {
            echo "Loading vacancies" . "\n";
            $vacancies = array();

            // INSTALLATION: fileds must be adjusted if required
            $matrix_vars = array(
                "fl" => implode(",", array(
                    "id",
                    "job_title",
                    "fe",
                    "sfe",
                    "industry",
                    "public_description",
                    "job_summary",
                    "open_date",
                    "closed_date",
                    "created_date",
                    "pay_rate",
                    "formatted_pay_rate",
                    "salary_from",
                    "formatted_salary_from",
                    "salary_to",
                    "formatted_salary_to",
                    "contract_length",
                    "location",
                    "job_type",
                    "employment_type",
                    //"published_date",
                    //"description",
                    "contact",
                    "salary_type",
                    "pay_interval",
                    "monthly_pay_rate",
                    "formatted_monthly_pay_rate",
                    "monthly_salary_from",
                    "formatted_monthly_salary_from",
                    "monthly_salary_to",
                    "formatted_monthly_salary_to",
                    "currency",
                    "company",
                    "owners",
                    "job_status",
                    // "status",
                    // "status_id"
                )),
                "sort" => "open_date desc"
            );
            $start = 0;
            $total = NULL;
            $attempts = 0;
            $limit = 100;

            do {
                echo "Loading vacancies " . $start . ".." . ($start + $limit) . "\n";
                $vacancies_raw = get_contents(
                    "https://" . $this->vincere_domain . ".vincere.io/api/v2/job/search/"
                        . implode(
                            ";",
                            array_map(
                                function ($key, $value) {
                                    return $key . "=" . $value;
                                },
                                array_keys($matrix_vars),
                                $matrix_vars
                            )
                        ),
                    array( // Installation: important part here!
                        //"q" => "private_job:0#open_date:[" . date("Y-m-d", strtotime("- 30 day")) . " TO *]#",  // This row filtering only open jobs that was open within last 30 days
                        //"q" => "private_job:0#closed_date:[" . date("Y-m-d") . " TO *]#",                                 // This row filtering only open jobs that have closing date in future.
                        // "q" => "private_job:0",  
                          
                        // One of option from above must be used depends on client's way of maintaining vacancies!
                        //"q" => "posted_on_website:1#",
                        "q" => "private_job:0#closed_date:[" . date("Y-m-d") . " TO *]#",
                        "start" => $start,
                        "limit" => $limit,
                    ),
                    NULL,
                    array(
                        "x-api-key:" . $this->vincere_api_key,
                        "id-token:" . $access_token->id_token,
                    )
                );


                if ($vacancies_raw) {
                    $vacancies_json = json_decode($vacancies_raw);

                    //print_data($vacancies_json);
                    //exit;

                    if ($vacancies_json && isset($vacancies_json->result) && isset($vacancies_json->result->total)) {
                        $total = $vacancies_json->result->total;
                        $vacancies = array_merge($vacancies, $vacancies_json->result->items);
                        $start += $limit;
                    } else {
                        $attempts++;
                    }
                } else {
                    $attempts++;
                }
            } while ($attempts < 5 && ($total === NULL || ($start < $total)));
            
            $remote_vacancies_ids = array();
            if (count($vacancies) > 0) {
                echo "Loaded " . count($vacancies) . " open vacancies in total" . "\n";

                Model::import('panel/vacancies');
                Model::import('panel/team');
                Model::import('panel/locations');
                Model::import('panel/sectors');
                foreach ($vacancies as $vacancy) {
                    if (!isset($vacancy->id) || !isset($vacancy->job_title) || $vacancy->job_status!="JOB_OPENED") {
                        continue;
                    }
                    
                    $ref = $vacancy->id;
                    $remote_vacancies_ids[] = $ref;
                    $consultant_id = 0;
                    //Way 1 to assign consultant - check contact object
                    if (isset($vacancy->contact) && isset($vacancy->contact->email)) {
                        $consultant = VincereModel::getUserByEmail(filter($vacancy->contact->email));

                        if ($consultant) {
                            $consultant_id = $consultant->id;
                        } 
                    }

                    // Installation: Proper way from above must be applied to assign consultant. Most of systems not allow publishing vacancies without consultants!
                    // if (!$consultant_id) {
                    //     echo "Vacancy #" . $vacancy->id . " " . $vacancy->job_title . " have no valid owner: " . (isset($vacancy->owners) ? var_export($vacancy->owners, TRUE) : "No data") . "\n";
                    // }

                    $contract_type = 'permanent';
                    if (isset($vacancy->job_type)) {
                        switch ($vacancy->job_type) { // Installation: Raw API data must be checked for more options
                            case 'CONTRACT':
                                $contract_type = 'contract';
                                break;
                            case 'PERMANENT':
                                $contract_type = 'permanent';
                                break;
                        }
                    }

                    $salary_type = 'salary';
                    $salary_value = 'Negotiable';
                    if (isset($vacancy->salary_type)) {
                        switch ($vacancy->salary_type) { // Installation: Raw API data must be checked for more options
                            case "DAILY":
                                $salary_type = 'daily';
                                break;
                            case "HOURLY":
                                $salary_type = 'hourly';
                                break;
                            case "ANNUAL":
                            default:
                                $salary_type = 'salary';
                                if ((isset($vacancy->salary_from) && floatval($vacancy->salary_from) > 0) || (isset($vacancy->salary_to) && floatval($vacancy->salary_to) > 0)) {
                                    $salary_parts = array();

                                    if (isset($vacancy->salary_from) && floatval($vacancy->salary_from) > 0) {
                                        $salary_parts[] = $vacancy->salary_from;
                                    }

                                    if (isset($vacancy->salary_to) && floatval($vacancy->salary_to) > 0) {
                                        $salary_parts[] = $vacancy->salary_to;
                                    }

                                    if (count($salary_parts) > 0)
                                        $salary_value = implode(" - ", $salary_parts);
                                } elseif (isset($vacancy->pay_rate) && $vacancy->pay_rate) {
                                    $salary_value = $vacancy->pay_rate;
                                }
                        }
                    }


                    $slug = makeSlug($vacancy->job_title);
                    $content_short =  isset($vacancy->public_description) ? strip_tags($vacancy->public_description) : '';
                    $trim_content = trim(preg_replace('/\s\s+/', ' ', $content_short));
                    $vacancy_data = array(
                        'title'         => filter($vacancy->job_title),
                        'ref'           => $ref,
                        'contract_type' => $contract_type,
                        //                        'contract_length' => isset($vacancy->contract_length) ? $vacancy->contract_length : NULL,
                        //                        'salary_type' => $salary_type,
                        'salary_value'  => filter($salary_value),
                        'salary_from' => filter($vacancy->salary_from),
                        'salary_to' => filter($vacancy->salary_to),
                        'content'       => isset($vacancy->public_description) ? filter($vacancy->public_description) : '',
                        'content_short' => mb_substr($trim_content,0,255),
                        'consultant_id' => $consultant_id,
                        //                        'client_name' => isset($vacancy->contact) ? $vacancy->contact->firstName . ' ' . $vacancy->contact->lastName : NULL,
                        //                        'client_email' => isset($vacancy->contact) && isset($vacancy->contact->email) ? $vacancy->contact->email : NULL,
                        //                        'postcode' => isset($vacancy->location) && isset($vacancy->location->post_code) && $vacancy->location->post_code ? $vacancy->location->post_code : NULL,
                        'meta_title'    => filter($vacancy->job_title),
                        'meta_desc'     => filter($vacancy->job_title),
                        'time'          => strtotime($vacancy->open_date),
                        'slug'          => filter($slug),
                        'time_expire'   => filter($vacancy->close_date),
                        'deleted' => 'no'
                    );

                    if (Model::count('vacancies', '*', "`ref` = '$ref'")) {
                        $db_vacancy = Model::getRow('vacancies', array('ref' => $ref));

                        $check_slug = Model::count('vacancies', '*', "`id` != '" . ($db_vacancy->id) . "' AND `slug` => '$slug'");
                        if ($check_slug > 0)
                            $vacancy_data['slug'] = makeSlug($vacancy->job_title) . '-' . $vacancy->id;

                        if ($db_vacancy->expiry_reason) {
                            echo "Vacancy ID " . $db_vacancy->id . " ignored. Expired: " . $db_vacancy->expiry_reason . "\n";
                            continue;
                        }
                        $updres = Model::updateRow('vacancies', $vacancy_data, array('id' => $db_vacancy->id));
                        if ($updres) {
                            // Locations
                            $actual_locations = array();
                            $actual_sectors = array();
                            if (isset($vacancy->location->city) && $vacancy->location->city) {
                                $location_name = trim($vacancy->location->city);

                                if (Model::countRows('locations', array('name' => $location_name))) {
                                    $location = Model::getRow('locations', ['name' => $location_name]);
                                    $actual_locations[] = $location->id;

                                    if (Model::countRows('vacancies_locations', ['vacancy_id' => $db_vacancy->id, 'location_id' => $location->id])) {
                                        Model::updateRow('vacancies_locations', ['vacancy_id' => $db_vacancy->id, 'location_id' => $location->id],array('vacancy_id' => $db_vacancy->id));
                                    } else {
                                        Model::insert('vacancies_locations', ['vacancy_id' => $db_vacancy->id, 'location_id' => $location->id]);
                                    }
                                } else {
                                    $res = Model::insert('locations', ['name' => $location_name]); // Insert row
                                    $insertID = Model::insertID();

                                    if ($insertID) {
                                        $actual_locations[] = $insertID;
                                        Model::insert('vacancies_locations', ['vacancy_id' => $db_vacancy->id, 'location_id' => $insertID]);
                                    }
                                }
                            }

                            // Industry sectors
                            if (isset($vacancy->industry) && is_array($vacancy->industry) && count($vacancy->industry)) {
                                foreach ($vacancy->industry as $industry) {
                                    $sector_name = trim($industry->description);

                                    if (Model::countRows('sectors', ['name' => $sector_name])) {
                                        $sector = Model::getRow('sectors', ['name' => $sector_name]);
                                        $actual_sectors[] = $sector->id;

                                        if (!Model::countRows('vacancies_sectors', ['vacancy_id' => $db_vacancy->id, 'sector_id' => $sector->id])) {
                                            Model::insert('vacancies_sectors', ['vacancy_id' => $db_vacancy->id, 'sector_id' => $sector->id]);
                                        }
                                    } else {
                                        $res = Model::insert('sectors', ['name' => $sector_name]); // Insert row
                                        $insertID = Model::insertID();

                                        if ($insertID) {
                                            $actual_locations[] = $insertID;
                                            Model::insert('vacancies_sectors', ['vacancy_id' => $db_vacancy->id, 'sector_id' => $insertID]);
                                        }
                                    }
                                }
                            }

                            Model::delete(
                                'vacancies_locations',
                                "`vacancy_id` = '" . ($db_vacancy->id) . "' AND NOT FIND_IN_SET(`location_id`, '" . implode("', '", $actual_locations) . "')"
                            );
                            Model::delete(
                                'vacancies_sectors',
                                "`vacancy_id` = '" . ($db_vacancy->id) . "' AND NOT FIND_IN_SET(`sector_id`, '" . implode("', '", $actual_sectors) . "')"
                            );
                        } 
                    } else {
                        $check_slug = Model::countRows('vacancies', array('slug' => $slug));
                        if ($check_slug > 0) {
                            $vacancy_data['slug'] = makeSlug($vacancy->job_title) . '-' . $vacancy->id;
                        }
                        $res = Model::insert('vacancies', $vacancy_data); // Insert row
                        $insertID = Model::insertID();

                        if ($insertID) {
                            $vacancy_id = $insertID;

                            if (isset($vacancy->location->city) && $vacancy->location->city) {
                                $location_name = trim($vacancy->location->city);

                                if (Model::countRows('locations', array('name' => $location_name))) {
                                    $location = Model::getRow('locations', ['name' => $location_name]);
                                    Model::insert('vacancies_locations', ['vacancy_id' => $vacancy_id, 'location_id' => $location->id]); // Insert row
                                } else {
                                    $res = Model::insert('locations', ['name' => $location_name]); // Insert row
                                    $insertID = Model::insertID();
                                    if ($insertID) {
                                        Model::insert('vacancies_locations', ['vacancy_id' => $vacancy_id, 'location_id' => $insertID]); // Insert row
                                    }
                                }
                            }

                            if (isset($vacancy->industry) && is_array($vacancy->industry) && count($vacancy->industry)) {
                                foreach ($vacancy->industry as $industry) {
                                    $sector_name = trim($industry->description);

                                    if (Model::countRows('sectors', ['name' => $sector_name])) {
                                        $sector = Model::getRow('sectors', ['name' => $sector_name]);
                                        Model::insert('vacancies_sectors', ['vacancy_id' => $vacancy_id, 'sector_id' => $sector->id]);
                                    } else {
                                        $res = Model::insert('sectors', ['name' => $sector_name]); // Insert row
                                        $insertID = Model::insertID();

                                        if ($insertID) {
                                            Model::insert('vacancies_sectors', ['vacancy_id' => $vacancy_id, 'sector_id' => $insertID]);
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "Database error on adding vacancy " . $ref . "\n";
                        }
                    }
                }
                
                $count_delete = VincereModel::jobCount($remote_vacancies_ids);
                if ($count_delete > 0) {
                    echo "Found " . $count_delete . " old vacancies, removing..." . "\n";

                    Model::update(
                        'vacancies',
                        ['deleted' => 'yes'],
                        "`vacancies`.`ref` NOT IN ('" . implode("','", $remote_vacancies_ids) . "')"
                    );
                }
                echo "Finished" . "\n";
            }
            
            // Delete if all are disable from vincere //
            if(empty($remote_vacancies_ids)) {
                Model::update(
                    'vacancies',
                    ['deleted' => 'yes']
                );
            }
            
        } else {
            echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), please refresh authorization." . "\n";
        }
        exit;
    }
    // Get Job Details API //
    public function getJobDetails($job_id="") {
        try {
            $access_token = VincereModel::get([], "time", "DESC");
    
            if ($access_token && (time() > ($access_token->expires_in + $access_token->time))) {
                echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), trying to refresh token." . "\n";
                $params = array(
                    "client_id" => $this->vincere_client_id,
                    "grant_type" => "refresh_token",
                    "refresh_token" => $access_token->refresh_token
                );
    
                $access_token_raw = get_contents("https://id.vincere.io/oauth2/token", NULL, $params);
    
                if ($access_token_raw) {
                    $access_token_json = json_decode($access_token_raw);
                    if ($access_token_json) {
                        echo "New access token received." . "\n";
    
                        $result = Model::insert('vincere_integration', array(
                            "access_token" => $access_token_json->access_token,
                            "refresh_token" => isset($access_token_json->refresh_token) && $access_token_json->refresh_token ? $access_token_json->refresh_token : $access_token->refresh_token,
                            "id_token" => $access_token_json->id_token,
                            "expires_in" => $access_token_json->expires_in,
                            "time" => time()
                        ));
                        $insertID = Model::insertID();
    
                        if (!$result && $insertID)
                            $access_token = VincereModel::get(array(), "time", "DESC");
                    }
                }
            }
    
            if ($access_token && (time() < ($access_token->expires_in + $access_token->time))) {
                // Get Job Details //
                $status = 0;
                $headers = array(
                                    "x-api-key:" . $this->vincere_api_key,
                                    "id-token:" . $access_token->id_token,
                                    "Content-Type:application/json" ,
                                );
                $details_url = "https://initi8.vincere.io/api/v2/position/".$job_id;
                $details_result = $this->curlRequest($details_url, [] , false, $headers);
                
                // print_data('JOB details ::::::::');
                // print_data($vacancy);
                
                if (isset($details_result['status_id'])) {
                    $status = $details_result['status_id'];
                } 
                return $status;
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    // Create Candidate on Vincere code start //
    public function exportCvAction() {
        try {
            Model::import('Cv');
            $cvs = CvModel::getAll();
            $count = 0;
                
            $access_token = VincereModel::get([], "time", "DESC");
    
            if ($access_token && (time() > ($access_token->expires_in + $access_token->time))) {
                echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), trying to refresh token." . "\n";
                $params = array(
                    "client_id" => $this->vincere_client_id,
                    "grant_type" => "refresh_token",
                    "refresh_token" => $access_token->refresh_token
                );
    
                $access_token_raw = get_contents("https://id.vincere.io/oauth2/token", NULL, $params);
    
                if ($access_token_raw) {
                    $access_token_json = json_decode($access_token_raw);
                    if ($access_token_json) {
                        echo "New access token received." . "\n";
    
                        $result = Model::insert('vincere_integration', array(
                            "access_token" => $access_token_json->access_token,
                            "refresh_token" => isset($access_token_json->refresh_token) && $access_token_json->refresh_token ? $access_token_json->refresh_token : $access_token->refresh_token,
                            "id_token" => $access_token_json->id_token,
                            "expires_in" => $access_token_json->expires_in,
                            "time" => time()
                        ));
                        $insertID = Model::insertID();
    
                        if (!$result && $insertID)
                            $access_token = VincereModel::get(array(), "time", "DESC");
                    }
                }
            }
    
            if ($access_token && (time() < ($access_token->expires_in + $access_token->time))) {
                echo "saving cvs" . "\n";
                if ($cvs) {
                    foreach ($cvs as $single) {
                        if ($single->cv) {
                            // Insert Candidate //
                            $headers = array(
                                                "x-api-key:" . $this->vincere_api_key,
                                                "id-token:" . $access_token->id_token,
                                                "Content-Type:application/json" ,
                                            );
                            $full_name = $single->name;
                            $parts = explode(" ", $full_name);
                            if(count($parts) > 1) {
                                $lastname = array_pop($parts);
                                $firstname = implode(" ", $parts);
                            }
                            else
                            {
                                $firstname = $full_name;
                                $lastname = "NA";
                            }
    
                            Model::import('Jobs');
                            $get_job = JobsModel::getVacanydetails($single->vacancy_id);
                            //print_r(SITE_URL.'app/data/cvs/'.$single->cv); die();
                            //echo "here";
                            //$this->associateCvAction(406784, 6806);
                            $myObj = new stdClass();
                            $myObj->first_name = $firstname;
                            $myObj->last_name = $lastname;
                            $myObj->mobile = $single->tel;
                            $myObj->email = $single->email;
                            $myObj->candidate_source_id = 29093;
                            $myObj->registration_date = date("Y-m-d")."T00:00:00.000Z";
                            $myObj->linked_in = $single->linkedin ? $single->linkedin : "";
                            $insert_data = json_encode($myObj);
                            $insert_url = "https://initi8.vincere.io/api/v2/candidate";
                            $insert_result = $this->curlRequest($insert_url, $insert_data, true, $headers); 
                            if (isset($insert_result['id'])) {
                                $this->uploadCvAction($single, $insert_result['id']);
                                if ($get_job->ref) {
                                    $this->associateCvAction($insert_result['id'], $get_job->ref);
                                }
                            } 
                        }
                        $count++;
                    }
                    echo json_encode(["Total saved records" => $count, "date" => date("Y-m-d h:i:s")]);
                }
                echo "finished" . "\n";
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
        die;
    }
    // Upload CV on vincere //
    public function uploadCvAction($data, $candidate_id) {
        try {
            $access_token = VincereModel::get([], "time", "DESC");
    
            if ($access_token && (time() > ($access_token->expires_in + $access_token->time))) {
                echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), trying to refresh token." . "\n";
                $params = array(
                    "client_id" => $this->vincere_client_id,
                    "grant_type" => "refresh_token",
                    "refresh_token" => $access_token->refresh_token
                );
    
                $access_token_raw = get_contents("https://id.vincere.io/oauth2/token", NULL, $params);
    
                if ($access_token_raw) {
                    $access_token_json = json_decode($access_token_raw);
                    if ($access_token_json) {
                        echo "New access token received." . "\n";
    
                        $result = Model::insert('vincere_integration', array(
                            "access_token" => $access_token_json->access_token,
                            "refresh_token" => isset($access_token_json->refresh_token) && $access_token_json->refresh_token ? $access_token_json->refresh_token : $access_token->refresh_token,
                            "id_token" => $access_token_json->id_token,
                            "expires_in" => $access_token_json->expires_in,
                            "time" => time()
                        ));
                        $insertID = Model::insertID();
    
                        if (!$result && $insertID)
                            $access_token = VincereModel::get(array(), "time", "DESC");
                    }
                }
            }
    
            if ($access_token && (time() < ($access_token->expires_in + $access_token->time))) {
                if ($data) {
                        if ($data->cv) {
                            $headers = array(
                                                "x-api-key:" . $this->vincere_api_key,
                                                "id-token:" . $access_token->id_token,
                                                "Content-Type:application/json" ,
                                            );
                            
                            $myObj = new stdClass();
                            $myObj->file_name = $data->cv;
                            $myObj->document_type_id = 1;
                            $myObj->url = SITE_URL.'app/data/cvs/'.$data->cv;
                            $myObj->original_cv = true;
                            $insert_data = json_encode($myObj);
                            $insert_url = "https://initi8.vincere.io/api/v2/candidate/".$candidate_id."/file";
                            $insert_result = $this->curlRequest($insert_url, $insert_data, true, $headers); 
                        }
                }
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
        //die;
    }
    // Associate candidate to job on vincere //
    public function associateCvAction($candidate_id, $job_id) {
        try {
            $access_token = VincereModel::get([], "time", "DESC");
    
            if ($access_token && (time() > ($access_token->expires_in + $access_token->time))) {
                echo "Access to Remote API expired (" . date("Y-m-d H:i:s", ($access_token->expires_in + $access_token->time)) . "), trying to refresh token." . "\n";
                $params = array(
                    "client_id" => $this->vincere_client_id,
                    "grant_type" => "refresh_token",
                    "refresh_token" => $access_token->refresh_token
                );
    
                $access_token_raw = get_contents("https://id.vincere.io/oauth2/token", NULL, $params);
    
                if ($access_token_raw) {
                    $access_token_json = json_decode($access_token_raw);
                    if ($access_token_json) {
                        echo "New access token received." . "\n";
    
                        $result = Model::insert('vincere_integration', array(
                            "access_token" => $access_token_json->access_token,
                            "refresh_token" => isset($access_token_json->refresh_token) && $access_token_json->refresh_token ? $access_token_json->refresh_token : $access_token->refresh_token,
                            "id_token" => $access_token_json->id_token,
                            "expires_in" => $access_token_json->expires_in,
                            "time" => time()
                        ));
                        $insertID = Model::insertID();
    
                        if (!$result && $insertID)
                            $access_token = VincereModel::get(array(), "time", "DESC");
                    }
                }
            }
    
            if ($access_token && (time() < ($access_token->expires_in + $access_token->time))) {
                if ($candidate_id) {
                    $headers = array(
                                        "x-api-key:" . $this->vincere_api_key,
                                        "id-token:" . $access_token->id_token,
                                        "Content-Type:application/json" ,
                                    );
                    
                    $myObj = new stdClass();
                    $myObj->candidate_id = $candidate_id;
                    $myObj->job_id = $job_id;
                    $myObj->stage = "SHORTLISTED";
                    $myObj->registration_date = date("Y-m-d")."T00:00:00.000Z";
                    $insert_data = json_encode($myObj);
                    $insert_url = "https://initi8.vincere.io/api/v2/application";
                    $insert_result = $this->curlRequest($insert_url, $insert_data, true, $headers); 
                }
            }
        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }
        die;
    }
    public function curlRequest($url, $data = [], $postMethod = false, $headers = []) {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            if($postMethod) {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }

            $result=curl_exec ($ch);
            curl_close ($ch);
            return json_decode($result, true);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
/* End of file */