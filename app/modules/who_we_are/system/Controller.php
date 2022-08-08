<?php

class Who_we_areController extends Controller
{
    use Validator;

    public function indexAction()
    {
        Model::import('panel/videos');
        /* $this->view->video = VideosModel::getVideoByName('what-we-do');
 */
        Request::setTitle('Who we are');
        Request::setKeywords('');
        Request::setDescription('');
    }

    public function teamAction()
    {
        Model::import('panel/videos');
        /* $this->view->video = VideosModel::getVideoByName('what-we-do');
 */
        Request::setTitle('Team');
        Request::setKeywords('');
        Request::setDescription('');
    }
}
/* End of file */