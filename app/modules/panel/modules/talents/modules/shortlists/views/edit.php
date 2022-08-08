<form id="form_box" action="{URL:panel/talents/shortlists/edit/<?= $this->list->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/talents/shortlists}">Short List</a>&nbsp;» Edit</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Company Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="<?= post('name', false, $this->list->name); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="vacancy_title">Vacancy Title</label>
                            <input class="form-control" type="text" name="vacancy_title" id="vacancy_title" value="<?= post('vacancy_title', false, $this->list->vacancy_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="location">Location</label>
                            <input class="form-control" type="text" name="location" id="location" value="<?= post('location', false, $this->list->location); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="20"><?= post('description', false, $this->list->description); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Open profiles to add to hotlist (Check the ones you'd like to add)</label>
                        <div class="form-check scroll_max_200 border_1">
                            <?php if (isset($this->opens) && is_array($this->opens) && count($this->opens) > 0) { ?>
                                <?php foreach ($this->opens as $item) { ?>
                                    <div class="custom-control custom-checkbox checkbox-info">
                                        <input class="custom-control-input" type="checkbox" name="opens_ids[]" id="opens_<?=$item->id?>" value="<?= $item->id; ?>"
                                            <?= checkCheckboxValue(post('opens_ids'), $item->id, $this->list->opens_ids); ?>>
                                        <label class="custom-control-label" for="opens_<?=$item->id?>"><?= $item->candidate_name; ?></label>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="setTextareaValue(); load('panel/talents/shortlists/edit/<?= $this->list->id; ?>', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/talents/shortlists}"><i class="fas fa-ban"></i>Cancel</a>
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

    function setTextareaValue() {
        $('#description').val(editorField.getData());
    }

    $(function () {

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
