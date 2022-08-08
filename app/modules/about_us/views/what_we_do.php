<section class="inner-banner">
        <div class="cust-container">
            <h2>What We Do</h2>
        </div>
    </section>


    <section class="feature-block feature-block-bnner">
        <div class="cust-container">
            <div class="feature-left">
                 <div class="feature-left-inner">
                     <contentElement name="banner_content" type="textarea">
                    <p>We are experts in recruiting for a range of technical roles. We cover all aspects of IT recruitment,
                        from niche specialist roles right up to CIO or CTO. </p>
                        </contentElement>
                    <!-- <a href="#" class="outline-grey-btn">
                        <span><cite>Learn More</cite> <i class="arrow-right"></i></span>
                    </a> -->
                </div>
            </div>

            <div class="feature-img">
                <div class="img-box">
                    <img src="<?= getImageElement('banner_image', _SITEDIR_ . 'public/images/feature-4.png'); ?>" alt='<contentElement name="banner_image_alt" type="input">feature-4</contentElement>'>
                </div>
            </div>
        </div>
    </section>

    <section class="method-block">
        <div class="cust-container">
            <h4><contentElement name="initi8_method_title" type="input">The Initi8 Method</contentElement></h4>
            <contentElement name="initi8_method_content" type="textarea">
            <p>Over the years we’ve mastered the art of recruitment and this has culminated in the Initi8 Method.</p>
            </contentElement>
            <div class="method-items-row">
                <div class="method-items-cell">
                    <div class="method-items-inner">
                        <span>
                            <h4>1.</h4> <img src="<?= getImageElement('initi8_image', _SITEDIR_ . 'public/images/clients-ico.svg'); ?>" alt='<contentElement name="initi8_image_alt" type="input">client-ico</contentElement>'>
                        </span>
                        <contentElement name="initi8_content" type="textarea">
                        <p>Spending time with clients to understand requirements</p>
                        </contentElement>
                    </div>
                </div>

                <div class="method-items-cell">
                    <div class="method-items-inner">
                        <span>
                            <h4>2.</h4> <img src="<?= getImageElement('machine_learning_image', _SITEDIR_ . 'public/images/machine-learning-ico.svg'); ?>" alt='<contentElement name="machine_image_alt" type="input">machine_leaning</contentElement>'>
                        </span>
                        <contentElement name="machine_learning_content" type="textarea">
                        <p>Source a diverse talent pool using AI machine learning and our network</p>
                         </contentElement>
                    </div>
                </div>

                <div class="method-items-cell">
                    <div class="method-items-inner">
                        <span>
                            <h4>3.</h4> <img src="<?= getImageElement('video_icon_image', _SITEDIR_ . 'public/images/video-ico.svg'); ?>" alt='<contentElement name="video_icon_image_alt" type="input">video_icon</contentElement>'>
                        </span>
                        <contentElement name="video_icon_content" type="textarea">
                        <p>Video interview and technical testing to shortlist candidates</p>
                         </contentElement>
                    </div>
                </div>

                <div class="method-items-cell">
                    <div class="method-items-inner">
                        <span>
                            <h4>4.</h4> <img src="<?= getImageElement('hub_icon_image', _SITEDIR_ . 'public/images/hub-ico.svg'); ?>" alt='<contentElement name="hub_ico_image_alt" type="input">hub_ico</contentElement>'>
                        </span>
                        <contentElement name="hub_icon_content" type="textarea">
                        <p>Delivering shortlist to clients via our Engagement Hub</p>
                        </contentElement>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="accordian-block">
        <div class="cust-container">
            <h4><contentElement name="area_cover_title" type="input">The Areas We Cover Include </contentElement></h4>
            <div class="wrap-accordian-block">
                <div class="accordion" id="faq">
                    <div class="card">
                        <div class="card-header" id="faqhead1">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq1"
                                aria-expanded="true" aria-controls="faq1">
                                <img src="<?= getImageElement('acrchitecture_image', _SITEDIR_ . 'public/images/architecture-ico.svg'); ?>" alt='<contentElement name="architecture_image_alt" type="input">architecture-ico</contentElement>'>
                                <h5><contentElement name="whatwedo_title" type="input">Architecture</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq1" class="collapse" aria-labelledby="faqhead1" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="architecture_content" type="textarea">
                                    <li><a href="{URL:jobs}">Enterprise Architect</a></li>
                                    <li><a href="{URL:jobs}">Solutions Architect</a> </li>
                                    <li><a href="{URL:jobs}">Technical architect</a> </li>
                                    <li><a href="{URL:jobs}">Data Architect</a> </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="faqhead2">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                                aria-expanded="true" aria-controls="faq2">
                                <img src="<?= getImageElement('frontend-ico_image', _SITEDIR_ . 'public/images/frontend-ico.svg'); ?>" alt='<contentElement name="frontend-ico_image_alt" type="input">frontend-ico</contentElement>'>
                                <h5><contentElement name="frontend_title" type="input">Front End Development</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list"><contentElement name="frontend_content" type="textarea">
                                    <li><a href="{URL:jobs}">HTML5 
                                    </li>
                                    <li><a href="{URL:jobs}">CSS3 </a></li>
                                    <li><a href="{URL:jobs}">JavaScript</a>  </li>
                                    <li><a href="{URL:jobs}">NodeJS</a>  </li>
                                    <li><a href="{URL:jobs}">ReactJS</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Jquery </a>
                                    </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="faqhead3">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                                aria-expanded="true" aria-controls="faq3">
                                <img src="<?= getImageElement('fullstack-ico_image', _SITEDIR_ . 'public/images/fullstack-ico.svg'); ?>" alt='<contentElement name="fullstack-ico_image_alt" type="input">fullstack-ico</contentElement>'>
                                <h5><contentElement name="fullstack_title" type="input">Full Stack Engineer</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="fullstack_content" type="textarea">
                                    <li><a href="{URL:jobs}">Mobile Development (android & iOS)</a>
                                    </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqhead4">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq4"
                                aria-expanded="true" aria-controls="faq4">
                                <img src="<?= getImageElement('backend-ico_image', _SITEDIR_ . 'public/images/backend-ico.svg'); ?>" alt='<contentElement name="backend-ico_image_alt" type="input">backend-ico</contentElement>'>
                                <h5><contentElement name="back_end_title" type="input">Back End Development</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="back_end_content" type="textarea">
                                    <li><a href="{URL:jobs}">Java </a></li>
                                    <li><a href="{URL:jobs}">Python</a></li>
                                    <li><a href="{URL:jobs}">Rust </a></li>
                                    <li><a href="{URL:jobs}">Principle Engineers</a></li>
                                    <li><a href="{URL:jobs}">Team Leaders </a></li>
                                    <li><a href="{URL:jobs}">Golang</a>
                                    </li>
                                    <li><a href="{URL:jobs}">.Net</a></li>
                                    <li><a href="{URL:jobs}">CRM</a></li>
                                    <li><a href="{URL:jobs}">ERP</a></li>
                                    <li><a href="{URL:jobs}">Ruby on Rails</a> 
                                    </li>
                                    <li><a href="#">Developer in test</a>
                                    </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqhead5">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq5"
                                aria-expanded="true" aria-controls="faq5">
                                <img src="<?= getImageElement('devops-ico_image', _SITEDIR_ . 'public/images/devops-ico.svg'); ?>" alt='<contentElement name="devops-ico_image_alt" type="input">devops-ico</contentElement>'>
                                <h5><contentElement name="dev_ops_title" type="input">Dev Ops & Deployment</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq5" class="collapse" aria-labelledby="faqhead5" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="dev_ops_content" type="textarea">
                                    <li><a href="{URL:jobs}">Infrastructure</a> 
                                    </li>
                                    <li><a href="{URL:jobs}">Cloud </a>
                                    </li>
                                    <li><a href="{URL:jobs}">Azure </a>
                                    </li>
                                    <li><a href="{URL:jobs}">GCP</a> </li>
                                    <li><a href="{URL:jobs}">AWS</a></li>
                                    <li><a href="{URL:jobs}">Testing manual / automation</a>
                                    </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqhead6">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq6"
                                aria-expanded="true" aria-controls="faq6">
                                <img src="<?= getImageElement('data-ico_image', _SITEDIR_ . 'public/images/data-ico.svg'); ?>" alt='<contentElement name="data-ico_image_alt" type="input">data-ico</contentElement>'>
                                <h5><contentElement name="data_engg_title" type="input">Data Engineering</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq6" class="collapse" aria-labelledby="faqhead6" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="data_engg_content" type="textarea">
                                    <li><a href="{URL:jobs}">Data science</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Machine Learning</a>
                                    </li>
                                    <li><a href="{URL:jobs}">NLP</a>
                                    </li>
                     
                                    <li><a href="{URL:jobs}">No Code</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Artificial Intelligence</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Hadoop</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Oracle</a></li>
                                    <li><a href="{URL:jobs}">SQL </a></li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqhead7">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq7"
                                aria-expanded="true" aria-controls="faq7">
                                <img src="<?= getImageElement('delivery_image', _SITEDIR_ . 'public/images/delevry-ico.png'); ?>" alt='<contentElement name="delivery_image_alt" type="input">delivery_image</contentElement>'
