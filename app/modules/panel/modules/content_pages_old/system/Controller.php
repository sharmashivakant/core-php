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
        $pages = Content_pagesModel::getPages($module);
        $names = Content_pagesModel::getPagesNames($module);

        foreach ($pages as $page) {
            foreach ($names as $name) {
                if ($page->page == $name->page)
                    $page->page_name = $name->content;
            }
        }

        $this->view->list = $pages;

        Request::setTitle('Content Pages');
    }

    public function editAction()
    {
        $module = get('module', true, false);
        $page   = get('page',   true, false);

        $this->view->list = Content_pagesModel::getBlocks($module, $page);

        // Create content field for page name
        $this->view->page_name = Content_pagesModel::getBlock($module, $page, 'page_name');
        if (!$this->view->page_name)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'page_name', 'type' => 'page_name', 'time' => time()]);

        // Create content fields for meta tags
        $this->view->meta_title = Content_pagesModel::getBlock($module, $page, 'meta_title');
        if (!$this->view->meta_title)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_title', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_keywords = Content_pagesModel::getBlock($module, $page, 'meta_keywords');
        if (!$this->view->meta_keywords)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_keywords', 'type' => 'meta', 'time' => time()]);

        $this->view->meta_desc = Content_pagesModel::getBlock($module, $page, 'meta_desc');
        if (!$this->view->meta_desc)
            Model::insert('content_pages_tree', ['module' => $module, 'page' => $page, 'name' => 'meta_desc', 'type' => 'meta', 'time' => time()]);


        if (!$this->view->list)
            redirect(url('panel/content_pages'));

        if ($this->startValidation()) {
            $this->validatePost('meta_title',       'Meta Title',           'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords',    'Meta Keywords',        'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',        'Meta Description',     'trim|min_length[0]|max_length[200]');
            $this->validatePost('page_name',        'PAge Name',            'trim|min_length[0]|max_length[200]');

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
                Model::update('content_pages_tree', ['content' => post('page_name')], "`module` = '$module' AND `page` = '$page' AND `name` = 'page_name'"); // Update row
                Model::update('content_pages_tree', ['content' => post('meta_title')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_title'"); // Update row
                Model::update('content_pages_tree', ['content' => post('meta_keywords')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_keywords'"); // Update row
                Model::update('content_pages_tree', ['content' => post('meta_desc')], "`module` = '$module' AND `page` = '$page' AND `name` = 'meta_desc'"); // Update row

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

    public function deleteAction()
    {
        $id = get('id');
        $block = Content_pagesModel::get($id);

        if (!$block)
            redirect(url('panel/content_pages/edit?module=' . get('module') . '&page=' . get('page')));

        $result = Model::delete('content_pages_tree', " `id` = '$id'");

        if ($result) {
//            $this->session->set_flashdata('success', 'Content block created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'content_blocks', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }


        redirect(url('panel/content_pages/edit?module=' . get('module') . '&page=' . get('page')));
    }
}
/* End of file */