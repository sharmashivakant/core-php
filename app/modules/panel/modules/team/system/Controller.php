<?php
class TeamController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->team = TeamModel::getUsersWhere("`role` IN ('admin', 'moder')");

        Request::setTitle('Team Manager');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('firstname',    'First Name',       'required|trim|min_length[1]|max_length[100]');
           // $this->validatePost('lastname',     'Last Name',        'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('email',        'Email',            'required|trim|min_length[1]|max_length[100]|valid_email');
            $this->validatePost('password',     'Password',         'required|trim|min_length[6]|max_length[32]');
             
            if ($this->isValid()) {
               $name=post('firstname').'-'.post('lastname'); 
                $data = array(
                    'firstname'     => post('firstname'),
                    'lastname'      => post('lastname'),
                    'email'         => post('email'),
                    'slug'          => post('slug'),
                    'role'          => post('role'),
                    'password'      => md5(post('password')),
                    'reg_time'      => time(),
                    'last_time'     => time(),
                );

                // Copy and remove image
                if ($data['image']) {
                    if (!File::copy('data/tmp/' . $data['image'], 'data/users/' . $data['image']))
                        print_data(error_get_last());
                }

                $checkEmail = TeamModel::getUserByEmail($data['email']);
                if ($checkEmail)
                    Request::returnError('This email is already taken');

                $result   = Model::insert('users', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'User created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'team', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Team Member');
    }

    public function editAction()
    {
        $userID = intval(Request::getUri(0));
        $this->view->user = TeamModel::getUser($userID);
        $this->view->sectors = TeamModel::getSectors();

        if (!$this->view->user)
            redirect(url('panel/team'));   

        $this->view->imagesList = TeamModel::getUserImages($userID);           

        if ($this->startValidation()) {
            $this->validatePost('firstname',    'First Name',       'required|trim|min_length[1]|max_length[100]');
            //$this->validatePost('lastname',     'Last Name',        'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('email',        'Email',            'required|trim|min_length[1]|max_length[100]|email');
            $this->validatePost('tel',          'Telephone Number', 'trim|min_length[0]|max_length[100]');
            $this->validatePost('password',     'Password',         'trim|min_length[6]|max_length[32]');
            //$this->validatePost('title',        'Title',            'trim|min_length[0]|max_length[150]');
            $this->validatePost('job_title',    'Job Title',        'trim|min_length[0]|max_length[150]');
            $this->validatePost('role',          'Role',             'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('description',  'Description',      'trim|min_length[0]');
            $this->validatePost('for_fun',      'For fun',          'trim|min_length[0]');
            $this->validatePost('linkedin',     'LinkedIn URL',     'trim|min_length[0]|max_length[100]');
            $this->validatePost('twitter',      'Twitter URL',      'trim|min_length[0]|max_length[100]');
            $this->validatePost('skype',        'Skype',            'trim|min_length[0]|max_length[100]');
            $this->validatePost('slug',         'Slug',             'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('facebook',     'Facebook URL',     'trim|min_length[0]|max_length[100]');
            $this->validatePost('instagram',     'Instagram URL',     'trim|min_length[0]|max_length[100]');
            $this->validatePost('organization',        'Organization',            'trim|min_length[0]|max_length[150]');
             $this->validatePost('sector',        'Sector',            'trim|min_length[0]|max_length[150]');  

            if ($this->isValid()) {
                $data = array(
                    'firstname'     => post('firstname'),
                    'lastname'      => post('lastname'),
                    'email'         => post('email'),
                    'tel'           => post('tel'),
                    //'title'         => post('title'),
                    'job_title'     => post('job_title'),
                    'role'          => post('role'),
                    'description'   => post('description'),
                    'for_fun'       => post('for_fun'),
                    'linkedin'      => post('linkedin'),
                    'twitter'       => post('twitter'),
                    'skype'         => post('skype'),
                    'image'         => post('image'),
					'detail_image'         => post('detail_image'),
                    'slug'          => post('slug'),
                    'is_speaker'  =>'0',
                    'is_team_member'  => '0',
                    'facebook'       => post('facebook'),
                    'instagram'       => post('instagram'),
                    'organization'       => post('organization'),  
                    'sector'       => post('sector'),
                    'is_ambassador'  => post('is_ambassador', true, 0),       
                );

                if (post('password'))
                    $data['password'] = md5(post('password'));

                // Copy and remove image
                if ($this->view->user->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/users/' . $data['image'])) {
                        File::remove('data/users/' . $this->view->user->image);
                    } else
                        print_data(error_get_last());
                }
			
				 // Copy and remove image
                if ($this->view->user->detail_image !== $data['detail_image']) {
                    if (File::copy('data/tmp/' . $data['detail_image'], 'data/users/' . $data['detail_image'])) {
                        File::remove('data/users/' . $this->view->user->detail_image);
                    } else
                        print_data(error_get_last());
                }
				
                if(post('is_ambassador')=='1'){
                 $sectorID=post('sector');   
                 $ambassadorCheck=TeamModel::ambassadorCheck($sectorID);
                 if($ambassadorCheck!=''){
                 $ambassadordata = array(
                    'is_ambassador'     =>'0',
                     );
                $ambassadorresult = Model::update('users', $ambassadordata);
            }
            }
            
                $result = Model::update('users', $data, "`id` = '$userID'"); // Update row

                if ($result) {
//                    Request::addResponse('redirect', false, url('panel', 'team', 'edit', $userID));
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

        Request::setTitle('Edit Team Member');
    }

    public function deleteAction()
    {
        $userID = (Request::getUri(0));
        $user = TeamModel::getUser($userID);

        if (!$user)
            redirect(url('panel/team'));

        $data['deleted'] = 'yes';
        $result = Model::update('users', $data, "`id` = '$userID'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'User created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'team', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/team'));
    }

    public function sortAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $userID = Request::getUri(1);
        $direction = Request::getUri(0);
        if ($direction != 'up') $direction = 'down';

        $user = TeamModel::getUser($userID);

        if (!$user)
            redirectAny(url('panel/team'));

        if (!$user->sort) { // if sort = 0
            $biggest = TeamModel::getBiggestSort();
            $data['sort'] = intval($biggest->sort) + 1;
            Model::update('users', $data, "`id` = '$userID'");
        } else { // if sort > 0
            if ($direction == 'up') {
                $smallest = TeamModel::getNextSmallestSort($user->sort);
                if (!$smallest)
                    Request::returnError('Already on the top');

                Model::update('users', ['sort' => $smallest->sort], "`id` = '$userID'");
                Model::update('users', ['sort' => $user->sort], "`id` = '" . ($smallest->id) . "'");
            } else {
                $biggest = TeamModel::getNextBiggestSort($user->sort);
                if (!$biggest)
                    Request::returnError('Already on the bottom');

                Model::update('users', ['sort' => $biggest->sort], "`id` = '$userID'");
                Model::update('users', ['sort' => $user->sort], "`id` = '" . ($biggest->id) . "'");
            }
        }

        redirectAny(url('panel/team'));
    }


    public function uploadAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $preview = post('preview', true, '#preview_image'); // field where to put image name after uploading

        if (!$name) $name = randomHash();

        $data['path'] = 'data/' . $path . '/';
        $data['new_name'] = $name;
        $data['new_format'] = 'png';
        $data['mkdir'] = true;

        $imgInfo = null;
        foreach ($_FILES as $file) {
            $imgInfo = File::LoadImg($file, $data);
            break;
        }

        $imageName = $imgInfo['new_name'] . '.' . $imgInfo['new_format']; // new name & format


        $data = array(
            'user_id' => post('user'),
            'image'   => $imageName,
        );
        $result   = Model::insert('user_images', $data); // Insert row
        $insertID = Model::insertID();

        Request::addResponse('append', $preview, '<img src="' . _SITEDIR_ . 'data/' . $path . '/' . $imageName . '?t=' . time() . '" alt="" style="max-height: 150px; max-width: 150px;">');
    }

    public function remove_funAction()
    {
        Request::ajaxPart(); // if not Ajax part load
        $id = post('id');
        $image = TeamModel::getUserImage($id);

        Model::delete('user_images', "`id` = '$id'");
        File::remove('data/fun/' . $image->image);
        Request::addResponse('remove', '#ft_' . $id, false);
    }
}
/* End of file */