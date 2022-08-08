<section class="inner-banner">
    <div class="cust-container">
        <h2>Blog</h2>
    </div>
</section>

<div class="blog-feature-content">
    <div class="blog-row">
        <div id="blog-cara" class="blog-feature-left owl-carousel owl-theme w-100">
            <div class="item d-flex">
                <div class="blog-img-boxOuter">
                <div class="img-box">
                    <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><img src="<?= _SITEDIR_; ?>data/blog/<?= $this->featured_blogs['0']->image; ?>" alt="<?= $this->featured_blogs['0']->title; ?>"></a>
                </div></div>
                <div class="blog-feature-right">
            <div class="blog-feature-right-inner">
                <span class="date"><?= date("d/m/Y", $this->featured_blogs['0']->time); ?></span>
                <h3><a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><?= $this->featured_blogs['0']->title; ?></a></h3>
                <?= html_entity_decode($this->featured_blogs['0']->short_description); ?>
                <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}" class="show-more arrow-grey-btn">
                    READ MORE
                </a>
            </div>
        </div>
            </div>
            <div class="item d-flex">
                <div class="blog-img-boxOuter">
                <div class="img-box">
                    <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><img src="<?= _SITEDIR_; ?>data/blog/<?= $this->featured_blogs['0']->image; ?>" alt="<?= $this->featured_blogs['0']->title; ?>"></a>
                </div></div>
                <div class="blog-feature-right">
            <div class="blog-feature-right-inner">
                <span class="date"><?= date("d/m/Y", $this->featured_blogs['0']->time); ?></span>
                <h3><a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><?= $this->featured_blogs['0']->title; ?></a></h3>
                <?= html_entity_decode($this->featured_blogs['0']->short_description); ?>
                <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}" class="show-more arrow-grey-btn">
                    READ MORE
                </a>
            </div>
        </div>
            </div>
            <!--div class="item">-->
            <!--    <div class="img-box">-->
            <!--        <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><img src="<?= _SITEDIR_; ?>data/blog/<?= $this->featured_blogs['0']->image1; ?>" alt="<?= $this->featured_blogs['0']->title; ?>"></a>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="item">-->
            <!--    <div class="img-box">-->
            <!--       <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"> <img src="<?= _SITEDIR_; ?>data/blog/<?= $this->featured_blogs['0']->image2; ?>" alt="<?= $this->featured_blogs['0']->title; ?>"></a>-->
            <!--    </div>-->
            <!--</div>-->
            <!--<div class="item">-->
            <!--    <div class="img-box">-->
            <!--        <a href="{URL:blog/<?= $this->featured_blogs['0']->slug; ?>}"><img src="<?= _SITEDIR_; ?>data/blog/<?= $this->featured_blogs['0']->image3; ?>" alt="<?= $this->featured_blogs['0']->title; ?>"></a>-->
            <!--    </div>-->
            <!--</div><-->


        </div>


        

    </div>
</div>

