<section class="inner-banner">
    <div class="cust-container">
        <h3 class="text-center text-white"><?= $this->blog->title; ?></h3>
    </div>
</section>
<section>
    <div class="blog-detail-content-top">
                                <div class="cust-container">
    <p><strong><?= reFilter($this->blog->short_description); ?></strong></p></div></div>
    <div class="blog-detail-img">
                                <img src="<?= _SITEDIR_; ?>data/blog/<?= $this->blog->details_image; ?>" alt="<?= $this->blog->title; ?>">
                            </div>
                            
                            <div class="blog-detail-content">
                                <div class="cust-container">
                                <p><?= reFilter($this->blog->content); ?></p>
<div class="btm-cont-blog d-flex">  

                        <div class="autor-blog mr-5">
                           <h6>Author</h6>
                           <?php if($this->blog->consultant_id!=''){?>
                           <p><?= $this->blog->firstname; ?> <?= $this->blog->lastname; ?></p>
                           <?php }?>
                        </div>
                        <div class="date-blog">
                           <h6>Date</h6>
                           <p><?= date('d F Y', $this->blog->time);?></p>
                        </div>
                     </div>
                                </div></div>
</section>

<section class="recent-blog">

<div class="cust-container">
    <h4 class="text-center">Recent Blogs</h4>
            <div class="blog-content-row" id="blog-data">
                <?php foreach($this->recents as $key=>$recent) { ?>
                    <div class="blog-content-cell">
                        <div class="blog-content-inner">
                            <div class="img-box">
                               <a href="{URL:blog/<?= $recent->slug; ?>}"> <img src="<?= _SITEDIR_; ?>data/blog/<?= $recent->image; ?>" alt=""></a></a>
                            </div>
                            <span class="date"><?= date("d/m/Y", $recent->time); ?></span>
                            <h4><a href="{URL:blog/<?= $recent->slug; ?>}"> <?= $recent->title ?> </a></h4>
                            <p><?= html_entity_decode($recent->short_description); ?></p>
                            <a href="{URL:blog/<?= $recent->slug; ?>}" class="arrow-grey-btn">
                                READ MORE
                            </a>
                        </div>
                    </div>
                    <?php }?>
                    <!--<div class="blog-content-cell">-->
                    <!--    <div class="blog-content-inner">-->
                    <!--        <div class="img-box">-->
                    <!--           <a href="{URL:blog/<?= $blogs->slug; ?>}"> <img src="https://bolddev7.co.uk/initi8/app/data/blog/14751e9e866db0f8956e800d57f6a776.png" alt=""></a>-->
                    <!--        </div>-->
                    <!--        <span class="date"><?= date("d/m/Y", $blogs->time); ?></span>-->
                    <!--        <h4><a href="{URL:blog/<?= $blogs->slug; ?>}"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a></h4>-->
                    <!--        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat sed interdum nunc blandit tincidunt pellentesque neque vitae eget. Euismod convallis a eu, feugiat fermentum.</p>-->
                    <!--        <a href="{URL:blog/<?= $blogs->slug; ?>}" class="arrow-grey-btn">-->
                    <!--            READ MORE-->
                    <!--        </a>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="blog-content-cell">-->
                    <!--    <div class="blog-content-inner">-->
                    <!--        <div class="img-box">-->
                    <!--           <a href="{URL:blog/<?= $blogs->slug; ?>}"> <img src="https://bolddev7.co.uk/initi8/app/data/blog/14751e9e866db0f8956e800d57f6a776.png" alt=""></a>-->
                    <!--        </div>-->
                    <!--        <span class="date"><?= date("d/m/Y", $blogs->time); ?></span>-->
                    <!--        <h4><a href="{URL:blog/<?= $blogs->slug; ?>}"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </a></h4>-->
                    <!--        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Placerat sed interdum nunc blandit tincidunt pellentesque neque vitae eget. Euismod convallis a eu, feugiat fermentum.</p>-->
                    <!--        <a href="{URL:blog/<?= $blogs->slug; ?>}" class="arrow-grey-btn">-->
                    <!--            READ MORE-->
                    <!--        </a>-->
                    <!--    </div>-->
                    <!--</div>-->
                   
            </div>
            

        </div>
</section>

