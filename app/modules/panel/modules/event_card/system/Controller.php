<?php
class Event_cardController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = Event_cardModel::getAll();

        Request::setTitle('Events');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),
                    'slug'          => makeSlug(post('name')),
                );

                $result   = Model::insert('event_card', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
//                    $this->session->set_flashdata('success', 'Event created successfully.');
                    Request::addResponse('redirect', false, url('panel', 'event_card', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Request::setTitle('Add Event');
    }

    public function editAction()
    {
        Model::import('panel/locations');
        Model::import('panel/team');

        $id = intval(Request::getUri(0));
        $this->view->edit = Event_cardModel::get($id);
        $this->view->locations  = LocationsModel::getAll();
        $this->view->users  = TeamModel::getAllUsers();

        if (!$this->view->edit)
            redirect(url('panel/event_card'));

        if ($this->startValidation()) {
            $this->validatePost('name',             'Name',           'required|trim|min_length[1]|max_length[200]');
            $this->validatePost('book_link',        'Book link',      'required|trim|min_length[1]|max_length[100]|url');
            /* $this->validatePost('site_link',        'Site link',      'required|trim|min_length[1]|max_length[100]|url'); */
            $this->validatePost('image',            'Image',          'required|trim|min_length[1]|max_length[100]');
            $this->validatePost('content',          'Page Content',   'required|trim|min_length[0]');
            $this->validatePost('date',          'date',   'required|trim|min_length[0]');
            $this->validatePost('time',          'time',   'required|trim|min_length[0]');
            $this->validatePost('location_id',          'location',   'required|trim|min_length[0]');
            $this->validatePost('user_ids',   'Speakers',   'is_array');

            if ($this->isValid()) {
                $data = array(
                    'name'      => post('name'),
                    'book_link' => post('book_link'),
                   /*  'site_link' => post('site_link'), */
                    'image'     => post('image'),
                    'content'   => post('content'),
                    'date'   => post('date'),
                    'time'   => post('time'),
                    'location_id'   => post('location_id'),
                );

                // Copy and remove image
                if ($this->view->edit->image !== $data['image']) {
                    if (File::copy('data/tmp/' . $data['image'], 'data/events/' . $data['image'])) {
                        File::remove('data/events/' . $this->view->edit->image);
                    } else
                        print_data(error_get_last());
                }

                $result = Model::update('event_card', $data, "`id` = '$id'"); // Update row

                if ($result) {
                    // Remove and after insert users
                    Event_cardModel::removeEventUsers($id);
                    if (is_array(post('user_ids')) && count(post('user_ids')) > 0) {
                        foreach (post('user_ids') as $user_id) {
                            Model::insert('event_speakers', array(
                                'event_id' => $id,
                                'user_id' => $user_id
                            ));
                        }
                    }
//                    Request::addResponse('redirect', false, url('panel', 'event_card', 'edit', $id));
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

        Request::setTitle('Edit Event');
    }

    public function deleteAction()
    {
        $id = (Request::getUri(0));
        $user = Event_cardModel::get($id);

        if (!$user)
            redirect(url('panel/event_card'));

        $data['deleted'] = 'yes';
        $result = Model::update('event_card', $data, "`id` = '$id'"); // Update row

        if ($result) {
//            $this->session->set_flashdata('success', 'Event created successfully.');
//            Request::addResponse('redirect', false, url('panel', 'event_card', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/event_card'));
    }
}
/* End of file */