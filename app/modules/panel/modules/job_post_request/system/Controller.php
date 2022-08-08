<?php
class Job_post_requestController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = job_post_requestModel::getAll();

        Request::setTitle('Posted Job Requests');
    }

    public function viewAction()
    {
        $id = intval(Request::getUri(0));
        if (!$id)
            redirect('panel/vacancies');

        $this->view->list = job_post_requestModel::getWhere("`vacancy_id` = '$id'");

        Request::setTitle('Posted Job Requests');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = job_post_requestModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/job_post_request'));


        if ($this->startValidation()) {
            $this->validatePost('name',         'Full name',            'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('email',        'Email',                'trim|min_length[1]|max_length[200]');
            $this->validatePost('tel',          'Contact number',       'trim|min_length[1]|max_length[200]');
            $this->validatePost('message',      'Message',              'trim|min_length[1]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),
                    'email'     => post('email'),
                    'tel'       => post('tel'),
                    'message'   => post('message'),
                );


                $result = Model::update('posted_jobs', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    $this->session->set_flashdata('success', 'Uploaded Vacancy updated successfully.');
                    Request::addResponse('redirect', false, url('panel', 'job_post_request', 'edit', $id));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())  
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Job Post Request');   
    }      
     
    public function export_dataAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('type', 'Type', 'required');

            if ($this->isValid()) {

                $data = Model::fetchAll(Model::select('talent_pool_cv'));

                if (is_array($data) && count($data) > 0) {

                    //prepare data
                    $dataToCsv = [];
                    $i = 0;
                    foreach ($data as $item) {
                        $dataToCsv[$i]['id'] = $item->id;
                        $dataToCsv[$i]['name'] = $item->name;
                        $dataToCsv[$i]['email'] = $item->email;
                        $dataToCsv[$i]['date submitted'] = date('m.d.Y', $item->time);
                        $dataToCsv[$i]['cv link'] = SITE_NAME . _SITEDIR_ . 'data/cvs/' . $item->cv ;

                        $i++;
                    }

                    $df = fopen("app/data/tmp/export.csv", 'w');
                    fputcsv($df, array_keys(reset($dataToCsv)), ';');
                    foreach ($dataToCsv as $row) {
                        fputcsv($df, $row, ';');
                    }
                    fclose($df);

                    Request::addResponse('func', 'downloadFile', _SITEDIR_ . 'data/tmp/export.csv');
                    Request::endAjax();
                } else {
                    Request::returnError('No Data');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

    }

    public function export_data_employerAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('type', 'Type', 'required');

            if ($this->isValid()) {

                $data = Model::fetchAll(Model::select('talent_pool_cv'));

                if (is_array($data) && count($data) > 0) {

                    //prepare data
                    $dataToCsv = [];
                    $i = 0;
                    foreach ($data as $item) {
                        $dataToCsv[$i]['id'] = $item->id;
                        $dataToCsv[$i]['name'] = $item->name;
                        $dataToCsv[$i]['email'] = $item->email;
                        $dataToCsv[$i]['date submitted'] = date('m.d.Y', $item->time);
                        $dataToCsv[$i]['cv link'] = SITE_NAME . _SITEDIR_ . 'data/cvs/' . $item->cv ;

                        $i++;
                    }

                    $df = fopen("app/data/tmp/export.csv", 'w');
                    fputcsv($df, array_keys(reset($dataToCsv)), ';');
                    foreach ($dataToCsv as $row) {
                        fputcsv($df, $row, ';');
                    }
                    fclose($df);

                    Request::addResponse('func', 'downloadFile', _SITEDIR_ . 'data/tmp/export.csv');
                    Request::endAjax();
                } else {
                    Request::returnError('No Data');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

    }

    public function export_data_candidateAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('type', 'Type', 'required');

            if ($this->isValid()) {

                $data = Model::fetchAll(Model::select('talent_pool_cv'));

                if (is_array($data) && count($data) > 0) {

                    //prepare data
                    $dataToCsv = [];
                    $i = 0;
                    foreach ($data as $item) {
                        $dataToCsv[$i]['id'] = $item->id;
                        $dataToCsv[$i]['name'] = $item->name;
                        $dataToCsv[$i]['email'] = $item->email;
                        $dataToCsv[$i]['date submitted'] = date('m.d.Y', $item->time);
                        $dataToCsv[$i]['cv link'] = SITE_NAME . _SITEDIR_ . 'data/cvs/' . $item->cv ;

                        $i++;
                    }

                    $df = fopen("app/data/tmp/export.csv", 'w');
                    fputcsv($df, array_keys(reset($dataToCsv)), ';');
                    foreach ($dataToCsv as $row) {
                        fputcsv($df, $row, ';');
                    }
                    fclose($df);

                    Request::addResponse('func', 'downloadFile', _SITEDIR_ . 'data/tmp/export.csv');
                    Request::endAjax();
                } else {
                    Request::returnError('No Data');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

    }

    public function submited_cvAction()
    {
        $this->view->list = Model::fetchAll(Model::select('talent_pool_cv', " `deleted` = 'no' AND cv != '' ORDER BY `time`"));

        Request::setTitle('Uploaded CVs');
    }

    public function cv_deleteAction()
    {
        $id = (Request::getUri(0));
        $user = job_post_requestModel::getCv($id);

        if (!$user)
            redirect(url('panel/job_post_request/submited_cv'));


        $data['deleted'] = 'yes';
        $result = Model::update('talent_pool_cv', $data, " `id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Vacancy created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'job_post_request', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/job_post_request/submited_cv'));
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = job_post_requestModel::get($id);

        if (!$user)
            redirect(url('panel/job_post_request'));

        $data['deleted'] = 'yes';
        $result = Model::update('posted_jobs', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Vacancy created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'job_post_request', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/job_post_request'));
    }

    public function employer_listAction()
    {
        $this->view->list = Model::fetchAll(Model::select('talent_pool_cv', " `deleted` = 'no' AND page_type = 'employer' AND cv = '' ORDER BY `time`"));

        Request::setTitle('Employer List');
    }

    public function candidate_listAction()
    {
        $this->view->list = Model::fetchAll(Model::select('talent_pool_cv', " `deleted` = 'no' AND page_type = 'candidate' AND cv = '' ORDER BY `time`"));

        Request::setTitle('Contact List');
    }

}
/* End of file */