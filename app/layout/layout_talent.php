<?php if (!Request::isAjax()) { ?>
    <!--

    /*
      ____        _     _    ____ __  __ ____
     | __ )  ___ | | __| |  / ___|  \/  / ___|
     |  _ \ / _ \| |/ _` | | |   | |\/| \___ \
     | |_) | (_) | | (_| | | |___| |  | |___) |
     |____/ \___/|_|\__,_|  \____|_|  |_|____/   .v4 2020

     Copyright Bold Identities Ltd - All Rights Reserved

     Author: Bold Identities Ltd

    */

    -->
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?= Request::getTitle(); ?></title>

    <link rel="icon" type="image/x-icon" href="<?= _SITEDIR_; ?>assets/img/favicon.png"/>

    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/bootstrap.min.css">
    <link href="<?= _SITEDIR_; ?>public/css/slick.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/slick-theme.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/selectize.default.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/aos.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/locomotive-scroll.min.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/style.css" type="text/css" rel="stylesheet"/>
    <link href="<?= _SITEDIR_; ?>public/css/additional_styles.css" type="text/css" rel="stylesheet" />
    <link href="<?= _SITEDIR_; ?>public/css/talent/style.css" rel="stylesheet" type="text/css" />


    <script>var site_url = '<?= SITE_URL; ?>';</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/function.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/event.js"></script>
    <!--<script src="<?= _SITEDIR_; ?>assets/js/libs/jquery-3.1.1.min.js"></script>-->

    <script src="<?= _SITEDIR_; ?>public/js/bootstrap.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/menu-accordion.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/slick.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/selectize.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/aos.js"></script>



    <script src="<?= _SITEDIR_; ?>public/js/typed.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/jquery.waypoints.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/jquery.countup.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/locomotive-scroll.min.js"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>-->


    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php /*
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/backend/main.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/backend/jquery-ui.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/additional_styles.css" type="text/css" />
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/backend/all.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/data-tables/jquery.datatables.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/backend/jquery_scroll.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/tooltipster-master/dist/css/tooltipster.bundle.min.css"/>
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/plugins/tooltipster-master/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-borderless.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="<?= _SITEDIR_; ?>public/css/jquery.Jcrop.css" type="text/css" />

    <link rel="shortcut icon" href="<?= _SITEDIR_; ?>public/images/backend/dashboard-icons/manage-microsites.png" type="image/png"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"></script>
    <script src="<?= _SITEDIR_; ?>public/js/jquery-ui.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/jquery.scrollbar.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/function.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/event.js"></script>
    <script src="<?= _SITEDIR_; ?>public/js/backend/jquery.Jcrop.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/af-2.3.0/b-1.5.2/b-colvis-1.5.2/b-flash-1.5.2/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/rg-1.0.3/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
    <script src="<?= _SITEDIR_; ?>public/plugins/tooltipster-master/dist/js/tooltipster.bundle.min.js"></script>

    <!-- Datepicker -->
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    */ ?>
</head>
<body>

    <div id="site" class="home" data-scroll-container><!-- class ??? -->

        <div id="content" class="content">

    <?php //echo View::get('panel/talents/index', 'left'); // !!! LEFT-MENU !!! ?>
<?php } ?>

    <?php echo $this->Load('contentPart'); // Content wrapper ?>

