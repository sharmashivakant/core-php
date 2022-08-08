<?php
class Home_page_imagesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = home_page_imagesModel::getAll();

        Request::setTitle('Images');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'logo'      => post('image'),
                    'title'      => post('title'),
                );

                                // Copy and remove image
                if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                    File::remove('data/events/' . $this->view->edit->logo);
                }

                $result   = Model::insert('home_page_images', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Event created successfully.');
                   // Request::addResponse('redirect', false, url('panel', 'home_page_images', 'edit', $insertID));
                     Request::addResponse('redirect', false, url('panel', 'home_page_images'));
                      redirect(url('panel/home_page_images'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Image');
    }

    public function editAction()
    {

        Model::import('panel/locations');
        Model::import('panel/team');

        $id = intval(Request::getUri(0));
        $this->view->edit = home_page_imagesModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)

            redirect(url('panel/home_page_images'));

        if ($this->startValidation()) {
            //$this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');    
            if ($this->isValid()) {
                 if(post('title')!=''){
                  $data['title']=post('title');  
                }
                if(post('image')!=''){
                  $data['logo']=post('image');  
                }

                // Copy and remove image
                if ($this->view->edit->logo !== $data['logo']) {
                    if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                        File::remove('data/events/' . $this->view->edit->logo);
                    } else
                    print_data(error_get_last());
                }

                $result = Model::update('home_page_images', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    redirect(url('panel/home_page_images'));
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

        Request::setTitle('Edit Image');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = home_page_imagesModel::get($id);

        if (!$user)
            redirect(url('panel/home_page_images'));

        $data['deleted'] = 'yes';
        $result = Model::update('home_page_images', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'home_page_images', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/home_page_images'));
    }
}
/* End of file */