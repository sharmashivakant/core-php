<section class="inner-banner">
        <div class="cust-container">
            <h2>For Candidates</h2>
            <img class="animation-clients-img" src="<?= _SITEDIR_; ?>public/images/animation-can.gif" alt="">
        </div>
    </section>


    <section class="feature-block feature-block-bnner feature-funt-content client-feature-content">
        <div class="cust-container">
            <div class="feature-left">
                <div class="feature-left-inner">
                    <h4><contentElement name="banner_title" type="input">Why Use Us</contentElement></h4>
                    <contentElement name="banner_section_content" type="textarea">
                    <p> At Initi8 we believe in the personal touch. Our expert consultants will get to know you and will use their specialist knowledge of your sector, to share exciting roles that match your career goals.</p>
                    </contentElement>
                    <a href="javascript:void(0)" class="show-more outline-grey-btn show_hide"
                        data-content="toggle-text">
                        READ MORE</span>
                    </a>

                    <div class="show-more-content">
                        <contentElement name="banner_show_more_content" type="textarea">
                        <p>We go above and beyond for our candidates. We provide a free CV review, interview technique coaching, market information as well as multiple job opportunities. </p>
                        <p>We believe in simplicity. If you’re required to do a technical test, we’ll ensure it is only one and we’ll share the results with multiple clients.  </p>
                        <p>  We believe our candidates should start on a level playing field. That’s why we screen all interview questions for bias on our video interview platform.  </p>
                        <p>We’ll keep you informed of your progress every step of the way and you can track your application using your candidate portal. </p>
                        <p> We’re here to maximise your potential, build a long-term relationship with you and make your job hunt an enjoyable process. </p>
                    </contentElement>
                        <a href="javascript:void(0)" class="show-less outline-grey-btn show_hide"
                            data-content="toggle-text">
                            READ LESS
                        </a>
                    </div>
                </div>

            </div>

            <div class="feature-img">
                <div class="img-box">
                    <img src="<?= getImageElement('candidate_banner_image', _SITEDIR_ . 'public/images/feature-16.png'); ?>" alt='<contentElement name="candidate_banner_image_alt" type="input">feature-16</contentElement>'
>
                </div>
            </div>
        </div>
    </section>

    <section class="current-jobs-block cust-container">
        <h4><contentElement name="current_job_title" type="input">Current Jobs</contentElement></h4>
        <div class="current-jobs-row">
              <?php if($this->list): foreach ($this->list as $item) { ?>
            <div class="job-content-card  job-content-card-lg yellow-block">
                <h4 class="heading"><?= $item->title ?></h4>
                <?php if($item->locations!=''){?>
                <span class="location-ico"><?php
                              echo implode(", ", array_map(function ($location) {
                               return $location->location_name;   
                            }, $item->locations)); 
                            ?></span>
                            <?php } ?>
                            <?php if($item->salary_value!=''){?>
                <span class="money-ico"><?php
                        if($item->salary_value!=''){?>
                            <?= (($item->salary_value) ? CURRENCY_SYMBOL.$item->salary_value : '00.00'); ?>
                       <?php  }else{?>
                        <?= (($item->salary_from) ? CURRENCY_SYMBOL.$item->salary_from . ' - ' : '')  . ( ($item->salary_to) ?CURRENCY_SYMBOL . $item->salary_to : ''); ?>
                    <?php }?></span> <?php } ?>
                <p class="para-heading"><?= reFilter($item->content_short) ?></p>
                <a href="{URL:job/<?= $item->slug; ?>}" class="arrow-ico"></a>
            </div>
<?php }  endif; ?>  
        </div>
        <a href="{URL:jobs}" class="outline-grey-btn">
            <span><cite>VIEW MORE JOBS</cite> <i class="arrow-right"></i></span>
        </a>
    </section>

    <section class="toolkit-block cust-container candidate-toolkit-block">
        <h4><contentElement name="candidate_toolkit_title" type="input">Candidate Toolkit</contentElement></h4>
        <contentElement name="candidate_toolkit_content" type="textarea">
        <p>Tips and tricks for becoming a great candidate</p>
        </contentElement>
        <div class="toolkit-row">
            <div class="toolkit-cell">
                <div class="toolkit-cell-inner">
                    <div>
                        <h4><contentElement name="cv_template_title" type="input">Initi8’s CV Template </contentElement></h4>
                    </div>

                    <a href="<?= _SITEDIR_; ?>public/documents/CV-Template.pdf" target="_blank" class="outline-grey-btn download-pdf-btn">
                        <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

            <div class="toolkit-cell">
                <div class="toolkit-cell-inner">
                    <div>
                        <h4><contentElement name="resume_writing_title" type="input">Initi8’s Principles For Resume Writing</contentElement></h4>
                    </div>
                    <a href="<?= _SITEDIR_; ?>public/documents/initi8-Initi8’s-Principles-for-CV-Writing.pdf" target="_blank" class="outline-grey-btn download-pdf-btn">
                        <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

            <div class="toolkit-cell">
                <div class="toolkit-cell-inner">
                    <div>
                        <h4><contentElement name="step_interview_title" type="input">Initi8’s 13 Steps To Interview Success</contentElement>
                        </h4>
                    </div>

                    <a href="<?= _SITEDIR_; ?>public/documents/initi8-Thirteen-Steps-for-Interview-Success.pdf" target="_blank" class="outline-grey-btn download-pdf-btn">
                        <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                    </a>
                </div>
            </div>

        </div>
    </section>
