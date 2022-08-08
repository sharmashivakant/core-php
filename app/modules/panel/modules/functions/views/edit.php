<div id="control-container">
    <div id="button-holder">
        <a href="{URL:panel/functions}" onclick="load('panel/functions');" class="btn add"><i class="fas fa-ban"></i>Cancel</a>
        <div class="clr"></div>
    </div>
    <h1>
        <i class="fas fa-users"></i>Functions <i class="fas fa-caret-right"></i>Edit
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


    <form id="form_box" action="{URL:panel/functions/edit/<?= $this->sector->id; ?>}" method="post" enctype="multipart/form-data">
        <div class="form-section">
            <span class="heading">General</span>

            <div class="col full_column">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= post('name', false, $this->sector->name); ?>">
            </div>

            <div class="col full_column">
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="20"><?= post('content', false, $this->sector->content); ?></textarea>
            </div>
            <div class="clr"></div>
        </div>

        <div class="form-section">
            <button type="submit" name="submit" class="btn submit" onclick="setTextareaValue(); load('panel/functions/edit/<?= $this->sector->id; ?>', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
            <a href="{URL:panel/functions}" onclick="load('panel/functions');" class="btn cancel"><i class="fas fa-ban"></i>Cancel</a>
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
        $('#content').val(editorField.getData());
    }

    $(function () {
        initSlug('#slug', '#name');

        $("#name").keyup(function () {
            initSlug('#slug', '#name');
        });

        editorField = CKEDITOR.replace('content', {
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