<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">

                <!-- Head -->
                <div class="flex-btw flex-vc mob_fc">
                    <h1>Modules</h1>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-4">
                        <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th style="width: 80px;">Name</th>
                            <th style="width: 50px;">Version</th>
                            <th style="width: 10%;">Time</th>
                            <th style="width: 100px;">Options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($this->list->num_rows) { ?>
                            <?php while ($list = mysqli_fetch_object($this->list)) { ?>
                                <tr>
                                    <td><?= $list->id; ?></td>
                                    <td><?= $list->name; ?></td>
                                    <td><?= $list->version; ?></td>
                                    <td><?= date('d-m-Y', $list->time); ?></td>
                                    <td class="option__buttons">
                                        <a onclick="load('panel/modules_edit/<?= $list->id; ?>');" style="cursor: pointer;" class="bs-tooltip fa fa-pencil-alt" title="Edit"></a>
                                        <?php /*
                                        <a href="{URL:panel/modules/delete/<?= $list->id; ?>}" class="bs-tooltip" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </a>
 */ ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="center">No records</td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>
