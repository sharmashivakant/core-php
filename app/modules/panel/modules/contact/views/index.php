<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= _SITEDIR_; ?>plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="<?= _SITEDIR_; ?>plugins/table/datatable/dt-global_style.css">
<!-- END PAGE LEVEL STYLES -->

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">

                <!-- Head -->
                <div class="flex-btw flex-vc mob_fc">
                    <h1>Inquiry Forms</h1>
                    <a class="btn btn-primary mb-2 mr-2" onclick="load('panel/contact/export_data'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Export to CSV
                    </a>
                </div>

                <!-- Table -->
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Time</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($this->list) && is_array($this->list) && count($this->list)) { ?>
                            <?php foreach ($this->list as $item) { ?>
                                <tr>
                                    <td>
                                        <?= $item->first_name; ?>
                                    </td>
                                    
                                    <td>
                                        <?= $item->email; ?>
                                    </td>
                                    <td>
                                        <?= $item->phone; ?>
                                    </td>
                                    
                                    <td>
                                        <?= $item->message; ?>
                                    </td>
                                    
                                    <td>
                                        <?= printTime($item->time, 'd.m.Y / H:i'); ?>
                                    </td>
                                    <td class="option__buttons">
                                         
                                        <a href="{URL:panel/contact/delete/<?= $item->id; ?>}" class="bs-tooltip fa fa-trash" title="Delete"></a>
                                        <?php if ($item->cv_file) { ?>
                                                <a href="<?= _SITEDIR_; ?>data/cvs/<?= $item->cv_file; ?>" class="bs-tooltip fa fa-download" title="Download CV"></a>
                                            <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>


<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= _SITEDIR_; ?>plugins/table/datatable/datatables.js"></script>
<script>
    $(function () {
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [10, 25, 50, 100],
            "pageLength": 25
        });
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->