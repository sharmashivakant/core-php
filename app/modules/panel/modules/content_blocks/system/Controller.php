<?php
class Content_blocksController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Content_blocksModel::getAll();

        Request::setTitle('Content Blocks');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',             'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('title',            'Title',            'trim|min_length[1]|max_length[200]');
            $this->validatePost('content',          'Page Content',     'required|trim|min_length[0]');
            $this->validatePost('meta_title',       'Meta Title',       'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',    'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description', 'trim|min_length[0]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'          => post('name'),
                    'title'         => post('title'),
                    'content'       => post('content'),
                    'meta_title'    => post('meta_title'),
                    'meta_keywords' => post('meta_keywords'),
                    'meta_desc'     => post('meta_desc')
                );

                $result   = Model::insert('content_blocks', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Content block created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'content_blocks', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Content Block');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = Content_blocksModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/content_blocks'));

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',             'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('title',            'Title',            'trim|min_length[1]|max_length[200]');
            $this->validatePost('content',          'Page Content',     'required|trim|min_length[0]');
            $this->validatePost('meta_title',       'Meta Title',       'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',    'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description', 'trim|min_length[0]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'          => post('name'),
                    'title'         => post('title'),
                    'content'       => post('content'),
                    'meta_title'    => post('meta_title'),
                    'meta_keywords' => post('meta_keywords'),
                    'meta_desc'     => post('meta_desc')
                );

                $result = Model::update('content_blocks', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    $this->session->set_flashdata('success', 'Content block created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'content_blocks', 'edit', $id));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Content Block');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = Content_blocksModel::get($id);

        if (!$user)
            redirect(url('panel/content_blocks'));

        $data['deleted'] = 'yes';
        $result = Model::update('content_blocks', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Content block created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'content_blocks', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/content_blocks'));
    }
}
/* End of file */