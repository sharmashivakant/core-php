<form id="form_box" action="{URL:panel/microsites/add}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/microsites}">Microsite</a> » Add</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Account Info</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ref">Ref (Only numbers, letters and dash accepted)</label>
                            <input class="form-control" type="text" name="ref" id="ref" value="<?= post('ref', false); ?>">
                        </div>

                        <!--<div class="form-group col-md-6">
                            <label for="">Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="logo_image" id="logo_image" value="<?= post('logo_image', false, $this->user->logo_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#logo_image', 'preview=#pre_logo_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_logo_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('logo_image', false, $this->user->logo_image); ?>" alt="">
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group col-md-12">
                            <label for="">Landing Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="header_image" id="header_image" value="<?= post('header_image', false, $this->user->header_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#header_image', 'preview=#pre_header_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_header_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('header_image', false, $this->user->header_image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


           <!-- <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Key Information</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="website">Website URL</label>
                            <input class="form-control" type="text" name="website" id="website" value="<?= post('website', false); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company_size">Company Size*</label>
                            <input class="form-control" type="text" name="company_size" id="company_size" value="<?= post('company_size', false); ?>">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">Key Information Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="key_image" id="key_image" value="<?= post('key_image', false, $this->user->key_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#key_image', 'preview=#pre_key_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_key_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('key_image', false, $this->user->key_image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                      <div class="form-group col-md-6">  
                            <label>Industries/Sectors</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->sectors) && is_array($this->sectors) && count($this->sectors) > 0) { ?>
                                    <?php foreach ($this->sectors as $item) { ?>
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input class="custom-control-input" type="checkbox" name="sector_ids[]" id="sector_<?= $item->id ?>" value="<?= $item->id; ?>" <?= checkCheckboxValue(post('sector_ids'), $item->id, $this->edit->sector_ids); ?>><label class="custom-control-label" for="sector_<?= $item->id ?>"><?= $item->name; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Headquarters</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->locations) && is_array($this->locations) && count($this->locations) > 0) { ?>
                                    <?php foreach ($this->locations as $item) { ?>
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input class="custom-control-input" type="checkbox" name="location_ids[]" id="location_<?= $item->id ?>" value="<?= $item->id; ?>" <?= checkCheckboxValue(post('location_ids'), $item->id, $this->edit->location_ids); ?>><label class="custom-control-label" for="location_<?= $item->id ?>"><?= $item->name; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div-->

            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                            <label>Key Information </label>
                            <div class="form-group">
                                <textarea class="form-control" name="key_content" id="key_content" rows="20"><?= post('content', false, $this->edit->key_content); ?></textarea>
                            </div>
                        </div>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Overview</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content_box" rows="20"><?= post('content', false); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>On-page SEO</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="meta_title">
                                    Meta Title
                                    <a href="https://moz.com/learn/seo/title-tag" target="_blank"><i class="fas fa-info-circle"></i></a>
                                </label>
                                <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false); ?>">
                            </div>
                            </div>
                             <div class="form-group col-md-6">
                            <div class="form-group ">
                                <label for="meta_keywords">
                                    Meta Keywords
                                    <a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                                </label>
                                <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false); ?>">
                            </div>
                        </div>

                        <!--<div class="form-group col-md-6">
                            <label for="">Open Graph Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>
                            <div class="choose-file modern">
                                <input type="hidden" name="og_image" id="og_image" value="<?= post('og_image', false, $this->user->og_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#og_image', 'preview=#pre_og_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_og_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('og_image', false, $this->user->og_image); ?>" alt="">
                                </div>
                            </div>
                        </div>-->
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="meta_desc">
                                Meta Description
                                <a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false); ?>">
                        </div>
                    </div>
                    <!--<div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="slug">
                                URL Slug<a href="https://moz.com/job/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
                                &nbsp;&nbsp;<?= SITE_URL; ?>microsites/<?= post('slug', false); ?>
                            </label>
                            <input class="form-control" type="text" name="slug" id="slug" value="<?= post('slug', false); ?>" readonly>
                        </div>
                    </div>-->

                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="setTextareaValue(); load('panel/microsites/add', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/microsites}"><i class="fas fa-ban"></i>Cancel</a>
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
<script>
    var editorField;
    var editorField2;

    function setTextareaValue() {
        $('#content_box').val(editorField.getData());
        $('#key_content').val(editorField2.getData());
    }

    $(function() {
        initSlug('#ref', '#title');

        $("#title").keyup(function() {  
            initSlug('#ref', '#title');
        });       

        editorField = CKEDITOR.replace('content_box', {
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
        
        editorField2 = CKEDITOR.replace('key_content',{    
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