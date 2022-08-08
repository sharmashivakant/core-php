<?php
class SectorsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = SectorsModel::getAll();

        Request::setTitle('Industry Sectors');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');


            if ($this->isValid()) {
                $data = array(
                    'name'          => post('name'),
                );

                $result   = Model::insert('sectors', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'User created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'sectors', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Industry Sector');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = SectorsModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/sectors'));

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');
           // $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]');
           // $this->validatePost('image',        'Image',                'trim|min_length[1]|max_length[100]');
            //$this->validatePost('icon',        'Icon',                'trim|min_length[1]|max_length[100]');
//            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
//            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');
//            $this->validatePost('slug',             'Slug',                 'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'          => post('name'),
                   // 'content'       => post('content'),
                   // 'image'         => post('image'),
                   // 'icon'         => post('icon'),
//                    'meta_title'    => post('meta_title'),
//                    'meta_keywords' => post('meta_keywords'),
//                    'meta_desc'     => post('meta_desc'),
//                    'slug'          => post('slug')
                );

                // Copy and remove image
                if ($data['image']) {
                    if ($this->view->edit->image !== $data['image']) {
                        if (File::copy('data/tmp/' . $data['image'], 'data/sector/' . $data['image'])) {
                            File::remove('data/sector/' . $this->view->edit->image);
                        } else
                            print_data(error_get_last());
                    }
                }

                 // Copy and remove icon
                if ($data['icon']) {
                    if ($this->view->edit->icon !== $data['icon']) {
                        if (File::copy('data/tmp/' . $data['icon'], 'data/sector/' . $data['icon'])) {
                            File::remove('data/sector/' . $this->view->edit->icon);
                        } else
                            print_data(error_get_last());
                    }
                }

                $result = Model::update('sectors', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    $this->session->set_flashdata('success', 'Sector created successfully.');
                    Request::addResponse('func', 'noticeSuccess', 'Saved');
                    Request::endAjax();
                    Request::addResponse('redirect', false, url('panel', 'sectors', 'edit', $id));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Industry Sector');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = SectorsModel::get($id);

        if (!$user)
            redirect(url('panel/sectors'));

        $data['deleted'] = 'yes';
        $result = Model::update('sectors', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'User created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'sectors', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/sectors'));
    }
}
/* End of file */