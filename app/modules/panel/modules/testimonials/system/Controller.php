<?php
class TestimonialsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = TestimonialsModel::getAll();

        Request::setTitle('Testimonials');
    }

    public function addAction()
    {
        Model::import('panel/team');
        $this->view->team = TeamModel::getAllUsers();

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'     => post('name'),
                );

                $result   = Model::insert('testimonials', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('redirect', false, url('panel', 'testimonials', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Testimonial');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->testimonial = TestimonialsModel::get($id);

        if (!$this->view->testimonial)
            redirect(url('panel/testimonials'));

        Model::import('panel/team');
        $this->view->team = TeamModel::getAllUsers();

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('position',         'Position',       'trim|min_length[1]|max_length[100]');
            //$this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]'); 
           /* if(post('type')=='home'){
            $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]|max_length[200]');
             }else{
               $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]|max_length[500]'); 
             }*/
           // $this->validatePost('type',           'Page',               'required|trim|min_length[1]|max_length[50]');

            //$this->validatePost('company',           'Company',               'required|trim|min_length[1]|max_length[50]');
            $image=post('image');

            if ($this->isValid()) {
                $data = array(
                    'name'       => post('name'),
                    'position'   => post('position'),
                    //'company'      => post('company'),
                    'content'    => post('content'),
                    'image'    => post('image'),
                   // 'type'    => post('type'),
                );
                  // Copy and remove image
                if ($data['image']) {
                    if ($this->view->testimonial->image !== $data['image']) {
                        if (File::copy('data/tmp/' . $data['image'], 'data/testimonials/' . $data['image'])) {
                            File::remove('data/testimonials/' . $this->view->testimonial->image);
                        } else
                            print_data(error_get_last());
                    }
                }
                  
                 /*if ($this->view->testimonial->image !== $data['image']) {
                    if (File::copy('data/tmp/' . User::get('id') . '.png', 'data/testimonials/' . $data['image'])) {
                        File::remove('data/testimonials/' . $this->view->testimonial->image);
                    } else
                        print_data(error_get_last());
                } */

                $result = Model::update('testimonials', $data, "`id` = '$id'"); // Update row

                if ($result) {
//                    Request::addResponse('redirect', false, url('panel', 'testimonials', 'edit', $id));
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

        Request::setTitle('Edit Testimonial');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = TestimonialsModel::get($id);

        if (!$user)
            redirect(url('panel/testimonials'));

        $data['deleted'] = 'yes';
        $result = Model::update('testimonials', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Testimonial created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'testimonials', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/testimonials'));
    }
}
/* End of file */