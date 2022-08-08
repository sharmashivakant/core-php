<div class="box">
    <h1 class="title_2">Guests <span class="minor_text">per 24h:</span> <?php echo $this->online24h; ?></h1>

    <div class="flex-btw mt_12">
        <div>All time:</div>
        <div>Google: <?php echo $this->google->num_rows; ?></div>
        <div>Twitter: <?php echo $this->twitter->num_rows . '(+'.$this->twitter_2->num_rows.')'; ?></div>
        <div>Instagram: <?php echo $this->instagram->num_rows; ?></div>
    </div>

    <hr/>

    <table class="case-table mt_12">
        <tr>
            <th>IP</th>
            <th>Browser</th>
            <th>Referer</th>
            <th>Count</th>
            <th>Time</th>
        </tr>

    <?php while ($list = mysqli_fetch_object($this->list)) { ?>
        <tr>
            <td><?php echo $list->ip; ?></td>
            <td class="w40p"><?php echo $list->browser; ?></td>
            <td><a href="<?php echo $list->referer; ?>" target="_blank"><?php echo $list->referer; ?></a></td>
            <td class="yellow bold"><?php echo $list->count; ?></td>
            <td><?php echo printTime($list->time); ?></td>
        </tr>
    <?php } ?>
    </table>
</div>