<?php
class PanelController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        Model::import('panel/dashboard_settings');
        $this->view->statistics = Dashboard_settingsModel::getAll('active', 6);

        Request::setTitle('Dashboard');
    }

    public function testAction()
    {
        Request::setTitle('Test');
    }

    /* --- Login --- */

    public function loginAction()
    {
        if ($this->startValidation()) {
            $email = $this->validatePost('email',       'Email',    'required|trim|email');
            $pass  = $this->validatePost('password',    'Password', 'required|trim|min_length[6]|max_length[32]');

            $user = PageModel::getUserByEmail($email);

            // Check password
            if ($user && $user->password == md5($pass)) {
                User::setUserSession($user->id); // Create user session

                $url = get('url');
                redirect($url ? $url : url('panel'));
            } else
                $this->addError('password', 'Invalid email and/or password. Please check your data and try again');
        }

        if ($this->isErrors())
            $this->view->errors = $this->getErrors();

        $this->setLayout('layout_panel_login');
        Request::setTitle('Login');
    }

    public function restore_passwordAction()
    {
        if ($this->startValidation()) {
            Request::ajaxPart();
            $this->validatePost('email',   'Email',    'required|trim|email');

            if ($this->isValid()) {
                $user = PageModel::getUserByEmail(post('email'));
                if (!$user)
                    Request::returnError('This email does not exist');
                // Send email to admin

                $this->view->user = $user;
                require_once(_SYSDIR_ . 'system/lib/phpmailer/class.phpmailer.php');
                $mail = new PHPMailer;

                // Mail to client/consultant
                $mail->IsHTML(true);
                $mail->SetFrom(Request::getParam('noreply_mail')->value, Request::getParam('noreply_name')->value);
                $mail->AddAddress($user->email);


                $mail->Subject = 'Restore Password';
                $mail->Body = $this->getView('modules/panel/views/email_templates/restore_password.php');
                $mail->AltBody = 'Note: Our emails are a lot nicer with HTML enabled!';
                $mail->Send();

                Request::addResponse('html', '#restore_form', '<h3 class="title"><span>An email has been sent to the address you provided. Please check your inbox and junk mail folder.</span></h3>');
            }
        }

        if ($this->isErrors())
            $this->view->errors = $this->getErrors();


        $this->setLayout('layout_panel_login');
        Request::setTitle('Restore Password');
    }

    public function restore_processAction()
    {
        $email = get('email');
        $hash = get('hash');
        $user = PageModel::getUserByEmail($email);
        $userHash = md5($user->email . $user->id);

        //check hash
        if ($userHash !== $hash)
            $this->view->errors = 'Hash is invalid';

        if ($this->startValidation()) {
            Request::ajaxPart();
            $this->validatePost('password',      'Password',          'required|trim|min_length[6]|max_length[32]');
            $this->validatePost('password2',     'Confirm Password',  'required|trim|min_length[6]|max_length[32]');

            if (post('password') !== post('password2'))
                $this->addError('password', 'Passwords should match');

            if ($this->isValid()) {
                Model::update('users', ['password' => md5(post('password'))], "`id` = '$user->id'"); // Update row

                Request::addResponse('html', '#restore_form', '<h3 class="title"><span>Password updated successfully</span></h3>');
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        $this->setLayout('layout_panel_login');
        Request::setTitle('Restore Password');
    }

    public function logoutAction()
    {
        User::setUserSession(null); // Remove user session
        redirect(url('panel'));
    }

    public function settingAction()
    {
        Model::import('panel/analytics');
        $this->view->admin_mail     = AnalyticsModel::get('admin_mail');
        $this->view->noreply_mail   = AnalyticsModel::get('noreply_mail');
        $this->view->noreply_name   = AnalyticsModel::get('noreply_name');
        $this->view->tracker        = AnalyticsModel::get('tracker');
        $this->view->tracker_api    = AnalyticsModel::get('tracker_api');

        if ($this->startValidation()) {
            $this->validatePost('admin_mail', 'Admin email', 'trim|min_length[0]|max_length[50]');
            $this->validatePost('noreply_mail', 'Noreply email', 'trim|min_length[0]|max_length[50]');
            $this->validatePost('noreply_name', 'Noreply name', 'trim|min_length[0]|max_length[50]');

            if ($this->isValid()) {
                if (!AnalyticsModel::count_rows('admin_mail')) {
                    $insert = Model::insert('settings', array(
                        'name' => 'admin_mail',
                        'title' => 'Admin Email',
                        'value' => post('admin_mail'),
                    ));
                    $insertID = Model::insertID();
                } else {
                    $update = Model::update('settings', array(
                        'title' => 'Admin Email',
                        'value' => post('admin_mail'),
                    ), "`name` = 'admin_mail'");
                }

                if (!AnalyticsModel::count_rows('noreply_mail')) {
                    $insert = Model::insert('settings', array(
                        'name' => 'noreply_mail',
                        'title' => 'Noreply Email',
                        'value' => post('noreply_mail'),
                    ));
                    $insertID = Model::insertID();
                } else {
                    $update = Model::update('settings', array(
                        'title' => 'Noreply Email',
                        'value' => post('noreply_mail'),
                    ), "`name` = 'noreply_mail'");
                }

                if (!AnalyticsModel::count_rows('noreply_name')) {
                    $insert = Model::insert('settings', array(
                        'name' => 'noreply_name',
                        'title' => 'Noreply Name',
                        'value' => post('noreply_name'),
                    ));
                    $insertID = Model::insertID();
                } else {
                    $update = Model::update('settings', array(
                        'title' => 'Noreply Name',
                        'value' => post('noreply_name'),
                    ), "`name` = 'noreply_name'");
                }

                if (!AnalyticsModel::count_rows('tracker')) {
                    $insert = Model::insert('settings', array(
                        'name' => 'tracker',
                        'title' => 'Tracker',
                        'value' => post('tracker'),
                    ));
                    $insertID = Model::insertID();
                } else {
                    $update = Model::update('settings', array(
                        'title' => 'Tracker',
                        'value' => post('tracker'),
                    ), "`name` = 'tracker'");
                }

                if (!AnalyticsModel::count_rows('tracker_api')) {
                    $insert = Model::insert('settings', array(
                        'name' => 'tracker_api',
                        'title' => 'Tracker API',
                        'value' => post('tracker_api'),
                    ));
                    $insertID = Model::insertID();
                } else {
                    $update = Model::update('settings', array(
                        'title' => 'Tracker API',
                        'value' => post('tracker_api'),
                    ), "`name` = 'tracker_api'");
                }

                Request::addResponse('func', 'noticeSuccess', 'Saved');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Setting');
    }

    /**
     * Upload image for admin panel
     */
    public function upload_imageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#image'); // field where to put image name after uploading
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

        //        $divSize = 470;
        //        $imgCoefficient = 0;
        //        $imgWidth = $imgInfo['new_width'];
        //        $imgHeight = $imgInfo['new_height'];
        //
        //        if ($imgWidth > $divSize OR $imgHeight > $divSize) {
        //            if ($imgWidth > $imgHeight) {
        //                $coefficient = round($imgHeight/$imgWidth, 10);
        //                $imgCoefficient = round($imgWidth/$divSize, 10);
        //                $imgWidth = $divSize;
        //                $imgHeight = round($imgWidth * $coefficient, 0);
        //            } else {
        //                $coefficient = round($imgWidth/$imgHeight, 10);
        //                $imgCoefficient = round($imgHeight/$divSize, 10);
        //                $imgHeight = $divSize;
        //                $imgWidth = round($imgHeight * $coefficient, 0);
        //            }
        //        }
        //
        //        $this->view->imgCoefficient = $imgCoefficient;
        //        $marginLeft = 0;
        //        if ($imgWidth < $divSize + 6) {
        //            $marginLeft = round(($divSize + 6 - $imgWidth)/2, 0);
        //            if ($marginLeft < 2) $marginLeft = 0;
        //        }
        //
        //        $pathImg = _SITEDIR_.$imgInfo['originalPath'].$imgInfo['new_name'].'.'.$imgInfo['new_format'];
        //
        //        $this->view->marginLeft = $marginLeft;
        //        $this->view->avatar = '<img id="crop" class="nos" src="'.$pathImg.'?t='.time().'" onmousedown="return false" onselectstart="return false" style="height: '.$imgHeight.'px; width: '.$imgWidth.'px;">';

        $imageName = $imgInfo['new_name'] . '.' . $imgInfo['new_format']; // new name & format

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');

        //        Request::addResponse('html', '#popup', $this->getView());
        //        Request::addResponse('func', 'setMinHeightForCrop', 100);
        //        Request::addResponse('func', 'setMinWidthForCrop', 100);
        //        Request::addResponse('func', 'addCrop', 'crop');
    }
	
	/**
     * Upload image for admin panel
     */
    public function upload_detailimageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#detail_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_detail_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');

        //        Request::addResponse('html', '#popup', $this->getView());
        //        Request::addResponse('func', 'setMinHeightForCrop', 100);
        //        Request::addResponse('func', 'setMinWidthForCrop', 100);
        //        Request::addResponse('func', 'addCrop', 'crop');
    }
	

	
	
    public function upload_image1Action()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#image1'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_image1'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_image2Action()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#image2'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_image2'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_image3Action()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#image3'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_image3'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_challenge_logoAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#challenge_logo'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_challenge_logo'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_solution_logoAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#solution_logo'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_solution_logo'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_results_logoAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#results_logo'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_results_logo'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
    public function upload_logo_imageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#logo_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_logo_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }

    public function upload_detail_imageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#details_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_details_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
	
		 public function upload_ReadMoreimageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#read_more_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_read_more_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');

    }
    public function upload_team_imageAction()
    {
        print_r($_FILES);
        die;
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#team_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_team_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }
     public function upload_image_popupAction()
    {

        Request::ajaxPart();

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#image'); // field where to put image name after uploading
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

        $imageName = $imgInfo['new_name']; // new name & format

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        $this->view->imagename = $imageName . '.'  . $data['new_format'];
        //$this->view->preview = $preview;
        //$this->view->field = $field;
        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $newImageName. '" alt=" ">');
       /* Request::addResponse('html', '#crop_image', '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');


        Request::addResponse('html', '#popup', $this->getView());*/    
    }
    public function cropAction()
    {
        Request::ajaxPart();

        $name = post('name');
        $preview = post('preview');
        $field = post('field');

        // оригинальное изображение
        $filename = $name;
        //название для обрезанного изображения
        $new_filename = 'crop_' . $name;

        // получаем размеры изображения
        list($current_width, $current_height) = getimagesize(_SYSDIR_ . 'data/tmp/' . $filename);

        //коэф. для масштабирования
        $hh = $current_height / 300;
        $ww = $current_width / 400;

        // координаты x и y оригинального изображение, где мы
        // будем вырезать фрагмент, по данным, берущимся из формы
        $x1    = $_POST['x1'] * $ww;
        $y1    = $_POST['y1'] * $hh;
        //$x2    = $_POST['x2'];
        //$y2    = $_POST['y2'];
        $w    = $_POST['w'] * $ww;
        $h    = $_POST['h'] * $hh;


        // создаём маленькое изображение
        $new = imagecreatetruecolor($w, $h);
        // создаём оригинальное изображение\

        $formats = File::$allowedImageFormats;
        $format =  File::format($filename);

        if ($format == 'jpg')
            $imageCreateFrom = 'imagecreatefromjpeg';
        elseif (array_key_exists($format, $formats))
            $imageCreateFrom = 'imagecreatefrom' . $format;

        $current_image =  $imageCreateFrom(_SYSDIR_ . 'data/tmp/' . $filename); //sys dir

        //вырезаем
        imagecopyresampled($new, $current_image, 0, 0, $x1, $y1, $w, $h, $w, $h);
        // создаём новое изображение
        imagejpeg($new, _SYSDIR_ . 'data/tmp/' . $new_filename, 95);


        Request::addResponse('val', $field, $new_filename);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $new_filename . '" alt="">');
        Request::addResponse('func', 'closePopup', false);
    }


    /* --- Logs --- */

    public function logsAction()
    {
        if ($this->startValidation()) {
            Model::delete('logs', "`id` > 0");
            redirectAny(url('panel/logs'));
        }

        $this->view->list = Model::select('logs', "1 ORDER BY `id` DESC LIMIT 40");
        $this->view->stat = Model::getStat();
        Request::setTitle('Logs');
    }

    /* --- Modules --- */

    public function modulesAction()
    {
        $this->view->list = Model::select('modules', "1 ORDER BY `id` DESC");
        Request::setTitle('Modules');
    }

    /* --- Users --- */

    public function usersAction()
    {
        Request::setTitle('Users');
        $this->view->online24h = PanelModel::countUsers("`last_time` > '" . (time() - 24 * 3600) . "'");
        $this->view->list = PanelModel::getUsersOnline(1440);
    }

    public function guestsAction()
    {
        Request::setTitle('Guests');

        $this->view->online24h = PanelModel::countGuests("`time` > '" . (time() - 24 * 3600) . "'");
        $this->view->google = PanelModel::getGuests('browser', 'google');
        $this->view->instagram = PanelModel::getGuests('referer', 'instagram');
        $this->view->twitter = PanelModel::getGuests('referer', 't.co');
        $this->view->twitter_2 = PanelModel::getGuests('referer', 'twitter');
        $this->view->list = PanelModel::getGuestsOnline(1440);
    }

    public function modules_editAction()
    {
        Request::ajaxPart();

        $id = Request::getUri(0);
        $this->view->edit = Model::fetch(Model::select("modules", " `id` = '$id' LIMIT 1"));

        if (!$this->view->edit)
            redirect(url('panel/modules'));


        if ($this->startValidation()) {
            $this->validatePost('version', 'Version', 'required|trim');

            if ($this->isValid()) {

                $result = Model::update('modules', ['version' => post('version')], "`id` = '$id'"); // Update row

                if ($result) {
                    Request::addResponse('func', 'closePopup();');
                    Request::addResponse('func', 'noticeSuccess', 'Saved');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::addResponse('html', '#popup', $this->getView());
    }

    public function robotsAction()
    {

        $file = fopen('robots.txt', 'c+');

        $content = '';
        while (!feof($file)) {
            $str = htmlentities(fgets($file));
            $content .= $str;
        }

        fclose($file);

        $this->view->content = $content;

        if ($this->startValidation()) {
            $this->validatePost('text', 'Content', 'trim');

            if ($this->isValid()) {

                if (file_exists('robots.txt')) {

                    $content = str_replace(['\r', '\n'], ["\r", "\n"], post('text'));

                    file_put_contents('robots.txt', $content);

                    Request::addResponse('redirect', false, url('panel', 'robots'));
                } else
                    Request::returnError('file does not exist');
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }
    }

    /**
     * Upload icon for admin panel
     */
    public function upload_iconAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'tmp'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#icon'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_icon'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/tmp/' . $imageName . '?t=' . time() . '" alt="">');
    }

    /**
     * Upload icon for service page admin panel
     */
    public function upload_serviceIconAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/images'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#title_icon'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_title_icon'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/services/images/' . $imageName . '?t=' . time() . '" alt="">');
    }

    /**
     * Upload icon for service page admin panel
     */
    public function upload_serviceImageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/images'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#service_image'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_service_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/services/images/' . $imageName . '?t=' . time() . '" alt="">');
    }

    /**
     * Upload icon for service page Squad admin panel
     */
    public function upload_SuadimageAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/images'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#squad_icon'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_squad_image'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/services/images/' . $imageName . '?t=' . time() . '" alt="">');
    }

    /**
     * Upload icon for service page Squad admin panel
     */
    public function upload_Suadimage2Action()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/images'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#squad_subscription_icon'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_squad_subscription_icon'); // field where to put image name after uploading

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

        if ($data['new_name'])
            $fileName = $data['new_name'];
        else
            $fileName = md5($imgInfo['new_name'] . '_' . time());

        $newImageName =  $fileName . '.' . $imgInfo['new_format']; // randomized name

        Request::addResponse('val', $field, $newImageName);
        Request::addResponse('html', $preview, '<img src="' . _SITEDIR_ . 'data/services/images/' . $imageName . '?t=' . time() . '" alt="">');
    }

    /**
     * Upload PDF1 admin panel
     */
    public function upload_PdfAction()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/pdf'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#pdf1'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_pdf1'); // field where to put image name after uploading

        $path = 'data/' . $path . '/';

        $result = null;
        foreach ($_FILES as $file) {
            $result = File::UploadCV($file, $path, $name);
            break;
        }

        $newFileName = $result['name'] . '.' . $result['format']; // randomized name

        Request::addResponse('val', $field, $newFileName);
        Request::addResponse('html', $preview, $result['fileName']);
    }

    /**
     * Upload PDF2 admin panel
     */
    public function upload_Pdf2Action()
    {
        Request::ajaxPart(); // if not Ajax part load

        $name = post('name'); // image name, if not set - will be randomly
        $path = post('path', true, 'services/pdf'); // path where image will be saved, default: 'tmp'
        $field = post('field', true, '#pdf2'); // field where to put image name after uploading
        $preview = post('preview', true, '#preview_pdf2'); // field where to put image name after uploading

        $path = 'data/' . $path . '/';

        $result = null;
        foreach ($_FILES as $file) {
            $result = File::UploadCV($file, $path, $name);
            break;
        }

        $newFileName = $result['name'] . '.' . $result['format']; // randomized name

        Request::addResponse('val', $field, $newFileName);
        Request::addResponse('html', $preview, $result['fileName']);
    }
}
/* End of file */