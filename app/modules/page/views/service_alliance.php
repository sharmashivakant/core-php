 <section class="inner-banner">
        <div class="cust-container">
            <h2><?= $this->service_alliance->title; ?></h2>
        </div>
    </section>

    <section class="feature-block feature-block-bnner feature-funt-content mod-feature-content">
        <div class="cust-container">
            <div class="feature-left">
                <div class="feature-left-inner">
                   <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->service_alliance->title_icon ?>" alt="">
                    <h4><?= $this->service_alliance->sub_title; ?></h4>
                 <?= html_entity_decode($this->service_alliance->desc_short); ?>
                   
                    <a href="javascript:void(0)" class="show-more green-btn outline-grey-btn show_hide"
                        data-content="toggle-text">
                        READ MORE
                    </a>

                    <div class="show-more-content">
                         <?= html_entity_decode($this->service_alliance->desc); ?>
                        <a href="javascript:void(0)" class="show-less green-btn outline-grey-btn show_hide"
                            data-content="toggle-text">
                            READ LESS 
                        </a>
                    </div>
                </div>
            </div>

            <div class="feature-img">
                <div class="img-box">
				 <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->service_alliance->image ?>" alt="">
                </div>
                <div class="img-box show-more-img">
                     <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->service_alliance->read_more_image ?>" alt="">
                </div>
            </div>

        </div>  
    </section>

    <section class="downlaod-pdf-block cust-container  downlaod-pdf-mod">
        <div class="downlaod-pdf-row">
            <div class="downlaod-pdf-cell">
                <div class="yellow-card downlaod-pdf-inner">
                  <a href="<?= _SITEDIR_; ?>data/services/pdf/<?= $this->service_alliance->pdf1; ?>" target="_blank" class="outline-grey-btn download-pdf-btn" >
                        <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

        </div>
    </section>