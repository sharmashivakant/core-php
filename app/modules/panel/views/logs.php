<div class="layout-px-spacing">
    <div class="row layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">

                <!-- Head -->
                <div class="flex-btw flex-vc mob_fc">
                    <h1>Logs</h1>

                    <a class="btn btn-primary mb-2 mr-2" onclick="load('panel/logs', 'q=clear');">
                        Clear Logs
                    </a>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-4">
                        <thead>
                        <tr>
                            <th style="width: 70px;">ID</th>
                            <th style="width: 80px;">Type</th>
                            <th style="width: 110px;">Where</th>
                            <th>Error</th>
                            <th style="width: 10%;">Time</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php if ($this->list->num_rows) { ?>
                            <?php while ($list = mysqli_fetch_object($this->list)) { ?>
                                <tr>
                                    <td><?= $list->id; ?></td>
                                    <td><?= $list->status; ?></td>
                                    <td><?= $list->where; ?></td>
                                    <td class="w40p"><?= reFilter($list->error); ?></td>
                                    <td><?= $list->time; ?></td>
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