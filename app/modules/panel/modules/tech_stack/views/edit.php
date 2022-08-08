<div id="control-container">
    <div id="button-holder">
        <a href="{URL:panel/tech_stack}" onclick="load('panel/tech_stack');" class="btn add"><i class="fas fa-ban"></i>Cancel</a>
        <div class="clr"></div>
    </div>
    <h1>
        <i class="fas fa-users"></i>Tech Stack <i class="fas fa-caret-right"></i>Edit
    </h1>
    <hr/>

    <?php if (isset($success) && $success) { ?>
        <div class="success">
            <i class="fas fa-check-circle"></i><?= $success; ?>
        </div>
    <?php } ?>
    <?php if (isset($error) && $error) { ?>
        <div class="error">
            <i class="fas fa-check-circle"></i><?= $error; ?>
        </div>
    <?php } ?>
    <?php //echo validation_errors('<div class="error"><i class="fas fa-check-circle"></i>', '</div>'); ?>


    <form id="form_box" action="{URL:panel/tech_stack/edit/<?= $this->edit->id; ?>}" method="post" enctype="multipart/form-data">
        <div class="form-section">
            <span class="heading">General</span>

            <div class="col half_column_left">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?= post('name', false, $this->edit->name); ?>">
            </div>

            <!-- Image -->
            <div class="col half_column_right">
                <label for="image">Image<small><i>(Image files must be under <?= file_upload_max_size_format() ?>, and JPG, GIF or PNG format)</i></small></label>

                <div class="choose-file modern">
                    <input type="hidden" name="image" id="image" value="<?= post('image', false, $this->edit->image); ?>">
                    <input type="file" accept="image/jpeg,image/png,image/gif" onchange="initFile(this); load('panel/upload_image/', 'name=<?= randomHash(); ?>', 'field=#image');">
                    <a class="file-fake"><i class="fas fa-folder-open"></i>Choose image</a>
                    <div id="preview_image" class="preview_image">
                        <img src="<?= _SITEDIR_; ?>data/tech_stack/<?= post('image', false, $this->edit->image); ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="clr"></div>
        </div>

        <div class="form-section">
            <button type="submit" name="submit" class="btn submit" onclick="load('panel/tech_stack/edit/<?= $this->edit->id; ?>', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
            <a href="{URL:panel/tech_stack}" onclick="load('panel/tech_stack');" class="btn cancel"><i class="fas fa-ban"></i>Cancel</a>
            <div class="clr"></div>
        </div>
    </form>
</div>