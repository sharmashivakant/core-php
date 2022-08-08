<?php

class MicrositeController extends Controller
{

    public function indexAction()
    {
        $ref = Request::getUri(0);
        $microsite = MicrositeModel::getMicrosite($ref);

        Model::import('panel/microsites');
        $this->view->microsite = MicrositesModel::get($microsite->id);

        $vacancydata = array();
        foreach ($this->view->microsite->vacancies as $vacancies) {
            $vacancydata[] = MicrositeModel::getVacancy($vacancies->vacancy_id);
        }
        $this->view->vacanciesdata = $vacancydata;

        if (!$this->view->microsite)
            redirect(url('/'));

        Model::import('panel/vacancies');
        $this->view->vacancies = VacanciesModel::getAll(); // $microsite->id

        Model::import('panel/microsites/testimonials');
        $this->view->testimonials = TestimonialsModel::getAll($microsite->id);

        Model::import('panel/microsites/photos');
        $this->view->photos = PhotosModel::getAll($microsite->id);


        Model::import('panel/microsites/videos');
        $this->view->videos = VideosModel::getAll($microsite->id);

        Model::import('panel/microsites/offices');
        $this->view->offices = OfficesModel::getAll($microsite->id);

        Model::import('panel/analytics');
        $this->view->maps_api_key = AnalyticsModel::get('maps_api_key');

        // Tech stack icons
        Model::import('panel/tech_stack');
        $this->view->tech_list = Tech_stackModel::getArrayWithID();

        Request::setTitle('Microsite');
        Request::setKeywords('');
        Request::setDescription('');
    }
}
/* End of file */