<?php
class FunctionsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = FunctionsModel::getAll();

        Request::setTitle('Functions');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]');
//            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');
//            $this->validatePost('slug',             'Slug',                 'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'         => post('name'),
                    'content'       => post('content'),
//                    'meta_title'    => post('meta_title'),
//                    'meta_keywords' => post('meta_keywords'),
//                    'meta_desc'     => post('meta_desc'),
//                    'slug'          => post('slug')
                );

                $result   = Model::insert('functions', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Function created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'functions', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Function');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->sector = FunctionsModel::get($id);

        if (!$this->view->sector)
            redirect(url('panel/functions'));

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]');
//            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');
//            $this->validatePost('slug',             'Slug',                 'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'         => post('name'),
                    'content'       => post('content'),
//                    'meta_title'    => post('meta_title'),
//                    'meta_keywords' => post('meta_keywords'),
//                    'meta_desc'     => post('meta_desc'),
//                    'slug'          => post('slug')
                );

                $result = Model::update('functions', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    $this->session->set_flashdata('success', 'Function created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'functions', 'edit', $id));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Function');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = FunctionsModel::get($id);

        if (!$user)
            redirect(url('panel/functions'));

        $data['deleted'] = 'yes';
        $result = Model::update('functions', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Function created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'functions', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/functions'));
    }
}
/* End of file */