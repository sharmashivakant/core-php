<form id="form_box_page" action="{URL:panel/employer_page_logos/add}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/employer_page_logos}">Logo</a> » Add</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <!-- Image -->
                        <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                        <div class="choose-file modern">
                            <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->edit->image); ?>">
                            <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                            <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                            <div id="preview_image" class="preview_image">
                                <img src="<?= _SITEDIR_; ?>data/events/<?= post('image', false, $this->edit->image); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="load('panel/employer_page_logos/add', 'form:#form_box_page'); return false;">Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/employer_page_logos}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
