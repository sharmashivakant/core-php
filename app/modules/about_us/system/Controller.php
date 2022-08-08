<?php

class About_usController extends Controller
{
    use Validator;

    public function indexAction()
    {
        Model::import('panel/videos');
       Model::import('Jobs');
         $listJob = JobsModel::search(false, false, false, false,'DESC',3);
        $this->view->list      = $listJob['vacancies'];
       $this->view->team =About_usModel::getTeam(6); 
        Request::setTitle('Who We Are');
        Request::setKeywords('');
        Request::setDescription('');
    }
 
    public function who_we_areAction()
    {
        

        Request::setTitle('Who we are');
    }

    public function our_peopleAction()
    {
        $this->view->list = About_usModel::getUsers(" AND `id` >= '9' ORDER BY `sort` ASC"); // AND `id` <= '21'
        Request::setTitle('Our People');
    }

    public function what_we_doAction()
    {
        /*Model::import('panel/testimonials');
        Model::import('common');
         Model::import('jobs');
        $this->view->testimonials = TestimonialsModel::getAll();
        $this->view->team = About_usModel::getTeam();
        $this->view->cititecbenefits = About_usModel::getcititecbenefits();
         $list      = About_usModel::search($keywords, $type, $sector, $location, false,false, 0, false, $salary, 0);

        $this->view->list      = $list['vacancies'];
        $this->view->vacancy_count = $list['count'];
        $this->view->sectors   = JobsModel::getSectors();
        $this->view->locations = JobsModel::getLocations();
        Model::import('panel/videos');
        $this->view->video = VideosModel::getVideoByName('work-for-us');
*/
        Request::setTitle('What we do');
    }

    public function contactAction()
    {
        Request::ajaxPart();

        $slug = Request::getUri(0);
        $this->view->get = $consultant = About_usModel::getUser($slug);

        if (!$consultant)
            redirect(url('about-us','our-people'));

        if ($this->startValidation()) {
            $this->validatePost('name',    'Name',    'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',   'Email',   'required|trim|email');
            $this->validatePost('message', 'Message', 'required|trim|min_length[1]|max_length[500]');

            if ($this->isValid()) {
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

                $mail->AddAddress($consultant->email);

                $mail->Subject = 'Vacancy applied';
                $mail->Body = $this->getView('modules/about_us/views/email_templates/contact.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();

                Request::addResponse('html', '#apply_form', '<h3 class="title-small">Thank you!</h3>');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }
}
/* End of file */