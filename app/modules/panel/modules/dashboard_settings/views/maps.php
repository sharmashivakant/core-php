<form id="form_box" action="{URL:panel/analytics/config}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title">Maps</h1>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <h4>Configuration</h4>

                    <div class="form-group">
                        <label for="maps_api_key">
                            API Key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Obtain</a>
                        </label>
                        <input class="form-control" type="text" name="maps_api_key" id="maps_api_key" value="<?= post('maps_api_key', false, $this->maps_api_key->value); ?>" required>
                    </div>
                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <a class="btn btn-success" onclick="load('panel/dashboard_settings/maps', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</a>
                            <a class="btn btn-outline-warning" href="{URL:panel}"><i class="fas fa-ban"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>