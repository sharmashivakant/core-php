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
                    <h1>Manage Vacancies
                        <?php
                        if ($this->microsite)
                            echo 'for ' . $this->microsite->title;
                        ?></h1>

                    <a class="btn btn-primary mb-2 mr-2" href="{URL:panel/vacancies}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                       Active Vacancies
                    </a>
                </div>

                <!-- Table -->
                <div class="table-responsive mb-4 mt-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th align="center">Ref</th>
                            <th>Job Title</th>
                            <th>Sector(s)</th>
                            <th>Location(s)</th>
                            <th>Views</th>
                            <th>Applications</th>
                            <th>Data Posted</th>
                            <th align="center">Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($this->list) && is_array($this->list) && count($this->list)) { ?>
                            <?php foreach ($this->list as $item) { ?>
                                <tr>
                                    <td align="center">
                                        <?= $item->ref; ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-arrow-right" style="padding-right: 5px;"></i><a href="{URL:panel/uploaded_vacancies/view/<?= $item->id ?>}" style="text-decoration: none;color: black"><?= $item->title; ?></a>
                                    </td>
                                    <td>
                                        <?php echo implode(", ", array_map(function ($sector) {
                                            return $sector->sector_name;
                                        }, $item->sectors)); ?>
                                    </td>
                                    <td>
                                        <?php echo implode(", ", array_map(function ($location) {
                                            return $location->location_name;
                                        }, $item->locations)); ?>
                                    </td>
                                    <td>
                                        <?= $item->views; ?>
                                    </td>
                                    <td>
                                        <?= date("d/m/Y", $item->time); ?>
                                    </td>
                                    <td align="center">
                                        <?= $item->expire_reason; ?>
                                    </td>
                                    <td align="center">
                                        <?= date("d/m/Y", $item->time_expire); ?>
                                    </td>
                                    <td>
                                        <a href="{URL:panel/vacancies/edit/<?= $item->id; ?>}" class="bs-tooltip" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                        </a>
                                        <?php if ($item->deleted == 'yes'){?>
                                        <a  onclick="load('panel/vacancies/resume', 'id=<?=$item->id?>')" style="cursor:pointer" class="bs-tooltip" title="Resume">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                        </a>
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