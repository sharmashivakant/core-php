<form id="form_box" action="{URL:panel/case_studies/edit/<?= $this->case_studies->id; ?>}" method="post" enctype="multipart/form-data">
	<div class="layout-px-spacing">
		<div class="row layout-top-spacing">
			<!-- Title ROW -->
			<div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
				<div class="statbox widget box box-shadow">
					<div class="widget-header">
						<h1 class="page_title"><a href="{URL:panel/case_studies}">Case Study</a> » Edit</h1>
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
								<label for="title">Case Study Title</label>
								<input type="text" class="form-control" name="title" id="title" value="<?= post('title', false, $this->case_studies->title); ?>">
							</div>
							<!--<div class="form-group">-->
							<!--	<label for="subtitle">Subtitle</label>-->
							<!--	<input type="text" class="form-control" name="subtitle" id="subtitle" value="<?= post('subtitle', false, $this->case_studies->subtitle); ?>">-->
							<!--</div>-->
						</div>
						<div class="form-group col-md-6">
							<!-- Image -->
							<label for="image">Logo<small><i>(Logo files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>
							<div class="choose-file modern">
								<input type="hidden" name="image" id="image" value="<?= post('image', false, $this->case_studies->image); ?>">
								<input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
								<a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
								<div id="preview_image" class="preview_image">
									<img src="<?= _SITEDIR_; ?>data/case-studies/<?= post('image', false, $this->case_studies->image); ?>" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="form-row">
                        <div class="form-group col-md-6">
                            <!--<div class="form-group">-->
                            <!--    <label for="sector">Category</label>-->
                            <!--    <input type="text" class="form-control" name="category" id="category" value="<?= post('category', false, $this->case_studies->category); ?>">-->
                            <!--</div>-->
                            <div class="form-group">
                                <label for="time">Date Posted</label>
                                <input class="form-control" type="text" name="time" id="time" value="<?= post('time', false, date("d/m/Y", $this->case_studies->time)); ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="icon">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>
                            <div class="choose-file modern">
                                <input type="hidden" name="icon" id="icon" value="<?= post('icon', false, $this->case_studies->icon); ?>">
                                <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initSecondFile(this); load('panel/upload_icon/', 'name=<?= randomHash(); ?>', 'field=#icon');">
                                <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>

                                <div id="preview_icon" class="preview_icon">
                                    <img src="<?= _SITEDIR_; ?>data/case-studies/<?= post('icon', false, $this->case_studies->icon); ?>" alt="">
                                </div>
                            </div>
                        </div>
						<div class="form-group col-md-6">
							<label for="posted">Posted</label>
							<select class="form-control" name="posted" id="posted" required>
								<option value="yes" <?= checkOptionValue(post('posted'), 'yes', $this->case_studies->posted); ?>>Yes</option>
								<option value="no" <?= checkOptionValue(post('posted'), 'no', $this->case_studies->posted); ?>>No</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="short_description">Short Description</label>
							<input type="text" class="form-control" name="short_description" id="short_description" value="<?= post('short_description', false, $this->case_studies->short_description); ?>">
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
								<input class="form-control" type="text" name="meta_title" id="meta_title" value="<?= post('meta_title', false, $this->case_studies->meta_title); ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="meta_keywords">
								Meta Keywords<a href="https://moz.com/learn/seo/what-are-keywords" target="_blank"><i class="fas fa-info-circle"></i></a>
								</label>
								<input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="<?= post('meta_keywords', false, $this->case_studies->meta_keywords); ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="meta_desc">
								Meta Description<a href="https://moz.com/learn/seo/meta-description" target="_blank"><i class="fas fa-info-circle"></i></a>
								</label>
								<input class="form-control" type="text" name="meta_desc" id="meta_desc" value="<?= post('meta_desc', false, $this->case_studies->meta_desc); ?>">
							</div>
							<div class="form-group col-md-6">
								<label for="slug">
								URL Slug<a href="https://moz.com/case_studies/15-seo-best-practices-for-structuring-urls" target="_blank"><i class="fas fa-info-circle"></i></a>
								&nbsp;&nbsp;{URL:case_studies}/<?= $this->case_studies->slug; ?>
								</label>
								<input class="form-control" type="text" name="slug" id="slug" value="<?= $this->case_studies->slug; ?>">
							</div>
						</div>
					</div>
				</div>
				<?php /*
					<!-- Checkbox -->
					<div class="form-group">
					    <div class="form-check pl-0">
					        <div class="custom-control custom-checkbox checkbox-info">
					            <input type="checkbox" class="custom-control-input" id="gridCheck">
					            <label class="custom-control-label" for="gridCheck">Check me out</label>
					        </div>
					    </div>
					</div>
					
					<div class="code-section-container">
					    <button class="btn toggle-code-snippet"><span>Info</span></button>
					
					    <div class="code-section text-left">
					        <pre>
					            Some notes...
					        </pre>
					    </div>
					</div>
					*/ ?>
			<!-- Content -->
			<div id="flFormsGrid" class="col-lg-12 layout-spacing">
				<div class="statbox widget box box-shadow">
					<h4>The Challange Content</h4>
					<div class="form-group">
						<textarea class="form-control" name="content" id="text_content2" rows="20"><?= post('content', false, $this->case_studies->content); ?></textarea>
					</div>
					<h4>The Solution Content</h4>
					<div class="form-group">
						<textarea class="form-control" name="first_section_content" id="text_content" rows="20"><?= post('first_section_content', false, $this->case_studies->first_section_content); ?></textarea>
					</div><h4>The Result Content</h4>
					<div class="form-group">
						<textarea class="form-control" name="second_section_content" id="text_content1" rows="20"><?= post('second_section_content', false, $this->case_studies->second_section_content); ?></textarea>        
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
								load('panel/case_studies/edit/<?= $this->case_studies->id; ?>', 'form:#form_box'); return false;">
							<i class="fas fa-save"></i>Save Changes  
							</a>
							<a class="btn btn-outline-warning" href="{URL:panel/case_studies}"><i class="fas fa-ban"></i>Cancel</a>
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
	var editorField2;
	
	function setTextareaValue() {
	    $('#text_content').val(editorField.getData());
	    $('#text_content1').val(editorField1.getData());
	     $('#text_content2').val(editorField2.getData());
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
	//for conetnt 
	$(function () {
	    editorField2 = CKEDITOR.replace('text_content2', {
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