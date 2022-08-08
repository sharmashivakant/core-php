<?php
class Employer_page_logosController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = employer_page_logosModel::getAll();

        Request::setTitle('Logos');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'logo'      => post('image'),
                );

                                // Copy and remove image
                if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                    File::remove('data/events/' . $this->view->edit->logo);
                }

                $result   = Model::insert('employer_page_logos', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Event created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'employer_page_logos', 'index', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Logos');
    }

    public function editAction()
    {
        Model::import('panel/locations');   
        Model::import('panel/team');

        $id = intval(Request::getUri(0));
        $this->view->edit = employer_page_logosModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)
            redirect(url('panel/employer_page_logos'));

        if ($this->startValidation()) {
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            
            if ($this->isValid()) {
                $data = array(
                    'logo'     => post('image'),
                );

                // Copy and remove image
                if ($this->view->edit->logo !== $data['logo']) {
                    if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                        File::remove('data/events/' . $this->view->edit->logo);
                    } else
                    print_data(error_get_last());
                }

                $result = Model::update('employer_page_logos', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    redirect(url('panel/employer_page_logos'));
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

        Request::setTitle('Edit Logos');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = employer_page_logosModel::get($id);

        if (!$user)
            redirect(url('panel/employer_page_logos'));

        $data['deleted'] = 'yes';
        $result = Model::update('employer_page_logos', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'employer_page_logos', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/employer_page_logos'));
    }
}
/* End of file */