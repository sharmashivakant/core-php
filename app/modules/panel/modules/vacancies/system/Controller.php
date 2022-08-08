<?php
class VacanciesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $id = intval(Request::getUri(0));
        if ($id) {
            Model::import('panel/microsites');
            $this->view->microsite = MicrositesModel::get($id);
        } else
            $id = false;

        $this->view->list = VacanciesModel::getAll($id, false, " AND (`time_expire` > '" . (time() - 180) . "' OR `time_expire` = 0)");

        Request::setTitle('Manage Vacancies');
    }

    public function archiveAction()
    {
        $id = intval(Request::getUri(0));

        $this->view->list = VacanciesModel::getAll($id, false, " OR (`time_expire` < '" . (time() - 180) . "' AND `time_expire` != 0)", 'yes');

        Request::setTitle('Archive Vacancies');
    }

    public function addAction()
    {

        if ($this->startValidation()) {
            $this->validatePost('title',        'Job Title',            'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'slug'          => makeSlug(post('title')),
                    'time_expire'   => time() + 24 * 3600 * 180,
                    'time'          => time(),

                );    

                $result   = Model::insert('vacancies', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('redirect', false, url('panel', 'vacancies', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Vacancy');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = VacanciesModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/vacancies'));

        Model::import('panel/sectors');
        Model::import('panel/locations');
        Model::import('panel/functions');
        Model::import('panel/team');
        Model::import('panel/microsites');
//        Model::import('panel/tech_stack');

        $this->view->sectors    = SectorsModel::getAll();
        $this->view->locations  = LocationsModel::getAll();
        $this->view->functions  = FunctionsModel::getAll();
        $this->view->team       = TeamModel::getAllUsers();
        $this->view->microsites = MicrositesModel::getAll();
//        $this->view->tech       = Tech_stackModel::getAll();


        if ($this->startValidation()) {
            $this->validatePost('title',        'Job Title',            'required|trim|min_length[1]|max_length[200]');
            // $this->validatePost('ref',          'Job Ref',              'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('sector_ids',   'Industries/Sectors',   'is_array');
            $this->validatePost('location_ids', 'Locations',            'is_array');
            $this->validatePost('salary_value', 'Salary',               'trim|min_length[1]|max_length[100]');
            $this->validatePost('contract_type','Contract Type',        'trim|min_length[1]|max_length[50]');
            $this->validatePost('time',         'Date Posted',          'trim|min_length[1]|max_length[50]');
            $this->validatePost('time_expire',  'Date Expires',         'trim|min_length[1]|max_length[50]');
            $this->validatePost('package',      'Package',              'trim|min_length[1]|max_length[250]');
            $this->validatePost('postcode',     'Postcode',             'trim|min_length[1]|max_length[250]');
            $this->validatePost('content',      'Description',          'required|trim|min_length[1]');
//            $this->validatePost('client_email', 'Client Email',         'required|trim|min_length[1]|valid_email');    
            //$this->validatePost('content_short','Short Description',    'required|trim|min_length[1]|max_length[250]');
            $this->validatePost('consultant_id','Consultant',           'required|trim|min_length[1]');
            $this->validatePost('microsite_id', 'Microsite',            'trim|min[0]');
//            $this->validatePost('tech_stack',   'Tech Stack',           'required|trim|min_length[1]');
            $this->validatePost('meta_title',   'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords','Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',    'Meta Description',     'trim|min_length[0]|max_length[200]');
            $this->validatePost('slug',         'Slug',                 'required|trim|min_length[1]|max_length[200]');  
            $this->validatePost('image',        'Image',                'trim|min_length[1]|max_length[100]');

            // Times comparing/checking
            $intTime   = convertStringTimeToInt(post('time'));
            $checkTime = date("d/m/Y", $intTime);

            $intTimeExpire   = convertStringTimeToInt(post('time_expire'));
            $checkTimeExpire = date("d/m/Y", $intTimeExpire);

            if ($checkTime != post('time')) {
                $this->addError('time', 'Wrong Date Posted');
            } else if ($checkTimeExpire != post('time_expire')) {
                $this->addError('time_expire', 'Wrong Date Expires');
            }

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'ref'           => post('ref'),
                    'salary_value'  => post('salary_value'),
                    'contract_type' => post('contract_type'),
                    //'package'       => post('package'),
                    'postcode'      => post('postcode'),
                    'content'       => post('content'),
//                    'client_email'  => post('client_email'),
                    'content_short' => post('content_short'),
                    'consultant_id' => post('consultant_id'),
                    //'microsite_id'  => post('microsite_id', true, 0),
//                    'tech_stack'    => post('tech_stack'),
                    'meta_title'    => post('meta_title'),
                    'meta_keywords' => post('meta_keywords'),
                    'meta_desc'     => post('meta_desc'),
                    'slug'          => post('slug'),
                    'time_expire'   => $intTimeExpire,
                    'time'          => $intTime,
                    'image'         => post('image'),
                    //'internal_job'  => post('internal_job', true, 0),
                );  

                $oldslug = $slug = makeSlug(post('title'));
                $i = 2;
                Model::import('jobs');
                while ($vac = JobsModel::getNotThis($slug, $id)) {
                    $slug = $oldslug . '-' . $i;
                    $i ++;
                }   

                $data['slug'] = $slug;

                $oldref = $ref = post('ref');
                $i = 2;
                Model::import('jobs');
                while ($vacancy = JobsModel::getNotThis($ref, $id)) {
                    $ref = $oldref . '-' . $i;
                    $i ++;
                }

                $data['ref'] = $ref;


                // Copy and remove image
                if ($data['image']) {
                    if ($this->view->edit->image !== $data['image']) {
                        if (File::copy('data/tmp/' . $data['image'], 'data/vacancy/' . $data['image'])) {
                            File::remove('data/vacancy/' . $this->view->edit->image);
                        } else
                            print_data(error_get_last());
                    }
                }


                $result = Model::update('vacancies', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    // Remove and after insert sectors
                    VacanciesModel::removeSectors($id);
                    if (is_array(post('sector_ids')) && count(post('sector_ids')) > 0) {
                        foreach (post('sector_ids') as $sector_id) {
                            Model::insert('vacancies_sectors', array(
                                'vacancy_id' => $id,
                                'sector_id' => $sector_id
                            ));
                        }
                    }

                    // Remove and after insert locations
                    VacanciesModel::removeLocations($id);
                    if (is_array(post('location_ids')) && count(post('location_ids')) > 0) {
                        foreach (post('location_ids') as $location_id) {
                            Model::insert('vacancies_locations', array(
                                'vacancy_id' => $id,
                                'location_id' => $location_id
                            ));
                        }
                    }

                    // Remove and after insert functions
                    VacanciesModel::removeFunctions($id);
                    if (is_array(post('function_ids')) && count(post('function_ids')) > 0) {
                        foreach (post('function_ids') as $function_id) {
                            Model::insert('vacancies_functions', array(
                                'vacancy_id' => $id,
                                'function_id' => $function_id
                            ));
                        }
                    }

//                    Request::addResponse('redirect', false, url('panel', 'vacancies', 'edit', $id));
                    Request::addResponse('func', 'noticeSuccess', 'Saved');
                    Request::endAjax();
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Vacancy');
    }

    public function dublicateAction()
    {
        Request::ajaxPart();
        $id = intval(Request::getUri(0));
        $vacancy = VacanciesModel::get($id);

        if (!$vacancy)
            redirect(url('panel/vacancies'));

        $data = [
            'title'           => $vacancy->title,
            'salary_value'    => $vacancy->salary_value,
            'contract_type'   => $vacancy->contract_type,
            'package'         => $vacancy->package,
            'postcode'        => $vacancy->postcode,
            'image'           => $vacancy->image,
            'content_short'   => $vacancy->content_short,
            'content'         => $vacancy->content,
            'consultant_id'   => $vacancy->consultant_id,
            'microsite_id'    => $vacancy->microsite_id,
            'time_expire'     => $vacancy->time_expire,
            'time'            => $vacancy->time,
        ];

        $oldslug = $slug = makeSlug($vacancy->title);
        $i = 2;
        Model::import('jobs');
        while ($vac = JobsModel::get($slug)) {
            $slug = $oldslug . '-' . $i;
            $i ++;
        }
        $data['slug'] = $slug;


        $oldref = $ref = $vacancy->ref;
        $i = 2;
        Model::import('jobs');
        while ($vacancy = JobsModel::getByRef($ref)) {
            $ref = $oldref . '-' . $i;
            $i ++;
        }
        $data['ref'] = $ref;

        $result   = Model::insert('vacancies', $data); // Insert row
        $insertID = Model::insertID();

        if (!$result && $insertID) {

            // Remove and after insert sectors
            $sectors = VacanciesModel::getVacancySectors($id);
            if (is_array($sectors) && count($sectors) > 0) {
                foreach ($sectors as $sector) {
                    Model::insert('vacancies_sectors', array(
                        'vacancy_id' => $insertID,
                        'sector_id' => $sector->sector_id
                    ));
                }
            }

            // Remove and after insert locations
            $locations = VacanciesModel::getVacancyLocations($id);
            if (is_array($locations) && count($locations) > 0) {
                foreach ($locations as $location) {
                    Model::insert('vacancies_locations', array(
                        'vacancy_id' => $insertID,
                        'location_id' => $location->location_id
                    ));
                }
            }

            Request::addResponse('redirect', false, url('panel', 'vacancies', 'edit', $insertID));

        } else {
            Request::returnError('Database Error');
        }

    }

    public function resumeAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('id','ID', 'required|trim');

            if ($this->isValid()) {


                $result = Model::update('vacancies', ['deleted' => 'no'], "`id` = '". post('id') . "'"); // Update row

                if ($result) {
                    Request::addResponse('redirect', false, url('panel', 'vacancies', 'archive'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

    }

    public function expireAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = VacanciesModel::get($id);

        if (!$id)
            redirect(url('panel/vacancies'));

        if ($this->startValidation()) {
            $this->validatePost('reason','Reason', 'required|trim|min_length[1]|max_length[255]');


            if ($this->isValid()) {
                $data = array(
                    'expire_reason' => post('reason'),
                    'time_expire'   => time() - 180 * 24 * 3600,
                );

                $result = Model::update('vacancies', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    Request::addResponse('redirect', false, url('panel', 'vacancies'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Expire Vacancy');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = VacanciesModel::get($id);

        if (!$user)
            redirect(url('panel/vacancies'));

        $data['deleted'] = 'yes';
        $result = Model::update('vacancies', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Vacancy created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'vacancies', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/vacancies'));
    }

    public function widgetAction()
    {
        $target = post('target', true, '#widget_list');
        $action = post('action', true, 'append'); // append|html|...
        $this->view->list = VacanciesModel::getLatest(6);

        Request::ajaxPart();
        Request::addResponse($action, $target, $this->getView());
    }
}
/* End of file */