<?php

class Open_profileController extends Controller
{
    use Validator;

    protected $layout = 'layout_talent';

    public function indexAction()
    {
    }

    public function viewAction()
    {
        $id = Request::getUri(0);

        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
        if (!$this->view->profile)
            redirect(url('/'));

        // module protections
        $acess = getSession('acess');
        $protection = Model::fetch(Model::select('talent_password_protection'));
        $areas = explode('||', trim($protection->areas, '|'));

        if (in_array('open_profiles', $areas) && $acess !== 'yes')
            redirectAny(url("talent/protection?url=talent/open_profile/" . $this->view->profile->id));

        $this->view->tc = Model::fetch(Model::select('your_tc'));

        Request::setTitle('Profile - ' . $this->view->profile->job_title);
    }

    public function candidate_alertAction()
    {
        Request::ajaxPart();

        $id = Request::getUri(0);
        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
        $this->view->candidate_name=$this->view->profile->candidate_name;

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('company_name',     'Company Name',         'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('postcode',         'Postcode/Zip',         'required|trim');
            //$this->validatePost('skills_keywords','Skills/Keywords',      'required');
            $this->validatePost('max_salary',       'Max_salary',           'required|trim|min_length[1]|max_length[255]');
            $this->validatePost('salary_term',      'Salary Term',          'required|trim|min_length[1]|max_length[50]');
            $this->validatePost('check',            'Agree',                'required');
           
            if ($this->isValid()) {
                 $skillsArr=post('skills_keywords');
            if($skillsArr[0]!=''){
            $skillsData=implode(",",$skillsArr);
                $data = array(
                    'area'             => 'Open profile',
                    'area_id'          => $this->view->profile->id,
                    'name'             => post('name'),
                    'email'            => post('email'),
                    'company_name'     => post('company_name'),
                    'postcode'         => post('postcode'),
                    'skills_keywords'  => $skillsData,
                    'max_salary'       => post('max_salary'),
                    'salary_term'      => post('salary_term'),
                    'time'             => time()
                );

                $this->view->area = 'Open profile';
                $this->view->area_id = $this->view->profile->id;
                 $this->view->data=$data; 
                 $this->view->job_title=$this->view->profile->job_title;

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
               

                // Mail to client/consultant
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

                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;  
                $consultant_email=$this->view->profile->consultant->email;       
                $mail->AddAddress($consultant_email);
                $mail->AddAddress($admin_mail);
                $mail->Subject = 'Candidate Alert';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/candidate_alert.php');   
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();     
                //user email
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
                $user_mail->IsHTML(true);
                $mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;     
                $user_mail->Subject ="Thank you for candidate alert";
                $user_mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/alert_thanks.php'); 
                $user_mail->AltBody =  'Note: Our emails are a lot nicer with HTML enabled!';
                $sendUserStatus = false;  
                if ($user_mail->Send())   
                    $sendUserStatus = true;

              /*  // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

                // Mail to client/consultant
                $mail->IsHTML(true);
                $mail->SetFrom(Request::getParam('noreply_mail')->value, Request::getParam('noreply_name')->value);
                $mail->AddAddress(Request::getParam('admin_mail')->value);


                $mail->Subject = 'Candidate Alert';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/candidate_alert.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->Send();*/

                $result = Model::insert('talent_candidate_alerts', $data);
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#apply_form', '<h3 style="font-size: 35px;">Thank you!</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            }else{
                  Request::returnError('Skill / Keyword is required!');
            
            } 
           
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
             
        }

        Request::addResponse('html', '#popup', $this->getView());
    }


    public function request_interviewAction()
    {
        Request::ajaxPart();

        $id = Request::getUri(0);
        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
        $this->view->candidate_name=$this->view->profile->candidate_name;

        if ($this->startValidation()) {
            //$this->validatePost('date',             'Date',                 'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('company_name',     'Company Name',         'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('tel',              'Telephone',            'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('check',            'Agree',                'required');

            if ($this->isValid()) {
                $data = array(
                    "request_type" => "interview",
                    "user_id"      =>  $this->view->profile->consultant_id,
                    "profile_type" => "open",
                    "profile_id"   =>  $this->view->profile->id,
                    "name"         => post('name'),
                    //"date"         => post('date'),
                    "company"      => post('company_name'),
                    "email"        => post('email'),
                    "tel"          => post('tel'),
                    "ip"           => $_SERVER['REMOTE_ADDR'],
                    "time"         => time()
                );
               $this->view->data=$data;
               $this->view->job_title=$this->view->profile->job_title;
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
               

                // Mail to client/consultant
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

                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;
                $consultant_email=$this->view->profile->consultant->email;  
                $mail->AddAddress($consultant_email);
                $mail->AddAddress($admin_mail);
                $mail->Subject = 'Request Interview';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/request_interview.php');   
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();   
                $this->view->data=$data;   
                //user email
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
                $user_mail->IsHTML(true);
                $mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;
                $user_mail->Subject = "Thank you for interview request";
                $user_mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/thanks.php'); 
                $user_mail->AltBody =  'Note: Our emails are a lot nicer with HTML enabled!';
                $sendUserStatus = false;  
                if ($user_mail->Send())   
                    $sendUserStatus = true;
           /*     // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

                // Mail to client/consultant
                $mail->IsHTML(true);
                $mail->SetFrom(Request::getParam('noreply_mail')->value, Request::getParam('noreply_name')->value);
                $mail->AddAddress(Request::getParam('admin_mail')->value);


                $mail->Subject = 'Request Interview';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/request_interview.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->Send();*/

                $result = Model::insert('talent_requests', $data);
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#apply_form', '<h3 style="font-size: 35px;">Thank you!</h3>');
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

    public function feedbackAction()
    {
        Request::ajaxPart();


        $id = Request::getUri(0);
        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('company',          'Company Name',         'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('check',            'Agree',                'required');

            if ($this->isValid()) {

                // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

                // Mail to client/consultant
                $mail->IsHTML(true);
                $mail->SetFrom(Request::getParam('noreply_mail')->value, Request::getParam('noreply_name')->value);
                $mail->AddAddress(Request::getParam('admin_mail')->value);


                $mail->Subject = 'Request Interview';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/feedback.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->Send();


                Request::addResponse('html', '#apply_form', '<h3 style="font-size: 35px;">Thank you!</h3>');
                Request::endAjax();

            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }


    public function bookAction()
    {
        Request::ajaxPart();

        $id = Request::getUri(0);
        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
      
        
        $this->view->candidate_name=$this->view->profile->candidate_name;
       

        if ($this->startValidation()) {
           // $this->validatePost('date',             'Date',                 'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('company_name',     'Company Name',         'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('tel',              'Telephone',            'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('check',            'Agree',                'required');

            if ($this->isValid()) {
                $data = array(
                    "request_type" => "book",
                    "user_id"      =>  $this->view->profile->consultant_id,
                    "profile_type" => "open",
                    "profile_id"   =>  $this->view->profile->id,
                    "name"         => post('name'),
                    //"date"         => post('date'),
                    "company"      => post('company_name'),
                    "email"        => post('email'),
                    "tel"          => post('tel'),
                    "ip"           => $_SERVER['REMOTE_ADDR'],
                    "time"         => time()
                );
                  $this->view->data=$data; 
                  $this->view->job_title=$this->view->profile->job_title;
                   
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
               

                // Mail to client/consultant
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

                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL; 
                $consultant_email=$this->view->profile->consultant->email;        
                $mail->AddAddress($consultant_email);
                $mail->AddAddress($admin_mail);
                $mail->Subject = 'Talent Vault full profile and CV request';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/book.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();     
                //user email
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
                $user_mail->IsHTML(true);
                $mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;
                $user_mail->Subject = "Thank you booking contract";
                $user_mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/thanks.php'); 
                $user_mail->AltBody =  'Note: Our emails are a lot nicer with HTML enabled!';
                $sendUserStatus = false;  
                if ($user_mail->Send())   
                    $sendUserStatus = true;
                //end user email

                $result = Model::insert('talent_requests', $data);
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#apply_form', '<h3 style="font-size: 35px;">Thank you!</h3>');
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

    public function request_infoAction()
    {
        Request::ajaxPart();

        $id = Request::getUri(0);
        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
        $this->view->candidate_name=$this->view->profile->candidate_name;

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('company_name',     'Company Name',         'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('tel',              'Telephone',            'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('check',            'Agree',                'required');

            if ($this->isValid()) {
                $data = array(
                    "request_type" => "further_info",
                    "user_id"      =>  $this->view->profile->consultant_id,
                    "profile_type" => "open",
                    "profile_id"   =>  $this->view->profile->id,
                    "name"         => post('name'),
                    "company"      => post('company_name'),
                    "email"        => post('email'),
                    "tel"          => post('tel'),
                    "ip"           => $_SERVER['REMOTE_ADDR'],
                    "time"         => time()
                );
             $this->view->data=$data;
             $this->view->job_title=$this->view->profile->job_title;
                // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

                // Mail to client/consultant
                $mail->IsHTML(true);
                $mail->SetFrom(Request::getParam('noreply_mail')->value, Request::getParam('noreply_name')->value);
                $mail->AddAddress(Request::getParam('admin_mail')->value);
                $consultant_email=$this->view->profile->consultant->email;    
                $mail->AddAddress($consultant_email);


                $mail->Subject = 'Request Further Info';
                $mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/request_info.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->Send();
                 //user email
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
                $user_mail->IsHTML(true);
                $mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $baseUrl=SITE_URL;
                $user_mail->Subject = "Thank you For Submitting Further Info Request";
                $user_mail->Body = $this->getView('modules/talent/modules/open_profile/views/email_templates/thanks.php'); 
                $user_mail->AltBody =  'Note: Our emails are a lot nicer with HTML enabled!';
                $sendUserStatus = false;  
                if ($user_mail->Send())   
                    $sendUserStatus = true;
                //end user email

                $result = Model::insert('talent_requests', $data);
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#apply_form', '<h3 style="font-size: 35px;">Thank you!</h3>');
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

}
/* End of file */  