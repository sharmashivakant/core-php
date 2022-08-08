<?php
class BlogController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = BlogModel::getAll();

        Request::setTitle('Blog');
    }

    public function addAction()
    {
        Model::import('panel/blog/categories');
        $this->view->sectors = CategoriesModel::getAll();

        if ($this->startValidation()) {
            $this->validatePost('title',            'Blog Title',           'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'title'         => post('title'),
                    'slug'          => makeSlug(post('title')),
                    'time'          => time()
                );

                $result   = Model::insert('blog', $data); // Insert row
                $insertID = Model::insertID();


                if (!$result && $insertID) {
                    Request::addResponse('redirect', false, url('panel', 'blog', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Blog Post');
    }

    public function editAction()
    {

        $id = intval(Request::getUri(0));
        $this->view->blog = BlogModel::get($id);
        //$this->view->teamimages = BlogModel::getteamimages($id);

        if (!$this->view->blog)
            redirect(url('panel/blog'));

         Model::import('panel/blog/categories');
         $this->view->sectors = CategoriesModel::getAll();

        Model::import('panel/team');
        $this->view->team    = TeamModel::getAllUsers();

        if ($this->startValidation()) {
            $this->validatePost('title',            'Blog Title',           'required|trim|min_length[1]|max_length[200]');
           //$this->validatePost('subtitle',         'Subtitle',             'trim|min_length[1]|max_length[200]');
            // $this->validatePost('subtitle2',        'Super Subtitle',       'trim|min_length[1]|max_length[200]');
            $this->validatePost('image',            'Image',                'required|trim|min_length[1]|max_length[100]');
            // $this->validatePost('image1',            'First Image',                'required|trim|min_length[1]|max_length[100]');
            //  $this->validatePost('image2',            'Second Image',                'required|trim|min_length[1]|max_length[100]');
            // $this->validatePost('image3',            'Third Image',                'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('details_image',            'Image',                'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('consultant_id',    'Author',               'required|trim');
            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');
            $this->validatePost('content',          'Page Content',         'required|trim|min_length[0]');
            // $this->validatePost('content_before',   'Content before image', 'trim|min_length[0]');
            $this->validatePost('sector',           'Industries/Sectors',   'required|trim|min_length[1]');
            $this->validatePost('slug',             'Slug',                 'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('time',             'Date Posted',          'trim|min_length[1]|max_length[50]');
            $this->validatePost('posted',           'Posted',               'trim|min_length[1]|max_length[50]');
            $this->validatePost('short_description',   'Short Description', 'trim|min_length[1]');

            // Times comparing/checking
            $intTime   = convertStringTimeToInt(post('time'));
            $checkTime = date("d/m/Y", $intTime);

            if ($checkTime != post('time')) {
                $this->addError('time', 'Wrong Date Posted');
            }

            if ($this->isValid()) {

                $data = array(
                    'title'          => post('title'),
                   // 'subtitle'       => post('subtitle'),
                    'consultant_id'  => post('consultant_id', 'int', 0),
                    'image'          => post('image'),
                    //'image1'          => post('image1'),
                    //'image2'          => post('image2'),
                    //'image3'          => post('image3'),
                    'details_image'  => post('details_image'),
                    'meta_title'     => post('meta_title'),
                    'meta_keywords'  => post('meta_keywords'),
                    'meta_desc'      => post('meta_desc'),
                    'short_description'        => post('short_description'),
                    'content'        => post('content'),
                    'is_featured'        => post('is_featured'),
                    'sector'         => post('sector'),
                    'slug'           => post('slug'),
                    'posted'         => post('posted'),
                    'time'           => $intTime,
                    //'video'           =>post('video'),
                    //'Journey_content'           => post('Journey_content'),  
                );

                // Copy and remove image
                if ($this->view->blog->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/blog/' . $data['image'])) {
                        File::remove('data/blog/' . $this->view->blog->image);
                    } else
                        print_data(error_get_last());
                }
                /*if ($this->view->blog->image1 !== $data['image1']) {
                    if (File::copy('data/tmp/' . $data['image1'], 'data/blog/' . $data['image1'])) {
                        File::remove('data/blog/' . $this->view->blog->image1);
                    } else
                        print_data(error_get_last());
                }
                if ($this->view->blog->image2 !== $data['image2']) {
                    if (File::copy('data/tmp/' . $data['image2'], 'data/blog/' . $data['image2'])) {
                        File::remove('data/blog/' . $this->view->blog->image2);
                    } else
                        print_data(error_get_last());
                }
                if ($this->view->blog->image3 !== $data['image3']) {
                    if (File::copy('data/tmp/' . $data['image3'], 'data/blog/' . $data['image3'])) {
                        File::remove('data/blog/' . $this->view->blog->image3);
                    } else
                        print_data(error_get_last());
                }*/
                if ($this->view->blog->details_image !== $data['details_image']) {
                    if (File::copy('data/tmp/' . $data['details_image'], 'data/blog/' . $data['details_image'])) {
                        File::remove('data/blog/' . $this->view->blog->details_image);
                    } else
                        print_data(error_get_last());    
                }

                $result = Model::update('blog', $data, "`id` = '$id'"); // Update row

                if ($result) {

                    //                    Request::addResponse('redirect', false, url('panel', 'blog', 'edit', $id));
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

        Request::setTitle('Edit Blog Post');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = BlogModel::get($id);

        if (!$user)
            redirect(url('panel/blog'));

        $data['deleted'] = 'yes';
        $result = Model::update('blog', $data, "`id` = '$id'"); // Update row

        if ($result) {
            //            $this->session->set_flashdata('success', 'User created successfully.');
            //            Request::addResponse('redirect', false, url('panel', 'blog', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/blog'));
    }
    public function addTeamimagesAction()
    {

        if (!empty($_FILES))
            $blog_id = post('blog_id');
        $resultt = Model::delete('blog_team_images', "`blog_id` = '$blog_id'");

        /*if(is_array($_FILES) && !empty($_FILES['avatar']))  */ {
            $i = 1;
            foreach ($_FILES as $key => $filename) {
                /*echo '<pre>';
        print_r($filenamedata);
        die;*/
                /* foreach($filenamedata as $key => $filename)  
     { */
                /*echo '<pre>';
        print_r($filename);
        die;*/

                $file_name = explode(".", $filename['name']);

                $allowed_extension = array("jpg", "jpeg", "png", "gif");
                if (in_array($file_name[1], $allowed_extension)) {
                    $new_name = rand() . '.' . $file_name[1];
                    $sourcePath = $filename['temp_name'];
                    $targetPath = _SITEDIR_ . "data/blog/" . $new_name;

                    move_uploaded_file($sourcePath, $targetPath);
                }

                $data = array(
                    'blog_id'         => $blog_id,
                    'image'          => $new_name,
                    'time'          => time()
                );


                $result   = Model::insert('blog_team_images', $data); // Insert row 

                //} 
                $i++;
            }
        }
        exit();
    }
}
/* End of file */
