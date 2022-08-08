<?php if (!Request::isAjax()) { 
   $sitemapuri =  _URI_;
   if($sitemapuri != '/sitemap.xml') {
      $page_url= _URI_ ;
      $page_array= explode('/',$page_url);
      ?>  
      <!DOCTYPE html>
      <html lang="en">
      <head>   
         <!--importants---->
         <?php echo reFilter(Request::getParam('include_code_top')->value); // Top JS code ?>

         <meta http-equiv="content-type" content="text/html; charset=utf-8" />
         <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
         <title><?= Request::getTitle(); ?> | genesis</title>

         <?php if (Request::getKeywords()) { ?>
            <meta content="<?= Request::getKeywords(); ?>" name="keywords">
         <?php } ?>
         <?php if (Request::getDescription()) { ?>
            <meta content="<?= Request::getDescription(); ?>" name="description">
         <?php } ?>


         <meta property="og:title" content="<?= Request::getTitle(); ?>">
         <meta property="og:url" content="<?= SITE_URL . _URI_; ?>">
         <meta property="og:type" content="website">

         <meta property="og:site_name" content="<?= SITE_NAME; ?>">
         <meta property="og:og:description" content="<?= Request::getDescription(); ?>">
         <?php $ogurl = _URI_;
         $blogog = explode('/',$ogurl);
         $ogcheck = $blogog[1];
         $ogcheck1 = $ogcheck.'/'.$blogog[1];
         if($ogcheck == 'job') {
           ?>
           <meta property="og:image" content="<?= SITE_URL; ?>app/public/images/og-job.png">
        <?php } elseif($ogcheck == 'blog') {?>
           <meta property="og:image" content="<?= SITE_URL; ?>app/public/images/og-blog.png">
        <?php } else { ?>
           <meta property="og:image" content="<?= SITE_URL; ?>app/public/images/og-home.png">
        <?php } ?>



        <meta name="theme-color" content="#2f2f2f">
        <meta name="apple-mobile-web-app-title" content="Westlakes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#2f2f2f">   
        <!---end importants-->
        <!--  <title>cititec</title>      -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?= SITE_URL; ?>app/public/images/favicon.ico" type="image/gif" sizes="16x16">
        <link rel="icon" href="<?= SITE_URL; ?>app/public/images/favicon.ico" type="image/gif" sizes="32x32">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/animate.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/owl.theme.default.min.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/reset.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/variable.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/elements.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/style.css">
        <link rel="stylesheet" href="<?= SITE_URL; ?>app/public/css/responsive.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  
        <script>var site_url = '<?= SITE_URL; ?>';</script>
        <script src="<?= _SITEDIR_; ?>public/js/backend/function.js"></script>
        <script src="<?= _SITEDIR_; ?>public/js/backend/event.js"></script>
        <script src="<?= SITE_URL; ?>app/public/js/owl.carousel.min.js"></script>
     </head>
     <body>     
  <header class="page__header">
        <div class="cust-container-lg">
            <a href="{URL:/}" class="header-logo">
                <img src="<?= SITE_URL; ?>app/public/images/logo.png" alt="genesis">
            </a>

            <ul class="header-nav">
                <li><a href="{URL:what-we-do}">What We Do</a></li>
                <li><a href="{URL:who-we-are}">Who We Are</a></li>
                <li><a href="{URL:clients}">For Clients</a></li>
                <li><a href="{URL:candidate}">For Candidates</a></li>
                <li><a href="{URL:blogs}">Blog</a></li>
            </ul>
        </div>
    </header>
     <!-- mobile-menu starts -->

    <div class="toggle-btn" id="toggle-btn">
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
    </div>

    <div class="fullview-menu" id="fullview-menu">
        <div class="fullview-inner">
            <a href="{URL:/}" class="logo">
                <img src="<?= SITE_URL; ?>app/public/images/logo-yellow.svg" alt="">
            </a>

            <nav class="fullview-nav">
                <div class="fullview-nav-inner">
                    <ul class="page__menu">
                        <li><a href="{URL:what-we-do}">What We Do</a></li>
                        <li><a href="{URL:who-we-are}">Who We Are</a></li>
                        <li><a href="{URL:clients}">For Clients</a></li>
                        <li><a href="{URL:candidate}">For Candidates</a></li>
                        <li><a href="{URL:blogs}">Blog</a></li>
                    </ul>
                    <ul class="social-ico">
                        <li class="linkedin-ico"><a href="https://www.linkedin.com/company/genesis-recruitment" target="_blank"></a></li>
                         <li class="twitter-ico"><a href="https://twitter.com/genesisRecruit" target="_blank"></a></li>
                         <li class="facebook-ico"><a href="https://www.facebook.com/genesisRecruitment/"  target="_blank"></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- mobile-menu ends-->
<div id="content" class="content arrive">
<?php } } ?>
<?php echo $this->Load('contentPart');?>   
<?php if(!Request::isAjax()) { ?>

   <?php if($sitemapuri != '/sitemap.xml') { 
      ?>
      <?php// if($page_array[1]=='talentdetails'){?>
<div id="popup" class="popup"></div>
 <?php/// }?>
   </div>   
   <!----modal---->  
   <div class="modal popup1" id="jobpostModal">  
      <div class="modal-dialog">
         <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title sub-heading">Post A Job</h4>  
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <!--<form id="job_post_form" class="popup-form">-->
               <!--   <div class="modal-body">-->
                  <!--      <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name*" onKeyPress="return nameonly(event)">-->
                     <!--      </div>-->
                     <!--      <div class="form-group"> <input class="form-control" type="text" name="email" placeholder="Email*" onKeyPress="return emailonly(event)">-->

                        <!--      </div>-->
                        <!--      <div class="form-group"> <input class="form-control" type="text" name="tel" minlength="8" maxlength="12" placeholder="Phone*" onKeyPress="return contactonly(event)">-->
                           <!--      </div>-->
                           <!--      <div class="form-group">  -->
                              <!--         <label class="pf-label">Job Specification <span class="cv_file_name" style="color: #64C2C8;"></span></label>-->
                              <!--         <input class="pf-text-field" type="file" name="job_specification" style="border: none; padding: 0;"-->
                              <!--         accept=".doc, .docx, .txt, .pdf, .fotd" onchange="initFile(this); load('cv/upload/', 'field=#job_specification', 'preview=.cv_file_name');">-->
                              <!--         <input type="hidden" name="job_specification" id="job_specification" value="<?= post('job_specification', false); ?>">-->
                              <!--      </div>-->

                              <!--      <div class="form-group">  <textarea class="form-control" type="message" name="message" placeholder="Message*"></textarea>-->
                                 <!--      </div>    -->

                                 <!--      <div class="form-group">  <button class="cmn-btn" type="submit" onclick="load('jobs/post_job/<?= $this->job->slug; ?>', 'form:#job_post_form'); return false;">POST NOW</button>   -->
                                    <!--      </div>  -->
                                    <!--   </div>-->
                                    <!--</form>             -->
                                 </div>
                              </div>
                           </div>       
                           <!---end modal-->      
<footer class="page__footer">
        <div class="cust-container-lg">

            <div class="page-footer-row row">
                <div class="page__footer-cell">
                    <a href="{URL:/}" class="footer-logo">
                        <img src="<?= SITE_URL; ?>app/public/images/logo-yellow.svg" alt="" srcset="">
                    </a>

                    <ul class="social-ico">
                        <li class="linkedin-ico"><a href="https://www.linkedin.com/company/genesis-recruitment" target="_blank"></a></li>
                         <li class="twitter-ico"><a href="https://twitter.com/genesisRecruit" target="_blank"></a></li>
                         <li class="facebook-ico"><a href="https://www.facebook.com/genesisRecruitment/"  target="_blank"></a></li>
                    </ul>
                </div>

                <div class="page__footer-cell">
                    <h2>Contact</h2>
                    <div class="footer-text-cell">
                        <span>30 Stamford Street </span>
                        <span>London SE1 9LQ</span>
                    </div>

                    <div class="footer-text-cell">
                        <span>UK Phone: <a href="tel:+442070928190">+44 (0)20 7092 8190</a></span>
                        <span>USA Phone: <a href="tel:+16465064834">+1 646 506 4834</a> </span>
                        <span>Email: <a
                                href="mailto:info&#64;genesisrecruitment.com">info&#64;genesisrecruitment.com</a></span>
                    </div>
                </div>


                <div class="page__footer-cell">
                    <h2>Company</h2>
                    <ul>
                        <li><a href="{URL:what-we-do}">What We Do</a></li>
                        <li><a href="{URL:who-we-are}">Who We Are</a></li>
                        <li><a href="{URL:clients}">For Clients</a></li>
                        <li><a href="{URL:candidate}">For Candidates</a></li>
                        <li><a href="{URL:blogs}">Blog</a></li>
                    </ul>
                </div>

                <div class="page__footer-cell">
                    <h2>Legal</h2>
                    <ul> <?php if($page_array[1]=='permanent'){?>
                        <li><a href="javascript:void(0)">Permanent Terms</a></li> 
                        <?php } ?>
                        <li><a href="{URL:privacy-policy}">Privacy Policy</a></li>
                        <li><a href="{URL:statement}">Equality & Diversity Statement</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>  
   <!-- <script src="<?= SITE_URL; ?>app/public/js/jquery-3.5.1.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="<?= SITE_URL; ?>app/public/js/wow.js"></script>
    <script src="<?= SITE_URL; ?>app/public/js/custom.js"></script>
    <script>
          $('#home-testi').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 0,
            items: 1,
            nav: false,
            dots: false,
            touchDrag:true,
            mouseDrag:true,
            smartSpeed: 10000,
            dragEndSpeed: 1000,
            singleItem: true,
            autoHeight: true,
            autoplayTimeout: 5000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            responsive: {
                320: {
                    items: 1,
                    autoplay: true,
                    nav: false,
                    dots: false,
                    margin: 0
                },

                400: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },

                480: {
                    items: 1,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    loop: true,
                    margin: 0
                },
                601: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },
                767: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },
                992: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },
                1280: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },
                1440: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                },
                1920: {
                items: 1,
                nav: false,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
                }
            }
        });
  
    </script>
    <script>
    // $(document).ready(function(){
    
    //   $(".close-popup").click(function(){
             
    //     $("body").removeClass("popup-open");
    //   });
    // });
    $(document).on("click",".close-popup",function(e){
        $("body").removeClass("popup-open");
    });
</script>
    <div class="shadow-box"></div>
</body>

</html>            
               


             <script type="text/javascript">
               function nameonly(e){
                 var unicode=e.charCode? e.charCode : e.keyCode
                 if (unicode!=8 && unicode!=9 && unicode!=32)
                 {
                   if (unicode<65||unicode>90 && unicode<97||unicode>122)
                     return false
               }
            }
            function emailonly(e){
              var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=9 && unicode!=95)
              {
                if (unicode<45||unicode>57 && unicode<64||unicode>90 && unicode<97||unicode>122)
                  return false
            }
         }   
         function contactonly(e){    
            var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=8 && unicode!=9)
            {
               if (unicode<48||unicode>57)
                return false
          }
       }
       function passwordonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=9)
        {
         if (unicode<33||unicode>126)
          return false
    }
 }
</script>

<?php }}?>