<?php

class JobsController extends Controller
{
    use Validator;

    public function indexAction()
    {
        $keywords = post('keywords');
        $type     = post('type');
        $sector   = post('sector');
        $location = post('location');
        $salary = post('salary');
        $offset = post('offset');

        $list      = JobsModel::search($keywords, $type, $sector, false, false, DATA_LIMIT, 0, false, $salary, 0);

        $this->view->list      = $list['vacancies'];
        $this->view->vacancy_count = $list['count'];
        $this->view->sectors   = JobsModel::getSectors();
        $this->view->locations = JobsModel::getLocations();
        $this->view->limit = DATA_LIMIT;
        $this->view->total_pages = ceil(($this->view->vacancy_count) / $this->view->limit);
        // $count = Model::count('vacancies', '*', "`deleted` = 'no'");
        // Tech stack icons
        Model::import('panel/tech_stack');
        $this->view->tech_list = Tech_stackModel::getArrayWithID();

        Request::setTitle('Search Jobs');
        Request::setKeywords('');
        Request::setDescription('');
    }

    public function viewAction()
    {

        $slug = Request::getUri(0);
        $this->view->job = JobsModel::get($slug);
        /*echo '<pre>';   
        print_r($this->view->job);
        die;*/
        $data['views'] = '++';
        Model::update('vacancies', $data, "`id` = '" . $this->view->job->id . "'");

        $this->view->consultant = JobsModel::getUser($this->view->job->consultant_id);
        
        $sectors = $this->view->job->sector_ids;
        /*echo '<pre>';
        print_r($this->view->job);
        print_r($this->view->job->sector_ids);
        die;*/
        $this->view->locations = JobsModel::getLocations();
        //$sectors = JobsModel::getSectors();
         //$this->view->sectors = $sectors;
        //$listJob = JobsModel::search(false, false, false, false,'DESC',3);

        $this->view->list      = $listJob['vacancies'];   
        $jobID=$this->view->job->id;
        $related_jobs = JobsModel::search(false,false, $sectors,false,false,3,0,$jobID,false,0);

        $this->view->related_jobs = $related_jobs['vacancies'];

        Request::setTitle('Job - ' . $this->view->job->title);
    }  

    public function job_searchAction()
    {
        $slug = Request::getUri(0);
        $this->view->job = JobsModel::get($slug);
        Request::setTitle('Job search');
        Request::setKeywords('');
        Request::setDescription('');
       /*  Request::ajaxPart();

        $keywords   = post('keywords');
        $type       = post('type');
        $sector     = post('sector');
        $location   = post('location');

        // Tech stack icons
        Model::import('panel/tech_stack');
        $this->view->tech_list = Tech_stackModel::getArrayWithID();

        $this->view->list = JobsModel::search($keywords, $type, $sector, $location, false, 30);

        Request::addResponse('html', '#search_results_box', $this->getView()); */
    }

    public function candidateAction()
    {
        //Request::ajaxPart();

       $slug = Request::getUri(0);
        $this->view->job = JobsModel::get($slug);
         $list      = JobsModel::search($keywords, $type, $sector, false, false, 3, 0, false, $salary, 0);
        $this->view->list      = $list['vacancies'];
        Request::setTitle('Candidate');
        Request::setKeywords('');
        Request::setDescription('');
    }

    public function employerAction()
    {
        $slug = Request::getUri(0);

        $featured_jobs = JobsModel::search('','','','','',3,1);
        $this->view->featured_jobs = $featured_jobs;
        Model::import('common');
        $this->view->employerpagelogos = JobsModel::getEmployerpagelogos();  
        $this->view->case_studies = CommonModel::getCaseStudies(3);
        $this->view->client_logos = JobsModel::getclientLogos();
        $this->view->testimonials = JobsModel::getallTestimonials();

        $count = Model::count('testimonials', '*', "`deleted` = 'no' and `type` = 'employer'");
        $modules = $count%2;
        if ($modules == 1) {
            $final_count =  (int)($count/2)+1;
        }
        else {
            $final_count =  $count/2;
        }

        $this->view->testimonials_count = $final_count;

        Model::import('page');

        $this->view->page_desc = PageModel::checkContentPage('short-description', 'page', 'employers');

        Request::setTitle('Employer');
        Request::setKeywords('');
        Request::setDescription('');
    }

