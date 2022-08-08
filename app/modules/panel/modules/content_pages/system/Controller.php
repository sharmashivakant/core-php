<?php
class Content_pagesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Content_pagesModel::getModules();
        Request::setTitle('Content Pages');
    }

    public function viewAction()
    {
        $module = get('module', true, false);
        $this->view->list = Content_pagesModel::getPages($module);
        Request::setTitle('Content Pages');
    }

    public function editAction()
    {
        $module = get('module', true, false);
        $page   = get('page',   true, false);
        $lang   = post('lang',   true, false);
        
     
        if (!$lang)
            $lang = 'en';

        $this->view->list = Content_pagesModel::getBlocks($module, $page, $lang);
        

        // Create content fields for meta tags
        $this->view->meta_title = Content_pagesModel::getBlock($module, $page, 'meta_title', $lang);
        if (!$this->view->meta_title)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_title', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_keywords = Content_pagesModel::getBlock($module, $page, 'meta_keywords', $lang);
        if (!$this->view->meta_keywords)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_keywords', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_desc = Content_pagesModel::getBlock($module, $page, 'meta_desc', $lang);
        if (!$this->view->meta_desc)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_desc', 'type' => 'meta', 'time' => time()]);

        if (!$this->view->list)
            redirect(url('panel/content_pages'));

        if ($this->startValidation()) {
            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');

            // Generating rules
            foreach ($this->view->list as $item) {
                $this->validatePost(($item->name . '--alias'),  defaultValue($item->alias, $item->name) . ' Block Name',    'trim|min_length[0]|max_length[150]');
                $this->validatePost($item->name,                defaultValue($item->alias, $item->name) . ' Content',       'required|trim|min_length[0]');
            }

            if ($this->isValid()) {
            
                $result = false;
                // Updating elements
                foreach ($this->view->list as $item) {
                    $data = array(
                        'alias'   => post(($item->name . '--alias')),
                        'content' => post($item->name),
                    );

                    // Copy and remove image
                    if ($item->type === 'image' && $item->content !== $data['content']) {
                        if (File::copy('data/tmp/' . $data['content'], 'data/images/' . $data['content'])) {
                            File::remove('data/images/' . $item->content);
                        } else
                            print_data(error_get_last());
                        $data['content'] = _SITEDIR_ . 'data/images/' . $data['content'];
                    }


                    // Copy and remove video
                    if ($item->type === 'video' && $item->content !== $data['content']) {
                        if (File::copy('data/tmp/' . $data['content'], 'data/videos/' . $data['content'])) {
                            File::remove('data/videos/' . $item->content);
                        } else
                            print_data(error_get_last());
                        $data['content'] = _SITEDIR_ . 'data/videos/' . $data['content'];
                    }

                  
                    $result = Model::update('content_pages_tree', $data, "`id` = '$item->id'"); // Update row
                }


                // Update content fields for meta tags
                Model::update('content_pages_tree', ['content' => post('meta_title')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_title' AND `lang` = '$lang'"); // Update row
                Model::update('content_pages_tree', ['content' => post('meta_keywords')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_keywords' AND `lang` = '$lang'"); // Update row
                Model::update('content_pages_tree', ['content' => post('meta_desc')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_desc' AND `lang` = '$lang'"); // Update row

                if ($result)
                    Request::addResponse('redirect', false, url('panel', 'content_pages', 'edit') . '?module=' . $module . '&page=' . $page);
                else
                    Request::returnError('Database error');
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Edit Content Block');
    }

    public function change_langAction()
    {
        Request::ajaxPart();

        $module = post('module');
        $page = post('page');
        $lang = post('lang');

        $this->view->list = Content_pagesModel::getBlocks($module, $page, $lang);
       

        if (!$this->view->list) {
            //get all elements for EN lang
            $en = Content_pagesModel::getBlocks($module, $page, 'en', 'assoc');

            //copy content for new lang
            $values = ['module', 'page', 'name', 'alias', 'content', 'type', 'lang', 'video_type',
                'image_height', 'image_width', 'position', 'time'];
            $sql = "INSERT INTO `content_pages_tree`(`" . implode('`, `', $values) ."`) VALUES ";

            foreach ($en as $k => $item) {
                $data = [
                    "module"         => $item['module'],
                    "page"           => $item['page'],
                    "name"           => $item['name'],
                    "alias"          => $item['alias'],
                    "content"        => $item['content'],
                    "type"           => $item['type'],
                    "lang"           => $lang,
                    "video_type"     => $item['video_type'],
                    "image_height"   => $item['image_height'],
                    "image_width"    => $item['image_width'],
                    "position"       => $item['position'],
                    "time"           => time(),
                ];


                if ($k == (count($en) - 1))
                    $sql .= "('" . implode("', '", $data) . "')";
                else
                    $sql .= "('" . implode("', '", $data) . "'), ";
            }

            $insert = Model::query($sql);

           

            // update content fields for meta tags
            $en_meta_title = Content_pagesModel::getBlock($module, $page, 'meta_title', 'en');
            if ($en_meta_title)
                Model::insert('content_pages_tree',
                    ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_title', 'type' => 'meta', 'time' => time(), 'content' => $en_meta_title->content]);


            $en_meta_keywords = Content_pagesModel::getBlock($module, $page, 'meta_keywords', 'en');
            if ($en_meta_keywords)
                Model::insert('content_pages_tree',
                    ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_keywords', 'type' => 'meta', 'time' => time(), 'content' => $en_meta_keywords->content]);

            $en_meta_desc = Content_pagesModel::getBlock($module, $page, 'meta_desc', 'en');
            if ($en_meta_desc)
                Model::insert('content_pages_tree',
                    ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_desc', 'type' => 'meta', 'time' => time(), 'content' => $en_meta_desc->content ]);

            $this->view->list = Content_pagesModel::getBlocks($module, $page, $lang);
        }


        

        // Create content fields for meta tags
        $this->view->meta_title = Content_pagesModel::getBlock($module, $page, 'meta_title', $lang);
        if (!$this->view->meta_title)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_title', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_keywords = Content_pagesModel::getBlock($module, $page, 'meta_keywords', $lang);
        if (!$this->view->meta_keywords)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_keywords', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_desc = Content_pagesModel::getBlock($module, $page, 'meta_desc', $lang);
        if (!$this->view->meta_desc)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'lang' => $lang, 'name' => 'meta_desc', 'type' => 'meta', 'time' => time()]);

        if (!$this->view->list)
            redirect(url('panel/content_pages'));
           

        Request::addResponse('html', '#content_box', $this->getView());
    }
}
/* End of file */