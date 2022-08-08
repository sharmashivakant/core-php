<?php

class BlogsController extends Controller
{

    public function indexAction()
    {
        //Model::import('panel/blog/categories');

        // Pagination
        $limit = 6;
        $is_featured = 0;
        $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes' AND `is_featured` = '0'");
        // $event_count = Model::count('event_card', '*', "`deleted` = 'no'");
        $this->view->blogs = BlogsModel::getAll(0, $is_featured, $limit);
        $this->view->featured_blogs = BlogsModel::getFeaturedBlogs($limit);
        $this->view->blogs_count = $count;
        // $this->view->events_count = $event_count;
        $this->view->total_pages = ceil(($count) / $limit);

        // Get sector list and make ID => NAME array
        //$sectors = CategoriesModel::getAll();
        //$sectorsArray = array();
        //foreach ($sectors as $sector)
        //  $sectorsArray[$sector->id] = $sector->name;
        //$this->view->sectors = $sectorsArray;

        //$this->view->events = BlogsModel::getAllEvent();

        Request::setTitle('Blogs');
        Request::setKeywords('');
        Request::setDescription('');
    }

    public function viewAction()
    {
        $slug = Request::getUri(0);
        $this->view->blog = BlogsModel::getBySlug($slug);

        Model::import('panel/blog/categories');
        /*  if (!$this->view->blog)
      redirect(url('blogs'));     */

        $this->view->prev = BlogsModel::getPrevBlog($this->view->blog->id);
        $this->view->next = BlogsModel::getNextBlog($this->view->blog->id);

        //$this->view->blog->category = CategoriesModel::get($this->view->blog->sector);
        $this->view->recents = BlogsModel::getRecentBlogs(3);

        Request::setTitle('Blog- ' . $this->view->blog->meta_title);
        Request::setKeywords($this->view->blog->meta_keywords);
        Request::setDescription($this->view->blog->meta_desc);
    }


    public function searchAction()
    {
        Request::ajaxPart();

        $limit = '6';
        //$keywords   = post('keywords');
        $page = post('page');
        $is_featured   = '0';
        $offset =  $page ? ($page - 1) * $limit : 0;


        $list = BlogsModel::getAll($offset, $is_featured, $limit);
        $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes' AND `is_featured` = '0'");

        if (!empty($list)) {

            foreach ($list as $blogs) {

                $data .= '<div class="blog-content-cell">
                <div class="blog-content-inner">
                    <div class="img-box"><a href="' . SITE_URL . 'blog/' . $blogs->slug . '"><img src="' . _SITEDIR_ . 'data/blog/' . $blogs->image . '" alt=""></a>
                    </div><span class="date">' . date("d/m/Y", $blogs->time) . '</span>
                    <h4><a href="' . SITE_URL . 'blog/' . $blogs->slug . '">' . $blogs->title . '</a> </h4>' . html_entity_decode($blogs->short_description) . '<a href="' . SITE_URL . 'blog/' . $blogs->slug . '" class="arrow-grey-btn">Read More</a></div>
                  </div>';
            }

            $offset = $offset + $limit;
        } else {
            $data = "<div class='no-record'><center><h4> No Result found</h4></center></div>";
            $offset = 0;
        }

        // pagination content
        $pagination = "";
        $total_pages = ceil(($count) / $limit);
        if (!empty($total_pages) && $total_pages > 1) :
            $pagination .= ' <span class="prev" data-id="0"  id="prevPage" ><a href="#" class="back-arrow"></a></span>';
            for ($i = 1; $i <= $total_pages; $i++) :
                if ($i == $page) :
                    $pagination .= ' <span class="para-heading page-item disabled" id="pageContent' . $i . '" data-id="' . $i . '"><a class="page-link" href="javascript:void(0)" tabindex="-1">' . $i . '</a></span>';
                else :
                    $pagination .= '<span class="para-heading page-item" id="pageContent' . $i . '" data-id="' . $i . '"><a class="page-link" href="javascript:void(0)" tabindex="-1">' . $i . '</a></span>';
                endif;
            endfor;
            $pagination .= '<span class="next" data-id="2"  id="nextPage" >
             <a href="#" class="next-arrow "></a></span>';
        endif;
        //  end of pagination

        echo json_encode(array(
            'offset' => $offset,
            'html' => $data,
            'count' => $count,
            'pagination' => $pagination,
        ));
        exit;
    }

    /*  public function blog_detailsAction()
    {
        $slug = Request::getUri(0);
        Request::setTitle('Blog details');
        Request::setKeywords('');
        Request::setDescription('');
    } */

