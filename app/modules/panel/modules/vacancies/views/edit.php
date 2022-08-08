<form id="form_box" action="{URL:panel/vacancies/edit/<?= $this->edit->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/vacancies}">Vacancy</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Job Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->edit->title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ref">Job Ref (Letters, numbers and hyphens (-) only)</label>
                            <input class="form-control" type="text" name="ref" id="ref" value="<?= post('ref', false, $this->edit->ref); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Industries/Sectors</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->sectors) && is_array($this->sectors) && count($this->sectors) > 0) { ?>
                                    <?php foreach ($this->sectors as $item) { ?>
                                        <div class="custom-control custom-checkbox checkbox-info">
                                            <input class="custom-control-input" type="checkbox" name="sector_ids[]" id="sector_<?=$item->id?>" value="<?= $item->id; ?>"
                                                <?= checkCheckboxValue(post('sector_ids'), $item->id, $this->edit->sector_ids); ?>
                                            ><label class="custom-control-label" for="sector_<?=$item->id?>"><?= $item->name; ?></label>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Locations</label>
                            <div class="form-check scroll_max_200 border_1">
                                <?php if (isset($this->locations) && is_array($this->locations) && count($this->locations) > 0) { ?>
                                <?php foreach ($this->locations as $item) { ?>
                                    <div class="custom-control custom-checkbox checkbox-info">
                                        <input class="custom-control-input" type="checkbox" name="location_ids[]" id="location_<?=$item->id?>" value="<?= $item->id; ?>"
                                            <?= checkCheckboxValue(post('location_ids'), $item->id, $this->edit->location_ids); ?>
                                        ><label class="custom-control-label" for="location_<?=$item->id?>"><?= $item->name; ?></label>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php /*
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Functions</label>
                            <select name="function_ids[]" id="function_ids" required>
                                <?php if (isset($this->functions) && is_array($this->functions) && count($this->functions) > 0) { ?>
                                    <?php foreach ($this->functions as $item) { ?>
                                        <option value="<?= $item->id; ?>" <?= checkOptionValue(post('function_ids'), $item->id, $this->edit->function_ids); ?>><?= $item->name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
 */ ?>

                    <div class="form-row">
                         <!-- <div class="form-group col-md-6">
                            <div class="form-row">
                            <div class="form-group col-md-3">
                            <label for="salary_value">Salary From</label>
                            <input class="form-control" type="text" name="salary_from" id="salary_from" value="<?= post('salary_from', false, $this->edit->salary_from); ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="salary_value">Salary To</label>
                            <input class="form-control" type="text" name="salary_to" id="salary_to" value="<?= post('salary_to', false, $this->edit->salary_to); ?>">
                        </div>
                         </div>
                        </div> -->
                      <div class="form-group col-md-6">
                            <label for="salary_value">Salary</label>
                            <input class="form-control" type="text" name="salary_value" id="salary_value" value="<?= post('salary_value', false, $this->edit->salary_value); ?>">
                        </div> 
                        <div class="form-group col-md-6">
                            <label for="contract_type">Contract Type</label>
                            <select class="form-control" name="contract_type" id="contract_type" required>
                                <option value="permanent" <?= checkOptionValue(post('contract_type'), 'permanent', $this->edit->contract_type); ?>>Permanent</option>
                                <option value="temporary" <?= checkOptionValue(post('contract_type'), 'temporary', $this->edit->contract_type); ?>>Temporary</option>
                                <option value="contract" <?= checkOptionValue(post('contract_type'), 'contract', $this->edit->contract_type); ?>>Contract</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="time">Date Posted</label>
                            <input class="form-control" type="text" name="time" id="time" value="<?= post('time', false, date("d/m/Y", $this->edit->time)); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="time_expire">Date Expires</label>
                            <input class="form-control" type="text" name="time_expire" id="time_expire" value="<?= post('time_expire', false, date("d/m/Y", $this->edit->time_expire)); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- <div class="form-group col-md-6">
                            <label for="package">Package</label>
                            <input class="form-control" type="text" name="package" id="package" value="<?= post('package', false, $this->edit->package); ?>">
                        </div> -->
                        <div class="form-group col-md-6">
                            <label for="postcode">Postcode</label>
                            <input class="form-control" type="text" name="postcode" id="postcode" value="<?= post('postcode', false, $this->edit->postcode); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="posted">Posted</label>
                            <select class="form-control" name="posted" id="posted" required>
                                <option value="yes" <?= checkOptionValue(post('posted'), 'yes', $this->blog->posted); ?>>Yes</option>
                                <option value="no" <?= checkOptionValue(post('posted'), 'no', $this->blog->posted); ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        
                       <!--  <div class="form-group col-md-6">
                            <label>Internal Job</label>   
                            <div class="custom-control custom-checkbox checkbox-info">
                                <input class="custom-control-input" type="checkbox" name="internal_job" id="internal_job" value="1" <?php if($this->edit->internal_job=='1'){ echo 'checked'; }?> ><label class="custom-control-label" for="internal_job"></label>  
                            </div>
                        </div>  -->
                       <!-- <div class="form-group col-md-6">
                            <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->edit->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/vacancy/<?= post('image', false, $this->edit->image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                     <div class="form-group col-md-6">
                            <label>Internal Job</label>   
                            <div class="custom-control custom-checkbox checkbox-info">
                                <input class="custom-control-input" type="checkbox" name="internal_job" id="internal_job" value="1" <?php if($this->edit->internal_job=='1'){ echo 'checked'; }?> ><label class="custom-control-label" for="internal_job"></label>  
                            </div>
                        </div> 
                        </div>   
                </div>
            </div>---->

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h4>Short Description</h4>
                            <div class="form-group">
                                <textarea class="form-control" name="content_short" id="content_short" rows="20"><?= post('content_short', false, $this->edit->content_short); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                        <div class="form-group col-md-12">
                            <h4>Consultant</h4>
                            <select class="form-control" name="consultant_id" id="consultant_id" required>
                                <?php if (isset($this->team) && is_array($this->team) && count($this->team) > 0) { ?>
                                    <?php foreach ($this->team as $member) { ?>
                                        <option value="<?= $member->id; ?>" <?= checkOptionValue(post('consultant_id'), $member->id, $this->edit->consultant_id); ?>><?= $member->firstname . ' ' . $member->lastname; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
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
            </div> -->

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
                                    load('panel/vacancies/edit/<?= $this->edit->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/vacancies}"><i class="fas fa-ban"></i>Cancel</a>
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
    function setTextareaValue() {
        $('#content_short').val(editorField.getData());
        $('#description').val(editorField2.getData());
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

    });
</script>   
