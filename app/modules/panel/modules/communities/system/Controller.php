<?php
class CommunitiesController extends Controller  
{
    protected $layout = 'layout_panel';   

    use Validator;

    public function indexAction()
    {
        $this->view->list = communitiesModel::getAll();

        Request::setTitle('Images');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('logo_image',            'Logo Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('short_description',            'Short Description','required|trim|min_length[30]');  
            $this->validatePost('description',            'Description','required|trim|min_length[30]');  

            if ($this->isValid()) {
                $data = array(
                    'logo_image'      => post('logo_image'),
                    'image'      => post('image'),
                    'title'      => post('title'),
                    'short_description'      => post('short_description'),
                    'description'      => post('description'),
                );   
  
                                // Copy and remove image
                if (File::copy('data/tmp/' . $data['image'], 'data/events/' .$data['image'])) {
                    File::remove('data/events/' . $this->view->edit->image);
                }
                if (File::copy('data/tmp/' . $data['logo_image'], 'data/events/' .$data['logo_image'])) {
                    File::remove('data/events/' . $this->view->edit->logo_image);
                }


                $result   = Model::insert('communities',$data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                     Request::addResponse('redirect', false, url('panel', 'communities', 'index'));
                     // redirect(url('panel/communities'));
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
        $this->view->edit = communitiesModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)

            redirect(url('panel/communities'));

        if ($this->startValidation()) {
            //$this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');   
            $this->validatePost('short_description',            'Short Description','required|trim|min_length[30]');   
            if ($this->isValid()) {
                 if(post('title')!=''){
                  $data['title']=post('title');  
                }
                if(post('logo_image')!=''){
                  $data['logo_image']=post('logo_image');  
                }
                 if(post('image')!=''){
                  $data['image']=post('image');  
                }
                 if(post('description')!=''){
                  $data['description']=post('description');  
                }
                if(post('short_description')!=''){
                  $data['short_description']=post('short_description');  
                }

                // Copy and remove image
                if ($this->view->edit->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/events/' . $data['image'])) {
                        File::remove('data/events/' . $this->view->edit->image);
                    } else
                    print_data(error_get_last());
                }
                if ($this->view->edit->logo_image !== $data['logo_image']) {
                    if (File::copy('data/tmp/' . $data['logo_image'], 'data/events/' . $data['logo_image'])) {
                        File::remove('data/events/' . $this->view->edit->logo_image);
                    } else
                    print_data(error_get_last());      
                }

                $result = Model::update('communities', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    redirect(url('panel/communities'));
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
        $user = communitiesModel::get($id);

        if (!$user)
            redirect(url('panel/communities'));

        $data['deleted'] = 'yes';
        $result = Model::update('communities', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'communities', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/communities'));  
    }
}
/* End of file */