>
                                <h5><contentElement name="delivery_title" type="input">Delivery</contentElement></h5>
                            </a>
                        </div>

                        <div id="faq7" class="collapse" aria-labelledby="faqhead7" data-parent="#faq">
                            <div class="card-body">
                                <ul class="cust-list">
                                    <contentElement name="delivery_content" type="textarea">
                                    <li><a href="{URL:jobs}">Agile Coach</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Delivery Manager</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Product Manager</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Product Owner </a>
                                    </li>
                                    <li><a href="{URL:jobs}">Scrum Master</a> 
                                    </li>
                                    <li><a href="{URL:jobs}">Project Manager </a>
                                    </li>
                                    <li><a href="{URL:jobs}">Development Manager</a> 
                                    </li>
                                    <li><a href="{URL:jobs}">Software Development Manager</a>
                                    </li>
                                    <li><a href="{URL:jobs}">Business Analyst </a>
                                    </li>
                                    </contentElement>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <contentElement name="bottom_section_content" type="textarea">
            <p>
                <cite>We use the latest recruitment technology to make the process as efficient as possible for our
                    candidates and clients.</cite>
                <cite> Our video interviewing platform has reduced the time to hire by over 60%, and our AI tools
                    pinpoint the most capable candidates,</cite>
                <cite>track their careers and support them in achieving their ambitions.</cite> <cite>Whatever your IT
                    need - we have it covered.</cite>
            </p>
            </contentElement>
        </div>
    </section>

    <section class="find-block">
        <div class="cust-container">
            <div class="find-row row">
                <div class="find-cell col-sm-6">
                    <div class="find-inner-cell">
                        <div class="img-color-box client-img-box">
                            <a href="{URL:clients}"><img src="<?= _SITEDIR_; ?>public/images/animation-2.gif" class="animateda bouncea" alt="" srcset=""></a>
                          
                        </div>
                        <h5>I am a client</h5>
                        <a href="{URL:talent-vault}" class="arrow-grey-btn">
                            <span><cite>find me a CANDIDATE</cite> <i class="arrow-right"></i></span>
                        </a>
                    </div>

                </div>

                <div class="find-cell col-sm-6">
                    <div class="find-inner-cell">
                        <div class="img-color-box candidate-img-box">
                            <a href="{URL:candidate}"> <img src="<?= _SITEDIR_; ?>public/images/animation-1.gif" class="animated bounce" alt="" srcset=""> </a>
                        </div>

                        <h5>I am a candidate</h5>
                        <a href="{URL:jobs}" class="arrow-grey-btn">
                            <span><cite>FIND ME A JOB</cite> <i class="arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
