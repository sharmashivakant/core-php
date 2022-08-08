<?php

class ContactController extends Controller
{
    use Validator;

    public function indexAction()
    {

    }

    public function contact_usAction()  
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[3]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('phone',            'Phone',       'required|trim|min_length[8]|max_length[12]');
            $this->validatePost('message',          'Message',  'required|trim|min_length[6]|max_length[1000]');
           
         $contact_type=post('contact_type');
         $contact_page_name=post('contact_page_name');
         if($contact_page_name=='work-for-us'){
               $this->validatePost('cv_file',            'CV File',                'required');

         }
         if ($this->isValid()) {
            $data = array(
                'first_name' => post('name'),
                'email'     => post('email'),
                'phone'       => post('phone'),
                'message'   => post('message'),
                'time'      => time(),    
            );
            if($contact_page_name=='work-for-us'){
              $data['cv_file']=post('cv_file');
               
                if (!File::copy('data/tmp/' . $data['cv_file'], 'data/cvs/' . $data['cv_file']))
                    print_data(error_get_last());
           
         }

                    // Send email to admin
                    //$this->view->uvid = $insertID;
            $this->view->data = $data;

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

                    // Mail to admin
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

                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;
                $mail->AddAddress($admin_mail);  

                $mail->Subject = "Contact Us Request | " . SITE_NAME;
                $mail->Body = $this->getView('modules/contact/views/email_templates/contact_us.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                if($contact_page_name=='work-for-us'){
                 $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv_file'], 'cv_file.' . File::format($data['cv_file']));
             }
                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                    // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);

                //  host setting for mail
                $user_mail->IsSMTP();
                $user_mail->Mailer = "smtp";
                $user_mail->Host = SMTP_HOST;
                $user_mail->Port = SMTP_PORT; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
                $user_mail->SMTPAuth = true;
                $user_mail->SMTPSecure = 'tls';
                $user_mail->Username = SMTP_USERNAME;
                $user_mail->Password = SMTP_PASSWORD;
                // End of host details setting


                 $baseUrl=SITE_URL;   
             
                $user_mail->SetFrom($select_noreply_mail, $select_noreply_name);    
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $user_mail->Subject =  "Thank you for Contacting " . SITE_NAME;
                $user_mail->Body = 'Hi '.$data['first_name'].',<br>
                <p>Thank you for Contacting '. SITE_NAME . '.</p>
                        <p>Your message has been received, we will be in touch to discuss your enquiry in further detail.</p>
               <p>Thank you,</p>
                        <p>The '.SITE_NAME.' Team.</p> 
                <img src="'.$baseUrl.'app/public/images/email-logo.png">';        


                $sendUserStatus = false;
                if ($user_mail->Send()) {

                    $result   = Model::insert('contact_us', $data); // Insert row
                    $insertID = Model::insertID();

                    if (!$result && $insertID) {
                        Request::addResponse('html', '#'.$contact_type, '<div class="row"><h3 class="title-small">Thank you!  Your Enquiry has been Sent Successfully.</h3></div>');
                        Request::endAjax();
                    } else {
                        Request::returnError('Database error');
                    }
                }
            }
            else {  
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }

            
        }
        Request::setTitle('Contact Us');
    }

    public function join_usAction()
    {
        Model::import('About_us');
        Model::import('Jobs');
        $listJob = JobsModel::search(false, false, false, false,'DESC',4);
        $this->view->list      = $listJob['vacancies'];
        $this->view->team =About_usModel::getTeam(6); 
        Request::setTitle('Join Us');
    }
    public function upload_cvAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {

            $this->validatePost('first_name',   'first_name',   'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('last_name',    'last_name',    'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',    'Email',    'required|trim|email');
            $this->validatePost('phone',  'Contact Number',   'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('message',  'Further information',  'trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('first_name'). " ".post('last_name'),
                    'email'     => post('email'),
                    'phone'       => post('phone'),
                    'message'   => post('message'),
                    'page_type'   => post('page_type'),
                    'form_type'   => post('form_type'),
                    'time'      => time()
                );

                $this->view->data = $data;
                 // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

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
                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;
                $mail->AddAddress($admin_mail);

                $mail->Subject = 'Vacancy Application';
                $mail->Body = $this->getView('modules/cv/views/email_templates/contact_us.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                /* $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv'])); */

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom(NOREPLY_MAIL, NOREPLY_NAME);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $user_mail->Subject = 'Thank you for Contacting Burman.';
                $user_mail->Body = 'Your message has been received, we will be in touch to discuss your enquiry in further detail. <br><br>
                Thank you,<br> The Burman Team';

                $sendUserStatus = false;
                if ($user_mail->Send())
                    $sendUserStatus = true;

                $result   = Model::insert('talent_pool_cv', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#upload_cv_form', '<h3 class="title-small">Thank you!</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }
    }

    public function upload_permanent_cvAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {

            $this->validatePost('first_name',   'first_name',   'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('last_name',    'last_name',    'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',    'Email',    'required|trim|email');
            $this->validatePost('phone',  'Contact Number',   'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('message',  'Further information',  'trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('first_name'). " ".post('last_name'),
                    'email'     => post('email'),
                    'phone'       => post('phone'),
                    'message'   => post('message'),
                    'page_type'   => post('page_type'),
                    'form_type'   => post('form_type'),
                    'time'      => time()
                );

                $this->view->data = $data;
                 // Send email to admin
                require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

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

                $select = AnalyticsModel::get('admin_mail');
                if ($select->value)
                    $admin_mail = $select->value;
                else
                    $admin_mail = ADMIN_MAIL;
                $mail->AddAddress($admin_mail);
                
                $mail->Subject = 'Vacancy Application';
                $mail->Body = $this->getView('modules/cv/views/email_templates/contact_us.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                /* $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv'])); */

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom(NOREPLY_MAIL, NOREPLY_NAME);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $user_mail->Subject = 'Thank you for Contacting Burman.';
                $user_mail->Body = 'Your message has been received, we will be in touch to discuss your enquiry in further detail. <br><br>
                Thank you,<br> The Burman Team';

                $sendUserStatus = false;
                if ($user_mail->Send())
                    $sendUserStatus = true;

                $result   = Model::insert('talent_pool_cv', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#upload_permanent_cv', '<h3 class="title-small">Thank you!</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }
    }



    /**
     * Upload CV files, etc.
     */
    public function uploadAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name    = post('name', true); // file name, if not set - will be randomly
        $path    = post('path', true, 'tmp'); // path where file will be saved, default: 'tmp'
        $field   = post('field', true, '#image'); // field where to put file name after uploading
        $preview = post('preview', true, '#preview_file'); // field where to put file name after uploading

        $path = 'data/' . $path . '/';

        $result = null;
        foreach ($_FILES as $file) {
            $result = File::UploadCV($file, $path, $name);
            break;
        }

        $newFileName = $result['name'] . '.' . $result['format']; // randomized name

        Request::addResponse('val', $field, $newFileName);
        Request::addResponse('html', $preview, $result['fileName']);
    }

    /**
     * Upload CV files, etc.
     */
    public function upload_fileAction()
    {
       if ($this->startValidation()) {
        $this->validatePost('cv_field', 'CV', 'required|trim|min_length[0]|max_length[100]');

        if ($this->isValid()) {
            $data = array(
                'cv'        => post('cv_field'),
                'page_type'   => post('page_type'),
                'time'      => time()
            );

                // Copy CV
            if ($data['cv']) {
                if (!File::copy('data/tmp/' . $data['cv'], 'data/cvs/' . $data['cv']))
                    print_data(error_get_last());
            }

                   // Send email to admin
            require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
            $mail = new PHPMailer;

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

                $mail->Subject = 'Vacancy Application';
                $mail->Body = $this->getView('modules/jobs/views/email_templates/apply_now.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv']));

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                $result   = Model::insert('talent_pool_cv', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('html', '#upload_cv_file', '<h3 class="title-small">Thank you!</h3>');
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

    public function uploadVideoAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name    = post('name', true); // file name, if not set - will be randomly
        $path    = post('path', true, 'tmp'); // path where file will be saved, default: 'tmp'
        $field   = post('field', true, '#image'); // field where to put file name after uploading
        $preview = post('preview', true, '#preview_file'); // field where to put file name after uploading

        $path = 'data/' . $path . '/';

        $result = null;
        foreach ($_FILES as $file) {
            $result = File::UploadVideo($file, $path, $name);
            break;
        }

        $newFileName = $result['name'] . '.' . $result['format']; // randomized name

        Request::addResponse('val', $field, $newFileName);
        Request::addResponse('html', $preview, $result['fileName']);
    }
}
/* End of file */