<?php
class CategoriesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = CategoriesModel::getAll();

        Request::setTitle('Blog Categories');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',    'Name',         'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),
                );

                $result   = Model::insert('blog_categories', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'User created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'blog', 'categories', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Categories');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = CategoriesModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/sectors'));

        if ($this->startValidation()) {
            $this->validatePost('name',    'Name',         'required|trim|min_length[1]|max_length[200]');
           //$this->validatePost('color_code',         'Color',             'required');
           // $this->validatePost('content', 'Page Content', 'trim|min_length[0]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),       
                   // 'color_code'   => post('color_code'),
                   //'content'   => post('content'),         
                );

                $result = Model::update('blog_categories', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    Request::addResponse('redirect', false, url('panel', 'blog', 'categories', 'edit', $id));
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

        Request::setTitle('Edit categories');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = CategoriesModel::get($id);

        if (!$user)
            redirect(url('panel/sectors'));

        $data['deleted'] = 'yes';
        $result = Model::update('blog_categories', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'User created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'blog', 'categories', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/blog/categories'));
    }
}
/* End of file */