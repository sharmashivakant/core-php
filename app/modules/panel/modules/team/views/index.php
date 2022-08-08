<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?= _SITEDIR_; ?>plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="<?= _SITEDIR_; ?>plugins/table/datatable/dt-global_style.css">
<!-- END PAGE LEVEL STYLES -->

<style>
    td img {
        width: 32px;
        height: 32px;
        border-radius: 16px;
    }
</style>

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">

                <!-- Head -->
                <div class="flex-btw flex-vc mob_fc">
                    <h1>Team</h1>

                    <a class="btn btn-primary mb-2 mr-2" href="{URL:panel/team/add}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add New Team Member
                    </a>
                </div>


                <!-- Table -->
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="max_w_60">ID</th>
                            <th>Sort</th>
                            <th>Ful Name</th>
                            <th>Email</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($this->team) && is_array($this->team) && count($this->team)) { ?>
                            <?php foreach ($this->team as $item) { ?>
                                <tr>
                                    <td class="mini_mize max_w_60" title="<?= $item->id; ?>">
                                        <?php echo $item->id; ?>
                                    </td>
                                    <td>
                                        <?php echo $item->sort; ?>
                                    </td>
                                    <td>
                                        <?php if ($item->image) { ?>
                                            <img src="<?= _SITEDIR_; ?>data/users/<?= $item->image ?>" alt="avatar">
                                        <?php } else { ?>
                                            <img src="<?= _SITEDIR_; ?>assets/img/90x90.jpg" alt="avatar">
                                        <?php } ?>
                                        <?php echo $item->firstname . ' ' . $item->lastname; ?>
                                    </td>
                                    <td>
                                        <?php echo $item->email; ?>
                                    </td>
                                    <td class="option__buttons">
                                        <a href="#" onclick="share_linkedin(this);" data-url="{URL:meet-the-team/<?= $item->slug; ?>}" class="bs-tooltip fa fa-linkedin" title="Share To LinkedIn"></a>
                                        <a href="#" onclick="share_facebook(this);" data-url="{URL:meet-the-team/<?= $item->slug; ?>}" class="bs-tooltip fa fa-facebook" title="Share To Facebook"></a>
                                        <a href="#" onclick="share_twitter(this);" data-url="{URL:meet-the-team/<?= $item->slug; ?>}" class="bs-tooltip fa fa-twitter" title="Share To Twitter"></a>
                                        <a href="#" data-clipboard-text="{URL:meet-the-team/<?= $item->slug; ?>}" class="bs-tooltip copy_btn fa fa-copy" title="Copy Link"></a>
                                        -
                                        <a onclick="load('panel/team/sort/down/<?= $item->id; ?>');" class="bs-tooltip fa fa-arrow-down" title="Down"></a>
                                        <a onclick="load('panel/team/sort/up/<?= $item->id; ?>');" class="bs-tooltip fa fa-arrow-up" title="Up"></a>
                                        -
                                        <a href="{URL:meet-the-team/<?= $item->slug; ?>}" class="bs-tooltip fa fa-eye" title="View Member" target="_blank"></a>
                                        <a href="{URL:panel/team/edit/<?= $item->id; ?>}" class="bs-tooltip fa fa-pencil-alt" title="Edit"></a>
                                        <?php if (User::get('id') !== $item->id) { ?>
                                            <a href="{URL:panel/team/delete/<?= $item->id; ?>}" class="bs-tooltip fa fa-trash" title="Delete"></a>
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