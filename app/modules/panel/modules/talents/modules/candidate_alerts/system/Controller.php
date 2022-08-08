<?php
class Candidate_alertsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Candidate_alertsModel::getAll();

        Request::setTitle('Candidate Alerts');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $skill = Candidate_alertsModel::get($id);

        if (!$skill)
            redirect(url('panel/talents/candidate_alerts'));

        $data['deleted'] = 'yes';
        $result = Model::update('talent_candidate_alerts', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Location created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'locations', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/talents/candidate_alerts'));
    }
}
/* End of file */