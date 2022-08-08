<div id="control-container">
    <div id="button-holder">
        <a href="{URL:panel/sitemap}" onclick="load('panel/sitemap');" class="btn add"><i class="fas fa-ban"></i>Cancel</a>
        <div class="clr"></div>
    </div>
    <h1>
        <i class="fas fa-users"></i>Site Map <i class="fas fa-caret-right"></i>Edit
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


    <form id="form_box">
        <div class="form-section">
            <span class="heading">General</span>

            <div class="col half_column_left">
                <label for="title">Table</label>
                <input type="text" name="table" id="table" value=" <?= post('table', false, $this->item->table); ?>">
            </div>

            <div class="col half_column_right">
                <label for="ref">Where</label>
                <input type="text" name="where" id="where" value=" <?= post('where', false, $this->item->where); ?>">
            </div>
            <div class="clr"></div>

            <div class="clr"></div>

            <div class="col full_column">
                <label>Url</label>
                <input type="text" name="url" id="url" value="<?= post('url', false, $this->item->url); ?>">
            </div>

        </div>
        <div class="form-section">
            <button type="submit" name="submit" class="btn submit" onclick="load('panel/sitemap/edit/<?= $this->item->id; ?>', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
            <a href="{URL:panel/sitemap/}" onclick="load('panel/sitemap/');" class="btn cancel"><i class="fas fa-ban"></i>Cancel</a>
            <div class="clr"></div>
        </div>
    </form>
</div>

