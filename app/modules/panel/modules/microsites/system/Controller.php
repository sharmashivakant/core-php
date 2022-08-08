<?php
class MicrositesController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        $this->view->list = MicrositesModel::getAll();

        Request::setTitle('Microsites');
    }

    public function addAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('title',        'Title',            'required|trim|min_length[0]|max_length[100]');
            $this->validatePost('ref',          'Ref',              'required|trim|min_length[0]|max_length[50]');
            // $this->validatePost('logo_image',   'Logo',             'required');
            $this->validatePost('header_image', 'Landing Image',    'required');
            $this->validatePost('website',      'Website URL',      'trim|min_length[0]');
            //$this->validatePost('company_size', 'Company Size',     'required|trim|min[1]');
            $this->validatePost('content',      'Overview',         'required|trim|min_length[1]');
             $this->validatePost('key_content', 'Key Content',     'required|trim|min_length[1]');
            $this->validatePost('meta_title',   'Meta Title',       'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords', 'Meta Keywords',    'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',    'Meta Description', 'trim|min_length[0]|max_length[200]');
            //  $this->validatePost('slug',         'Slug',             'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'title'                 => post('title'),
                    'ref'                   => post('ref'),
                    'key_content'               => post('key_content'),
                    //'company_size'          => post('company_size'),
                    'content'               => post('content'),
                    'meta_title'            => post('meta_title'),
                    'meta_keywords'         => post('meta_keywords'),
                    'meta_desc'             => post('meta_desc'),
                    //'logo_image'            => post('logo_image'),
                    'header_image'          => post('header_image'),
                    //'key_image'             => post('key_image'),
                    //'overview_image'        => post('overview_image'),
                    //                    'opportunities_image'   => post('opportunities_image'),
                    //'og_image'              => post('og_image'),
                    // 'slug'                  => post('slug'),
                    'time'                  => time(),
                );

                // Copy logo_image
                // if ($data['logo_image']) {
                //     if (!File::copy('data/tmp/' . $data['logo_image'], 'data/microsite/' . $data['logo_image']))
                //       print_data(error_get_last());
                // }

                // Copy header_image
                if ($data['header_image']) {
                    if (!File::copy('data/tmp/' . $data['header_image'], 'data/microsite/' . $data['header_image']))
                        print_data(error_get_last());
                }

                // Copy key_image
                if ($data['key_image']) {
                    if (!File::copy('data/tmp/' . $data['key_image'], 'data/microsite/' . $data['key_image']))
                        print_data(error_get_last());
                }

                // Copy overview_image
                //    if ($data['overview_image']) {
                //       if (!File::copy('data/tmp/' . $data['overview_image'], 'data/microsite/' . $data['overview_image']))
                //          print_data(error_get_last());
                //  }

                //                // Copy opportunities_image
                //                if ($data['opportunities_image']) {
                //                    if (!File::copy('data/tmp/' . $data['opportunities_image'], 'data/microsite/' . $data['opportunities_image']))
                //                        print_data(error_get_last());
                //                }

                // Copy og_image
                // if ($data['og_image']) {
                //    if (!File::copy('data/tmp/' . $data['og_image'], 'data/microsite/' . $data['og_image']))
                //     print_data(error_get_last());
                //  }

                $result   = Model::insert('microsites', $data); // Insert row
                $insertID = Model::insertID();

                if (!$result && $insertID) {
                    // Insert sectors
                    if (is_array(post('sector_ids')) && count(post('sector_ids')) > 0) {
                        foreach (post('sector_ids') as $sector_id) {
                            Model::insert('microsites_sectors', array(
                                'microsite_id' => $insertID,
                                'sector_id' => $sector_id
                            ));
                        }
                    }

                    // Insert locations
                    if (is_array(post('location_ids')) && count(post('location_ids')) > 0) {
                        foreach (post('location_ids') as $location_id) {
                            Model::insert('microsites_locations', array(
                                'microsite_id' => $insertID,
                                'location_id' => $location_id
                            ));
                        }
                    }

                    Request::addResponse('redirect', false, url('panel', 'microsites', 'edit', $insertID));
                } else {
                    Request::returnError('Database error');
                }
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        Model::import('panel/sectors');
        Model::import('panel/locations');

        $this->view->sectors   = SectorsModel::getAll();
        $this->view->locations = LocationsModel::getAll();

        Request::setTitle('Add Microsite');
    }

    public function editAction()
    {
        $id = intval(Request::getUri(0));
        $this->view->edit = MicrositesModel::get($id);

        if (!$this->view->edit)
            redirect(url('panel/microsites'));

        if ($this->startValidation()) {
            $this->validatePost('title',        'Title',            'required|trim|min_length[0]|max_length[100]');
            $this->validatePost('ref',          'Ref',              'required|trim|min_length[0]|max_length[50]');
            // $this->validatePost('logo_image',   'Logo',             'required');
            $this->validatePost('header_image', 'Landing Image',    'required');
            //$this->validatePost('website',      'Website URL',      'trim|min_length[0]');
            $this->validatePost('key_content', 'Key Content',     'required|trim|min_length[1]');
            $this->validatePost('content',      'Overview',         'required|trim|min_length[1]');
            $this->validatePost('meta_title',   'Meta Title',       'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_keywords', 'Meta Keywords',    'trim|min_length[0]|max_length[200]');
            $this->validatePost('meta_desc',    'Meta Description', 'trim|min_length[0]|max_length[200]');
            //  $this->validatePost('slug',         'Slug',             'required|trim|min_length[1]|max_length[100]');

            if ($this->isValid()) {
                $data = array(
                    'title'                 => post('title'),
                    'ref'                   => post('ref'),
                    'website'               => post('website'),
                    'key_content'          => post('key_content'),
                    'content'               => post('content'),
                    'meta_title'            => post('meta_title'),
                    'meta_keywords'         => post('meta_keywords'),
                    'meta_desc'             => post('meta_desc'),
                    //'logo_image'            => post('logo_image'),
                    'header_image'          => post('header_image'),
                    //'key_image'             => post('key_image'),
                    //'overview_image'        => post('overview_image'),
                    // 'opportunities_image'   => post('opportunities_image'),
                    //'og_image'              => post('og_image'),
                    //'slug'                  => post('slug'),
                );


                // Copy and remove logo_image
                //if ($this->view->edit->logo_image !== $data['logo_image']) {
                // if (File::copy('data/tmp/' . $data['logo_image'], 'data/microsite/' . $data['logo_image'])) {
                //    File::remove('data/microsite/' . $this->view->edit->logo_image);
                //} else
                //   print_data(error_get_last());
                // }

                // Copy and remove header_image
                if ($this->view->edit->header_image !== $data['header_image']) {
                    if (File::copy('data/tmp/' . $data['header_image'], 'data/microsite/' . $data['header_image'])) {
                        File::remove('data/microsite/' . $this->view->edit->header_image);
                    } else
                        print_data(error_get_last());
                }

                // Copy and remove key_image
               /* if ($this->view->edit->key_image !== $data['key_image']) {
                    if (File::copy('data/tmp/' . $data['key_image'], 'data/microsite/' . $data['key_image'])) {
                        File::remove('data/microsite/' . $this->view->edit->key_image);
                    } else
                        print_data(error_get_last());
                }*/

                // Copy and remove overview_image
                //  if ($this->view->edit->overview_image !== $data['overview_image']) {
                //     if (File::copy('data/tmp/' . $data['overview_image'], 'data/microsite/' . $data['overview_image'])) {
                //       File::remove('data/microsite/' . $this->view->edit->overview_image);
                //  } else
                //      print_data(error_get_last());
                // }

                // Copy and remove opportunities_image
                // if ($this->view->edit->opportunities_image !== $data['opportunities_image']) {
                //   if (File::copy('data/tmp/' . $data['opportunities_image'], 'data/microsite/' . $data['opportunities_image'])) {
                //      File::remove('data/microsite/' . $this->view->edit->opportunities_image);
                // } else
                //     print_data(error_get_last());
                //  }

                // Copy and remove og_image
                //  if ($this->view->edit->og_image !== $data['og_image']) {
                //   if (File::copy('data/tmp/' . $data['og_image'], 'data/microsite/' . $data['og_image'])) {
                //      File::remove('data/microsite/' . $this->view->edit->og_image);
                //  } else
                //     print_data(error_get_last());
                //  }


                $result = Model::update('microsites', $data, "`id` = '$id' LIMIT 1"); // Update row

                if ($result) {
                    // Remove and after insert tag sectors
                    Model::delete('microsites_tag_sectors', "`microsite_id` = '$id'");
                    if (is_array(post('tag_sector_ids')) && count(post('tag_sector_ids')) > 0) {
                        foreach (post('tag_sector_ids') as $sector_id) {
                            Model::insert('microsites_tag_sectors', array(
                                'microsite_id' => $id,
                                'sector_id' => $sector_id
                            ));
                        }
                    }

                    // Remove and after insert sectors
                    Model::delete('microsites_sectors', "`microsite_id` = '$id'");
                    if (is_array(post('sector_ids')) && count(post('sector_ids')) > 0) {
                        foreach (post('sector_ids') as $sector_id) {
                            Model::insert('microsites_sectors', array(
                                'microsite_id' => $id,
                                'sector_id' => $sector_id
                            ));
                        }
                    }

                    // Remove and after insert locations
                    Model::delete('microsites_locations', "`microsite_id` = '$id'");
                    if (is_array(post('location_ids')) && count(post('location_ids')) > 0) {
                        foreach (post('location_ids') as $location_id) {
                            Model::insert('microsites_locations', array(
                                'microsite_id' => $id,
                                'location_id' => $location_id
                            ));
                        }
                    }

                    // Remove and after insert vacancies
                    Model::delete('microsites_vacancies', "`microsite_id` = '$id'");
                    if (is_array(post('vacancy_ids')) && count(post('vacancy_ids')) > 0) {
                        foreach (post('vacancy_ids') as $vacancy_id) {
                            Model::insert('microsites_vacancies', array(
                                'microsite_id' => $id,
                                'vacancy_id' => $vacancy_id
                            ));
                        }
                    }

                    //                    Request::addResponse('redirect', false, url('panel', 'microsites', 'edit', $id));
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


        Model::import('panel/microsites/tag_sectors');
        Model::import('panel/sectors');
        Model::import('panel/locations');
        Model::import('panel/vacancies');

        $this->view->tag_sectors = Tag_sectorsModel::getAll();
        $this->view->sectors     = SectorsModel::getAll();
        $this->view->locations   = LocationsModel::getAll();
        $this->view->vacancies   = VacanciesModel::getAll(); //$id

        Request::setTitle('Edit Microsite');
    }

    public function deleteAction()
    {
        $userID = (Request::getUri(0));
        $user = MicrositesModel::get($userID);

        if (!$user)
            redirect(url('panel/microsites'));

        $data['deleted'] = 'yes';
        $result = Model::update('microsites', $data, "`id` = '$userID'"); // Update row

        if ($result) {
            //            Request::addResponse('redirect', false, url('panel', 'microsites', 'edit', $insertID));
        } else {
            Request::returnError('Database error');
        }

        redirect(url('panel/microsites'));
    }
}
/* End of file */