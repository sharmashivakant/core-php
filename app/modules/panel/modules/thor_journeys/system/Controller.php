<?php
class thor_journeysController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = thor_journeysModel::getAll();

        Request::setTitle('Journey');
    }

    public function addAction()   
    {
        if ($this->startValidation()) {
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title',            'Title',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('year',            'Year',          'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'logo'      => post('image'),
                    'title'      => post('title'),
                    'year'      => post('year'),
                );

                                // Copy and remove image
                if (File::copy('data/tmp/' . $data['logo'], 'data/events/' . $data['logo'])) {
                    File::remove('data/events/' . $this->view->edit->logo);
                }

                $result   = Model::insert('thor_journeys', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {  
                     Request::addResponse('redirect', false, url('panel','thor_journeys'));
                      redirect(url('panel/thor_journeys'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Journey');
    }

    public function editAction()
    {

        Model::import('panel/locations');
        Model::import('panel/team');

        $id = intval(Request::getUri(0));
        $this->view->edit = thor_journeysModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)

            redirect(url('panel/thor_journeys'));

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

                $result = Model::update('thor_journeys', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    redirect(url('panel/thor_journeys'));
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

        Request::setTitle('Edit Journey');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = thor_journeysModel::get($id);

        if (!$user)
            redirect(url('panel/thor_journeys'));

        $data['deleted'] = 'yes';
        $result = Model::update('thor_journeys', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'thor_journeys', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/thor_journeys'));
    }
}
/* End of file */