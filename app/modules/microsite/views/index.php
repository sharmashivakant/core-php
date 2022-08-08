<section class="inner-banner">
    <div class="cust-container">
        <h2><?= $this->microsite->title; ?></h2>
    </div>
</section>

<section class="img-content-block">
    <div class="cust-container">
        <div class="img-content-row img-content-row-one">
            <div class="img-content-cell">
                <div class="img-content-inner img-box">
                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= $this->microsite->header_image; ?>" alt="">
                </div>
            </div>

            <div class="img-content-cell">
                <div class="img-content-inner img-content-box">
                    <h4>Key Infomation</h4>
                 <?= reFilter($this->microsite->key_content); ?>

                   <!-- <ul>
                        <li><span>Website</span>
                            <span><a href="<?= $this->microsite->website; ?>" target="_blank">
                                    <?= $this->microsite->website; ?> </a>
                            </span>
                        </li>
                        <li> <span>Company Size</span><span><?= $this->microsite->company_size; ?></span>
                        </li>
                        <li><span>Headquarters</span>
                            <span><a id="overview"> <?php foreach ($this->microsite->locations as $locations) {
                                                        echo $locations->location_name . '</br>';
                                                    } ?> </a></span>
                        </li>
                        <li><span>Industry</span>
                            <span> <?php foreach ($this->microsite->sectors as $sectors) {
                                        echo $sectors->sector_name . '</br>';
                                    } ?> </span>
                        </li>
                        <li><span>Sectors</span>
                            <span> <?php foreach ($this->microsite->tag_sectors as $tag_sectors) {
                                        echo $tag_sectors->sector_name . '</br>';
                                    } ?> </span>
                        </li>
                    </ul>-->




                </div>
            </div>
        </div>
        <div class="img-content-row img-content-row-two">
            <div class="img-content-cell">
                <div class="img-content-inner img-content-box">

                    <?= reFilter($this->microsite->content); ?>
                </div>
            </div>
            <div class="img-content-cell">
                <div class="img-content-inner img-box">
                    <img src="<?= _SITEDIR_; ?>data/microsite/<?= $this->microsite->key_image; ?>" alt="">
                </div>
            </div>


        </div>
    </div>
</section>
<?php if (!empty($this->vacanciesdata)) { ?>
    <section class="current-jobs-block cust-container job-opportunity">
        <h4>Job Opportunities</h4>
        <div class="current-jobs-row">

            <?php foreach ($this->vacanciesdata as $vacancies) {
            ?>

                <div class="job-content-card  job-content-card-lg yellow-block">
                    <h4 class="heading"><?= $vacancies->title; ?></h4>
                    <span class="location-ico"><?php foreach ($vacancies->locations as $vaclocation) {
                                                    echo $vaclocation->location_name . ' ';
                                                } ?></span>

                    <span class="money-ico">
                        <?php
                        if ($vacancies->salary_value != '') { ?>
                            <?= (($vacancies->salary_value) ? CURRENCY_SYMBOL . $vacancies->salary_value : '00.00'); ?>
                        <?php  } else { ?>
                            <?= (($vacancies->salary_from) ? CURRENCY_SYMBOL . $vacancies->salary_from . ' - ' : '')  . (($vacancies->salary_to) ? CURRENCY_SYMBOL . $vacancies->salary_to : ''); ?>
                        <?php } ?></span>


                    <p class="para-heading"> <?= reFilter($vacancies->content_short) ?></p>
                    <a href="{URL:job/<?= $vacancies->slug; ?>}" class="arrow-ico"></a>
                </div>


            <?php }
            ?>



        </div>

    </section>
<?php } ?>