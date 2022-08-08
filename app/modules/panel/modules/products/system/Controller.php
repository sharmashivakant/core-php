<?php
class productsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $id = intval(Request::getUri(0));
        if ($id) {
            Model::import('panel/microsites');
            $this->view->microsite = MicrositesModel::get($id);
        } else
            $id = false;

        $this->view->list = productsModel::getAll($id, false, false);

        Request::setTitle('Manage Products');
    }

    public function archiveAction()
    {
        $id = intval(Request::getUri(0));

        $this->view->list = productsModel::getAll($id, false, " OR (`time_expire` < '" . (time() - 180) . "' AND `time_expire` != 0)", 'yes');

        Request::setTitle('Archive products');
    }

    public function addAction()
    {

        if ($this->startValidation()) {
            $this->validatePost('title',        'Job Title',            'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'slug'          => post('title'),
                    'time'          => time(),

                );

                $result   = Model::insert('products', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    Request::addResponse('redirect', false, url('panel', 'products', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Product');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = productsModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/products'));

        if ($this->startValidation()) {
            $this->validatePost('title',        'Job Title',            'required|trim|min_length[1]|max_length[200]');
            // $this->validatePost('ref',          'Job Ref',              'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('sub_title',   'Sub-Title',   'is_array');
             $this->validatePost('image',        'Image',                'trim|min_length[1]|max_length[100]');

 $this->validatePost('image1',        'Image',                'trim|min_length[1]|max_length[100]');

           $this->validatePost('image2',        'Image',                'trim|min_length[1]|max_length[100]');

            $this->validatePost('description', 'Description',            'is_array');
            $this->validatePost('challenge_title', 'Challenge Title',               'trim|min_length[1]|max_length[100]');
            $this->validatePost('challenge_logo','Challenge logo',        'trim|min_length[1]|max_length[50]');
            $this->validatePost('challenge_description',         'Challenge Description',          'trim|min_length[1]');
            $this->validatePost('solution_title',  'Solution Title',         'trim|min_length[1]|max_length[50]');
            $this->validatePost('solution_description',      'Solution Description',              'trim|min_length[1]');
            $this->validatePost('solution_logo',     'Solution Logo',             'trim|min_length[1]|max_length[250]');
            $this->validatePost('results_title',      'Result Title',          'required|trim|min_length[1]');
             $this->validatePost('results_logo',      'Result Logo',          'required|trim|min_length[1]');
             $this->validatePost('results_description',      'Result Description',          'required|trim|min_length[1]');
            $this->validatePost('meta_title',   'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords','Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',    'Meta Description',     'trim|min_length[0]|max_length[200]');
            $this->validatePost('slug',         'Slug',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('first_logo_title',         'First Logo Title',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('second_logo_title',         'Second Logo Title',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('third_logo_title',         'Third Logo Title',                 'required|trim|min_length[1]|max_length[200]');
           
            // Times comparing/checking
            /*$intTime   = convertStringTimeToInt(post('time'));
            $checkTime = date("d/m/Y", $intTime);

            $intTimeExpire   = convertStringTimeToInt(post('time_expire'));
            $checkTimeExpire = date("d/m/Y", $intTimeExpire);

            if ($checkTime != post('time')) {
                $this->addError('time', 'Wrong Date Posted');
            } else if ($checkTimeExpire != post('time_expire')) {
                $this->addError('time_expire', 'Wrong Date Expires');
            }*/

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'sub_title'           => post('sub_title'),
                    'image'  => post('image'),
                    'image1'  => post('image1'),
                    'image2' => post('image2'),
                    'content'       => post('content'),
                    'challenge_title'  => post('challenge_title'),
                    'challenge_logo' => post('challenge_logo'),
                    'challenge_description' => post('challenge_description'),
                    'solution_title'  => post('solution_title', true, 0),
                    'solution_logo'    => post('solution_logo'),
                    'solution_description'    => post('solution_description'),
                    'results_title'    => post('results_title'),
                    'results_logo'    => post('results_logo'),
                    'results_description'    => post('results_description'),
                    'first_logo_title'    => post('first_logo_title'),
                    'second_logo_title'    => post('second_logo_title'),
                    'third_logo_title'    => post('third_logo_title'),
                    'meta_title'    => post('meta_title'),
                    'meta_keywords' => post('meta_keywords'),
                    'meta_desc'     => post('meta_desc'),
                    'slug'          => post('slug'),
                    'time'          => time(),
                    'image'         => post('image'),
                    
                );  

                $oldslug = $slug = makeSlug(post('title'));
                $i = 2;
                Model::import('jobs');
                while ($vac = JobsModel::getNotThis($slug, $id)) {
                    $slug = $oldslug . '-' . $i;
                    $i ++;
                }   

                $data['slug'] = $slug;

                

                // Copy and remove image
                if ($data['image']) {
                    if ($this->view->edit->image !== $data['image']) {
                        if (File::copy('data/tmp/' . $data['image'], 'data/product/' . $data['image'])) {
                            File::remove('data/product/' . $this->view->edit->image);
                        } else
                            print_data(error_get_last());
                    }
                }
                if ($data['image1']) {
                    if ($this->view->edit->image1 !== $data['image1']) {
                        if (File::copy('data/tmp/' . $data['image1'], 'data/product/' . $data['image1'])) {
                            File::remove('data/product/' . $this->view->edit->image1);
                        } else
                            print_data(error_get_last());
                    }
                }
                if ($data['image2']) {
                    if ($this->view->edit->image2 !== $data['image2']) {
                        if (File::copy('data/tmp/' . $data['image2'], 'data/product/' . $data['image2'])) {
                            File::remove('data/product/' . $this->view->edit->image2);
                        } else
                            print_data(error_get_last());
                    }
                }
                if ($data['challenge_logo']) {
                    if ($this->view->edit->challenge_logo !== $data['challenge_logo']) {
                        if (File::copy('data/tmp/' . $data['challenge_logo'], 'data/product/' . $data['challenge_logo'])) {
                            File::remove('data/product/' . $this->view->edit->challenge_logo);
                        } else
                            print_data(error_get_last());
                    }
                }
                if ($data['solution_logo']) {
                    if ($this->view->edit->solution_logo !== $data['solution_logo']) {
                        if (File::copy('data/tmp/' . $data['solution_logo'], 'data/product/' . $data['solution_logo'])) {
                            File::remove('data/product/' . $this->view->edit->solution_logo);
                        } else
                            print_data(error_get_last());
                    }
                }
                if ($data['results_logo']) {
                    if ($this->view->edit->results_logo !== $data['results_logo']) {
                        if (File::copy('data/tmp/' . $data['results_logo'], 'data/product/' . $data['results_logo'])) {
                            File::remove('data/product/' . $this->view->edit->results_logo);
                        } else
                            print_data(error_get_last());
                    }
                }


                $result = Model::update('products', $data, "`id` = '$id'"); // Update row

                if ($result) {                 

//                    Request::addResponse('redirect', false, url('panel', 'products', 'edit', $id));
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

        Request::setTitle('Edit product');
    }

    public function dublicateAction()
    {
        Request::ajaxPart();
        $id = intval(Request::getUri(0));
        $product = productsModel::get($id);

        if (!$product)
            redirect(url('panel/products'));

        $data = [
            'title'           => $product->title,
            'salary_value'    => $product->salary_value,
            'contract_type'   => $product->contract_type,
            'package'         => $product->package,
            'postcode'        => $product->postcode,
            'image'           => $product->image,
            'content_short'   => $product->content_short,
            'content'         => $product->content,
            'consultant_id'   => $product->consultant_id,
            'microsite_id'    => $product->microsite_id,
            'time_expire'     => $product->time_expire,
            'time'            => $product->time,
        ];

        $oldslug = $slug = makeSlug($product->title);
        $i = 2;
        Model::import('jobs');
        while ($vac = JobsModel::get($slug)) {
            $slug = $oldslug . '-' . $i;
            $i ++;
        }
        $data['slug'] = $slug;


        $oldref = $ref = $product->ref;
        $i = 2;
        Model::import('jobs');
        while ($product = JobsModel::getByRef($ref)) {
            $ref = $oldref . '-' . $i;
            $i ++;
        }
        $data['ref'] = $ref;

        $result   = Model::insert('products', $data); // Insert row
        $insertID = Model::insertID();

        if (!$result && $insertID) {

            // Remove and after insert sectors
            $sectors = productsModel::getproductSectors($id);
            if (is_array($sectors) && count($sectors) > 0) {
                foreach ($sectors as $sector) {
                    Model::insert('products_sectors', array(
                        'product_id' => $insertID,
                        'sector_id' => $sector->sector_id
                    ));
                }
            }

            // Remove and after insert locations
            $locations = productsModel::getproductLocations($id);
            if (is_array($locations) && count($locations) > 0) {
                foreach ($locations as $location) {
                    Model::insert('products_locations', array(
                        'product_id' => $insertID,
                        'location_id' => $location->location_id
                    ));
                }
            }

            Request::addResponse('redirect', false, url('panel', 'products', 'edit', $insertID));

        } else {
            Request::returnError('Database Error');
        }

    }

    public function resumeAction()
    {
        Request::ajaxPart();

        if ($this->startValidation()) {
            $this->validatePost('id','ID', 'required|trim');

            if ($this->isValid()) {


                $result = Model::update('products', ['deleted' => 'no'], "`id` = '". post('id') . "'"); // Update row

                if ($result) {
                    Request::addResponse('redirect', false, url('panel', 'products', 'archive'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

    }

    public function expireAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = productsModel::get($id);

        if (!$id)
            redirect(url('panel/products'));

        if ($this->startValidation()) {
            $this->validatePost('reason','Reason', 'required|trim|min_length[1]|max_length[255]');


            if ($this->isValid()) {
                $data = array(
                    'expire_reason' => post('reason'),
                    'time_expire'   => time() - 180 * 24 * 3600,
                );

                $result = Model::update('products', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    Request::addResponse('redirect', false, url('panel', 'products'));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Expire product');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = productsModel::get($id);

        if (!$user)
            redirect(url('panel/products'));

        $data['deleted'] = 'yes';
        $result = Model::update('products', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'product created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'products', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/products'));
    }

    public function widgetAction()
    {
        $target = post('target', true, '#widget_list');
        $action = post('action', true, 'append'); // append|html|...
        $this->view->list = productsModel::getLatest(6);

        Request::ajaxPart();
        Request::addResponse($action, $target, $this->getView());
    }
}
/* End of file */