<?php if (!empty($this->blogs)) { ?>
    <section class="blog-content-block blog-content-blockBtm">
        <div class="cust-container">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="filter-bllog">
                
                        <div class="filter-head">
                            <h5>Filters</h5>
                        </div>
                   

                   
                        <div class="card-body filter-content">
                            <div class="list-group list-filter-content" id="list-tab" role="tablist">
      <a class="list-group-item-action active" id="list-blog-category-one-list" data-toggle="list" href="#list-blog-category-one" role="tab" aria-controls="blog-category-one">Lorem ipsum </a>
      <a class="list-group-item-action" id="list-blog-category-two-list" data-toggle="list" href="#list-blog-category-two" role="tab" aria-controls="blog-category-two">Consectetur elit</a>
      <a class="list-group-item-action" id="list-blog-category-three-list" data-toggle="list" href="#list-blog-category-three" role="tab" aria-controls="blog-category-three">Pellentesque neque </a>
      <a class="list-group-item-action" id="list-blog-category-five-list" data-toggle="list" href="#list-blog-category-five" role="tab" aria-controls="blog-category-five">Feugiat fermentum</a>
    </div>
                        </div>
                   
                </div>


            </div>
                <div class="col-md-8 col-lg-9">
                    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-blog-category-one" role="tabpanel" aria-labelledby="list-blog-category-one-list">
                  
            <div class="blog-content-row" id="blog-data">
                <?php foreach ($this->blogs as $blogs) { ?>
                    <!-------loop start ----------->
                    <div class="blog-content-cell">
                        <div class="blog-content-inner">
                            <div class="img-box">
                               <a href="{URL:blog/<?= $blogs->slug; ?>}"> <img src="<?= _SITEDIR_; ?>data/blog/<?= $blogs->image; ?>" alt=""></a>
                            </div>
                            <span class="date"><?= date("d/m/Y", $blogs->time); ?></span>
                            <h4><a href="{URL:blog/<?= $blogs->slug; ?>}"><?= $blogs->title; ?> </a></h4>
                            <?= html_entity_decode($blogs->short_description); ?>
                            <a href="{URL:blog/<?= $blogs->slug; ?>}" class="arrow-grey-btn">
                                READ MORE
                            </a>
                        </div>
                    </div>
                    <!-------loop end----------->
                <?php } ?>
            </div>
      </div>
      <div class="tab-pane fade" id="list-blog-category-two" role="tabpanel" aria-labelledby="list-blog-category-two-list">Blog category 2</div>
      <div class="tab-pane fade" id="list-blog-category-three" role="tabpanel" aria-labelledby="list-blog-category-three-list">Blog category 3</div>
      <div class="tab-pane fade" id="list-blog-category-five" role="tabpanel" aria-labelledby="list-blog-category-five-list">Blog category 4</div>
    </div>
  </div>
           
            <!--<div class="cust-pagination">
                <a href="#" class="back-arrow"></a>
                <span class="para-heading">1 of 7</span>
                <a href="#" class="next-arrow"></a>
            </div>-->
            <?php if (!empty($this->total_pages) && $this->total_pages > 1) { ?>
                <div class="cust-pagination" id="pagination">
                    <span class="prev" data-id="0" id="prevPage"><a href="#" class="back-arrow"></a></span>
                    <?php for ($i = 1; $i <= $this->total_pages; $i++) : ?>
                        <?php if ($i == 1) : ?>
                            <span class="para-heading page-item disabled" id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="-1"><?= $i ?></a></span>
                        <?php else : ?>
                            <span class="para-heading page-item " id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="-1"><?= $i ?></a></span>

                        <?php endif; ?>
                    <?php endfor; ?>
                    <span class="next" data-id="2" id="nextPage">
                        <a href="#" class="next-arrow "></a></span>
                </div>
            <?php }  ?>
            <input type="hidden" id="pageNumber" value="1">
</div>
            </div>
        </div>
    </section>
<?php } ?>

<script>
    $('#blog-cara').owlCarousel({
        loop: true,
        autoplay: true,
        margin: 0,
        items: 1,
        nav: true,
        dots: false,
        touchDrag: true,
        autoplayTimeout:5000,
        mouseDrag: true,
        responsive: {
            320: {
                items: 1,
                autoplay: true,
                nav: true,
                dots: false,
                margin: 0
            },

            400: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },

            480: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            601: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            767: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            992: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            1280: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            1440: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            },
            1920: {
                items: 1,
                nav: true,
                dots: false,
                autoplay: true,
                loop: true,
                margin: 0
            }
        }
    });

    $(document).on('click', '#pagination span', function(e) {
        e.preventDefault();
        $("#pagination span").removeClass('active');
        $(this).addClass('active');
        var curruntPage = $("#pageNumber").val();
        var pageNum = $(this).data('id');
        var nextpagenum = +pageNum + 1;
        var prevpagenum = pageNum - 1;
        $("#nextPage").attr('data-id', nextpagenum);
        $("#prevPage").attr('data-id', prevpagenum);
        $("#pageNumber").val(pageNum);
        var totalPage = $("#totalPage").val();
        if (curruntPage == 0 || curruntPage < 0) {
            $("#prevPage").addClass('disabled');
            return false;
        } else if (prevpagenum == totalPage || prevpagenum > totalPage) {
            $("#nextPage").addClass('disabled');
            return false;
        } else {
            ajaxPagination();
        };
    });


    function ajaxPagination() {

        let page = $("#pageNumber").val();

        $.ajax({
            type: 'POST',
            url: '{URL:blogs/search}',
            data: '&page=' + page,
            success: function(response) {
                jsonObj = $.parseJSON(response);
                // alert(height * jsonObj.vacancy_count);

                $('#blog-data').html(jsonObj.html);
                $('#pagination').html(jsonObj.pagination);
                $('.page-item').removeClass('active');
                var pageNum = $("#pageNumber").val();
                var totalPage = $("#totalPage").val();
                if (pageNum != totalPage || pageNum < totalPage) {
                    var nextpagenum = +pageNum + 1;
                    $("#nextPage").attr('data-id', nextpagenum);
                }

                if (pageNum != 0 || pageNum > 0) {
                    var prevpagenum = pageNum - 1;
                    $("#prevPage").attr('data-id', prevpagenum);
                }

            }
        });
    }
</script>