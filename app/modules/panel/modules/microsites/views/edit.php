<form id="form_box" action="{URL:panel/microsites/edit/<?= $this->edit->id ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/microsites}">Microsite</a> » Edite</h1>
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
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->edit->title); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ref">Ref (Only numbers, letters and dash accepted)</label>
                            <input class="form-control" type="text" name="ref" id="ref" value="<?= post('ref', false, $this->edit->ref); ?>" required>
                        </div>

                        <!-- <div class="form-group col-md-6">
                            <label for="">Logo<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="logo_image" id="logo_image" value="<?= post('logo_image', false, $this->edit->logo_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#logo_image', 'preview=#pre_logo_image');">
                                <a class="file-fake">
                                    <div>
                                        Choose image<br>
                                        <span>(230 x 230 px min)</span>
                                    </div>
                                </a>

                                <div id="pre_logo_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('logo_image', false, $this->edit->logo_image); ?>" alt="">
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group col-md-12">
                            <label for="">Landing Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="header_image" id="header_image" value="<?= post('header_image', false, $this->edit->header_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#header_image', 'preview=#pre_header_image');">
                                <a class="file-fake">
                                    <div>
                                        Choose image<br>
                                        <span>(1900 x 650 px min)</span>
                                    </div>
                                </a>

                                <div id="pre_header_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('header_image', false, $this->edit->header_image); ?>" alt="">
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
                            <input class="form-control" type="text" name="website" id="website" value="<?= post('website', false, $this->edit->website); ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="company_size">Company Size*</label>
                            <input class="form-control" type="text" name="company_size" id="company_size" value="<?= post('company_size', false, $this->edit->company_size); ?>" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">Key Information Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="key_image" id="key_image" value="<?= post('key_image', false, $this->edit->key_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#key_image', 'preview=#pre_key_image');">
                                <a class="file-fake">
                                    <div>
                                        Choose image<br>
                                        <span>(555 x 450 px min)</span>
                                    </div>
                                </a>

                                <div id="pre_key_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('key_image', false, $this->edit->key_image); ?>" alt="">
                                </div>
                            </div>
                        </div>-->

                        
                        <div class="form-group col-md-12">
                            <label>Key Information </label>
                            <div class="form-group">
                                <textarea class="form-control" name="key_content" id="key_content" rows="20"><?= post('content', false, $this->edit->key_content); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Overview</label>
                            <div class="form-group">
                                <textarea class="form-control" name="content" id="content_box" rows="20"><?= post('content', false, $this->edit->content); ?></textarea>
                            </div>
                        </div>

                    <!---    <div class="form-group col-md-6">
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
                                            <input class="custom-control-input" type="checkbox" name="location_ids[]" id="tag_<?= $item->id ?>" value="<?= $item->id; ?>" <?= checkCheckboxValue(post('location_ids'), $item->id, $this->edit->location_ids); ?>>
                                            <label class="custom-control-label" for="tag_<?= $item->id ?>"><?= $item->name; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>-->

            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">

                    <h4>Job Opportunities</h4>
                    <!--                    <input type="text" id="vacancy" value="" autocomplete="off" placeholder="Start typing to filter vacancies below">-->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Vacancies</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->vacancies) && is_array($this->vacancies) && count($this->vacancies) > 0) { ?>
                                    <?php foreach ($this->vacancies as $item) { ?>
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input class="custom-control-input" type="checkbox" name="vacancy_ids[]" id="vac_<?= $item->id ?>" value="<?= $item->id; ?>" <?= checkCheckboxValue(post('vacancy_ids'), $item->id, $this->edit->vacancy_ids); ?>>
                                            <label class="custom-control-label" for="vac_<?= $item->id ?>"><?= $item->title; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                     <!--   <div class="form-group col-md-6">
                            <label>Tag Sectors</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->tag_sectors) && is_array($this->tag_sectors) && count($this->tag_sectors) > 0) { ?>
                                    <?php foreach ($this->tag_sectors as $item) { ?>
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input class="custom-control-input" type="checkbox" name="tag_sector_ids[]" id="location_<?= $item->id ?>" value="<?= $item->id; ?>" <?= checkCheckboxValue(post('tag_sector_ids'), $item->id, $this->edit->tag_sector_ids); ?>>
                                            <label class="custom-control-label" for="location_<?= $item->id ?>"><?= $item->name; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>-->

                        <!--<div class="form-group col-md-6">
                            <label for="">Job Opportunities Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="opportunities_image" id="opportunities_image" value="<?= post('opportunities_image', false, $this->edit->opportunities_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>','path=tmp',  'field=#opportunities_image', 'preview=#pre_opportunities_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_opportunities_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('opportunities_image', false, $this->edit->opportunities_image); ?>" alt="">
                                </div>
                            </div>
                        </div>-->
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
                                <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->edit->meta_title); ?>">
                            </div>
                            </div>
                            <div class="form-group col-md-6">
                            <div class="form-group ">
                                <label for="meta_keywords">
                                    Meta Keywords
                                    <a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                                </label>
                                <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->edit->meta_keywords); ?>">
                            </div>
                        </div>

                        <!--<div class="form-group col-md-6">
                            <label for="">Open Graph Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>
                            <div class="choose-file modern">
                                <input type="hidden" name="og_image" id="og_image" value="<?= post('og_image', false, $this->edit->og_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'path=tmp', 'field=#og_image', 'preview=#pre_og_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="pre_og_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= post('og_image', false, $this->edit->og_image); ?>" alt="">
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
                            <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->edit->meta_desc); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <!--<div class="form-group col-md-6">
                            <label for="slug">
                                URL Slug<a href="https://moz.com/job/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
                                &nbsp;&nbsp;<?= SITE_URL; ?>microsites/<?= $this->edit->slug; ?>
                            </label>
                            <input class="form-control" type="text" name="slug" id="slug" value="<?= $this->edit->slug; ?>">
                        </div>-->
                    </div>

                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="setTextareaValue();
                            load('panel/microsites/edit/<?= $this->edit->id ?>', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
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