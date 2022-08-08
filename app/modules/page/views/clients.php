 <section class="inner-banner">
     <div class="cust-container">
         <h2>For Clients</h2>
         <img class="animation-clients-img" src="<?= _SITEDIR_; ?>public/images/animation-client.gif" alt="">
     </div>
 </section>


 <section class="feature-block feature-block-bnner feature-funt-content client-feature-content">
     <div class="cust-container">
         <div class="feature-left">
             <div class="feature-left-inner">
                 <h4><contentElement name="banner_content_title" type="input">Why Use Us</contentElement></h4>
                 <contentElement name="banner_content" type="textarea">
                 <p> At Initi8, we believe in <strong>collaboration</strong> and will work closely with you to understand your business and your requirements. 
                 Only then will we build talent pools of the highest calibre candidates, who are both capable and passionate about working for your business.</p></contentElement>
                 <a href="javascript:void(0)" class="show-more outline-grey-btn show_hide" data-content="toggle-text">
                    READ MORE</span>
                 </a>

                 <div class="show-more-content">
                     <contentElement name="banner_middle_section_content" type="textarea">
                     <p>We carry out <strong>aptitude, personality and technical tests</strong> and can interview on your behalf, so you can rest assured that your hires will be a great fit. </p>
                     <p>We’re committed to <strong>hiring as quickly as possible</strong>, whilst ensuring the quality of our candidates. Our video interviewing platform alone has reduced the time to hire by 60%. </p>
                     <p>We believe in <strong>taking you on the journey with us</strong>. Our clients have access to a portal to track all applications of potential candidates. </p>
                    </contentElement>
                     <a href="javascript:void(0)" class="show-less outline-grey-btn show_hide" data-content="toggle-text">
                         READ LESS
                     </a>
                 </div>
             </div>
         </div>

         <div class="feature-img">
             <div class="img-box">
                 <img src="<?= getImageElement('middle_section_image', _SITEDIR_ . 'public/images/feature-16.png'); ?>" alt='<contentElement name="middle_section_image_alt" type="input">feature-16</contentElement>'>
                 
             </div>
         </div>
     </div>
 </section>

 <section class="our-services-block">
     <div class="cust-container">
         <div class="services-container-inner">

             <h4><contentElement name="ourservice_title" type="input">Our Services</contentElement></h4>
            <contentElement name="ourservice_section_content" type="textarea">
             <p>We offer four solutions to meet the fast paced and flexible needs of our clients in the UK, European
                 Union and the United States.</p>
                 </contentElement>
             <div class="our-services-row">
                 <?php //print_r($this->services);
                 $i=1;
                    foreach ($this->services as $services) { ?>
                     <div class="our-services-cell">
                         <div class="our-services-inner <?php if($i==1){ echo 'red-block';} elseif($i==2){ echo 'blue-block';} elseif($i==3){ echo 'pink-block';} elseif($i==4){ echo 'green-block';} ?>">
                             <div>
                                 <img src="<?= _SITEDIR_; ?>data/services/images/<?= $services->title_icon; ?>" alt="">
                                 <h4><?= $services->title;  ?></h4>
                                 <?= html_entity_decode($services->info_desc);  ?>
                             </div>

                             <a href="<?= $siteurl . $services->slug; ?>" class="outline-grey-btn learn-more-btn">
                                 <span><cite>LEARN MORE</cite> <i class="arrow-right"></i></span>
                             </a>
                         </div>
                     </div>
                 <?php $i++; }
                    ?>



             </div>
         </div>
     </div>
 </section>

 <section class="talent-block cust-container">

     <div class="talent-row">
         <div class="talent-cell talent-cell-left">
             <div class="talent-inner">
                 <h4><contentElement name="talent_vault_title" type="input">Talent Vault</contentElement></h4>
                 <contentElement name="talent_vault_content" type="textarea">
                 <p>Browse through our latest candidates</p>
                 </contentElement>
                 <a href="{URL:talent-vault}" class="arrow-grey-btn learn-more-btn">
                     <span><cite>LEARN MORE</cite> <i class="arrow-right"></i></span>
                 </a>
             </div>
         </div>

         <div class="talent-cell talent-cell-right">
             <div class="talent-inner">
                 <div class="talent-content-box green-block">
                     <contentElement name="architecture_heading" type="textarea">
                     <p class="heading">Architecture</p>
                     </contentElement>
                     <span class="location-ico"><contentElement name="city_name" type="input">London</contentElement></span>
                     <span class="money-ico"><contentElement name="currency_text" type="input">£00.00</contentElement></span>
                     <contentElement name="architecture_section_content" type="textarea">
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In metus erat dui diam, fames
                         pretium. Etiam odio integer sit sed massa.</p></contentElement>
                     <a href="" class="arrow-ico"></a>
                 </div>

             </div>
         </div>
     </div>

 </section>

 <section class="scheme-block cust-container">
     <div class="scheme-block-inner">
         <h4><contentElement name="leadership_scheme_title" type="input">Thought Leadership Scheme</contentElement></h4>
         <contentElement name="leadership_scheme_content" type="textarea">
         <p>Through this scheme, we connect businesses seeking advice on how to elevate their
             organisations, with thought leaders in the recruitment industry. </p></contentElement>
         <a href="javascript:void(0)" class="show-more arrow-grey-btn show_hide" data-content="toggle-text">
             LEARN MORE</span>
         </a>

         <div class="scheme-more-content">
             <contentElement name="scheme_more_content" type="textarea">
             <p>Over the years, Initi8 has built strong relationships with thought leaders in
                 the recruitment
                 industry. These are individuals with a wealth of experience, who have been there, done that and have
                 shaken things up. They are industry innovators, who have built amazing businesses, unbelievable
                 engagement within their teams, have changed consumer habits and have helped to sculpt the world we
                 live in today. </p>

             <p>Through our Thought Leadership Scheme, we can connect businesses seeking advice
                 on how to take their
                 organisation to the next level, with these trailblazing individuals. </p>

             <p>Initi8 does not charge for this service. Our job is simply to put you in touch
                 with these leaders in
                 order to help your business flourish. Your thought leader will discuss their financial conditions
                 for their advice with you, and any financial relationship will be between you and your thought
                 leader.</p>

             <p>If your business requires a spark, a sounding board or independent advice, get
                 in touch with us.</p></contentElement>

             <a href="javascript:void(0)" class="show-less arrow-grey-btn show_hide" data-content="toggle-text">
                 READ Less
             </a>
         </div>
     </div>
 </section>

 <section class="toolkit-block cust-container">
     <h4><contentElement name="client_toolkit_title" type="input">Client Toolkit</contentElement></h4>
     <contentElement name="client_toolkit_content" type="textarea">
         <p class="para-heading">Read through our resources to help with recruitment </p>
         </contentElement>
     <div class="toolkit-row">
         <div class="toolkit-cell">
             <div class="toolkit-cell-inner">
                 <contentElement name="recuritment_title" type="textarea">
                 <p>Six Top Tips For The Recruitment Process</p>
                 </contentElement>


                 <a href="<?= _SITEDIR_; ?>public/documents/initi8-Six-Top-Tips-For-the-Recruitment-Process.pdf" target="_blank" class="outline-grey-btn download-pdf-btn">
                     <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                 </a>
             </div>
         </div>

         <div class="toolkit-cell">
             <div class="toolkit-cell-inner">
                 <contentElement name="interview_question_title" type="textarea">
                 <p>Preparing Effective Interview Questions</p>
                 </contentElement>

                 <a href="<?= _SITEDIR_; ?>public/documents/initi8-Preparing-Effective-Interview-Questions.pdf" class="outline-grey-btn download-pdf-btn" target="_blank">
                     <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                 </a>
             </div>
         </div>

         <div class="toolkit-cell">
             <div class="toolkit-cell-inner">
                 <contentElement name="interviewer_bias_title" type="textarea">
                 <p>The Ten Forms Of Interviewer Bias</p>
                 </contentElement>

                 <a href="<?= _SITEDIR_; ?>public/documents/initi8-The-Ten-Forms-of-Interviewer-Bias.pdf" class="outline-grey-btn download-pdf-btn" target="_blank">
                     <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                 </a>
             </div>
         </div>

         <div class="toolkit-cell">
             <div class="toolkit-cell-inner">
                 <contentElement name="avoid_interviewer_title" type="textarea">
                 <p>Initi8’s 8 Ways To Avoid Interviewer Bias</p>
                 </contentElement>

                 <a href="<?= _SITEDIR_; ?>public/documents/inti8-Initi8’s-Eight-Ways-to-Avoid-Interviewer-Bias.pdf" class="outline-grey-btn download-pdf-btn" target="_blank">
                     <span><cite>DOWNLOAD PDF</cite> <i class="arrow-right"></i></span>
                 </a>
             </div>
         </div>
     </div>
 </section>