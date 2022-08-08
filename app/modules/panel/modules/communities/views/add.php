<form id="form_box" action="{URL:panel/communities/add}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/communities}">Community</a> » Add</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <!-- Image -->
                        <label for="image">Title</label>
                            <input type="text" class="form-control" name="title" value="">    
                    </div>    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <!-- Image -->
                        <label for="image">Sub Title</label>
                            <input type="text" class="form-control" name="subtitle" value="">    
                    </div>    
                </div>
                 <div class="form-row">
                    <div class="form-group col-md-12">
                        <!-- Image -->
                        <label for="image">Short Description</label>
                            <textarea type="text" class="form-control" name="short_description" value="" id="text_content"> </textarea> 
                    </div>    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <!-- Image -->
                        <label for="image">Description</label>
                            <textarea type="text" class="form-control" name="description" value="" id="text_content1"> </textarea> 
                    </div>    
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">    
                        <!-- Image -->   
                        <label for="image">Logo Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                        <div class="choose-file modern">
                            <input type="hidden" name="logo_image" id="logo_image" value="<?= post('logo_image', false, $this->edit->logo_image); ?>">
                            <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_logo_image/', 'name=<?= randomHash(); ?>', 'field=#logo_image');">
                            <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                            <div id="preview_logo_image" class="preview_image">
                                <img src="<?= _SITEDIR_; ?>data/events/<?= post('logo_image', false, $this->edit->logo_image); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
         <div class="form-row">
                    <div class="form-group col-md-6">    
                        <!-- Image -->   
                        <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                        <div class="choose-file modern">
                            <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->edit->image); ?>">
                            <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                            <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                            <div id="preview_image" class="preview_image">
                                <img src="<?= _SITEDIR_; ?>data/events/<?= post('image', false, $this->edit->image); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="setTextareaValue(); load('panel/communities/add', 'form:#form_box'); return false;">Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/communities}">Cancel</a>
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
    var editorField1;
    
    function setTextareaValue() {
        $('#text_content').val(editorField.getData());
        $('#text_content1').val(editorField1.getData());
    }
    
    $(function () {
        editorField = CKEDITOR.replace('text_content', {
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
    // for second content
    $(function () {
        editorField1 = CKEDITOR.replace('text_content1', {
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
