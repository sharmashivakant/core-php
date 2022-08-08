<form id="form_box" action="{URL:panel/dashboard_settings/edit/<?= $this->edit->id; ?>}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/dashboard_settings}">Dashboard Settings</a> » Edit</h1>
                    </div>
                </div>
            </div>

            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>General</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false, $this->edit->title); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="active" <?= checkOptionValue(post('status', false, $this->edit->status), 'active'); ?>>Active</option>
                                <option value="inactive" <?= checkOptionValue(post('status', false, $this->edit->status), 'inactive'); ?>>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Table</label>
                            <select class="form-control" name="table" id="table" required>
                                <?php if (isset($this->tables) && is_array($this->tables) && count($this->tables) > 0) { ?>
                                    <?php foreach ($this->tables as $table) { ?>
                                        <option value="<?= $table; ?>" <?= checkOptionValue(post('table', false, $this->edit->table), $table); ?>><?= $table; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Where</label>
                            <input class="form-control" type="text" name="where" id="where" value="<?= post('where', false, $this->edit->where); ?>">
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
                                    load('panel/dashboard_settings/edit/<?= $this->edit->id; ?>', 'form:#form_box'); return false;">
                                <i class="fas fa-save"></i>Save Changes
                            </a>
                            <a class="btn btn-outline-warning" href="{URL:panel/dashboard_settings}"><i class="fas fa-ban"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>