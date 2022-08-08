<form id="form_box" action="{URL:panel/services/add}" method="post" enctype="multipart/form-data">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <!-- Title ROW -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <h1 class="page_title"><a href="{URL:panel/services}">Services</a> » New</h1>
                    </div>
                </div>
            </div>


            <!-- General -->
            <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Service Title</label>
                            <input class="form-control" type="text" name="title" id="title" value="<?= post('title', false); ?>">
                            <!--required-->
                        </div>
                    </div>

                </div>
            </div>

            <!-- Save Buttons -->
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div>
                            <button type="submit" name="submit" class="btn btn-success" onclick="load('panel/services/add', 'form:#form_box'); return false;"><i class="fas fa-save"></i>Save Changes</button>
                            <a class="btn btn-outline-warning" href="{URL:panel/services}"><i class="fas fa-ban"></i>Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>
<script>
    //$(function() {
    //   $("#firstname, #lastname").keyup(function() {
    //      initSlug('#slug', '#firstname,#lastname');
    //  });
    //});
</script>