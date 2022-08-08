<?php
class Talent_requestsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->edit = Talent_requestsModel::getallrequests();

        Request::setTitle('Your Terms and Conditions');
    }
 public function contract_requestsAction()
    {
        $this->view->list = Talent_requestsModel::get_requests('book');
     
       

        Request::setTitle('Contract Requests');
    }
    public function interview_requestsAction()
    {
        $this->view->list = Talent_requestsModel::get_requests('interview');
     
       

        Request::setTitle('Contract Requests');
    }
    public function furtherinfo_requestsAction()
    {
        $this->view->list = Talent_requestsModel::get_requests('further_info');
     
       

        Request::setTitle('Contract Requests');
    }
     public function deletecontract_requestsAction()
    {
        $id = (Request::getUri(0));
        
        $data['deleted'] = 'yes';
        $result = Model::update('talent_requests', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Location created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'locations', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/talents/talent_requests/contract_requests'));
    
}
     public function deleteinterview_requestsAction()
    {
        $id = (Request::getUri(0));
        
        $data['deleted'] = 'yes';
        $result = Model::update('talent_requests', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Location created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'locations', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/talents/talent_requests/interview_requests'));
    
}
 public function deletefurtherinfo_requestsAction()
    {
        $id = (Request::getUri(0));
        
        $data['deleted'] = 'yes';
        $result = Model::update('talent_requests', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Location created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'locations', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/talents/talent_requests/furtherinfo_requests'));
    
}

}
/* End of file */