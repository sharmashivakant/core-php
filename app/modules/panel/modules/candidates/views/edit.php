<div id="control-container">
    <div id="button-holder">
        <a href="{URL:panel/candidates}" class="btn add"><i class="fas fa-ban"></i>Cancel</a>
        <div class="clr"></div>
    </div>
    <h1>
        <i class="fas fa-users"></i>Candidates <i class="fas fa-caret-right"></i>Edit
    </h1>
    <hr/>

    <?php if (isset($success) && $success) { ?>
        <div class="success">
            <i class="fas fa-check-circle"></i><?= $success; ?>
        </div>
    <?php } ?>
    <?php if (isset($error) && $error) { ?>
        <div class="error">
            <i class="fas fa-check-circle"></i><?= $error; ?>
        </div>
    <?php } ?>
    <?php //echo validation_errors('<div class="error"><i class="fas fa-check-circle"></i>', '</div>'); ?>


    <form id="team_form" action="{URL:panel/candidates/edit/<?= $this->user->id; ?>}" method="post" enctype="multipart/form-data">
        <div class="form-section">
            <span class="heading">General</span>
            <div class="col half_column_left">
                <label for="firstname">First Name</label>
                <input type="text" name="firstname" id="firstname" value="<?= post('firstname', false, $this->user->firstname); ?>"><!--required-->
            </div>

            <div class="col half_column_right">
                <label for="lastname">Last Name</label>
                <input type="text" name="lastname" id="lastname" value="<?= post('lastname', false, $this->user->lastname); ?>"><!--required-->
            </div>

            <div class="col half_column_left">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= post('email', false, $this->user->email); ?>"><!--required-->
            </div>

            <div class="col half_column_right">
                <label for="tel">Telephone Number</label>
                <input type="tel" name="tel" id="tel" value="<?= post('tel', false, $this->user->tel); ?>">
            </div>

            <div class="col half_column_left">
                <label for="password">Password (Leave Empty If Do Not Want to Change)</label>
                <input type="password" name="password" id="password" value="<?= post('password', false); ?>">

                <div class="col">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" value="<?= post('slug', false, $this->user->slug); ?>">
                </div>
            </div>

            <?php /*
            <div class="col half_column_right">
                <label for="image">Image
                    <small><i>(Image files must be under <?php echo file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small>
                </label>
                <input type="file" name="image" id="image" class="inputfile"/>
            </div>
            */ ?>

            <!-- Image -->
            <div class="col half_column_right">
                <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                <div class="choose-file modern">
                    <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->user->image); ?>">
                    <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#image');">
                    <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                    <div id="preview_image" class="preview_image">
                        <img src="<?= _SITEDIR_; ?>data/users/<?= post('image', false, $this->user->image); ?>" alt="">
                    </div>
                </div>
            </div>

            <div class="clr"></div>
        </div>

        <div class="form-section">
            <span class="heading">Details</span>
            <div class="col full-column">
                <label for="title">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="<?= post('job_title', false, $this->user->job_title); ?>">
            </div>

            <div class="col half_column_left">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?= post('title', false, $this->user->title); ?>">
            </div>

            <div class="col half_column_right">
                <label for="linkedin">LinkedIn URL</label>
                <input type="text" name="linkedin" id="linkedin" value="<?= post('linkedin', false, $this->user->linkedin); ?>">
            </div>

            <div class="col half_column_left">
                <label for="linkedin">Twitter URL</label>
                <input type="text" name="twitter" id="twitter" value="<?= post('twitter', false, $this->user->twitter); ?>">
            </div>

            <div class="col half_column_right">
                <label for="linkedin">Skype</label>
                <input type="text" name="skype" id="skype" value="<?= post('skype', false, $this->user->skype); ?>">
            </div>

            <div class="clr"></div>
            <div class="col full_column">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="20"><?= post('description', false, $this->user->description); ?></textarea>
            </div>
            <div class="clr"></div>
        </div>

        <div class="form-section">
            <button type="submit" name="submit" class="btn submit" onclick="setTextareaValue(); load('panel/candidates/edit/<?= $this->user->id; ?>', 'form:#team_form'); return false;"><i class="fas fa-save"></i>Save Changes</button>
            <?php /*
            <input type="submit" name="submit" class="btn submit" value="Save Changes">
            <button type="submit" name="submit" class="btn submit" onclick="load('panel/team/edit/<?= $this->user->id; ?>//', 'form:#team_form'); return false;"><i class="fas fa-save"></i>Save Changes</button>
            */ ?>
            <a href="{URL:panel/candidates}" onclick="load('panel/candidates');" class="btn cancel"><i class="fas fa-ban"></i>Cancel</a>
            <div class="clr"></div>
        </div>
    </form>
</div>

<link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/ckeditor.js"></script>
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/js/sample.js"></script>
<script>
    var editorField;

    function setTextareaValue() {
        $('#description').val(editorField.getData());
    }

    $(function () {
        initSlug('#slug', '#firstname,#lastname');

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