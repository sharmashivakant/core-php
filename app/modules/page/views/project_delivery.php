<section class="inner-banner">
        <div class="cust-container">
            <h2><?= $this->projcet_delivery->title; ?></h2>
        </div>
    </section>

    <section class="feature-block feature-block-bnner feature-funt-content mod-feature-content">
        <div class="cust-container">
            <div class="feature-left">
                <div class="feature-left-inner">
				
				 <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->projcet_delivery->title_icon ?>" alt="">
				 <h4><?= $this->projcet_delivery->sub_title; ?></h4>
                 <?= html_entity_decode($this->projcet_delivery->desc_short); ?>
				 
                    
                    <a href="javascript:void(0)" class="show-more pink-btn outline-grey-btn show_hide"
                        data-content="toggle-text">
                        READ MORE
                    </a>

                    <div class="show-more-content">
                        <?= html_entity_decode($this->projcet_delivery->desc); ?>
                                                
                        <a href="javascript:void(0)" class="show-less pink-btn outline-grey-btn show_hide"
                            data-content="toggle-text">
                            READ LESS
                        </a>
                    </div>
                </div>
            </div>

            <div class="feature-img">
                <div class="img-box">
                    <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->projcet_delivery->image ?>" alt="">
                </div>
                <div class="img-box show-more-img">
                     <img src="<?= _SITEDIR_; ?>data/services/images/<?= $this->projcet_delivery->read_more_image ?>" alt="">
                </div>
            </div>

        </div>
    </section>

    <section class="downlaod-pdf-block cust-container downlaod-pdf-mod">
        <div class="downlaod-pdf-row">
            <div class="downlaod-pdf-cell">
                <div class="yellow-card downlaod-pdf-inner">
				<a href="<?= _SITEDIR_; ?>data/services/pdf/<?= $this->projcet_delivery->pdf1; ?>" target="_blank" class="outline-grey-btn download-pdf-btn">
                        <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

        </div>
    </section>  