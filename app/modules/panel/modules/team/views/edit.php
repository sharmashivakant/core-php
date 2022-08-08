<form id="form_box" action="{URL:panel/team/edit/<?= $this->user->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/team}">Team</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name</label>
                            <input class="form-control" type="text" name="firstname" id="firstname" value="<?= post('firstname', false, $this->user->firstname); ?>"><!--required-->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" value="<?= post('lastname', false, $this->user->lastname); ?>"><!--required-->
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" value="<?= post('email', false, $this->user->email); ?>"><!--required-->
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">Password (Leave Empty If Do Not Want to Change)</label>
                            <input class="form-control" type="password" name="password" id="password" value="<?= post('password', false); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                       
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role" required>
                                    <option value="admin"  <?= checkOptionValue(post('role'), 'admin', $this->user->role); ?>>Admin</option>
                                    <option value="moder"  <?= checkOptionValue(post('role'), 'moder', $this->user->role); ?>>Consultant</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slug">Slug</label>
                                <input class="form-control" type="text" name="slug" id="slug" value="<?= post('slug', false, $this->user->slug); ?>">
                            </div>
                            <!-- <div class="form-group">
                                <label>Team Member</label>
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input class="custom-control-input" type="checkbox" name="is_team_member" id="is_team_member" value="1" <?= $this->user->is_team_member==1 ? "checked" : "" ?> ><label class="custom-control-label" for="is_team_member"></label>
                                </div>
                            </div> -->
                           <!--  <div class="form-group">
                                <label>Speaker</label>
                                <div class="custom-control custom-checkbox checkbox-info">
                                    <input class="custom-control-input" type="checkbox" name="is_speaker" id="is_speaker" value="1" <?= $this->user->is_speaker==1 ? "checked" : "" ?> ><label class="custom-control-label" for="is_speaker"></label>
                                </div>
                            </div> -->
                     
						
                     </div>
                        <div class="form-row">
                        <div class="form-group col-md-6">
                            <!-- Image -->
                            <label for="image">View Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->user->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/users/<?= post('image', false, $this->user->image); ?>" alt="">
                                </div>
                            </div>
                        </div>
						
						 <div class="form-group col-md-6">
                            <!-- Image -->
                            <label for="image">Detail Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="detail_image" id="detail_image" value="<?= post('detail_image', false, $this->user->detail_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_detailimage/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#detail_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_detail_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/users/<?= post('detail_image', false, $this->user->detail_image); ?>" alt="">
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

            <!-- Details -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Details</h4>

                    <div class="form-row">
                         
                        <div class="form-group col-md-6">
                            <label for="title">Job Title</label>
                            <input class="form-control" type="text" name="job_title" id="job_title" value="<?= post('job_title', false, $this->user->job_title); ?>">
                        </div>
                       <!--  <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->user->title); ?>">
                        </div> -->    
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tel">Telephone Number</label>
                            <input class="form-control" type="tel" name="tel" id="tel" value="<?= post('tel', false, $this->user->tel); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="linkedin">LinkedIn URL</label>
                            <input class="form-control" type="text" name="linkedin" id="linkedin" value="<?= post('linkedin', false, $this->user->linkedin); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="linkedin">Twitter URL</label>
                            <input class="form-control" type="text" name="twitter" id="twitter" value="<?= post('twitter', false, $this->user->twitter); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="linkedin">Skype URL</label>
                            <input class="form-control" type="text" name="skype" id="skype" value="<?= post('skype', false, $this->user->skype); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="linkedin">Facebook URL</label>
                            <input class="form-control" type="text" name="facebook" id="facebook" value="<?= post('facebook', false, $this->user->facebook); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="linkedin">Instagram</label>
                            <input class="form-control" type="text" name="instagram" id="instagram" value="<?= post('instagram', false, $this->user->instagram); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="linkedin">Organization</label>
                            <input class="form-control" type="text" name="organization" id="organization" value="<?= post('organization', false, $this->user->organization); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="20"><?= post('description', false, $this->user->description); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <a class="btn btn-success" onclick="
                                    setTextareaValue();
                                    load('panel/team/edit/<?= $this->user->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/team}"><i class="fas fa-ban"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>


<link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/ckeditor.js"></script>
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/js/sample.js"></script>

<!-- Connect editor -->
<script>
    var editorField;

    function setTextareaValue() {
        $('#description').val(editorField.getData());
    }

    $(function () {
        $("#firstname, #lastname").keyup(function () {
            initSlug('#slug', '#firstname,#lastname');
        });

        editorField = CKEDITOR.replace('description', {
            htmlEncodeOutput: false,
            wordcount: {
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,
            },
            removePlugins: 'zsuploader',

            filebrowserBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
            filebrowserUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        });
    });
</script>