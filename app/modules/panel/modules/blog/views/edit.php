<form id="form_box" action="{URL:panel/blog/edit/<?= $this->blog->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/blog}">Blog</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="title">Blog Title</label>
                                <input type="text" class="form-control" name="title" id="title" value="<?= post('title', false, $this->blog->title); ?>">
                                <input type="hidden" class="form-control" id="blog_id" value="<?= $this->blog->id ?>">     

                            </div>
                        </div>
                         
                     <div class="form-group col-md-6">
                     <div class="form-group">
                                <label for="sector">Category</label>
                                <select class="form-control" name="sector" id="sector" required>
                                    <?php if (isset($this->sectors) && is_array($this->sectors) && count($this->sectors) > 0) { ?>
                                        <?php foreach ($this->sectors as $item) { ?>
                                            <option value="<?= $item->id; ?>" <?= checkOptionValue(post('function_ids'), $item->id, $this->blog->sector); ?>><?= $item->name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            </div>
                   <!--  <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="subtitle">Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle" value="<?= post('subtitle', false, $this->blog->subtitle); ?>">
                            </div>
                        </div>-->
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <!-- Image -->
                            <label for="image">Overview Page Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->blog->image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/blog/<?= post('image', false, $this->blog->image); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image">Detail Page Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="details_image" id="details_image" value="<?= post('details_image', false, $this->blog->details_image); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_detail_image/', 'name=<?= randomHash(); ?>', 'field=#details_image');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_details_image" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/blog/<?= post('details_image', false, $this->blog->details_image); ?>" alt="">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="short_description">Short Description</label>
                            <textarea rows="5" class="form-control" name="short_description" id="short_description" value="<?= post('short_description', false, $this->blog->short_description); ?>"><?= post('short_description', false, $this->blog->short_description); ?></textarea>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="time">Date Posted</label>
                            <input class="form-control" type="text" name="time" id="time" value="<?= post('time', false, date("d/m/Y", $this->blog->time)); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="posted">Posted</label>
                            <select class="form-control" name="posted" id="posted" required>
                                <option value="yes" <?= checkOptionValue(post('posted'), 'yes', $this->blog->posted); ?>>Yes</option>
                                <option value="no" <?= checkOptionValue(post('posted'), 'no', $this->blog->posted); ?>>No</option>
                            </select>
                        </div>
                       
                            <div class="form-group">
                            <label for="is_featured">Is Featured</label>
                            <input type="checkbox" name="is_featured" class="" id="is_featured" <?php if ($this->blog->is_featured == '1') echo "checked='checked'"; ?> value='1'>
                        </div>
            
                        <!-- <div class="form-group col-md-12">
                            
                        </div> -->
                    </div>


                </div>
            </div>
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Description</h4>

                    <div class="form-group">
                        <textarea class="form-control" name="content" id="text_content" rows="20"><?= post('content', false, $this->blog->content); ?></textarea>
                    </div>
                </div>
            </div>
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Author</h4>
                    <div class="form-group">

                        <select class="form-control" name="consultant_id" id="consultant_id" required>
                            <?php if (isset($this->team) && is_array($this->team) && count($this->team) > 0) { ?>
                                <?php foreach ($this->team as $member) { ?>
                                    <?php if (!$this->blog->consultant_id) { ?>
                                        <option value="<?= $member->id; ?>" <?= checkOptionValue(post('consultant_id'), $member->id, User::get('id')); ?>><?= $member->firstname . ' ' . $member->lastname; ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $member->id; ?>" <?= checkOptionValue(post('consultant_id'), $member->id, $this->blog->consultant_id); ?>><?= $member->firstname . ' ' . $member->lastname; ?></option>
                                <?php }
                                } ?>
                            <?php } ?>
                        </select>
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
                            <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->blog->meta_title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="meta_keywords">
                                Meta Keywords<a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->blog->meta_keywords); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="meta_desc">
                                Meta Description<a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
                            </label>
                            <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->blog->meta_desc); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="slug">
                                URL Slug<a href="https://moz.com/blog/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
                                &nbsp;&nbsp;{URL:blog}/<?= $this->blog->slug; ?>
                            </label>
                            <input class="form-control" type="text" name="slug" id="slug" value="<?= $this->blog->slug; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->

            <!--<div id="flFormsGrid2" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">-->



                    <!-- Checkbox -->
                   


              <!--      <div class="form-row featured-image-get">
                        <div class="form-group col-md-4">
                            <label for="image1">First Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image1" id="image1" value="<?= post('image1', false, $this->blog->image1); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image1/', 'name=<?= randomHash(); ?>', 'field=#image1');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image1" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/blog/<?= post('image1', false, $this->blog->image1); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image2">Second Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image2" id="image2" value="<?= post('image2', false, $this->blog->image2); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image2/', 'name=<?= randomHash(); ?>', 'field=#image2');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image2" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/blog/<?= post('image2', false, $this->blog->image2); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="image3">Third Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                            <div class="choose-file modern">
                                <input type="hidden" name="image3" id="image3" value="<?= post('image3', false, $this->blog->image3); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image3/', 'name=<?= randomHash(); ?>', 'field=#image3');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_image3" class="preview_image">
                                    <img src="<?= _SITEDIR_; ?>data/blog/<?= post('image3', false, $this->blog->image3); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>-->
               <!-- </div>
            </div>-->


            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <a class="btn btn-success" onclick="
                                    setTextareaValue();
                                    load('panel/blog/edit/<?= $this->blog->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/blog}"><i class="fas fa-ban"></i>Cancel</a>
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
        $('#text_content').val(editorField.getData());
        $('#short_description').val(editorField2.getData());
    }

    $(function() {
        editorField = CKEDITOR.replace('text_content', {
            htmlEncodeOutput: false,
            wordcount: {
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,
            },
            removePlugins: 'zsuploader',

            // filebrowserUploadUrl: 'http://bolddev7.co.uk/burman/app/ck/ck_upload.php', // define project BASE_PATH here located on root
            // filebrowserUploadMethod: 'form'

            filebrowserBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
            filebrowserUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        });

        editorField2 = CKEDITOR.replace('short_description', {
            htmlEncodeOutput: false,
            wordcount: {
                showWordCount: true,
                showCharCount: true,
                countSpacesAsChars: true,
                countHTML: false,
            },
            removePlugins: 'zsuploader',

            // filebrowserUploadUrl: 'http://bolddev7.co.uk/burman/app/ck/ck_upload.php', // define project BASE_PATH here located on root
            // filebrowserUploadMethod: 'form'

            filebrowserBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=files',
            filebrowserImageBrowseUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/browse.php?opener=ckeditor&type=images',
            filebrowserUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=files',
            filebrowserImageUploadUrl: '<?= _SITEDIR_; ?>public/plugins/kcfinder/upload.php?opener=ckeditor&type=images'
        });
    });
</script>
<script>
    $(document).ready(function() {


        /* UPLOAD CLICK */


        if ($('#is_featured').is(":checked") == true) {
            $(".featured-image-get").show();
        } else {
            $(".featured-image-get").hide();
        }


        $('#is_featured').change(function() {
            if (this.checked) {
                $(".featured-image-get").show();

            } else {

                $(".featured-image-get").hide();
            }
        });

    });
</script>