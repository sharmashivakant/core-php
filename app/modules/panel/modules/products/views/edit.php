<form id="form_box" action="{URL:panel/products/edit/<?= $this->edit->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/products}">Product</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Product Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->edit->title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sub_title">Product Sub-Title </label>
                            <input class="form-control" type="text" name="sub_title" id="sub_title" value="<?= post('sub_title', false, $this->edit->sub_title); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        
                       <div class="form-group col-md-4">
                         <label for="first_logo_title">First Logo Title</label>
                            <input class="form-control" type="text" name="first_logo_title" id="first_logo_title" value="<?= post('first_logo_title', false, $this->edit->first_logo_title); ?>">
                            <label for="image">First Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->edit->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('image', false, $this->edit->image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                         <div class="form-group col-md-4">
                            <label for="second_logo_title">Second Logo Title</label>
                            <input class="form-control" type="text" name="second_logo_title" id="second_logo_title" value="<?= post('second_logo_title', false, $this->edit->second_logo_title); ?>">
                            <label for="image1">Second Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image1" id="image1" value="<?= post('image1', false, $this->edit->image1); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image1/', 'name=<?= randomHash(); ?>', 'field=#image1');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>  

                                <div id="preview_image1" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('image1', false, $this->edit->image1); ?>" alt="">
                                </div>
                            </div>
                        </div>
                         <div class="form-group col-md-4">
                            <label for="third_logo_title">Third Logo Title</label>
                            <input class="form-control" type="text" name="third_logo_title" id="third_logo_title" value="<?= post('third_logo_title', false, $this->edit->third_logo_title); ?>">
                            <label for="image2">Third Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image2" id="image2" value="<?= post('image2', false, $this->edit->image2); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image2/', 'name=<?= randomHash(); ?>', 'field=#image2');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image2" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('image2', false, $this->edit->image2); ?>" alt="">
                                </div>
                            </div>
                        </div>

                    </div>  
                </div>
            </div>

            <!-- Content -->
            

            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Description</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="description" rows="20"><?= post('content', false, $this->edit->content); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                   <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Challenge Title</label>
                            <input class="form-control" type="text" name="challenge_title" id="challenge_title" value="<?= post('challenge_title', false, $this->edit->challenge_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image2">Challenge Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="challenge_logo" id="challenge_logo" value="<?= post('challenge_logo', false, $this->edit->challenge_logo); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_challenge_logo/', 'name=<?= randomHash(); ?>', 'field=#challenge_logo');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_challenge_logo" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('challenge_logo', false, $this->edit->challenge_logo); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Challenge Description</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="challenge_description" id="content_short" rows="20"><?= post('challenge_description', false, $this->edit->challenge_description); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="flFormsGrid1" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="solution_title">Solution Title</label>
                            <input class="form-control" type="text" name="solution_title" id="solution_title" value="<?= post('solution_title', false, $this->edit->solution_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="solution_logo">Solution Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="solution_logo" id="solution_logo" value="<?= post('solution_logo', false, $this->edit->solution_logo); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_solution_logo/', 'name=<?= randomHash(); ?>', 'field=#solution_logo');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_solution_logo" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('solution_logo', false, $this->edit->solution_logo); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Solution Description</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="solution_description" id="responsibilities" rows="20"><?= post('solution_description', false, $this->edit->solution_description); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
              <div id="flFormsGrid2" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="results_title">Results Title</label>
                            <input class="form-control" type="text" name="results_title" id="results_title" value="<?= post('results_title', false, $this->edit->results_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="results_logo">Results Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="results_logo" id="results_logo" value="<?= post('results_logo', false, $this->edit->results_logo); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_results_logo/', 'name=<?= randomHash(); ?>', 'field=#results_logo');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_results_logo" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/product/<?= post('results_logo', false, $this->edit->results_logo); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Results Description</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="results_description" id="requirements" rows="20"><?= post('results_description', false, $this->edit->results_description); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           

           <!-- <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Microsite</h4>
                            <select name="microsite_id" class="form-control" id="microsite_id" required>
                                <option value="0">- Choose Microsite -</option>
                                <?php if (isset($this->microsites) && is_array($this->microsites) && count($this->microsites) > 0) { ?>
                                    <?php foreach ($this->microsites as $microsite) { ?>
                                        <option value="<?= $microsite->id; ?>" <?= checkOptionValue(post('microsite_id'), $microsite->id, $this->edit->microsite_id); ?>><?= $microsite->title; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>-->

            <!-- SEO -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>On-page SEO</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_title">
                                Meta Title<a href="https://moz.com/learn/seo/title-tag" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->edit->meta_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="meta_keywords">
                                Meta Keywords<a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->edit->meta_keywords); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_desc">
                                Meta Description<a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->edit->meta_desc); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">
                                URL Slug<a href="https://moz.com/job/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
                                &nbsp;&nbsp;{URL:job}/<?= $this->edit->slug; ?>
                            </label>
                            <input class="form-control" type="text" name="slug" id="slug" value="<?= $this->edit->slug; ?>">
                        </div>
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
                                    load('panel/products/edit/<?= $this->edit->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/products}"><i class="fas fa-ban"></i>Cancel</a>
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
    var editorField2;
    var editorField3;
    var editorField4;

    function setTextareaValue() {
        $('#content_short').val(editorField.getData());
        $('#description').val(editorField2.getData());
         $('#responsibilities').val(editorField3.getData());
          $('#requirements').val(editorField4.getData());
    }

    $(function () {
        editorField = CKEDITOR.replace('content_short', {
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

        editorField2 = CKEDITOR.replace('description', {
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
          editorField3 = CKEDITOR.replace('responsibilities', {
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
          editorField4 = CKEDITOR.replace('requirements', {
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