    public function apply_nowAction()
    {
        Request::ajaxPart();

        $slug = Request::getUri(0);
        $this->view->job = JobsModel::get($slug);

        if (!$this->view->job)
            redirect(url('jobs'));

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('tel',              'Contact Number',       'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('linkedin',         'LinkedIn',             'trim|min_length[0]|max_length[100]|url');
            $this->validatePost('message',          'Further information',  'trim|min_length[1]|max_length[100]');
            $this->validatePost('cv_field',         'CV',                   'required|trim|min_length[0]|max_length[100]');
            /*  $this->validatePost('check',            'Agree',                'required|trim|min_length[0]|max_length[100]'); */

            if ($this->isValid()) {
                $data = array(
                    'vacancy_id' => $this->view->job->id,
                    'name'       => post('name'),
                    'email'      => post('email'),
                    'tel'        => post('tel'),
                    'linkedin'   => post('linkedin'),
                    'message'    => post('message'),
                    'cv'         => post('cv_field'),
                    'time'       => time()
                );

                // Copy CV
                if ($data['cv']) {
                    if (!File::copy('data/tmp/' . $data['cv'], 'data/cvs/' . $data['cv']))
                        print_data(error_get_last());
                }

                $consultant = JobsModel::getUser($this->view->job->consultant_id);
                $this->view->data = $data;

                // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;
                 //  host setting for mail
                $mail->IsSMTP();
                $mail->Mailer = "smtp";
                $mail->Host = SMTP_HOST;
                $mail->Port = SMTP_PORT; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                // End of host details setting

                // Mail to client/consultant
                $mail->IsHTML(true);
                $noreply_mail = AnalyticsModel::get('noreply_mail');
                if ($noreply_mail->value)
                    $select_noreply_mail = $noreply_mail->value;
                else
                    $select_noreply_mail = NOREPLY_MAIL;

                $noreply_name = AnalyticsModel::get('noreply_name');
                if ($noreply_name->value)
                    $select_noreply_name = $noreply_name->value;
                else
                    $select_noreply_name = NOREPLY_NAME;

                $mail->SetFrom($select_noreply_mail, $select_noreply_name);

                $mail->AddAddress($consultant->email); //ADMIN_MAIL
                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;  
                $mail->AddAddress($admin_mail);
                
//                $mail->AddAddress('tom@boldidentities.com'); //ADMIN_MAIL
//                $mail->AddAddress('shloserb@gmail.com'); //ADMIN_MAIL

                $mail->Subject =  "New application received | " . SITE_NAME;      
                $mail->Body = $this->getView('modules/jobs/views/email_templates/apply_now.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv']));

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsSMTP();
                $user_mail->Mailer = "smtp";
                $user_mail->Host = SMTP_HOST;
                $user_mail->Port = SMTP_PORT; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                $user_mail->SMTPAuth = true;
                $user_mail->SMTPSecure = 'tls';
                $user_mail->Username = SMTP_USERNAME;
                $user_mail->Password = SMTP_PASSWORD;
                // End of host details setting   
                //job details 
                //job details   
                $jobDetails=JobsModel::get($slug);
                $jobLink=SITE_URL.'job/'.$jobDetails->slug; 
                $this->view->jobtitle = $jobDetails->title;
                $this->view->jobLink = $jobLink;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom(NOREPLY_MAIL, NOREPLY_NAME);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;
                $user_mail->Subject = "Thank you for applying with " . SITE_NAME;
                $user_mail->Body = $this->getView('modules/jobs/views/email_templates/user_apply_now.php');
                $user_mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                /*$user_mail->Body =  "Hi ".$data['name'].",<br><br>
                <p>Thank you for applying for <a href='".$jobLink."'>".$jobDetails->title."</a></p>    
                <p>Your application will be passed on to the relevant member of our team, who will be in touch to discuss your enquiry shortly.</p>
                <p>Thank you,</p>
                <p>The " . SITE_NAME . " Team.</p>  
                <img src='".$baseUrl."app/public/images/email-logo.png'>";*/
                $sendUserStatus = false;
                if ($user_mail->Send())   
                    $sendUserStatus = true;

                $result   = Model::insert('cv_library', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#apply_form', '<h3 class="title-small">Thank you! ' . ($sendStatus ? '' : '-') . '</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }

    public function latest_rolesAction()
    {
        Request::ajaxPart();

        // Tech stack icons
        Model::import('panel/tech_stack');
        $this->view->tech_list = Tech_stackModel::getArrayWithID();

        $this->view->list = JobsModel::search(false, false, false, false, 'DESC', 9);

        Request::addResponse('html', '.roles-slider', $this->getView());
        Request::addResponse('func', 'latestRolesSlider', '.roles-slider');
    }


    public function searchAction()    
    {
        Request::ajaxPart();

        $limit = DATA_LIMIT;
        $keywords   = post('keywords');
        $page = post('page');
        $type       = (post('type')) ? explode(",", post('type')) : '';
        $sector     = (post('sector')) ? explode(",", post('sector')) : '';
        $location   = post('location');
        $salary = ( post('salary') ) ? explode( ",", post('salary') ) : '';
        $offset =  $page ? ($page - 1) * $limit : 0;

        // Tech stack icons
        Model::import('panel/tech_stack');
        $this->view->tech_list = Tech_stackModel::getArrayWithID();

        $list = JobsModel::search($keywords, $type, $sector, $location, 'DESC', $limit, 0, false, $salary, $offset);
        $count = $list['count'];
        $vacancy_count = count($list['vacancies']);
        if (!empty($list['vacancies'])) {
      
            foreach ($list['vacancies'] as $single_item) {
                
             $data .=' <div class="job-content-card  job-content-card-lg green-block">
                    <h4 class="heading">'.$single_item->title.'</h4>
                    <span class="location-ico">'.implode(", ", array_map(function ($location) { return $location->location_name; }, $single_item->locations)).'</span>
                    <span class="money-ico">';
                         if($single_item->salary_value!=''){
                             $data .=(($single_item->salary_value) ? CURRENCY_SYMBOL.$single_item->salary_value : '00.00');
                       }else{
                         $data .= (($single_item->salary_from) ? CURRENCY_SYMBOL.$single_item->salary_from . ' - ' : '')  . ( ($single_item->salary_to) ?CURRENCY_SYMBOL . $single_item->salary_to : ''); 
                     }
                     $data .='</span>
                    <p class="para-heading" >'.reFilter($single_item->content_short).'</p>
                    <a href="'.SITE_URL.'job/'.$single_item->slug.'" class="arrow-ico"></a>
                </div>';  
                
            }
           
            $offset = $offset + $limit;
        } else {
            $data = "<div class='no-record'><center><h4> No Result found</h4></center></div>";
            $offset = 0;
        }

        // pagination content
        $pagination = "";
        $total_pages = ceil(($count) / $limit);
        if(!empty($total_pages) && $total_pages > 1):
             $pagination.=' <span class="prev" data-id="0"  id="prevPage" ><a href="#" class="back-arrow"></a></span>';
            for($i = 1; $i <= $total_pages; $i++):  
                if($i == $page):
                    $pagination .= ' <span class="para-heading page-item disabled" id="pageContent'. $i .'" data-id="'. $i .'"><a class="page-link" href="javascript:void(0)" tabindex="-1">'. $i .'</a></span>';
                else:
                    $pagination .= '<span class="para-heading page-item" id="pageContent'. $i .'" data-id="'. $i .'"><a class="page-link" href="javascript:void(0)" tabindex="-1">'. $i .'</a></span>';
                endif;
            endfor; 
             $pagination .='<span class="next" data-id="2"  id="nextPage" >
             <a href="#" class="next-arrow "></a></span>';
        endif;
        //  end of pagination

        echo json_encode(array(
            'offset' => $offset,
            'html' => $data,
            'count' => $count,
            'vacancy_count' => $vacancy_count,
            'pagination' => $pagination,
        ));
        exit;
    }
    //post a new job by user 
    public function post_jobAction()
    {
        Request::ajaxPart();

        $slug = Request::getUri(0);


        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[3]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('tel',            'Phone',       'required|trim|min_length[8]|max_length[12]');
            $this->validatePost('message',          'Message',  'required|trim|min_length[6]|max_length[1000]');         
           /* $this->validatePost('job_specification',         'Job Specification',             'trim|min_length[0]|max_length[100]|url');
           */



           if ($this->isValid()) {
            $data = array(
                'name'       => post('name'),
                'email'      => post('email'),
                'tel'        => post('tel'),
                'job_specification'   => post('job_specification'),
                'message'    => post('message'),
                'time'       => time()
            );

 // Copy job_specification
            if ($data['job_specification']) {
                if (!File::copy('data/tmp/' . $data['job_specification'], 'data/cvs/' . $data['job_specification']))
                    print_data(error_get_last());
            }
            $this->view->data = $data;
                // Send email to admin
            require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
            $mail = new PHPMailer;
                 //  host setting for mail
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->Host = SMTP_HOST;
                $mail->Port = SMTP_PORT; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Username = SMTP_USERNAME;
                $mail->Password = SMTP_PASSWORD;
                // End of host details setting

                // Mail to client/consultant
                $mail->IsHTML(true);
                $noreply_mail = AnalyticsModel::get('noreply_mail');
                if ($noreply_mail->value)
                    $select_noreply_mail = $noreply_mail->value;
                else
                    $select_noreply_mail = NOREPLY_MAIL;

                $noreply_name = AnalyticsModel::get('noreply_name');
                if ($noreply_name->value)
                    $select_noreply_name = $noreply_name->value;
                else
                    $select_noreply_name = NOREPLY_NAME;

                $mail->SetFrom($select_noreply_mail, $select_noreply_name);

                $mail->AddAddress($consultant->email); //ADMIN_MAIL
                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;
                $mail->AddAddress($admin_mail);
                
//                $mail->AddAddress('tom@boldidentities.com'); //ADMIN_MAIL
//                $mail->AddAddress('shloserb@gmail.com'); //ADMIN_MAIL

                $mail->Subject =  "New Job Posted | " . SITE_NAME;    
                $mail->Body = $this->getView('modules/jobs/views/email_templates/job_post.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['job_specification'], 'job_specification.' . File::format($data['job_specification']));

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsSMTP();
                $user_mail->Mailer = "smtp";
                $user_mail->Host = SMTP_HOST;
                $user_mail->Port = SMTP_PORT; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                $user_mail->SMTPAuth = true;
                $user_mail->SMTPSecure = 'tls';
                $user_mail->Username = SMTP_USERNAME;
                $user_mail->Password = SMTP_PASSWORD;
                // End of host details setting
                $user_mail->IsHTML(true);
                $user_mail->SetFrom(NOREPLY_MAIL, NOREPLY_NAME);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;
                $user_mail->Subject = "Thank you for posting job at " . SITE_NAME;
                $user_mail->Body =  "Hi ".$data['name'].",<br><br>
                <p>Thank you for posting at " . SITE_NAME . ".</p>
                <p>We will be in touch to discuss your enquiry shortly.</p>  
                <p>Thank you,</p>
                <p>The " . SITE_NAME . " Team.</p>  
                <img src='".$baseUrl."app/public/images/email-logo.png'>";
                $sendUserStatus = false;
                if ($user_mail->Send())   
                    $sendUserStatus = true;

                $result   = Model::insert('posted_jobs', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#job_post_form', '<h3 class="title-small">Thank you! ' . ($sendStatus ? '' : '-') . '</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }

    public function broadbeanAction()
    {

        $response = '<?xml version="1.0" encoding="utf-8"?>';

        file_put_contents('./log_'.date("j.n.Y").'.log','run', FILE_APPEND);

        if(isset($_POST))
        {

            try {

                $postData = file_get_contents('php://input');
                $xml = simplexml_load_string($postData);

                // $xml = '<job>
                // <command>add</command>
                // <username>bobsmith</username>
                // <password>p455w0rd</password>
                // <contact_name>Bob Smith</contact_name>
                // <contact_email>bob@smith.com</contact_email>
                // <contact_telephone>020 7987 6900</contact_telephone>
                // <contact_url>www.smith.com</contact_url>
                // <days_to_advertise>7</days_to_advertise>
                // <application_email>bob.12345.123@smith.aplitrak.com</application_email>
                // <application_url>http://www.url.com/ad.asp?adid=12345123</application_url>
                // <job_reference>abc123</job_reference>
                // <job_title>Test Engineer</job_title>
                // <job_type>Contract</job_type>
                // <job_duration>6 Months</job_duration>
                // <job_job_startdate>ASAP</job_job_startdate>
                // <job_skills>VB, C++, PERL, Java</job_skills>
                // <job_description>ssssThis is the detailed description</job_description>
                // <job_location>London</job_location>
                // <job_industry>Marketing</job_industry>
                // <salary_currency>gbp</salary_currency>
                // <salary_from>25000</salary_from>
                // <salary_to>30000</salary_to>
                // <salary_per>annum</salary_per>
                // <salary_benefits>Bonus and Pension</salary_benefits>
                // <salary>£25000 - £30000 per annum + Bonus and Pension</salary>
                // </job>'; 
                // $xml = simplexml_load_string($xml);

                if ($xml === false) {
               // die('Error parsing XML'); 
                  $response .= '<response>Error parsing XML</response>';
                  header("Content-type: text/xml; charset=utf-8");
                  echo $response;
                  die;  
              }

              $json = json_encode($xml);
              $vacancies = json_decode($json,TRUE);

          // $CI->load->model('vacancies_model');
          // $CI->load->model('team_model');
          // $CI->load->model('locations_model');
          // $CI->load->model('industry_sectors_model');

              $contract_type = 'permanent';
              if ($vacancies['job_type']) {
                $contract_type = $vacancies['job_type'];
            }
            $salary_type = $vacancies['salary_per'];
            $slug = preg_replace("/[^a-zA-Z0-9]+/is", "-", strtolower(trim($vacancies['job_title']))) . '-' . preg_replace("/[^a-zA-Z0-9]+/is", "-", strtolower(trim($vacancies['job_reference'])));

            if ($vacancies['contact_email']) {
                $consultantEmail = $vacancies['contact_email'];
                if ($consultant = JobsModel::getUserByEmail($consultantEmail)) {
                // echo "<pre>"; print_r($consultant); die;
                    $consultant_id = $consultant->id;
                } 
                else
                {
                    $consultantslug = preg_replace("/[^a-zA-Z0-9]+/is", "-", strtolower(trim($vacancies['contact_name'])));
                    $password = md5($vacancies['password']);
                    $consultant_data = array(
                        'firstname' => $vacancies['contact_name'],
                        'lastname' => '',
                        'email' => $vacancies['contact_email'],
                        'tel' => $vacancies['contact_telephone'],
                        'password' => $password,
                        'image' => '',
                        'title' => '',
                        'description' => '',
                        'linkedin' => '',
                        'twitter' => '',
                        'skype' => '',
                        'slug' => $consultantslug,
                        'deleted' => 0,
                        'role' => 'moder',
                        'active'=> 'YES',
                    );
                    Model::insert('users', $consultant_data);
                    $consultant_id = Model::insertID();
                }
            }

            $job_startdate = '';
            if (strpos($vacancies['job_startdate'] , '/' ) !== false) {

                $date_start =  str_replace('/', '-', $vacancies['job_startdate']);
                $job_startdate = date("Y-m-d H:i:s", strtotime($date_start));

            }

        // $ExpiryDate = '';
        // if (strpos($vacancies['ExpiryDate'] , '/' ) !== false) {

        //     $date_expiry =  str_replace('/', '-', $vacancies['ExpiryDate']);
        //     $ExpiryDate = date("Y-m-d H:i:s", strtotime($date_expiry));

        // }


            $vacancy_data = array(
                'title' => $vacancies['job_title'],
                'ref'=> $vacancies['job_reference'],
                'contract_type' => $contract_type,
                'salary_type' => $salary_type,
                'salary_value' => $vacancies['salary'],
                'content_short' => '',
                'content' => $vacancies['job_description'],
                'consultant_id' => $consultant_id,
                'client_name' => $vacancies['contact_name'],
                'client_email' => $vacancies['application_email'],
                'client_tel' => $vacancies['contact_telephone'],
                'client_twitter' => '',
                'postcode' => '',
                'meta_title' => SITE_NAME . ' | ' . $vacancies['job_title'],
                'meta_keywords' => '',
                'meta_desc' => $vacancies['job_title'],
                'deleted' => 'no',
                'expire_reason' => '',
                'slug' => $slug,
                'views' => 0,
                'salary_from' => $vacancies['salary_from'],
                'salary_to' => $vacancies['salary_to'],
            );

            $check_vancancy = JobsModel::getByRef($vacancies['job_reference']);

            if($check_vancancy > 0 ) {

                $vacancyStatus = Model::update('vacancies', $vacancy_data, "`ref` = '" . $vacancies['job_reference'] . "'");
                if ($vacancyStatus) {

                    $vacancy_id = $check_vancancy->id;

                    if ($vacancies['job_location']) {

                        $location_name = trim($vacancies['job_location']);

                        $location = JobsModel::getLocations("And `name` LIKE '$location_name'");
                        if ($location) {
                            model::insert('vacancies_locations', array('vacancy_id' => $vacancy_id, 'location_id' => $location->id));
                        } else {
                            Model::insert('locations', ['name' => $location_name]);
                            $location_id = Model::insertID();
                            if($location_id) {
                                model::insert('vacancies_locations', array('vacancy_id' => $vacancy_id, 'location_id' => $location_id));
                            }
                        }
                    }

                    if ($vacancies['job_industry']) {
                        $sector_name = trim($vacancies['job_industry']);

                        $sector = JobsModel::getSectors("And `name` LIKE '$sector_name'");
                        if ($sector) {
                            model::insert('vacancies_sectors', array('vacancy_id' => $vacancy_id, 'sector_id' => $sector->id));
                        } else {
                            Model::insert('sectors', ['name' => $sector_name]);
                            $sector_id = Model::insertID();
                            if ($sector_id) {
                                model::insert('vacancies_sectors', array('vacancy_id' => $vacancy_id, 'sector_id' => $sector_id));
                            }
                        }
                    }

                    echo  "Your Vacancy Record updated Successfully";
                    exit();
                }else {
                    echo "Database error on updated vacancy";
                    exit();
                }

            } else {

                if (model::insert('vacancies', $vacancy_data)) {
                    $vacancy_id = Model::insertID();

                    if ($vacancies['job_location']) {

                        $location_name = trim($vacancies['job_location']);

                        $location = JobsModel::getLocations("And `name` LIKE '$location_name'");
                        if ($location) {
                            model::insert('vacancies_locations', array('vacancy_id' => $vacancy_id, 'location_id' => $location->id));
                        } else {
                            Model::insert('locations', ['name' => $location_name]);
                            $location_id = Model::insertID();
                            if($location_id) {
                                model::insert('vacancies_locations', array('vacancy_id' => $vacancy_id, 'location_id' => $location_id));
                            }
                        }
                    }

                    if ($vacancies['job_industry']) {
                        $sector_name = trim($vacancies['job_industry']);

                        $sector = JobsModel::getSectors("And `name` LIKE '$sector_name'");
                        if ($sector) {
                            model::insert('vacancies_sectors', array('vacancy_id' => $vacancy_id, 'sector_id' => $sector->id));
                        } else {
                            Model::insert('sectors', ['name' => $sector_name]);
                            $sector_id = Model::insertID();
                            if ($sector_id) {
                                model::insert('vacancies_sectors', array('vacancy_id' => $vacancy_id, 'sector_id' => $sector_id));
                            }
                        }
                    }

                    //echo "Advert has been posted successfully";
                    file_put_contents('./log_'.date("j.n.Y").'.log', 'Advert has been posted successfully', FILE_APPEND);
                    $response .= '<response>Advert has been posted successfully</response>';
                    echo $response;
                    exit();

                } else {
                    //echo "Database error on adding vacancy";
                    file_put_contents('./log_'.date("j.n.Y").'.log', 'Database error on adding vacancy', FILE_APPEND);
                    $response .= '<response>Database error on adding vacancy</response>';
                    header("Content-type: text/xml; charset=utf-8");
                    echo $response;
                    exit();
                }
            }

        }catch(Exception $e) {
          //echo 'Message: ' .$e->getMessage();
          file_put_contents('./log_'.date("j.n.Y").'.log', $e->getMessage(), FILE_APPEND);
          $response .= '<response>'.$e->getMessage().'</response>';
          header("Content-type: text/xml; charset=utf-8");
          echo $response;
          exit();
      }
  }
  else
  {
            //echo "You are not authorized to access this URL.";
   $response .= '<response>You are not authorized to access this URL.</response>';
   header("Content-type: text/xml; charset=utf-8");
   echo $response;
   exit();
}  
}

}
/* End of file */