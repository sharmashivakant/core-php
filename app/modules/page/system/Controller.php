<?php

class PageController extends Controller
{
    use Validator;

    public function indexAction()
    {
        Model::import('blogs');
        Model::import('jobs');
        /*   Model::import('videos');
        $this->view->video = VideosModel::getVideoByName('home-what-we-do');
        $this->view->video_home_tech = VideosModel::getVideoByName('home-tech-community'); */
        $this->view->recent_blogs = BlogsModel::getRecentBlogs(3);
        $this->view->locations = JobsModel::getLocations();
        // Get sector list and make ID => NAME array
        // $sectors = JobsModel::getSectors();
        /* $sectorsArray = array();
        foreach ($sectors as $sector)
        $sectorsArray[$sector->id] = $sector->name; */
        //$this->view->sectors = $sectors;
        $this->view->clientlogos = JobsModel::getClientlogos();
        $this->view->homeimges = PageModel::getHomeimages();
        $listJob = JobsModel::search(false, false, false, false, 'DESC', 3);
        $this->view->list      = $listJob['vacancies'];
        $featured_jobs = JobsModel::search('', '', '', '', '', 3, 0);
        $this->view->featured_jobs = $featured_jobs;

        Request::setTitle('Home');
        Request::setKeywords('');
        Request::setDescription('');
    }


    public function permanentAction()
    {
        $this->view->permanent = PageModel::getAllPermanentServices($id = '4');
        Request::setTitle('Permanent');
    }
    public function contractAction()
    {
        $this->view->contract = PageModel::getAllPermanentServices($id = '3');
        Request::setTitle('Contract');
    }
    public function project_deliveryAction()
    {
        $this->view->projcet_delivery = PageModel::getAllPermanentServices($id = '2');
        Request::setTitle('Project Delivery');
    }
    public function service_allianceAction()
    {
        $this->view->service_alliance = PageModel::getAllPermanentServices($id = '1');
        Request::setTitle('Service Alliance');
    }
    public function clientsAction()
    {
        $this->view->services = PageModel::getAllServices();
        //print_r($this->view->services);

        Request::setTitle('Clients');
    }
    public function statementAction()
    {
       
        Request::setTitle('Equality & Diversity');
    }


    public function specialismsAction()
    {
        $this->view->list = PageModel::getSectors();

        Request::setTitle('Specialisms');
    }


    public function c_suiteAction()
    {
        Request::setTitle('C-suite Advisory');
    }


    public function tactical_solutionsAction()
    {
        Model::import('panel/videos');
        $this->view->video = VideosModel::getVideoByName('tactical-solutions');

        Request::setTitle('Tactical solutions for building teams');
    }


    public function operational_solutionsAction()
    {
        Request::setTitle('Operational solutions for scaling businesses');
    }


    public function communityAction()
    {
        $this->view->comunities = PageModel::getComunities();
        Request::setTitle('Our Community');
    }
    public function talent_solutionAction()
    {

        $this->view->cititec_way = PageModel::getcititec_way();
        Request::setTitle('Talent Solution');
    }


    public function tech_communityAction()
    {
        Model::import('panel/event_card');
        $this->view->events = Event_cardModel::getAll();

        Model::import('panel/videos');
        $this->view->video = VideosModel::getVideoByName('tech-community');

        Request::setTitle('Tech Community');
    }


    public function teamAction()
    {
        Model::import('panel/videos');
        $this->view->video_home_tech = VideosModel::getVideoByName('home-tech-community');
        Request::setTitle('Our Team');
    }


    public function terms_and_conditionsAction()
    {
        Model::import('panel/content_blocks');
        $this->view->terms_block = Content_blocksModel::getBlockByName('terms-and-conditions');

        Request::setTitle('Terms & Conditions');
    }


    public function privacy_policyAction()
    {
        Model::import('panel/content_blocks');
        $this->view->privacy_block = Content_blocksModel::getBlockByName('privacy-policy');

        Request::setTitle('Privacy Policy');
    }

    public function terms_conditionsAction()
    {
        Model::import('panel/content_blocks');
        $this->view->privacy_block = Content_blocksModel::getBlockByName('privacy-policy');

        Request::setTitle('Terms & Conditions');
    }

