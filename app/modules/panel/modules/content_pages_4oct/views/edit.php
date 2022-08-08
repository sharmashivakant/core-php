<link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/ckeditor.js"></script>
<script src="<?= _SITEDIR_; ?>public/plugins/ckeditor/samples/js/sample.js"></script>

<?php
$name = $this->page_name->content ? $this->page_name->content : ucfirst(get('page'));
?>
 
<!--Original codes start from here-->
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <form id="form_box" action="{URL:panel/content_pages/edit/}?module=<?= get('module'); ?>&page=<?= get('page'); ?>" method="post" enctype="multipart/form-data">
               <?php
               $module=get('module');
               $page=get('page');  
               if($module=='page' && $page=='index'){?>         
                    <div>
        <label for="lang">Language</label>
        <select name="lang" id="lang" onchange="load('panel/content_pages/change_lang', 'module=<?= get('module'); ?>',
                'page=<?= get('page'); ?>', 'lang#lang')">
            <option value="en">UK</option>
            <option value="us">US</option>           
        </select>
    </div>
   <?php } ?>

     <div id="content_box">   
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/content_pages}">Content Pages</a>
                            » <a href="{URL:panel/content_pages/view}?module=<?= get('module'); ?>"><?= ucfirst(get('module')); ?></a>
                            » <?= $name ?>
                        </h1>
                    </div>
              <!--  </div>
            </div>-->

            <!-- page name -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Page Name <span class="info_text">(Visible only in panel)</span></h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="page_name" id="page_name"
                                value="<?= post('page_name', false, $name); ?>">
                    </div>
                </div>
            </div>


            <!-- SEO: Meta title, keywords, description -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>On-page SEO</h4>

                    <div class="form-group">
                        <label for="meta_title">
                            Meta Title<a href="https://moz.com/learn/seo/title-tag" target="_blank"><i class="fas fa-info-circle"></i></a>
                        </label>
                        <input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->meta_title->content); ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">
                            Meta Keywords<a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
                        </label>
                        <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->meta_keywords->content); ?>">
                    </div>
                    <div class="form-group">
                        <label for="meta_desc">
                            Meta Description<a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
                        </label>
                        <input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->meta_desc->content); ?>">
                    </div>
                </div>
            </div>


            <!-- Content Blocks -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Content Blocks</h4>

                    <?php
                    $counter = 0;
                    foreach ($this->list as $item) {
                        ?>
                        <div class="content_box">
                            <div class="flex-btw">
                                <div class="form-group mb-4" style="min-width: 300px; width: 30%;">
                                    <label for="<?= $item->name; ?>--alias">Block Name <span class="info_text">(Visible only in panel)</span></label>
                                    <input type="text" class="form-control" name="<?= $item->name; ?>--alias" id="<?= $item->name; ?>--alias" value="<?= post($item->name.'--alias', false, $item->alias); ?>" placeholder="<?= $item->name; ?>">
                                </div>

                                <div class="option__buttons">
                                    <a href="{URL:panel/content_pages/delete}?id=<?= $item->id ?>&module=<?= get('module') ?>&page=<?= get('page') ?>"
                                       class="bs-tooltip fa fa-trash-restore-alt" title="Reset Element"></a>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <?php if ($item->type === 'input') { ?>
                                    <label for="<?= $item->name; ?>">Content</label>
                                    <input type="text" class="form-control" name="<?= $item->name; ?>" id="<?= $item->name; ?>" value="<?= post($item->name, false, $item->content); ?>">
                                <?php } else if ($item->type === 'textarea') { ?>
                                    <label for="<?= $item->name; ?>">Content</label>
                                    <textarea name="<?= $item->name; ?>" class="form-control" id="<?= $item->name; ?>" rows="20"><?= post($item->name, false, $item->content); ?></textarea>
                                    <script>
                                        var editorField<?= $counter; ?>;
                                        $(function () {
                                            editorField<?= $counter; ?> = CKEDITOR.replace('<?= $item->name; ?>', {
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
                                <?php } else if ($item->type =='image'){ ?>
                                    <!-- Image -->
                                    <div class="form-group col-md-6">
                                        <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                                        <div class="choose-file modern">
                                            <input type="hidden" name="<?= $item->name ?>" id="<?= $item->name ?>" value="<?= post($item->name, false, $item->content); ?>">
                                            <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image_popup/', 'name=<?= randomHash(); ?>', 'field=#<?= $item->name ?>', 'preview=#preview_<?= $item->name ?>',
                                                    'width=<?= $item->image_width ?>', 'height=<?= $item->image_height ?>');">
                                            <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                                            <div id="preview_<?= $item->name ?>" class="preview_image">
                                                <img src="<?= $item->content ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                <?php } else if ($item->type === 'video'){ ?>
                                    <?php if ($item->video_type == 'youtube'){ ?>
                                    <div class="form-group mb-4">
                                        <label for="<?= $item->name; ?>">Video Link</label>
                                        <input class="form-control" type="text" name="<?= $item->name; ?>" id="<?= $item->name; ?>" value="<?= post($item->name, false, $item->content); ?>">
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group col-md-6">
                                        <label for="file">Video
                                            <small>
                                                <i>(Videos must be under <?= file_upload_max_size_format() ?>, and <?= strtoupper(implode(', ', array_keys(File::$allowedVideoFormats))) ?> format)</i>
                                            </small>
                                            <?= ($item->content ? '<a href="'. $item->content . '" download="video"><i class="fas fa-download"></i> Download</a>' : '') ?>
                                        </label>
                                        <div class="flex-btw flex-vc" >
                                            <div class="choose-file">
                                                <input type="hidden" name="<?= $item->name ?>" id="<?= $item->name ?>" value="<?= post($item->name, false,  $item->content ); ?>">
                                                <input type="file" accept="video/mp4, video/avi, video/mkv" onchange="initFile(this); load('cv/uploadVideo/', 'name=<?= randomHash(); ?>', 'preview=#video_<?= $item->name ?>', 'field=#<?= $item->name ?>');">
                                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose file</a>
                                            </div>
                                            <div id="video_<?= $item->name ?>"></div>
                                        </div>
                                    </div>
                                <?php }
                                } ?>
                            </div>
                        </div>
<!--                        <hr>-->
                        <?php
                        $counter++;
                    }
                    ?>

                </div>
            </div>
</div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn submit" onclick="setTextareaValue(); load('panel/content_pages/edit/?module=<?= get('module'); ?>&page=<?= get('page'); ?>', 'form:#form_box', 'lang:#lang'); return false;"><i class="fas fa-save"></i>Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/content_pages/view}?module=<?= get('module'); ?>"><i class="fas fa-ban"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
     
</form>

<script>    
    $( document ).ready(function() {
    function setTextareaValue() {
        <?php
        $counter = 0;
        foreach ($this->list as $item) {

            if ($item->type === 'textarea')
                echo '$("#' . $item->name . '").val(editorField' . $counter . '.getData());';
            $counter++;
        }
        ?>
    }
    });
</script>