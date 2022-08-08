<form id="form_box" action="{URL:panel/testimonials/edit/<?= $this->testimonial->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/testimonials}">Testimonials</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>  

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>  
                                <input class="form-control" type="text" name="name" id="name" value="<?= post('name', false, $this->testimonial->name); ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="name">Job Title</label>
                                <input class="form-control" type="text" name="position" id="position" value="<?= post('position', false, $this->testimonial->position); ?>">
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-12">
                            <label for="type">Company</label>
                             <input class="form-control" type="text" name="company" id="company" value="<?= post('company', false, $this->testimonial->company); ?>">
                        </div> -->
                        <!--  <div class="form-group col-md-12">
                            <label for="type">Page </label>
                          <select class="form-control" name="type" id="type" required>
                             <option value="">Please select page</option>
                                <option value="home" <?php if($this->testimonial->type=='home'){ echo 'selected';} ?> >Home</option>
                                <option value="ict_technology" <?php if($this->testimonial->type=='ict_technology'){ echo 'selected';} ?> >ICT & Technology<?=$this->testimonial->type  ?></option>
                                <option value="life_sciences" <?php if($this->testimonial->type=='life_sciences'){ echo 'selected';} ?> >Life Sciences</option>
                                <option value="finance" <?php if($this->testimonial->type=='finance'){ echo 'seleccted';} ?> >Finance</option>   
                                <option value="energy_renewables" <?php if($this->testimonial->type=='energy_renewables'){ echo 'selected';} ?> >Energy & Renewables</option>
                                <option value="career" <?php if($this->testimonial->type=='career'){ echo 'selected';} ?> >Career</option>         
                            </select>      
                             </div> -->
                          <div class="form-group col-md-6">
                             <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->testimonial->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                                <div id="preview_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/testimonials/<?= post('image', false, $this->testimonial->image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>   

            <!-- Details -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="form-group">
                        <h4>Content</h4>
                        <textarea name="content" id="description" rows="20"><?= post('content', false, $this->testimonial->content); ?></textarea>
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
                                    load('panel/testimonials/edit/<?= $this->testimonial->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/testimonials}"><i class="fas fa-ban"></i>Cancel</a>
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