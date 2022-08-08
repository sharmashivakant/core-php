<section class="inner-banner">
        <div class="cust-container">
            <h2>Meet The Team</h2>
        </div>
    </section>


    <section class="team-block">
        <div class="cust-container">
            <div class="cust-para-block">
                
                <p class="para-heading"><contentElement name="banner_content" type="textarea">Our team is the beating heart of the business and our greatest asset. You’ll
                    find we’re lean-in positive
                    people, who are invested in your success and will go the extra mile for you. We’d describe ourselves
                    as
                    straight talking but kind, humorous, trustworthy and if we’re honest, a tad geeky!  </contentElement></p>
                   
                <p class="para-heading"><contentElement name="banner_sub_content" type="input"> Meet some of our wonderful team members below:</contentElement></p>
            </div>

            <div class="team-inner-row">
                <?php 
                  foreach ($this->team as $team) { ?>
                <div class="team-inner-cell">
                    <div class="flip-box">
                        <div class="flip-box-inner">

                            <div class="flip-box-front">
                                 <?php if($team->image!=''){?>
                        <img src="<?php echo _SITEDIR_; ?>data/users/<?= $team->image; ?>" alt="<?php echo $team->firstname. " ". $team->lastname?>">
                        <?php }else{ ?>
                        <img src="<?php echo _SITEDIR_; ?>public/images/no-image.png" alt="<?php echo $team->firstname. " ". $team->lastname?>">  
                        <?php } ?>
                                <div class="team-detail-front">
                                    <h4><?php echo $team->firstname. " ". $team->lastname?></h4>
                                    <h5><?php echo $team->job_title;?></h5>
                                </div>
                            </div>     
                            <div class="flip-box-back fadeIn">
                                 <?php if($team->detail_image!=''){?>
                        <img src="<?php echo _SITEDIR_; ?>data/users/<?= $team->detail_image; ?>" alt="<?php echo $team->firstname. " ". $team->lastname?>">
                        <?php }else{ ?>
                        <img src="<?php echo _SITEDIR_; ?>public/images/no-image.png" alt="<?php echo $team->firstname. " ". $team->lastname?>">  
                        <?php } ?>
                                <div class="back-detail-content">
                                    <h4><?php echo $team->firstname. " ". $team->lastname?></h4>
                                    <span><?=substr(reFilter($team->description),0,170);?>...
                                    </span>
                                    <a href="javascript:void(0);" class="arrow-grey-btn">
                                        <span><cite>READ MORE</cite> <i class="arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>  
                            <div class="team-content">
                                <h4><?php echo $team->firstname. " ". $team->lastname?></h4>
                                <span><?php echo $team->job_title;?></span>
                                <?=reFilter($team->description)?>
                                
                            </div>

                        </div>
                    </div>
                </div>
<?php }?>
                <!-- <div class="team-inner-cell">
                    <div class="flip-box">
                        <div class="flip-box-inner">
                            <div class="flip-box-front">
                                <img src="<?= _SITEDIR_; ?>public/images/Louise.svg" alt="Louise - Senior Manager">
                                <div class="team-detail-front">
                                    <h4>Louise</h4>
                                    <h5>Senior Manager</h5>
                                </div>
                            </div>
                            <div class="flip-box-back fadeIn">
                                <img src="<?= _SITEDIR_; ?>public/images/Louise.jpg" alt="">
                                <div class="back-detail-content">
                                    <h4>Louise</h4>
                                    <span>I’m Louise, and I’m a Manager at Initi8. I’ve worked at Initi8 for 12 years
                                        and now head up the Account Management function, ensuring the highest standards
                                        of service are offered to all clients.
                                    </span>
                                    <a href="#" class="arrow-grey-btn">
                                        <span><cite>Read More</cite> <i class="arrow-right"></i></span>
                                    </a>
                                </div>
                            </div>
                            <div class="team-content">
                                <h4>Louise</h4>
                                <span>Senior Manager</span>
                                <p>I’m Louise, and I’m a Manager at Initi8. I’ve worked at Initi8 for 12 years and
                                    now head up the Account Management function, ensuring the highest standards of
                                    service are offered to all clients. </p>

                                <p>I mentor our technical consultants in client management best practice, to ensure
                                    every customer engagement is a successful one. I’m also a hands on recruiter,
                                    acting as an Account Manager for some of our biggest clients and as an Account
                                    Director to other key accounts. I love building long lasting relationships with
                                    people based on trust, which is a key ingredient in all of my successful client
                                    and candidate partnerships. </p>

                                <p>Outside of work, I’m a bit of a foodie and luckily I’m also a keen runner, who
                                    you’ll find pounding the streets and parks of Surrey!
                                </p>

                            </div>

                        </div>
                    </div>
                </div> -->

            </div>

            <div class="two-btn-wrap">
                <a href="{URL:jobs}" class="arrow-grey-btn">
                    <span><cite>FIND ME A JOB</cite> <i class="arrow-right"></i></span>
                </a>

                <a href="{URL:join-team}" class="arrow-grey-btn">     
                    <span><cite>JOIN THE TEAM</cite> <i class="arrow-right"></i></span>          
                </a>
            </div>
        </div>
    </section>
     <div id="popup-team" class="popup-outer">
        <div class="popup-inner">

            <div class="popup-content">
                <a href="javascript:void(0);" class="close"><span>Close</span></a>
                <div class="team-detail-content">
                    <div class="team-detail-right">
                        <div class="wrap-team-detail-right">
                            <div class="inner-team-detail-right">

                            </div>
                        </div>
                        
        
                    </div>
                    <div class="team-detail-left">
                        <div class="img-box">
                            <img src="<?= _SITEDIR_; ?>public/images/alex.png">
                        </div>
                        <div class="team-detail-left-inner">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // team modals
        $(document).ready(function () {
            $(".team-inner-cell .arrow-grey-btn").on('click', function () {
                var imgSrc = $(this).parents(".team-inner-cell").find(".flip-box-back img").attr("src");
                var imgAlt = $(this).parents(".team-inner-cell").find(".img-box img").attr("alt");
                var teamDetail = $(this).parents(".team-inner-cell").find(".team-content").html();
                $(".popup-inner .img-box img").attr("src", imgSrc);
                $(".popup-inner .img-box img").attr("alt", imgAlt);
                $(".popup-inner .team-detail-right .inner-team-detail-right").html(teamDetail);
                $("#popup-team").show();
                $("body").addClass("body-fix");
            });

            $("#popup-team .close").on('click', function () {
                $("#popup-team").hide();
                $("body").removeClass("body-fix");
            });
        });
    </script>  