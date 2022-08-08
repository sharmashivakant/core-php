<form id="form_box" action="{URL:panel/services/edit/<?= $this->service->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/services}">Service</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Service Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->service->title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="title">Service Sub Title</label>
                            <input class="form-control" type="text" name="sub_title" id="sub_title" value="<?= post('sub_title', false, $this->service->sub_title); ?>">
                        </div>       
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title_icon">Icon Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="title_icon" id="title_icon" value="<?= post('title_icon', false, $this->service->title_icon); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_serviceIcon/', 'name=<?= randomHash(); ?>','path=services/images', 'field=#title_icon');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose Icon image</a>

                                <div id="preview_title_icon" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/services/images/<?= post('title_icon', false, $this->service->title_icon); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <!-- Image -->
                            <label for="service_image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="service_image" id="service_image" value="<?= post('service_image', false, $this->service->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_serviceImage/', 'name=<?= randomHash(); ?>', 'path=services/images', 'field=#service_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_service_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/services/images/<?= post('service_image', false, $this->service->image); ?>" alt="">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="statbox widget box box-shadow">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="info_desc">Information Description</label>
                                    <textarea name="info_desc" id="info_desc" rows="10"><?= post('info_desc', false, $this->service->info_desc); ?></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" rows="10"><?= post('short_description', false, $this->service->desc_short); ?></textarea>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="description">Full Description</label>
                                    <textarea name="description" id="description" rows="20"><?= post('description', false, $this->service->desc); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="read_more_image">Read More Image</label>
                                    <div class="choose-file modern">
                                        <input type="hidden" name="read_more_image" id="read_more_image" value="<?= post('read_more_image', false, $this->service->read_more_image); ?>">
                                        <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_ReadMoreimage/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#read_more_image');">
                                        <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                        <div id="preview_read_more_image" class="preview_image">
                                            <img src="<?= _SITEDIR_; ?>data/services/images/<?= post('read_more_image', false, $this->service->read_more_image); ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Squad Details -->
            <?php //if ($this->service->id == '4') { ?>
                <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <h4>Squad</h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="squad_title">Squad Title</label>
                                <input class="form-control" type="text" name="squad_title" id="squad_title" value="<?= post('squad_title', false, $this->service->squad_title); ?>">
                                <!--required-->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="title">squad SubTitle</label>
                                <input class="form-control" type="text" name="squad_subtitle" id="squad_subtitle" value="<?= post('squad_subtitle', false, $this->service->squad_subtitle); ?>">
                                <!--required-->
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!-- Image -->
                                <label for="squad_icon">Squad Icon<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                                <div class="choose-file modern">
                                    <input type="hidden" name="squad_icon" id="squad_icon" value="<?= post('squad_icon', false, $this->service->squad_icon); ?>">
                                    <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_Suadimage/', 'name=<?= randomHash(); ?>', 'path=services/images', 'field=#squad_icon');">
                                    <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                    <div id="preview_squad_image" class="preview_image">
                                        <img src="<?= _SITEDIR_; ?>data/services/images/<?= post('squad_icon', false, $this->service->squad_icon); ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="squad_short_desc">Squad Short Description</label>
                                <textarea name="squad_short_desc" id="squad_short_desc" rows="20"><?= post('squad_short_desc', false, $this->service->squad_short_desc); ?></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="squad_desc">Squad Full Description</label>
                                <textarea name="squad_desc" id="squad_desc" rows="20"><?= post('squad_desc', false, $this->service->squad_desc); ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Squad Subscription Details -->
                <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <h4>Squad Subscription</h4>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="squad_subscription_title">Squad Subscription Title</label>
                                <input class="form-control" type="text" name="squad_subscription_title" id="squad_subscription_title" value="<?= post('squad_subscription_title', false, $this->service->squad_subscription_title); ?>">
                                <!--required-->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="squad_subscription_subtitle">Squad Subscription SubTitle</label>
                                <input class="form-control" type="text" name="squad_subscription_subtitle" id="squad_subscription_subtitle" value="<?= post('squad_subscription_subtitle', false, $this->service->squad_subscription_subtitle); ?>">
                                <!--required-->
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!-- Image -->
                                <label for="squad_subscription_icon">Squad Subscription Icon<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                                <div class="choose-file modern">
                                    <input type="hidden" name="squad_subscription_icon" id="squad_subscription_icon" value="<?= post('squad_subscription_icon', false, $this->service->squad_subscription_icon); ?>">
                                    <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_Suadimage2/', 'name=<?= randomHash(); ?>', 'path=services/images', 'field=#squad_subscription_icon');">
                                    <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                    <div id="preview_squad_subscription_icon" class="preview_image">
                                        <img src="<?= _SITEDIR_; ?>data/services/images/<?= post('squad_subscription_icon', false, $this->service->squad_subscription_icon); ?>" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="squad_subscription_short_desc">Squad Subscription Description</label>
                                <textarea name="squad_subscription_short_desc" id="squad_subscription_short_desc" rows="20"><?= post('squad_subscription_short_desc', false, $this->service->squad_subscription_short_desc); ?></textarea>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="squad_subscription_desc">Squad Subscription Description</label>
                                <textarea name="squad_subscription_desc" id="squad_subscription_desc" rows="20"><?= post('squad_subscription_desc', false, $this->service->squad_subscription_desc); ?></textarea>
                            </div>
                        </div>

                    </div>
                </div>
            <?php //} ?>
            <!-- PDF DOwnload -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>PDF Download</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_title">PDF 1<small><i>(files must be under <?= file_upload_max_size_format() ?>, and DOC,DOCX,TXT,PDF format)</i></small></label>
                            <div class="choose-file modern">
                                <input type="hidden" name="pdf1" id="pdf1" value="<?= post('pdf1', false, $this->service->pdf1); ?>">
                                <input type="file" accept="doc/docx/txt/pdf/fotd" onchange="initFile(this); load('panel/upload_Pdf/', 'name=<?= randomHash(); ?>', 'path=services/pdf', 'field=#pdf1');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose File</a>

                                <div id="preview_pdf1" class="preview_image">
                                    <?= post('pdf1', false, $this->service->pdf1); ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="meta_keywords">PDF 2<small><i>(files must be under <?= file_upload_max_size_format() ?>, and DOC,DOCX,TXT,PDF format)</i></small></label>
                            <div class="choose-file modern">
                                <input type="hidden" name="pdf2" id="pdf2" value="<?= post('pdf2', false, $this->service->pdf2); ?>">
                                <input type="file" accept="doc/docx/txt/pdf/fotd" onchange="initFile(this); load('panel/upload_Pdf2/', 'name=<?= randomHash(); ?>', 'path=services/pdf', 'field=#pdf2');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose File</a>

                                <div id="preview_pdf2" class="preview_image">
                                    <?= post('pdf1', false, $this->service->pdf2); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>On-page SEO</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_title">
                                Meta Title<a href="https://moz.com/learn/seo/title-tag" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->service->meta_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="meta_keywords">
                                Meta Keywords<a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->service->meta_keywords); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_desc">
                                Meta Description<a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->service->meta_desc); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">
                                URL Slug<a href="https://moz.com/job/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
                                &nbsp;&nbsp;<?= SITE_URL; ?><?= $this->service->slug; ?>
                            </label>
                            <input class="form-control" type="text" name="slug" id="slug" value="<?= $this->service->slug; ?>" readonly>
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
                                    load('panel/services/edit/<?= $this->service->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/services}"><i class="fas fa-ban"></i>Cancel</a>
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
        $('#info_desc').val(editorField_info_desc.getData());
        $('#description').val(editorField.getData());
        $('#short_description').val(editorField_short.getData());
        $('#squad_desc').val(editorField_sqad.getData());
        $('#squad_subscription_desc').val(editorField_sqad_sub.getData());
        $('#squad_short_desc').val(editorField_squad_short_desc.getData());
        $('#squad_subscription_short_desc').val(editorField_squad_subscription_short_desc.getData());
    }

    $(function() {
        $("#title").keyup(function() {
            initSlug('#slug', '#title');
        });

        editorField_info_desc = CKEDITOR.replace('info_desc', {
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

        editorField_short = CKEDITOR.replace('short_description', {
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

        editorField_sqad = CKEDITOR.replace('squad_desc', {
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

        editorField_sqad_sub = CKEDITOR.replace('squad_subscription_desc', {
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

        editorField_squad_short_desc = CKEDITOR.replace('squad_short_desc', {
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

        editorField_squad_subscription_short_desc = CKEDITOR.replace('squad_subscription_short_desc', {
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