<div class="box">
    <h1 class="title_2">Users <span class="minor_text">per 24h:</span> <?php echo $this->online24h; ?></h1>
    <hr/>

    <table class="case-table mt_12">
        <tr>
            <th>ID</th>
            <th>Nick</th>
            <th>Email</th>
            <th>Time</th>
        </tr>

        <?php
        while ($list = mysqli_fetch_object($this->list)) { ?>
            <tr>
                <td><?php echo $list->id; ?></td>
                <td class="w40p"><?php echo $list->nickname; ?></td>
                <td><?php echo $list->email; ?></td>
                <td><?php echo printTime($list->last_time); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>