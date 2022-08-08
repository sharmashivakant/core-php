<!--<div class="tl-right">
                    <?php incFile('modules/page/system/inc/lang.php') ?>

                    <div class="menu-icon">
                      
                        <span></span>
                    </div>
                </div>-->
    <section class="banner main-banner">
        <div class="cust-container">
            <div class="main-banner-left">
                <div class="inside-left">
                    <div id="home-testi" class="owl-carousel owl-theme home-testimonial">
                        <contentElement name="banner_content" type="textarea">
                        <div class="item">
                            <p>“Initi8 has found me the best possible talent for the jobs I have been hiring for - a great success for both me and my new team”</p>
                        </div>
                        <div class="item">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy </p>
                        </div>
                        <div class="item">
                            <p>printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also theu</p>
                        </div>
                        <div class="item">
                            <p>was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop</p>
                        </div>
                        <div class="item">
                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature </p>
                        </div>
                        </contentElement>
                    </div>
                    <h3><contentElement name="banner_title" type="input">The spark of something <cite>big</cite>.</contentElement></h3>
                    <a href="{URL:jobs}" class="arrow-yellow-btn">
                    <span><cite>{L:FINDJOB_BUTTON}</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
                
            </div>

            <div class="main-banner-img">
                <div class="img-box">
                    <img src="<?= getImageElement('banner_image', _SITEDIR_ . 'public/images/feature-1.png'); ?>" alt='<contentElement name="banner_image_alt" type="input">feature-1</contentElement>'>
                </div>
            </div>
        </div>
    </section>

    <section class="w-we-do-block cust-container">   
        <div class="two-cell-row">
            <div class="text-block">
                <div class="text-inner-block">
                    <h4><contentElement name="whatwedo_title" type="input">What we do</contentElement></h4>
                    <contentElement name="we_place_content" type="textarea">
                    <p>We place exceptional candidates in today’s most significant IT roles and spark new beginnings. We
                        use the Initi8 Method to recruit for both permanent hires and contract assignments for a range
                        of technology roles in the UK, European Union and the United States. </p></contentElement>
                    <a href="{URL:what-we-do}" class="arrow-grey-btn learn-more-btn">
                        <span><cite>{L:LEARNMORE_BUTTON}</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

            <div class="img-block">
                <div class="img-box">
                    <img src="<?= getImageElement('banner_feature2_image', _SITEDIR_ . 'public/images/feature-2.svg'); ?>" alt='<contentElement name="banner_feature2_alt" type="input">feature-2</contentElement>'>
                </div>
            </div>
        </div>
    </section>

    <section class="w-we-are-block cust-container">
        <div class="two-cell-row">
            <div class="img-block">
                <div class="img-box">
                    <img src="<?= getImageElement('banner_feature5_image', _SITEDIR_ . 'public/images/feature-5.png'); ?>" alt='<contentElement name="banner_feature5_alt" type="input">feature-5</contentElement>'>
                </div>
            </div>

            <div class="text-block">
                <div class="text-inner-block">
                    <h4><contentElement name="whoweare_title" type="input">Who we are</contentElement></h4>
                    <contentElement name="whowe_are_content" type="textarea">
                    <p>We’re an expert, collaborative and passionate team of IT recruiters, with over 30 years of
                        experience. We’re invested in the success of our clients and candidates, and look to build
                        lasting relationships with them. Our friendly team of consultants are highly trained to ensure
                        we can deliver your recruitment needs, whatever they may be. </p></contentElement>
                    <a href="{URL:who-we-are}" class="arrow-grey-btn learn-more-btn">
                        <span><cite>{L:LEARNMORE_BUTTON}</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="find-block">
        <div class="cust-container">
            <div class="find-row row">
                <div class="find-cell col-sm-6">
                    <div class="find-inner-cell">
                        <div class="img-color-box client-img-box">
                                <a href="{URL:clients}"><img src="<?= SITE_URL; ?>app/public/images/animation-2.gif" class="animateda bouncea" alt="" ></a>
                          
                        </div>
                        <h5>{L:IAMCLIENT_BUTTON}</h5>
                        <a href="{URL:talent}" class="arrow-grey-btn">
                            <span><cite>{L:FINDCANDIDATE_BUTTON}</cite> <i class="arrow-right"></i></span>
                        </a>
                    </div>

                </div>

                <div class="find-cell col-sm-6">
                    <div class="find-inner-cell">
                        <div class="img-color-box candidate-img-box">
                              <a href="{URL:candidate}"> <img src="<?= SITE_URL; ?>app/public/images/animation-1.gif" class="animated bounce" alt="" srcset=""> </a>
                        </div>

                        <h5>{L:IAMCANDIDATE_BUTTON}</h5>
                        <a href="{URL:jobs}" class="arrow-grey-btn">
                            <span><cite>{L:FINDJOB_BUTTON}</cite> <i class="arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>