    public function arrange_callAction()
    {
        Request::ajaxPart();


        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('company',          'Company',              'trim|min_length[1]|max_length[100]');
            $this->validatePost('email',            'Email',                'trim|email');
            $this->validatePost('tel',              'Contact Number',       'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('check',            'Checkbox',             'trim|min_length[1]');

            if ($this->isValid()) {
                $this->view->data = array(
                    'name'      => post('name'),
                    'company'   => post('company'),
                    'email'     => post('email'),
                    'tel'       => post('tel'),
                    'time'      => time()
                );

                // Send email to admin
                require_once(_SYSDIR_ . 'system/lib/phpmailer/class.phpmailer.php');
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
                //$mail->AddCC('');
                //if (isset($file['filename']))
                //    $mail->addAttachment($file['filepath'] . $file['filename']);

                $mail->Subject = 'New Call Booking';
                $mail->Body = $this->getView('modules/page/views/email_templates/book_call.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();

                //$mail->ClearAllRecipients();
                //$mail->clearAttachments();

                Request::addResponse('html', '.callback_form', '<h3 class="title"><span>Thank you!</span></h3>');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }


    public function refer_friendAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('your_name',    'Your name',                    'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('your_email',   'Your email',                   'required|trim|min_length[1]|max_length[60]|email');
            $this->validatePost('your_tel',     'Your telephone number',        'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('friend_name',  'Your friend\'s name',            'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('friend_email', 'Your friend\'s email',            'required|required|trim|min_length[1]|max_length[60]|email');
            $this->validatePost('friend_tel',   'Your friend\'s telephone number', 'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('check',        'Privacy Policy',               'required|trim');

            if ($this->isValid()) {
                $this->view->data = array(
                    'your_name'    => post('your_name'),
                    'your_email'   => post('your_email'),
                    'your_tel'     => post('your_tel'),
                    'friend_name'  => post('friend_name'),
                    'friend_email' => post('friend_email'),
                    'friend_tel'   => post('friend_tel')
                );

                // Send email to admin
                require_once(_SYSDIR_ . 'system/lib/phpmailer/class.phpmailer.php');
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
                //$mail->AddCC('');
                //if (isset($file['filename']))
                //    $mail->addAttachment($file['filepath'] . $file['filename']);

                $mail->Subject = 'New Call Booking';
                $mail->Body = $this->getView('modules/page/views/email_templates/refer_friend.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();

                $mail->ClearAllRecipients();
                //$mail->clearAttachments();

                // todo: add email sender
                Request::addResponse('html', '.refer_form', '<h3 class="title"><span>Thank you!</span></h3>');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }


    public function upload_jobAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('name',     'Your name',     'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('email',    'Your email',    'required|trim|min_length[1]|max_length[60]|email');
            $this->validatePost('company',  'Company',       'required|trim|min_length[1]|max_length[150]');
            $this->validatePost('tel',      'Telephone',     'required|trim|min_length[1]|max_length[20]');
            $this->validatePost('cv_field', 'CV',            'required|trim');
            $this->validatePost('check',    'Privacy Policy', 'required|trim');

            if ($this->isValid()) {
                $this->view->data = array(
                    'name'     => post('name'),
                    'email'    => post('email'),
                    'company'  => post('company'),
                    'tel'      => post('tel'),
                    'cv_field' => post('cv_field')
                );

                // Send email to admin
                require_once(_SYSDIR_ . 'system/lib/phpmailer/class.phpmailer.php');
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
                //$mail->AddCC('');

                if (post('cv_field'))
                    $mail->addAttachment(_SYSDIR_ . 'data/tmp/' . post('cv_field'));

                $mail->Subject = 'New Uploaded Vacancy';
                $mail->Body = $this->getView('modules/page/views/email_templates/upload_job.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();


                Request::addResponse('html', '.refer_job', '<h3 class="title"><span>Thank you!</span></h3>');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }


    public function get_connectedAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('email', 'Email', 'required|trim|email');
            $this->validatePost('type', 'Type', 'required|trim|type');

            if ($this->isValid()) {
                $data = array(
                    'email' => post('email'),
                    'type' => post('type'),
                    'time'  => time()
                );

                // Send email to admin
                require_once(_SYSDIR_ . 'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

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

                $mail->Subject = 'Email Subscription';
                $mail->Body = 'New User Email Subscription with ' . $data['email'];
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';

                $sendStatus = false;
                if ($mail->Send())
                    $sendStatus = true;

                // Send email to user
                $user_mail = new PHPMailer;
                $user_mail->IsHTML(true);
                $user_mail->SetFrom($select_noreply_mail, $select_noreply_name);
                $user_mail->AddAddress($data['email']); //USER EMAIL
                $user_mail->Subject = 'Thank you for signing up to our newsletter.';
                $user_mail->Body = 'Thank you for signing up to our newsletter.  <br>
                We are currently building our mailing list so please bear with us. Our newsletter will be launched very soon. This will include all live jobs, industry insights and internal Burman news.  <br><br>
                Kind Regards,<br> The Team at Burman Recruitment<br><br>
                <img src="https://www.burmanrecruitment.com/app/public/images/email-logo.png">';

                $sendUserStatus = false;
                if ($user_mail->Send())
                    $sendUserStatus = true;

                $result   = Model::insert('subscribers', $data); // Insert row
                $insertID = Model::insertID();

                Request::addResponse('html', '.subs_res', '<h3 class="title"><span>Thank you!</span></h3>');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }
    }


    public function exitAction()
    {
        setSession('user', null);
        setSession('user_info', null);
        redirect('/');
    }
    public function sitemapAction()
    {
        header('Content-Type: application/xml; charset=utf-8');
        $siteurl = [];
        $siteurl[] = SITE_URL . 'who-we-are';
        $siteurl[] = SITE_URL . 'contact-us';
        $siteurl[] = SITE_URL . 'jobs';
        $siteurl[] = SITE_URL . 'community';
        $siteurl[] = SITE_URL . 'blogs';
        $siteurl[] = SITE_URL . 'case-studies';
        $siteurl[] = SITE_URL . 'meet-the-team';
        $siteurl[] = SITE_URL . 'terms-and-conditions';
        $siteurl[] = SITE_URL . 'privacy-policy';
        $this->view->slugs = $siteurl;
        Model::import('blogs');
        $this->view->blogs = BlogsModel::getAll();
        $this->view->events = BlogsModel::getAllEvent();

        Model::import('jobs');

        $list      = JobsModel::search($keywords, $type, $sector, $location, false, false, 0, false, $salary, 0);
        $this->view->list      = $list['vacancies'];

        Model::import('common');

        $this->view->team = CommonModel::getTeam();
        $this->view->casestudies = CommonModel::getCaseStudies();
    }
    public function change_langAction()
    {
        Request::ajaxPart();


        $lang = Request::getUri(0);
        
       // $url = post('url');

        if (User::get('id'))
            Model::update('users', ['lang' => $lang], " `id` = " . User::get('id'));
        else
            setMyCookie('lang', $lang, time() + 30 * 24 * 3600);

        redirectAny(url('/'));
    }
    
}
/* End of file */