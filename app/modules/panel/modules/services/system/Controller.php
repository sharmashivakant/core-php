<?php
class ServicesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->services = ServicesModel::getAllServices();

        Request::setTitle('Service Manager');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('title',    'Title',       'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'title'     => post('title'),
                    'created_at'  => date('Y-m-d H:i:s'),
                );

                // Copy and remove image
                // if ($data['image']) {
                //    if (!File::copy('data/tmp/' . $data['image'], 'data/users/' . $data['image']))
                //      print_data(error_get_last());
                // }


                $result   = Model::insert('services', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    // $this->session->set_flashdata('success', 'User created successfully.');

                    Request::addResponse('redirect', false, url('panel', 'services', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Services');
    }

    public function editAction()
    {
        $serviceID = intval(Request::getUri(0));

        $this->view->service = ServicesModel::getService($serviceID);


        if (!$this->view->service)
            redirect(url('panel/services'));

        if ($this->startValidation()) {
            $this->validatePost('title',    'Title',                   'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('sub_title',    'Sub Title',                   'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('title_icon',      'Title Icon',         'trim|min_length[1]|max_length[100]');
            $this->validatePost('info_desc',      'Information Description',         'required|trim|min_length[0]');
            $this->validatePost('description',      'Service Description',         'required|trim|min_length[0]');
            $this->validatePost('short_description',  'Short Description', 'required|trim|min_length[0]');
            //$this->validatePost('image',        'Image',                'trim|min_length[1]|max_length[100]');
            // $this->validatePost('squad_title',  'Squad Title',         'trim|min_length[1]|max_length[100]');
            //$this->validatePost('squad_subtitle',  'Squad Subtitle',    'trim|min_length[1]|max_length[200]');
            //$this->validatePost('squad_desc',  'Squad Description',     'trim|min_length[0]');
            $this->validatePost('pdf1',      'PDF 1',         'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('meta_title',   'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords', 'Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',    'Meta Description',     'trim|min_length[0]|max_length[200]');
            $this->validatePost('slug',         'Slug',                 'required|trim|min_length[1]|max_length[200]');




            if ($this->isValid()) {
                $data = array(
                    'title'       => post('title'),
                    'sub_title'       => post('sub_title'),
                    'title_icon'      => post('title_icon'),
                    'info_desc'             => post('info_desc'),
                    'desc'             => post('description'),
                    'desc_short'    => post('short_description'),
                    //'title'          => post('title'),
                    'image'            => post('service_image'),
					'read_more_image'  => post('read_more_image'),
                    'squad_title'      => post('squad_title'),
                    'squad_icon'        => post('squad_icon'),
                    'squad_subtitle'     => post('squad_subtitle'),
                    'squad_short_desc'           => post('squad_short_desc'),
                    'squad_desc'           => post('squad_desc'),
                    'squad_subscription_title'     => post('squad_subscription_title'),
                    'squad_subscription_subtitle'  => post('squad_subscription_subtitle'),
                    'squad_subscription_icon'      => post('squad_subscription_icon'),
                    'squad_subscription_short_desc'       => post('squad_subscription_short_desc'),
                    'squad_subscription_desc'       => post('squad_subscription_desc'),
                    'pdf1'                         => post('pdf1'),
                    'pdf2'                         => post('pdf2'),
                    'meta_title'                   => post('meta_title'),
                    'meta_keywords'                => post('meta_keywords'),
                    'meta_desc'                    => post('meta_desc'),
                    'slug'                         => post('slug'),
                );


                // Copy and remove image
                if(post('read_more_image')!=''){
               if ($this->view->service->read_more_image !== $data['read_more_image']) {
                    if (File::copy('data/tmp/' . $data['read_more_image'], 'data/services/images/' . $data['read_more_image'])) {
                     File::remove('data/services/images' . $this->view->service->read_more_image);
                } else{
                   print_data(error_get_last());
                  }
               }
                }

                $result = Model::update('services', $data, "`id` = '$serviceID'"); // Update row

                if ($result) {
                    //Request::addResponse('redirect', false, url('panel', 'services', 'edit', $serviceID));
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

        Request::setTitle('Edit Services');
    }

    public function deleteAction()
    {
        $serviceID = (Request::getUri(0));
        $service = ServicesModel::getService($serviceID);

        if (!$service)
            redirect(url('panel/services'));

        //$data['deleted'] = 'yes';
        $result = Model::delete('services', "`id` = '$serviceID'"); // Update row

        if ($result) {
            //$this->session->set_flashdata('success', 'Service Deleted successfully.');
            // Request::addResponse('redirect', false, url('panel', 'team', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/services'));
    }

    public function remove_funAction()
    {
        Request::ajaxPart(); // if not Ajax part load
        $id = post('id');
        $image = ServicesModel::getServiceImage($id);

        Model::delete('user_images', "`id` = '$id'");
        File::remove('data/fun/' . $image->image);
        Request::addResponse('remove', '#ft_' . $id, false);
    }
}
/* End of file */