<?php if (!Request::isAjax()) { ?>
<!--

/*
  ____        _     _    ____ __  __ ____
 | __ )  ___ | | __| |  / ___|  \/  / ___|
 |  _ \ / _ \| |/ _` | | |   | |\/| \___ \
 | |_) | (_) | | (_| | | |___| |  | |___) |
 |____/ \___/|_|\__,_|  \____|_|  |_|____/   .v3 2020

 Copyright Bold Identities Ltd - All Rights Reserved

 Author: Bold Identities Ltd

*/

-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= Request::getTitle(); ?> BoldCMS 3</title>

<!--    <link rel="shortcut icon" href="--><?php //echo _SITEDIR_; ?><!--public/images/favicon.png">-->
<!--    <link rel="manifest" href="/manifest.json">-->

    <meta name="theme-color" content="#2f2f2f">
    <meta name="apple-mobile-web-app-title" content="Amsource">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#2f2f2f">

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

    <script>var site_url = '<?= SITE_URL; ?>';</script>
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

    <script type="text/javascript">
        $(document).ready(function () {
            // Tooltipster
            $(document).ready(function () {
                $('.tooltip').tooltipster({
                    animation: 'grow',
                    delay: 100,
                    theme: 'tooltipster-borderless',
                    trigger: 'hover',
                    timer: 1000
                });
            });

            // Remove confirmation
            $('.fa-trash, .fa-trash-restore-alt').confirm({
                buttons: {
                    tryAgain: {
                        text: 'Yes, delete',
                        btnClass: 'btn-red',
                        action: function () {
                            console.log('Clicked tooltip');
                            location.href = this.$target.attr('href');
                        }
                    },
                    cancel: function () {
                    }
                },
                icon: 'fas fa-exclamation-triangle',
                title: 'Are you sure?',
                content: 'Are you sure you wish to delete this item? Please re-confirm this action.',
                type: 'red',
                typeAnimated: true,
                boxWidth: '30%',
                useBootstrap: false,
                theme: 'modern',
                animation: 'scale',
                backgroundDismissAnimation: 'shake',
                draggable: false
            });

            // Hide messages
            $('.success').delay(10000).fadeOut('fast');
            $('.error').delay(10000).fadeOut('fast');

            //
            var inputs = document.querySelectorAll('.inputfile');
            Array.prototype.forEach.call(inputs, function (input) {
                var label = input.nextElementSibling, labelVal;
                if (label) labelVal = label.innerHTML;

                input.addEventListener('change', function (e) {
                    var fileName = '';
                    if (this.files && this.files.length > 1)
                        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                    else
                        fileName = e.target.value.split('\\').pop();

                    if (fileName)
                        label.querySelector('span').innerHTML = fileName;
                    else
                        label.innerHTML = labelVal;
                });
            });

            //
            $("#left-column-nav .nav>ul>li .sub-drop-items li").each(function () {
                if ($(this).hasClass("active")) {
                    $(this).parents("li.subheader").addClass("active")
                }
            });

            // Menu 2nd level positions
            $("#left-column-nav .nav > ul > li.subheader").hover(function () {
                    var currlihe = $(this).height() / 2;
                    var currlipo = $(this).position().top;
                    var arrowpos = currlipo + currlihe - 160;

                    var currsublihe = 'translateY(-' + $(this).find(".sub-drop-items ul").height() / 2 + 'px)';
                    $(this).find(".sub-drop-items ul").css("margin-top", arrowpos);
                    $(this).find(".sub-drop-items ul").css("transform", currsublihe);
                },
                function () {
                    $("#left-column-nav .nav > ul > li.subheader .sub-drop-items ul").css("margin-top", 0);
                })
        });
    </script>
</head>
<body>

<div id="site">
    <?php echo View::get('panel/index', 'left'); // !!! LEFT-MENU !!! ?>

    <div id="content" class="content arrive">
<?php } ?>

    <?php echo $this->Load('contentPart'); // Content wrapper ?>

<?php if (!Request::isAjax()) { ?>
    </div>

    <div class="footer-strip text-right">
        <ul><li class="nos">© 2019 Bold Identities Ltd, registered in England & Wales (<a href="tel:09777426">09777426</a>)</li><li>Privacy & GDPR</li></ul>
    </div>

    <div>
        <div class="popup-fon" onclick="closePopup();"></div>
        <div id="popup" class="popup"></div>
    </div>
    <div id="notice"></div>
</div>

</body>
</html>
<?php } ?>