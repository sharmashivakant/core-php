<link href="<?= _SITEDIR_; ?>public/css/microsites.css" type="text/css" rel="stylesheet" />
<style type="text/css">
    <?php if ($this->microsite->header_image) { ?>
        .open-header-sec {
            background: url("<?= _SITEDIR_ . 'data/microsite/'. $this->microsite->header_image; ?>") center top no-repeat !important;
            background-size: cover !important;
        }
    <?php } ?>

    <?php if ($this->microsite->opportunities_image) { ?>
        .company-sec.sub-page::before {
            background: url(<?= _SITEDIR_ . 'data/microsite/'. $this->microsite->opportunities_image; ?>) bottom center no-repeat;
            background-size: cover;
        }
    <?php } ?>

    a {
        color: #64C2C8;
    }
    .carousel-control-next, .carousel-control-prev {
        opacity: .5 !important;
    }
    .carousel-control-next:hover, .carousel-control-prev:hover {
        opacity: .9 !important;
    }
</style>

<div class="main-wrapper">
    <div class="header-sec open-header-sec">
        <div class="about-bottom ptop150">
            <div class="about-bottom-content">
                <div class="main-logo wow fadeInUp"
                     style="background: url(<?= _SITEDIR_ . 'data/microsite/'. $this->microsite->logo_image; ?>) center center no-repeat; background-size: cover;">
                </div>

                <h2 class="main-title maxwidth90 wow fadeInUp" data-wow-delay="1s" data-wow-duration="1s">
                    <?= $this->microsite->title; ?>
                </h2>
            </div>
        </div>
        <?php if (stristr($this->microsite->header_image, "mp4")) { ?>
            <video class="m-visible" id="bgvid" playsinline autoplay muted loop>
                <source src="<?= _SITEDIR_ . 'data/microsite/' . $this->microsite->header_image; ?>" type="video/mp4">
            </video>
        <?php } ?>
    </div>

    <!-- KEY INFORMATION -->
    <div class="employer-sec-page">
        <div class="container">
            <div class="employer-cont">
                <ul>
                    <li>
                        <div class="img-sec" style="height:450px; background: url(
                        <?= $this->microsite->key_image
                            ? _SITEDIR_ . 'data/microsite/' . $this->microsite->key_image
                            : (isset($photosURLs) ? _SITEDIR_ . 'data/microsite/' . $photosURLs[array_rand($photosURLs)] : _SITEDIR_ . 'images/key-bg.png'); ?>) center center no-repeat; background-size: cover; border-top-left-radius: 10px;">
                        </div>
                    </li>
                    <li>
                        <div class="img-cont">
                            <h1 title="keyinfo" style="margin-bottom: 20px;">Key
                                <span>[Information]</span><br></h1>
                            <ul>
                                <li>
                                    <span>Website</span>
                                    <span>
                                        <a href="<?= $this->microsite->website; ?>" target="_blank">
                                            <?= str_replace(array("https://", "http://"), "", $this->microsite->website); ?>
                                        </a>
                                    </span>
                                </li>

                                <li>
                                    <span>Company Size</span><span><?= number_format($this->microsite->company_size, 0); ?></span>
                                </li>

                                <li>
                                    <span>Headquarters</span>
                                    <span>
                                        <a id="overview">
                                            <?= implode(
                                                ", ",
                                                array_map(function ($obj) {
                                                    return $obj->location_name;
                                                }, $this->microsite->locations)
                                            ); ?>
                                        </a>
                                    </span>
                                </li>

                                <li>
                                    <span>Industry</span>
                                    <span>
                                        <?= implode(
                                            ", ",
                                            array_map(function ($obj) {
                                                return $obj->sector_name;
                                            }, $this->microsite->sectors)
                                        ); ?>
                                    </span>
                                </li>

                                <li>
                                    <span>Sectors</span>
                                    <span>
                                        <?= implode(
                                            ", ",
                                            array_map(function ($obj) {
                                                return $obj->sector_name;
                                            }, $this->microsite->tag_sectors)
                                        ); ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul>
                    <li>
                        <div class="img-cont">
                            <p><?= reFilter($this->microsite->content); ?></p>
                        </div>
                    </li>
                    <li><a id="jobs"></a>
                        <div class="img-sec" style="height:450px; background:url(<?= $this->microsite->overview_image
                            ? _SITEDIR_ . 'data/microsite/' . $this->microsite->overview_image
                            : (isset($photosURLs) ? _SITEDIR_ . 'data/microsite/' . $photosURLs[array_rand($photosURLs)] : _SITEDIR_ . 'images/key-bg.png'); ?>) center center no-repeat; background-size: cover; border-bottom-right-radius: 10px;">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JOB OPPORTUNITIES -->
    <?php if (is_array($this->vacancies) && count($this->vacancies) > 0) { ?>
        <div class="company-sec sub-page">
            <div class="container">
                <div class="latest-sect company-cont sub-cont">
                    <h2 class="sub-head wow fadeInUp">Job <span>[Opportunities]</span></h2>
                    <div class="inner-sect slide-sec">
                        <ul id="vacancies-slider" class="slides-sect">
                            <?php
                            foreach ($this->vacancies as $vacancy) {
                                if (!in_array($vacancy->id, $this->microsite->vacancy_ids))
                                    continue;
                                ?>
                                <li class="slide-sect">
                                    <div class="inner-cont">
                                        <div class="icon-sec">
                                            <img src="<?= _SITEDIR_; ?>public/images/latest-icon-1.png" style="padding-top: 15px;">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="btm-sec">
                                            <h3><?= $vacancy->title; ?></h3>
                                            <h5>
                                                <?= implode(", ", array_map(function ($location) {
                                                    return $location->location_name;
                                                }, $vacancy->locations)); ?>
                                            </h5>
                                            <h6><?= $vacancy->salary_value; ?></h6>
                                            <ul>
                                                <li>
                                                    <a>+15% Bonus</a>
                                                </li>
                                                <li>
                                                    <a>+£6k Car</a>
                                                </li>
                                                <li>
                                                    <a>+Benefits</a>
                                                </li>
                                            </ul>
                                            <div style="min-height: 112px;"><?= reFilter($vacancy->content_short); ?></div>
                                            <a href="{URL:jobs/view/}<?= $vacancy->slug; ?>" class="f-more">Find out more</a>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <a id="more"></a>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- CONTENT PAGES -->
    <?php if (is_array($getContentPages) && count($getContentPages) > 0) { ?>
        <div class="find-more-sec">
            <div class="container">
                <h1 class="heading wow fadeInUp">Find out <span>[more]</span></h1>
                <div class="find-more-cont">
                    <ul id="pages-slider" class="slides-sect">
                        <?php foreach ($getContentPages as $content_page) { ?>
                            <li>
                                <div class="img-sec"
                                     style="background: url(<?= _SITEDIR_ . 'uploads/images/' . $content_page['image']; ?>) center center no-repeat; height:250px; background-size: cover; border-radius: 10px;"
                                     data-toggle="modal"
                                     data-target="#content_page_<?= $content_page['clients_content_page_id']; ?>">
                                </div>
                                <div class="img-cont" style="padding-left:0px;">
                                    <h2 class="text-center">
                                        <a href="#" data-toggle="modal"
                                           data-target="#content_page_<?= $content_page['clients_content_page_id']; ?>">
                                            <?= html_entity_decode($content_page['title']); ?>
                                        </a>
                                    </h2>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php foreach ($getContentPages as $content_page) { ?>
            <div class="modal fade" id="content_page_<?= $content_page['clients_content_page_id']; ?>"
                 tabindex="-1" role="dialog"
                 aria-labelledby="content_page_<?= $content_page['clients_content_page_id']; ?>Title"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="content_page_<?= $content_page['clients_content_page_id']; ?>Title">

                                <?= $content_page['title']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="content-page-body">
                                <img src="<?= _SITEDIR_ . 'uploads/images/' . $content_page['image']; ?>" style="float: left; margin-right: 20px;  width: 400px; margin-top: 10px;">
                                <?= html_entity_decode(str_replace("&nbsp;", " ", $content_page['content'])); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    <?php } ?>

    <!-- TESTIMONIALS -->
    <?php if (is_array($this->testimonials) && count($this->testimonials) > 0) {
//        print_data($this->testimonials);
        ?>
        <div class="testi-sec" id="testimonials">
            <div class="container">
                <div class="testi-cont">
                    <div class="carousel slide" data-ride="carousel">
                        <div id="testisec" class="carousel-inner">
                            <?php foreach ($this->testimonials as $i => $testimonial) { ?>
                                <div class="carousel-item <?= $i === 0 ? 'active' : ''; ?> wow fadeInUp">
                                    <ul>
                                        <?php if ($testimonial->image) { ?>
                                            <li>
                                                <div class="img-sec"
                                                     style="background-image: url('<?= _SITEDIR_ . 'data/microsite/testimonials/' . $testimonial->image; ?>'); background-size: cover;"
                                                    <?php if ($testimonial->video) { ?>
                                                        data-toggle="modal"
                                                        data-target="#testimonial-<?= $testimonial->microsite_id; ?>"
                                                    <?php } ?>></div>
                                                <?php if ($testimonial->video) { ?>
                                                    <img src="<?= _SITEDIR_; ?>images/play-btn.png"
                                                         data-toggle="modal"
                                                         data-target="#testimonial-<?= $testimonial->microsite_id; ?>"
                                                         width="100"
                                                         class="play-button">
                                                <?php } ?>
                                                <div class="img-cont"></div>
                                                <div class="clearfix"></div>
                                            </li>
                                        <?php } ?>
                                        <li <?php if(!$testimonial->image) { ?>style="width:100%;text-align:center;"<?php } ?>>
                                            <h3 class="testi-cont-text">
                                                <?= reFilter($testimonial->content); ?>
                                                <br/><br/>
                                                <p><strong><?= $testimonial->name; ?>, <?= $this->microsite->title; ?></strong></p>
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <a class="carousel-control-prev" href="#testisec" data-slide="prev">
                            <img src="<?= _SITEDIR_; ?>public/images/slide-arrow.png">
                        </a>
                        <a class="carousel-control-next" href="#testisec" data-slide="next">
                            <img src="<?= _SITEDIR_; ?>public/images/slide-arrow-2.png">
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php foreach ($this->testimonials as $i => $testimonial) { ?>
            <?php if ($testimonial->video) { ?>
                <div class="modal fade"
                     id="testimonial-<?= $testimonial->microsite_id; ?>"
                     style="margin-top: 60px"
                     tabindex="-1" role="dialog"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: transparent;">
                            <button type="button" class="close text-right"
                                    data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times; Close</span>
                            </button>
                            <div class='vimeo embed-container'>
                                <iframe class="vimeo"
                                        src="https://player.vimeo.com/video/<?= $testimonial->video; ?>?title=0&byline=0&portrait=0"
                                        frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="clearfix"></div>
    <?php } ?>

    <!-- PHOTOS -->
    <?php if (is_array($getPhotos) && count($getPhotos) > 0) { ?>
        <div class="gallery-title-sec">
            <div class="container">
                <h1 class="heading wow fadeInUp">Photo <span>[Gallery]</span></h1>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="gallery-sec">
            <ul id="photos-slider">
                <?php foreach ($getPhotos as $photo) { ?>
                    <li style="background: url(<?= _SITEDIR_ . 'uploads/images/' . $photo['image']; ?>) center center no-repeat; background-size: cover;">
                        <a href="<?= _SITEDIR_ . 'uploads/images/' . $photo['image']; ?>"
                           data-lightbox="image-1" data-title="<?= $photo['title']; ?>"
                           style="width: 100%; height: 100%; display: block;">
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php foreach ($getPhotos as $photo) { ?>
            <div class="modal fade" id="photo_<?= $photo['photo_id']; ?>"
                 tabindex="-1" role="dialog"
                 aria-labelledby="photo_<?= $photo['photo_id']; ?>Title"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"
                                id="photo_<?= $photo['photo_id']; ?>Title">
                                <?= $photo['title']; ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="<?= _SITEDIR_ . 'uploads/images/' . $photo['image']; ?>"
                                 class="img-fluid" width="100%">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"></div>
    <?php } ?>

    <!-- VIDEOS -->
    <?php if (is_array($getVideos) && count($getVideos) > 0) { ?>
        <div class="employer-sec-page">
            <div class="container">
                <div class="employer-cont">
                    <?php if (is_array($getVideos) && count($getVideos) > 0) { ?>
                        <ul>
                            <li style="min-height: 150px">
                                <div class="img-cont sub-page">
                                    <h1 class="heading" id="video-heading">
                                        <?= $getVideos[0]['title']; ?>
                                    </h1>
                                </div>
                            </li>
                            <li style="padding-top: 0px; padding-bottom: 0px; height: 300px;overflow: hidden;">
                                <div class="img-sec">
                                    <div id="videosec" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php foreach ($getVideos as $i => $video) { ?>
                                                <div class="carousel-item <?= $i === 0 ? 'active' : ''; ?>"
                                                     data-title="<?= $video['title']; ?>"
                                                     data-toggle="modal"
                                                     data-target="#vimeo-<?= $video['video_id']; ?>"
                                                     style="background: url(<?= _SITEDIR_ . 'uploads/images/' . $video['image'] ?>) no-repeat; background-size:cover;height:350px;text-align:center;padding-top:20%">
                                                    <img src="<?= _SITEDIR_; ?>images/play-button.png"
                                                         width="100"
                                                         class="play-button"
                                                         style="max-width: 100px; margin-top: 0; margin-left: 0;">
                                                </div>
                                                <div class="modal fade" id="vimeo-<?= $video['video_id']; ?>"
                                                     tabindex="-1" role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content"
                                                             style="background-color: transparent;">
                                                            <button type="button" class="close text-right"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">&times; Close</span>
                                                            </button>
                                                            <div class='vimeo embed-container'>
                                                                <iframe class="vimeo"
                                                                        src="https://player.vimeo.com/video/<?= $video['vimeo_video_id']; ?>?title=0&byline=0&portrait=0"
                                                                        frameborder="0" webkitallowfullscreen
                                                                        mozallowfullscreen
                                                                        allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#videosec" data-slide="prev">
                                            <img src="<?= _SITEDIR_; ?>images/slide-arrow.png">
                                        </a>
                                        <a class="carousel-control-next" href="#videosec" data-slide="next">
                                            <img src="<?= _SITEDIR_; ?>images/slide-arrow-2.png">
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php } ?>

    <!-- OFFICES -->
    <?php if (is_array($this->offices) && count($this->offices) > 0) { ?>
        <div class="our-location" id="offices">
            <div class="container">
                <div class="location-cont">
                    <h1 class="heading wow fadeInUp">Office <span>[Locations]</span></h1>
                    <div id="office-locations">
                        <?php
                        foreach ($this->offices as $i => $office) {
                            ?>
                            <span style="cursor: pointer;" onclick="mapZoom(this, '<?= $office->coordinates; ?>');"><?= $office->name; ?></span>
                            <?php
                            if ($i + 1 !== count($this->offices))
                                echo ' / ';
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="map-cont">
                        <div class="map" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- CONTACTS -->
    <div class="ms-ctas">
        <h1><span>[Contact]</span> Fruition</h1>
        <h2>Call us on <span>0113 323 9900</span></h2>
        <h2>Email us at <span>info@amsource.io</span></h2>
        <a href="{URL:contact-us}" target="_blank" class="mscta">Or click here to contact us</a>
    </div>
</div>

<script src="<?= _SITEDIR_; ?>blocks/lightbox2-master/dist/js/lightbox.js"></script>
<script src="<?= _SITEDIR_; ?>js/slick.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    $(document).ready(function () {
        $(this).scrollTop(0);
        $(document).scroll(function () {
            if ($(window).width() > 767) {
                var y = $(this).scrollTop();
                if (y > 800) {
                    $('#company-subnav').fadeIn();
                } else {
                    $('#company-subnav').fadeOut();
                }
            }
        });

        // Videos
        <?php if (is_array($getVideos) && count($getVideos) > 0) { ?>
            <?php foreach ($getVideos as $i => $video) { ?>
            $('#vimeo-<?= $video['video_id']; ?>').on('hidden.bs.modal', function (e) {
                var iframe = $(this).find('iframe.vimeo');
                if (iframe.length > 0) {
                    var player = new Vimeo.Player(iframe[0]);
                    player.pause();
                }
            });
            <?php } ?>
        <?php } ?>

        $('#vacancies-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            rows: 1,
            arrows: true,
            prevArrow: '<a class="slick-arrow carousel-control-prev content-pages-arrow-prev"><img src="<?= _SITEDIR_; ?>public/images/arrow-l.png"></a>',
            nextArrow: '<a class="slick-arrow carousel-control-next content-pages-arrow-next"><img src="<?= _SITEDIR_; ?>public/images/arrow-r.png"></a>',
            responsive: [
                {
                    breakpoint: 1030,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        $('#testisec').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            rows: 1,
            arrows: true,
            prevArrow: '<a class="slick-arrow carousel-control-prev content-pages-arrow-prev"><img src="<?= _SITEDIR_; ?>public/images/arrow-l.png"></a>',
            nextArrow: '<a class="slick-arrow carousel-control-next content-pages-arrow-next"><img src="<?= _SITEDIR_; ?>public/images/arrow-r.png"></a>',
            // responsive: [
            //     {
            //         breakpoint: 1030,
            //         settings: {
            //             slidesToShow: 2,
            //             slidesToScroll: 2,
            //         }
            //     },
            //     {
            //         breakpoint: 768,
            //         settings: {
            //             slidesToShow: 1,
            //             slidesToScroll: 1,
            //         }
            //     }
            // ]
        });

        $('#pages-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            rows: 1,
            arrows: true,
            prevArrow: '<a class="slick-arrow carousel-control-prev content-pages-arrow-prev"><img src="<?= _SITEDIR_; ?>public/images/arrow-l.png"></a>',
            nextArrow: '<a class="slick-arrow carousel-control-next content-pages-arrow-next"><img src="<?= _SITEDIR_; ?>public/images/arrow-r.png"></a>',
            responsive: [
                {
                    breakpoint: 1030,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
        $('#photos-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            rows: 1,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1030,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
        $('#videosec').on('slide.bs.carousel', function () {
            $('#video-heading').fadeOut();
        });
        $('#videosec').on('slid.bs.carousel', function () {
            $('#video-heading').text($('#videosec').find('.carousel-item.active').data('title'));
            $('#video-heading').fadeIn();
        });
        if ($('#videosec .carousel-inner div.carousel-item').length === 1) {
            $('#videosec .carousel-control-prev').hide();
            $('#videosec .carousel-control-next').hide();
        }
        if ($('#testisec .carousel-inner div.carousel-item').length === 1) {
            $('#testisec .carousel-control-prev').hide();
            $('#testisec .carousel-control-next').hide();
        }
    });
    var markers = <?= isset($markers) && is_array($markers) && count($markers) > 0 ? json_encode($markers) : "[]"; ?>,
        map;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            icon: "<?= _SITEDIR_ . 'public/images/map-pin.png'; ?>",
            center: markers.length > 0 ? markers[0] : null,
            scrollwheel: true,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            styles: [
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ]
        });
        $(markers).each(function (i, marker) {
            new google.maps.Marker({
                position: marker,
                map: map,
                icon: "<?= _SITEDIR_ . 'public/images/map-pin.png'; ?>"
            });
        });
    }

    function mapZoom(el, coordinates) {
        $('.map-location-active').removeClass('map-location-active');
        $(el).addClass('map-location-active');
        coordinates = coordinates.split(',');
        if (coordinates.length === 2) {
            map.panTo({
                lat: parseFloat(coordinates[0].trim()),
                lng: parseFloat(coordinates[1].trim()),
            });
            map.setZoom(10);
        }
    }

    function imgZoom(img) {
        if (!$(img).attr('width').length)
            $(img).attr('width', 300);
        else
            $(img).attr('width', '')
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=<?= isset($maps_api_key) && $maps_api_key ? $maps_api_key : ""; ?>"></script>