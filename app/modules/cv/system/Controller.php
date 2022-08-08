<?php

class CvController extends Controller
{
    use Validator;

    public function indexAction()
    {

    }


    public function contact_usAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',            'Email',                'required|trim|email');
            $this->validatePost('tel',              'Contact Number',       'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('message',          'Further information',  'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('linkedin',         'LinkedIn',             'trim|min_length[0]|max_length[100]|url');
            $this->validatePost('job_spec',         'Job spec',             'trim|min_length[0]|max_length[100]');
            $this->validatePost('cv',               'CV',                   'trim|min_length[0]|max_length[100]');
            $this->validatePost('check',            'GDPR',                 'required|trim|min_length[1]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),
                    'email'     => post('email'),
                    'tel'       => post('tel'),
                    'message'   => post('message'),
                    'linkedin'  => post('linkedin'),
                    'job_spec'  => post('job_spec'),
                    'cv'        => post('cv'),
                    'time'      => time()
                );

                // Copy job spec
                if ($data['job_spec']) {
                    if (!File::copy('data/tmp/' . $data['job_spec'], 'data/spec/' . $data['job_spec']))
                        print_data(error_get_last());
                }

                // Copy CV
                if ($data['cv']) {
                    if (!File::copy('data/tmp/' . $data['cv'], 'data/cvs/' . $data['cv']))
                        print_data(error_get_last());
                }


                $result   = Model::insert('cv_library', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    // Send email to admin
                    $this->view->uvid = $insertID;
                    $this->view->data = $data;

                    require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');
                    $mail = new PHPMailer;

                    Model::import('panel/analytics');
                    $select = AnalyticsModel::get('admin_mail');
                    if ($select->value)
                        $mail = $select->value;
                    else
                        $mail = ADMIN_MAIL;

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
                    $mail->AddAddress($mail);

                    $mail->Subject = 'Submited Contact Us form';
                    $mail->Body = $this->getView('modules/cv/views/email_templates/contact_us.php');
                    $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                    $mail->Send();


                    Request::addResponse('html', '#contact_form', '<h3 class="title-small">Thank you!</h3>');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Contact Us');
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
                
                $mail->Subject = 'New request received from website';
                $mail->Body = $this->getView('modules/cv/views/email_templates/contact_us.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                /* $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv'])); */

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                
                
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                if($data['page_type']=='candidate') {
                    $user_mail->Subject = 'Thank you for your interest in contract roles here at Burman Recruitment.';
                    
                    $user_mail->Body = 'Hi '.$data['name'].',<br><br>
                    Thank you for your interest in contract roles here at Burman Recruitment.  <br>
                    A member of our contract team will contact you within the next 24 hours.  <br>
                    In the meantime please feel free to send your CV to bradley@burmanrecruitment.com  <br><br>
                    Kind Regards,<br> The Team at Burman Recruitment<br><br>
                    <img src="https://www.burmanrecruitment.com/app/public/images/email-logo.png">';
                } elseif($data['page_type']=='employer') {
                    $user_mail->Subject = 'Thank you for getting in touch.';
                    
                    $user_mail->Body = 'Hi '.$data['name'].',<br><br>
                    A member of our contract team will contact you within the next 24 hours.  <br>
                    If your request is urgent, please feel free to contact our Head of Contract.   <br>
                    bradley@burmanrecruitment.com  <br><br>
                    Kind Regards,<br> The Team at Burman Recruitment<br><br>
                    <img src="https://www.burmanrecruitment.com/app/public/images/email-logo.png">';
                }
                
                

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

            $this->validatePost('first_name',   'first_name',   'required|trim|min_length[1]|mNew Request received from websiteax_length[200]');
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
                
                $mail->Subject = 'New request received from website';
                $mail->Body = $this->getView('modules/cv/views/email_templates/contact_us.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                /* $mail->AddAttachment(_SYSDIR_ . 'data/cvs/' . $data['cv'], 'CV.' . File::format($data['cv'])); */

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                if($data['page_type']=='candidate') {
                $user_mail->Subject = 'Thank you for your interest in permanent roles here at Burman Recruitment.';
                    
                    $user_mail->Body = 'Hi '.$data['name'].',<br><br>
                    Thank you for your interest in permanent roles here at Burman Recruitment.   <br>
                    A member of our perms team will contact you within the next 24 hours. <br>
                    In the meantime please feel free to send your CV to jonathan@burmanrecruitment.com  <br><br>
                    Kind Regards,<br> The Team at Burman Recruitment<br><br>
                    <img src="https://www.burmanrecruitment.com/app/public/images/email-logo.png">';
                } elseif($data['page_type']=='employer') {
                    $user_mail->Subject = 'Thank you for getting in touch.';
                    
                    $user_mail->Body = 'Hi '.$data['name'].',<br><br>
                    A member of our permanent team will contact you within the next 24 hours.  <br>
                    If your request is urgent, please feel free to contract our Head of Perm    <br>
                    jonathan@burmanrecruitment.com  <br><br>
                    Kind Regards,<br> The Team at Burman Recruitment<br><br>
                    <img src="https://www.burmanrecruitment.com/app/public/images/email-logo.png">';
                }

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

                $mail->Subject = 'New Request received from website';
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