<form id="form_box" action="{URL:panel/settings}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title">Settings</h1>
                    </div>
                </div>
            </div>

            <!-- Email Settings -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Email Settings</h4>

                    <div class="form-group">
                        <label for="base_url"><strong>Admin email</strong></label>
                        <input class="form-control" type="text" name="admin_mail" id="admin_mail"
                               value="<?= post('admin_mail', false, $this->admin_mail->value ? $this->admin_mail->value : ADMIN_MAIL); ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="noreply_mail">Noreply email</label>
                            <input class="form-control" type="text" name="noreply_mail" id="noreply_mail"
                                   value="<?= post('noreply_mail', false, $this->noreply_mail->value ? $this->noreply_mail->value : NOREPLY_MAIL); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="noreply_name">Noreply name</label>
                            <input class="form-control" type="text" name="noreply_name" id="noreply_name"
                                   value="<?= post('noreply_name', false, $this->noreply_name->value ? $this->noreply_name->value : NOREPLY_NAME); ?>">
                        </div>
                    </div>

<!--                    <div class="code-section-container">-->
<!--                        <div class="btn toggle-code-snippet"><span>Info</span></div>-->
<!---->
<!--                        <div class="code-section text-left">-->
<!--                            <div>-->
<!--                                <div><span class="darker">Admin email</span> - email address to which will go emails</div>-->
<!--                                <div><span class="darker">Noreply email</span> - email address from which system messages will be send</div>-->
<!--                                <div><span class="darker">Noreply name</span> - name of sender "Noreply email"</div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->

                </div>
            </div>

            <!-- Tracker -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Bug Tracker</h4>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tracker">Display "<strong>Report Issue</strong>" button?</label>
                            <select class="form-control" name="tracker" id="tracker">
                                <option value="yes" <?= checkOptionValue(post('tracker'), 'yes', $this->tracker->value); ?>>Yes</option>
                                <option value="no" <?= checkOptionValue(post('tracker'), 'no', $this->tracker->value); ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tracker_api">Tracker API key</label>
                            <input class="form-control" type="text" name="tracker_api" id="tracker_api"
                                   value="<?= post('tracker_api', false, $this->tracker_api->value); ?>">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <a class="btn btn-success" onclick="load('panel/setting', 'form:#form_box'); return false;">
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

