<?php
class Dashboard_settingsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Dashboard_settingsModel::getAll();

        Request::setTitle('Dashboard Settings');
    }

    public function addAction()
    {
        $this->view->tables = Model::getTables();

        if ($this->startValidation()) {
            $this->validatePost('title',   'Title',   'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('table',   'Table',   'required|trim|min_length[0]|max_length[24]');
            $this->validatePost('where',   'Where',   'trim|min_length[0]|max_length[200]');
            $this->validatePost('status',  'Status',  'required|trim|min_length[0]');

            if ($this->isValid()) {
                $data = array(
                    'title'  => post('title'),
                    'table'  => post('table'),
                    'where'  => post('where'),
                    'status' => post('status'),
                );

                $result   = Model::insert('dashboard_settings', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Setting created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'dashboard_settings', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Setting');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit   = Dashboard_settingsModel::get($id);
        $this->view->tables = Model::getTables();

        if (!$this->view->edit)
            redirect(url('panel/dashboard_settings'));

        if ($this->startValidation()) {
            $this->validatePost('title',   'Title',   'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('table',   'Table',   'required|trim|min_length[0]|max_length[24]');
            $this->validatePost('where',   'Where',   'trim|min_length[0]|max_length[200]');
            $this->validatePost('status',  'Status',  'required|trim|min_length[0]');

            if ($this->isValid()) {
                $data = array(
                    'title'  => post('title'),
                    'table'  => post('table'),
                    'where'  => post('where'),
                    'status' => post('status'),
                );

                $result = Model::update('dashboard_settings', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    Request::addResponse('redirect', false, url('panel', 'dashboard_settings', 'edit', $id));
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

        Request::setTitle('Edit Setting');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = Dashboard_settingsModel::get($id);

        if (!$user)
            redirect(url('panel/dashboard_settings'));

        $data['deleted'] = 'yes';
        $result = Model::update('dashboard_settings', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Setting created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'dashboard_settings', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/dashboard_settings'));
    }

    public function mapsAction()
    {
        Model::import('panel/analytics');

        if ($this->startValidation()) {
            $this->validatePost('maps_api_key', 'API Key', 'required|trim|min_length[1]');

            if ($this->isValid()) {
                // View ID
                if (!AnalyticsModel::count_rows('maps_api_key')) {
                    Model::insert('settings', array(
                        'name' => 'maps_api_key',
                        'title' => 'Google maps API key',
                        'value' => post('maps_api_key')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Google maps API key',
                        'value' => post('maps_api_key')
                    ), "`name` = 'maps_api_key'");
                }

                Request::addResponse('func', 'noticeSuccess', 'Saved');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        // Values
        $this->view->maps_api_key = AnalyticsModel::get('maps_api_key');

        Request::setTitle('Google Maps Integration');
    }
}
/* End of file */