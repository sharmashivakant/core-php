<?php
class Tech_stackController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Tech_stackModel::getAll();

        Request::setTitle('Tech Stack');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',  'Name',    'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('image', 'Image',   'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'name'     => post('name'),
                    'image'    => post('image')
                );

                // Copy and remove image
                if ($data['image']) {
                    if (!File::copy('data/tmp/' . $data['image'], 'data/tech_stack/' . $data['image']))
                        print_data(error_get_last());
                }

                $result   = Model::insert('tech_stack', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Tech created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'tech_stack', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Tech');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = Tech_stackModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/tech_stack'));

        if ($this->startValidation()) {
            $this->validatePost('name',  'Name',    'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('image', 'Image',   'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'name'     => post('name'),
                    'image'    => post('image')
                );

                // Copy and remove image
                if ($this->view->edit->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/tech_stack/' . $data['image'])) {
                        File::remove('data/tech_stack/' . $this->view->edit->image);
                    } else
                        print_data(error_get_last());
                }

                $result = Model::update('tech_stack', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    $this->session->set_flashdata('success', 'Tech created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'tech_stack', 'edit', $id));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Tech');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = Tech_stackModel::get($id);

        if (!$user)
            redirect(url('panel/tech_stack'));

        $data['deleted'] = 'yes';
        $result = Model::update('tech_stack', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Tech created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'tech_stack', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/tech_stack'));
    }
}
/* End of file */