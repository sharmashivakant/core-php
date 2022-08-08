<?php
class Cititec_wayController extends Controller
{
    protected $layout = 'layout_panel';   

    use Validator;

    public function indexAction()
    {
        $this->view->list = cititec_wayModel::getAll();

        Request::setTitle('Images');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('description',            'Description',          'required|trim|min_length[30]|max_length[500]');

            if ($this->isValid()) {
                $data = array(
                    'logo'      => post('image'),
                    'title'      => post('title'),
                    'description'      => post('description'),
                );

                                // Copy and remove image
                if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                    File::remove('data/events/' . $this->view->edit->logo);
                }

                $result   = Model::insert('cititec_way', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Event created successfully.');
                   // Request::addResponse('redirect', false, url('panel', 'cititec_way', 'edit', $insertID));
                     Request::addResponse('redirect', false, url('panel', 'cititec_way'));
                      redirect(url('panel/cititec_way'));
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
        $this->view->edit = cititec_wayModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)

            redirect(url('panel/cititec_way'));

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
                if(post('description')!=''){
                  $data['description']=post('description');  
                }

                // Copy and remove image
                if ($this->view->edit->logo !== $data['logo']) {
                    if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                        File::remove('data/events/' . $this->view->edit->logo);
                    } else
                    print_data(error_get_last());
                }

                $result = Model::update('cititec_way', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    redirect(url('panel/cititec_way'));
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
        $user = cititec_wayModel::get($id);

        if (!$user)
            redirect(url('panel/cititec_way'));

        $data['deleted'] = 'yes';
        $result = Model::update('cititec_way', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'cititec_way', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/cititec_way'));
    }
}
/* End of file */