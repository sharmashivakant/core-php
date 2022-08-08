<?php
class TalentController extends Controller
{
    use Validator;

    protected $layout = 'layout';

    public function indexAction()
    {
        //redirectAny(url('talent','anonymous_profile'));

       $keywords = post('keywords');
        $miles ='';
        $postcode = post('postcode');
        $latitude = '';
        $longitude = '';
        $contract = post('contract');
        
        $this->view->locations = TalentModel::getallLocations();
        $list=TalentModel::getopenprofiles($keywords,$miles,$postcode,$latitude, $longitude,$contract);
        $this->view->openprofiles = TalentModel::getopenprofiles($keywords,$miles,$postcode,$latitude, $longitude,$contract);
        $this->view->keywords = post('keywords');
        $this->view->miles = post('miles');
        $this->view->postcode = post('postcode');
        $this->view->latitude = post('latitude');
        $this->view->longitude = post('longitude');
        $this->view->contract = post('contract');
        $this->view->limit = DATA_LIMIT;
        $this->view->openprofiles_count = $list['count'];
        $this->view->total_pages = ceil(($this->view->openprofiles_count) / $this->view->limit);
        Request::setTitle('Talent');  
    }

    public function talentdetailsAction()   
    {
        $id = Request::getUri(0);

        Model::import('panel/talents/open_profiles');
        $this->view->profile = Open_profilesModel::get($id);
        if (!$this->view->profile)
            redirect(url('/'));

        // module protection
        $acess = getSession('acess');
        $protection = Model::fetch(Model::select('talent_password_protection'));
        $areas = explode('||', trim($protection->areas, '|'));

        if (in_array('open_profiles', $areas) && $acess !== 'yes')
            redirectAny(url("talent/protection?url=talent/open_profile/" . $this->view->profile->id));

        $this->view->tc = Model::fetch(Model::select('your_tc'));

        Request::setTitle('Profile - ' . $this->view->profile->job_title);
      
        Request::setTitle('Talent Details');
    }
    public function protectionAction()
    {
        if ($this->startValidation()) {
            $pass = $this->validatePost('password', 'Password', 'required|trim|min_length[6]|max_length[32]');

            if ($this->isValid()) {

                $protection = Model::fetch(Model::select('talent_password_protection'));

                if ($pass === $protection->password) {
                    setSession('acess', 'yes');
                    redirectAny(url(post('url')));
                } else
                    Request::returnError('Invalid password. Please try again');
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Protection');
    }
     public function getPostcodesAction()    
    {
        Request::ajaxPart();
        $postcode = @$_POST['postcode'];
        if ($postcode!='') {
            $postcode = str_replace(' ', '', $postcode);
            $data = TalentModel::getallpostcode($postcode);
           /* $data = $this->db->select('postcode, latitude, longitude')->limit(10)->where("replace(postcode, ' ', '') LIKE '%$postcode%'")->get('postcodelatlng')->result();*/
           $html='';
            if ($data) {
                foreach($data as  $dataitem){
                   $html.='<li onclick="getlatlong('.$dataitem->id.')">'.$dataitem->postcode.'</li>';
                }
              
              
            } 
            }
      echo $html;

exit;
       
       /* json_response([
            'status' => false,
            'data' => []
        ]);*/
    }
    public function getlatlongAction()    
    {
        Request::ajaxPart();
        $postcode = @$_POST['postcode'];
        if ($postcode) {
            $postcode = str_replace(' ', '', $postcode);
            $data = TalentModel::getlatlong($postcode);
           /* $data = $this->db->select('postcode, latitude, longitude')->limit(10)->where("replace(postcode, ' ', '') LIKE '%$postcode%'")->get('postcodelatlng')->result();*/
        
           $html='';
            if ($data) {
               
                   $html.=$data->postcode.','.$data->latitude.','.$data->longitude;
               
            } 
            }
      echo $html;

exit;
       
       /* json_response([
            'status' => false,
            'data' => []
        ]);*/
    }

}
/* End of file */
