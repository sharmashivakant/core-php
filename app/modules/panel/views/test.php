<div id="control-container">
    <h1>
        <i class="fas fa-tachometer-alt"></i>
        Test
    </h1>
    <div class="currentdatetime"><span><?php echo date('H:i'); ?> (GMT)</span><span><?php echo date('D d M. Y'); ?></span></div>

    <?php if (isset($success) && $success) { ?>
        <div class="success">
            <i class="fas fa-check-circle"></i><?php echo $success; ?>
        </div>
    <?php } ?>
    <?php if (isset($error) && $error) { ?>
        <div class="error">
            <i class="fas fa-exclamation-triangle"></i><?php echo $error; ?>
        </div>
    <?php } ?>

    <div id="dashboard-stats">

        <div class="column">
            <h1>Ha ha ha</h1>
            <a href="{URL:panel}">Link</a>


            <?php foreach ($statistics as $statistic) { ?>
                <div class="block">
                    <span class="number"><?php echo $statistic['count']; ?></span>
                    <span class="label"><?php echo $statistic['title']; ?></span>
                </div>
            <?php } ?>
        </div>

        <?php foreach ($widgets as $widget) { ?>
            <?php echo $widget; ?>
        <?php } ?>
        <div class="clr"></div>

    </div>
</div>