<?php
class TalentController extends Controller
{
    use Validator;

    protected $layout = 'layout';

    public function indexAction()
    {
        //redirectAny(url('talent','anonymous_profile'));

        $keywords = post('keywords');
        $location ='';
        $postcode = post('postcode');
         $offset= post('offset');
        $this->view->locations = TalentModel::getallLocations();
        $list=TalentModel::getopenprofiles($keywords,$location,$type,DATA_LIMIT,0);
        /*$this->view->openprofiles = TalentModel::getopenprofiles($keywords,$location,$postcode);*/
        $this->view->openprofiles =$list['allprofiles'];
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
        //$protection = Model::fetch(Model::select('talent_password_protection'));
        //$areas = explode('||', trim($protection->areas, '|'));
/*
        if (in_array('open_profiles', $areas) && $acess !== 'yes')
            redirectAny(url("talent/protection?url=talent/open_profile/" . $this->view->profile->id));*/

        $this->view->tc = Model::fetch(Model::select('your_tc'));

        Request::setTitle('Profile - ' . $this->view->profile->job_title);
      
        Request::setTitle('Talent Details');
    }
   /* public function protectionAction()
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
    }*/
     
     public function talentsearchAction()    
    {

     Request::ajaxPart();

        $limit = DATA_LIMIT;
        $keywords   = post('keywords');
        $page = post('page');
        $type       = (post('type')) ? explode(",", post('type')) : '';
        $location   = post('location');
        $offset =  $page ? ($page - 1) * $limit : 0;

        
        Model::import('panel/tech_stack');
        $list=TalentModel::getopenprofiles($keywords,$location,$type,DATA_LIMIT,$offset);
        
        $openprofiles =$list['allprofiles'];
        $this->view->openprofiles_count = $list['count'];
        $openprofiles_count = count($list['allprofiles']);
         $count = $list['count'];
        if (!empty($list)) {
      
            foreach ($openprofiles as $single_item) {
                $data .='<div class="job-content-card job-content-card-lg green-block">
            <h4 class="heading">'.$single_item->job_title.'</h4>';
            if(!empty($single_item->locations)){
                $data .='<h6>location</h6>
                <span class="location-ico">'.implode(", ", array_map(function ($location) { return $location->location_name; }, $single_item->locations)).' </span>';
     }
      $data .='<div class="rep-cont">
      <h6>top 3 skills</h6>
      <h5>'.$single_item->keywords.'</h5>
  </div>
  <p class="para-heading" >'.reFilter(substr($single_item->quote, 0,180)).'</p>
  <a href="'.SITE_URL.'talent/'.$single_item->id.'" class="arrow-ico"></a>
</div>';
               
            }
           
            $offset = $offset + $limit;
        } else {
            $data.= "<div class='no-record'><center><h4> No Result found</h4></center></div>";
            $offset = 0;
        }

        // pagination content
        $pagination = "";
        $total_pages = ceil(($count) / $limit);
        if(!empty($total_pages) && $total_pages > 1):
             $pagination.=' <span class="prev" data-id="0"  id="prevPage" ><a href="#" class="back-arrow"></a></span>';
            for($i = 1; $i <= $total_pages; $i++):  
                if($i == $page):
                    $pagination .= ' <span class="para-heading page-item disabled" id="pageContent'. $i .'" data-id="'. $i .'"><a class="page-link" href="javascript:void(0)" tabindex="-1">'. $i .'</a></span>';
                else:
                    $pagination .= '<span class="para-heading page-item" id="pageContent'. $i .'" data-id="'. $i .'"><a class="page-link" href="javascript:void(0)" tabindex="-1">'. $i .'</a></span>';
                endif;
            endfor; 
             $pagination .='<span class="next" data-id="2"  id="nextPage" >
             <a href="#" class="next-arrow "></a></span>';
        endif;
        //  end of pagination

        echo json_encode(array(
            'offset' => $offset,
            'html' => $data,
            'count' => $count,
            'openprofiles_count' => $openprofiles_count,
            'pagination' => $pagination,
        ));
        exit;
    }

}
/* End of file */
