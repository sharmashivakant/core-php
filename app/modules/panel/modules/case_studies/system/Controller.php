<?php
class Case_studiesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Case_studiesModel::getAll();
    
        Request::setTitle('Case Studies');
    }

    public function addAction()
    {

        if ($this->startValidation()) {
            $this->validatePost('title',            'Case Study Title',           'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'slug'          => makeSlug(post('title')),
                    'time'          => time()
                );

                $result   = Model::insert('case_studies', $data); // Insert row
                $insertID = Model::insertID();

              
                if (!$result && $insertID) {
                    Request::addResponse('redirect', false, url('panel', 'case_studies', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Case Study');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->case_studies = Case_studiesModel::get($id);
        /*echo '<pre>';
         print_r($_POST);
         die;*/
        if (!$this->view->case_studies)
            redirect(url('panel/case_studies'));

        if ($this->startValidation()) {
            $this->validatePost('title',            'Case Study Title',           'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('subtitle',         'Subtitle',             'trim|min_length[1]|max_length[200]');
            $this->validatePost('image',            'Image',                'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('icon',        'Icon',                'trim|min_length[1]|max_length[100]');
            $this->validatePost('content',          'Content',         'required|trim|min_length[0]');
            //$this->validatePost('first_section_title',          'First Section Title',         'required|trim|min_length[0]');
            $this->validatePost('first_section_content',          'First Section Content',         'required|trim|min_length[0]');
            //$this->validatePost('second_section_title',          'Second Section Title',         'required|trim|min_length[0]');
            $this->validatePost('second_section_content',          'Second Section Content',         'required|trim|min_length[0]');
            $this->validatePost('slug',             'Slug',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('time',             'Date Posted',          'trim|min_length[1]|max_length[50]');
            $this->validatePost('posted',           'Posted',               'trim|min_length[1]|max_length[50]');
            $this->validatePost('short_description',   'Short Description', 'trim|min_length[1]|max_length[200]');
            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');

            // Times comparing/checking
            $intTime   = convertStringTimeToInt(post('time'));
            $checkTime = date("d/m/Y", $intTime);

            if ($checkTime != post('time')) {
                $this->addError('time', 'Wrong Date Posted');
            }

            if ($this->isValid()) {
                $data = array(
                    'title'          => post('title'),
                    'subtitle'       => post('subtitle'),
                    'category'       => post('category'),
                    'image'          => post('image'),
                    'icon'         => post('icon'),
                    'meta_title'     => post('meta_title'),
                    'meta_keywords'  => post('meta_keywords'),
                    'meta_desc'      => post('meta_desc'),
                    'content'        => post('content'),     
                    'first_section_title'        => post('first_section_title'),
                    'first_section_content'        => post('first_section_content'),
                    'second_section_title'        => post('second_section_title'),
                    'second_section_content'        => post('second_section_content'),
                    'slug'           => post('slug'),
                    'posted'         => post('posted'),
                    'time'           => $intTime,
                    'short_description' => post('short_description'),
                );


                // Copy and remove image
                if ($this->view->case_studies->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/case-studies/' . $data['image'])) {
                        File::remove('data/case-studies/' . $this->view->case_studies->image);
                    } else
                        print_data(error_get_last());
                }

                // Copy and remove icon
                if ($data['icon']) {
                    if ($this->view->case_studies->icon !== $data['icon']) {
                        if (File::copy('data/tmp/' . $data['icon'], 'data/case-studies/' . $data['icon'])) {
                            File::remove('data/case-studies/' . $this->view->case_studies->icon);
                        } else
                            print_data(error_get_last());
                    }
                }

                $result = Model::update('case_studies', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    Request::addResponse('redirect', false, url('panel', 'blog', 'edit', $id));
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

        Request::setTitle('Edit Cae Study');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = Case_studiesModel::get($id);

        if (!$user)
            redirect(url('panel/case_studies'));

        $data['deleted'] = 'yes';
        $result = Model::update('case_studies', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'User created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'blog', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/case_studies'));
    }
}
/* End of file */