<?php if (!Request::isAjax()) { ?>

        </div>
        <?php if (CONTROLLER == 'page' && ACTION == 'index') { ?>

        <?php } else { ?>
            <footer>
                <div class="footer-block">
            <span class="pattern_10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 220.747 277.725">
                  <path id="pattern_10" data-name="pattern_10"
                        d="M1632.557,712.666a60.693,60.693,0,0,1,52.387-60.045,9.378,9.378,0,0,0,8.212-9.246V598.006a9.464,9.464,0,0,0-10.212-9.442,124.521,124.521,0,0,0,0,248.2,9.463,9.463,0,0,0,10.212-9.441v-45.37a9.378,9.378,0,0,0-8.212-9.246A60.692,60.692,0,0,1,1632.557,712.666Z"
                        transform="matrix(0.899, 0.438, -0.438, 0.899, -1043.056, -1216.616)"/>
                </svg>
            </span>
                    <span class="pattern_11">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 169.549 169.667">
                  <path id="pattern_11" data-name="pattern_11"
                        d="M946.219,795.121v-76.24a24.553,24.553,0,0,1,24.553-24.553h76.164a6.447,6.447,0,0,0,6.448-6.447V638.348a6.448,6.448,0,0,0-6.448-6.448H954.524a70.691,70.691,0,0,0-70.69,70.691v92.53a6.447,6.447,0,0,0,6.447,6.447h49.49A6.447,6.447,0,0,0,946.219,795.121Z"
                        transform="translate(-883.834 -631.9)"/>
                </svg>
            </span>
                    <span class="pattern_12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 262.778 262.772">
                  <path id="pattern_12" data-name="pattern_12"
                        d="M1591.709,481.471V422.336a16.532,16.532,0,0,0-16.532-16.533h-59.135a16.532,16.532,0,0,1-16.533-16.532V343.965a16.533,16.533,0,0,1,16.533-16.533h59.135a16.532,16.532,0,0,0,16.532-16.533V251.764a16.533,16.533,0,0,1,16.533-16.532h45.306a16.533,16.533,0,0,1,16.533,16.532V310.9a16.533,16.533,0,0,0,16.533,16.533h59.14a16.533,16.533,0,0,1,16.533,16.533v45.306a16.532,16.532,0,0,1-16.533,16.532h-59.14a16.533,16.533,0,0,0-16.533,16.533v59.135A16.533,16.533,0,0,1,1653.548,498h-45.306A16.533,16.533,0,0,1,1591.709,481.471Z"
                        transform="translate(-1499.509 -235.232)"/>
                </svg>
            </span>
                    <div class="fixed">
                        <div class="footer-email"><a href="mailto:info@thryvetalent.com">info@thryvetalent.com</a></div>
                        <div class="footer-section">
                            <h3>What are you up to right now? We’ll go first.</h3>
                            <a class="btn" href="{URL:contact-us}">Tell me more</a>
                        </div>
                        <div class="footer-section">
                            <h3>Basic boring business stuff.</h3>
                            <a class="btn" href="{URL:the-boring-bits}">Let’s go</a>
                        </div>
                        <div class="social-block">
                            <a href="https://www.facebook.com/thryvetalent" target="_blank"><span class="icon-facebook-official"></span></a>
                            <a href="https://www.instagram.com/thryvetalent/" target="_blank"><span class="icon-instagram"></span></a>
                            <a href="https://www.linkedin.com/company/thryvetalent" target="_blank"><span class="icon-linkedin-square"></span></a>
                            <a href="https://twitter.com/thryvetalent" target="_blank"><span class="icon-twitter"></span></a>
                        </div>
                    </div>
                </div>
            </footer>
        <?php } ?>


        <?php if (Request::getParam('tracker')->value == 'yes') { ?>
            <!-- Bug Tracker -->
            <div id="api_content"></div>

            <div class="scan__block">
                <a class="report__button"
                   onclick="load('issue_manager/create_task', 'project=<?= Request::getParam('tracker_api')->value ?>', 'url=' + window.location.href);">Report<br>an
                    issue</a>
                <?php /*<a class="report__button" onclick="load('https://donemen.com/api/create_task', 'project=<?= CONF_PROJECT ?>', 'url=' + window.location.href);">Report<br>an issue</a>*/ ?>
            </div>
            <!-- /Bug Tracker -->
        <?php } ?>
    </div>

    <?php echo reFilter(Request::getParam('include_code_bottom')->value); // Bottom JS code ?>
    <div>
        <div class="popup-fon" onclick="closePopup()"></div>
        <div id="popup" class="popup"></div>
    </div>
    <div id="notice"></div>

    <script src="<?= _SITEDIR_; ?>public/js/main.js"></script>

</body>
</html>
<?php } ?>

