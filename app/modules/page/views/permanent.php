<section class="inner-banner">
    <div class="cust-container">

        <h2><?= $this->permanent->title; ?></h2>
    </div>
</section>

<section class="feature-block feature-block-bnner feature-funt-content mod-feature-content">
    <div class="cust-container">
        <div class="feature-left">
            <div class="feature-left-inner">
                <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->permanent->title_icon ?>" class="feature-ico" alt="">
                <h4><?= $this->permanent->sub_title; ?></h4>
                <?php //print_r($this->permanent);
                ?>
                <?= html_entity_decode($this->permanent->desc_short); ?>
                <a href="javascript:void(0)" class="show-more red-btn outline-grey-btn show_hide" data-content="toggle-text">
                    READ MORE
                </a>

                <div class="show-more-content">
                    <?= html_entity_decode($this->permanent->desc); ?>
                    <a href="javascript:void(0)" class="show-less red-btn outline-grey-btn show_hide" data-content="toggle-text">
                        READ LESS
                    </a>
                </div>
            </div>

        </div>

        <div class="feature-img">
            <div class="img-box">
                <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->permanent->image ?>" alt="">
            </div>
        </div>
    </div>
</section>

<section class="squad-block cust-container">
    <div class="squad-row">
        <div class="squad-cell">
            <div class="squad-inner to-show-inner">
                <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->permanent->squad_icon ?>" alt="">
                <h4><?= $this->permanent->squad_title; ?></h4>
                <h5><?= $this->permanent->squad_subtitle; ?></h5>

                <?= html_entity_decode($this->permanent->squad_short_desc); ?>

                <a href="javascript:void(0)" class="to-show-more red-btn outline-grey-btn" data-content="toggle-text">
                    <?= $this->permanent->squad_title ?> INCLUDES
                </a>

                <div class="content-to-show">
                    <?= html_entity_decode($this->permanent->squad_desc); ?>

                    <a href="javascript:void(0)" class="to-show-less red-btn outline-grey-btn" data-content="toggle-text">
                        READ LESS
                    </a>
                </div>

            </div>
        </div>

        <div class="squad-cell">
            <div class="squad-inner to-show-inner">
                <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->permanent->squad_subscription_icon ?>" alt="">
                <h4> <?= $this->permanent->squad_subscription_title ?></h4>
                <h5> <?= $this->permanent->squad_subscription_subtitle ?></h5>

                <?= html_entity_decode($this->permanent->squad_subscription_short_desc); ?>
                <a href="javascript:void(0)" class="to-show-more red-btn outline-grey-btn" data-content="toggle-text">
                    <?= $this->permanent->squad_subscription_title ?> INCLUDES
                </a>

                <div class="content-to-show">
                    <?= html_entity_decode($this->permanent->squad_subscription_desc); ?>
                    <a href="javascript:void(0)" class="to-show-less red-btn outline-grey-btn" data-content="toggle-text">
                        READ LESS
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="downlaod-pdf-block cust-container">
    <div class="downlaod-pdf-row">
        <div class="downlaod-pdf-cell">
            <div class="yellow-card downlaod-pdf-inner">
                <a href="<?= _SITEDIR_; ?>data/services/pdf/<?= $this->permanent->pdf1; ?>"  target="_blank" class="outline-grey-btn download-pdf-btn">
                    <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                </a>
            </div>
        </div>

        <div class="downlaod-pdf-cell">
            <div class="yellow-card downlaod-pdf-inner">
                <a href="<?= _SITEDIR_; ?>data/services/pdf/<?= $this->permanent->pdf2; ?>" target="_blank" class="outline-grey-btn download-pdf-btn">
                    <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                </a>
            </div>
        </div>
    </div>
</section>