    public function event_viewAction()
    {
        $slug = Request::getUri(0);
        $this->view->event = BlogsModel::getEventBySlug($slug);
        $this->view->location = BlogsModel::getLocationById($this->view->event->location_id);

        if (!$this->view->event)
            redirect(url('blogs'));

        $this->view->recents = BlogsModel::getRecentEvents(3);
    }

    public function speaker_viewAction()
    {
        $slug = Request::getUri(0);
        $user_slug = Request::getUri(1);

        $this->view->event = BlogsModel::getEventBySlug($slug);
        $this->view->user = BlogsModel::getUserBySlug($user_slug);
        $this->view->location = BlogsModel::getLocationById($this->view->event->location_id);

        if (!$this->view->event)
            redirect(url('blogs'));
    }
    public function blogs_load_moreAction()
    {
        Request::ajaxPart();
        // $offset =  post('offset') ? post('offset') : 0;
        $limit = 6;
        $offset =  post('page') ? (post('page') - 1) * $limit : 0;
        $sector =  post('sector') ? post('sector') : "";
        $keywords =  post('keywords') ? post('keywords') : "";
        $blogs = BlogsModel::getAll($offset, $sector, $limit, $keywords);
        //$blogs_count = $count;

        if ($sector && $keywords) {
            $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes' AND `sector` IN ($sector) ");
        } else if ($sector) {
            $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes' AND `sector` IN ($sector)");
        } else if ($keywords) {
            $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes'");
        } else {
            $count = Model::count('blog', '*', "`deleted` = 'no' AND `posted` = 'yes'");
        }

        if (!empty($blogs)) {
            foreach ($blogs as $blog) {
                $data .= ' <div class="blog-box blog">
             <div class="img-sec">';
                if ($blog->image != '') {
                    $data .= '<img src="' . _SITEDIR_ . 'data/blog/' . $blog->image . '" alt="' . $blog->title . '">';
                } else {
                    $data .= '<img src="' . _SITEDIR_ . 'public/images/no-blog-image.jpg" alt="' . $blog->title . '">';
                }
                $data .= '</div>
        <div class="blog-cont">
        <h6><span class="blog-heading-icon border-color-icon1"  style="border-top-color:' . $blog->color_code . '"></span>' . $blog->name . '</h6>
        <h5><a href="' . SITE_URL . 'blog/' . $blog->slug . '">' . $blog->title . '</a>
        </h5>
        <a class="cust-btn" href="' . SITE_URL . 'blog/' . $blog->slug . '">read more</a>
        </div>
        </div>';
            }
            $offset = $offset + $limit;
        } else {
            $data = "<li class='no-record'>Data not found</li>";
            $offset = 0;
        }

        $pagination = "";
        $total_pages = ceil(($count) / $limit);
        // echo $count . ' - ' . $total_pages; die;
        if (!empty($total_pages) && $total_pages > 1) :
            for ($i = 1; $i <= $total_pages; $i++) :
                if ($i == 1) :
                    $pagination .= '<li class="page-item active"  id="pageContent' . $i . '" data-id="' . $i . '"><a class="page-link" href="javascript:void(0)">' . $i . '</a></li>';
                else :
                    $pagination .= '<li class="page-item" id="pageContent' . $i . '" data-id="' . $i . '"><a class="page-link" href="javascript:void(0)">' . $i . '</a></li>';
                endif;
            endfor;
        endif;
        echo json_encode(array(
            'offset' => $offset,
            'html' => $data,
            'pagination' => $pagination,
            'count' => $count,
            'blog_count' => ceil(count($blogs) / 3)
        ));

        exit;
    }

    public function events_load_moreAction()
    {
        Request::ajaxPart();
        $offset =  post('offset');
        $events = BlogsModel::getAllEvent($offset);
        $events_count = $count;
        $count = Model::count('event_card', '*', "`deleted` = 'no'");
        if ($events) {
            foreach ($events as $event) {
                $data .= '<li>
            <div class="box">
            <div class="img-sec">
            <a href="' . SITE_URL . 'event/' . $event->slug . '"><img src="' . _SITEDIR_ . 'data/events/' . $event->image . '" alt="event"></a>
            </div>
            <div class="img-cont">
            <a href="' . SITE_URL . 'event/' . $event->slug . '"><h2 class="sub-heading">' . $event->title . '</h2></a>
            <p>' . reFilter(mb_substr($event->content, 0, 100)) . '...</p>
            <a class="arrow-btn" href="' . SITE_URL . 'event/' . $event->slug . '"></a>
            </div>
            </div>
            </li>';
            }
            echo json_encode(array(
                'offset' => ($offset + 4),
                'html' => $data,
                'count' => $count
            ));
            exit;
        }
    }
}

/* End of file */