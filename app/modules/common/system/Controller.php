<?php

class CommonController extends Controller
{
    use Validator;

    public function indexAction()
    {

    }

    public function team_workAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name', 'Name', 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email', 'Email', 'required|trim|email');
            $this->validatePost('tel', 'Contact Number', 'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('message', 'Further information', 'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('linkedin', 'LinkedIn', 'trim|min_length[0]|max_length[100]|url');
            $this->validatePost('job_spec', 'Job spec', 'trim|min_length[0]|max_length[100]');
            $this->validatePost('cv', 'CV', 'trim|min_length[0]|max_length[100]');
            $this->validatePost('check', 'GDPR', 'required|trim|min_length[1]');

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

        Request::setTitle('Team Work');
    }


   

    public function join_teamAction()
    {
        Request::setTitle('Join Team');
    }

    

    public function teamAction()
    {
        $this->view->team = CommonModel::getTeam();
        Model::import('jobs');
        $sectors = JobsModel::getSectors();
        $this->view->sectors = $sectors;

        Model::import('page');
        $this->view->page_desc = PageModel::checkContentPage('short-description', 'page', 'Who_we_are');
        $this->view->history_left = PageModel::checkContentPage('burman-history-left', 'page', 'Who_we_are');
        $this->view->history_right = PageModel::checkContentPage('burman-history-right', 'page', 'Who_we_are');
        $this->view->join_team = PageModel::checkContentPage('want-to-join-our-team', 'page', 'Who_we_are');

        Request::setTitle('Team');
    }

    public function viewAction()
    {
    
       $slug = Request::getUri(0);
        Model::import('jobs');
        $this->view->member = CommonModel::getMemberBySlug($slug);
        $this->view->member_jobs = CommonModel::getUserJobs($this->view->member->id, 3);
        $member_id = $this->view->member->id;
        //$this->view->testimonials = JobsModel::getTestimonials("user",$member_id);

        /*$count = Model::count('testimonials', '*', "`deleted` = 'no' and `user_image` = $member_id and `type` = 'user'");

        $modules = $count%2;
        if ($modules == 1) {
            $final_count =  (int)($count/2)+1;
        }
        else {
            $final_count =  $count/2;
        }*/
        
        //$this->view->testimonials_count = $final_count;

        Request::setTitle('Team - ' .$slug);  
    }
    public function case_studiesAction()
    {
    
       /* $slug = Request::getUri(0);
        $this->view->case_study = CommonModel::getBySlug($slug);
        if (!$this->view->case_study)
            redirect(url('employer'));*/
       
            $this->view->testimonials = CommonModel::getAlltestimonials();

        $this->view->recents = CommonModel::getCaseStudies();

        Request::setTitle('Case Studies - ' . $this->view->case_study->meta_title);
        Request::setKeywords($this->view->case_study->meta_keywords);
        Request::setDescription($this->view->case_study->meta_desc);
        Request::setTitle('Case-Studies');        
    }
     public function view_case_studiesAction()
    {
    
       $slug = Request::getUri(0);    
        $this->view->case_study = CommonModel::getBySlug($slug);   
        if (!$this->view->case_study)
            redirect(url('employer'));

        $this->view->recents = CommonModel::getCaseStudies(4, $slug);

        Request::setTitle('Case Studies - ' . $this->view->case_study->meta_title);
        Request::setKeywords($this->view->case_study->meta_keywords);
        Request::setDescription($this->view->case_study->meta_desc);
        Request::setTitle('View-Case-Studies');       
    }
    

    public function member_viewAction()
    {
        $slug = Request::getUri(0);
        Model::import('jobs');
        $this->view->member = CommonModel::getMemberBySlug($slug);
        $this->view->member_jobs = CommonModel::getUserJobs($this->view->member->id, 3);
        $member_id = $this->view->member->id;
        
        $this->view->testimonials = JobsModel::getTestimonials("user",$member_id);

        $count = Model::count('testimonials', '*', "`deleted` = 'no' and `user_image` = $member_id and `type` = 'user'");

        $modules = $count%2;
        if ($modules == 1) {
            $final_count =  (int)($count/2)+1;
        }
        else {
            $final_count =  $count/2;
        }
        
        $this->view->testimonials_count = $final_count;

        Request::setTitle('Team - ' . $this->view->blog->meta_title);
    }

}
/* End of file */