<section class="inner-banner">
        <div class="cust-container">
            <h2><?= $this->profile->job_title ?></h2>
        </div>
    </section>

    <section class="talent-detail-page">
    <div class="cust-container">
            <div class="job-role-row">
                <div class="job-role-left">
                    <div class="job-role-inner">
                        <h4>Key Info</h4>
                        <div class="table-responsive mb-40">
                         <table class="table table-striped table-talent-info table-borderless mb-0">

                            <tbody>
                              <tr>
                               <th>Job Title</th>
                                <td><?= $this->profile->job_title ?></td>

                              </tr>
                              <?php if($this->profile->locations!=''){?>
                              <tr>
                               <th>Location</th>
                                <td><?= implode(", ", array_map(function ($location) {
                                            return $location->location_name;
                                        }, $this->profile->locations)
                                    ); ?></td>

                              </tr>
                          <?php }?>
                          <!--<?php if($this->profile->education!=''){?>
                              <tr>
                               <th>Education</th>
                                <td><?= $this->profile->education ?> </td>

                              </tr>
                              <?php }?>-->
                              <?php if($this->profile->keywords!=''){?>
                              <tr>
                               <th>Top 3 Skills</th>
                                <td><?= str_replace(',', ', ', $this->profile->keywords) ?> </td>

                              </tr>
                              <?php }?>
                              <!--<tr>
                               <th>Sports</th>
                                <td><?= str_replace(',', ', ', $this->profile->sports) ?></td>

                              </tr>-->
                              <tr>
                               <th>Will Relocate?</th>
                                <td><?= $this->profile->relocate ?></td>

                              </tr><?php if ($this->profile->radius) { ?>
                                                              <tr>

                               <th>Will Commute?</th>
                                <td> <?= $this->profile->radius . " " . $this->profile->distance_type; ?></td>

                              </tr>
                              <?php } ?>
                                    <?php if ($this->profile->contract) { ?>                                                        <tr>
                               <th>Contract Preference</th>
                                <td> <?=$this->profile->contract?></td>

                              </tr> 
                              <?php } ?>   
                              <?php if ($this->profile->availability) { ?>
                                                                                            <tr>
                               <th>Availability (Notice Period)</th>
                                <td> <?= $this->profile->availability; ?></td>

                              </tr>
                              <?php } ?>
                                <?php if ($this->profile->min_hourly_salary) { ?>
                                                                                              <tr>
                               <th>Min Hour Rate Req. (Contract Roles)</th>
                                <td><?= $this->profile->hourly_currency . $this->profile->min_hourly_salary; ?> per hour</td>
                                <!-- <td>German, English</td>
 -->
                              </tr>
                               <?php } ?>
                               <tr>
                               <th>Job Title</th>
                                <td><?= $this->profile->job_title ?></td>

                              </tr>

                            </tbody>
                          </table>
                       </div>
                        <p><?= reFilter($this->profile->resume_info); ?> </p>
                            
                            <h4>key skills &amp; experience</h4>

                        <p><?= reFilter($this->profile->quote); ?></p>
                        <h4>Is this candidate of interest?</h4>
                        <p class="btn-box-talent-page">
                            <button class="arrow-grey-btn learn-more-btn"   type="button" data-toggle="modal"
                                    onclick="load('open-book/<?= $this->profile->id; ?>'); return false;"
                                    data-target="#reveal_modal" value="submit">REQUEST FULL PROFILE & CV <i class="arrow-right"></i> </button>
                               <!-- <a data-toggle="modal" data-target="#exampleModalCenter" class="arrow-grey-btn learn-more-btn">
                    <span><cite>REQUEST FULL PROFILE & CV</cite> <i class="arrow-right"></i></span>
                    </a> -->
                    <button class="arrow-grey-btn learn-more-btn" data-toggle="modal"
                            onclick="load('open-request-interview/<?= $this->profile->id; ?>'); return false;"
                            data-target="#interview_modal" type="submit"  value="submit"> REQUEST INTERVIEW</button>
                                 <!--  <a data-toggle="modal" data-target="#exampleModalCenter" class="arrow-grey-btn learn-more-btn">
                    <span><cite>REQUEST INTERVIEW</cite> <i class="arrow-right"></i></span>
                    </a> -->
                     <button class="arrow-grey-btn learn-more-btn" data-toggle="modal"
                            onclick="load('open-request-info/<?= $this->profile->id; ?>'); return false;"
                            data-target="#info_modal" type="submit"  value="submit"> REQUEST FURTHER INFO</button>
                    
                     <!-- <a data-toggle="modal" data-target="#exampleModalCenter" class="arrow-grey-btn learn-more-btn">
                    <span><cite>REQUEST INTERVIEW</cite> <i class="arrow-right"></i></span>
                    </a> -->  

                          </p>
                          <div class="mb-40">
                          <h4>Not Quite The Right Fit?</h4>

                        <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu eu diam viverra eget nibh dolor adipiscing ut orci. </p>
                        <a onclick="load('open-candidate-alert/<?= $this->profile->id; ?>'); return false;"
                           data-toggle="modal" data-target="#candidate_alert" class="btn-yellow btn-inline">
                         <button class="arrow-grey-btn learn-more-btn"  type="submit"  value="submit">REGISTER CANDIDATE ALERT</button></a>
                      <!-- <a data-toggle="modal" data-target="#exampleModalCenter" class="arrow-grey-btn learn-more-btn">
                    <span><cite>REGISTER CANDIDATE ALERT</cite> <i class="arrow-right"></i></span>
                    </a> --></div>
                    <p class="theme-italic-txt"><small>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu eu diam viverra eget nibh dolor
                            adipiscing ut orci. Scelerisque <strong>facilisi libero</strong> posuere in. Sed nunc at nec aliquet velit
                            ut. Elementum adipiscing aliquam habitasse morbi est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Arcu eu diam viverra eget nibh dolor
                            adipiscing ut orci. Scelerisque facilisi libero posuere in. Sed nunc at nec aliquet velit
                            ut. Elementum adipiscing aliquam habitasse morbi est. <?php if($this->tc->file!=''){?><a target="_blank"
                                                                            href="<?= _SITEDIR_ ?>data/talent/your_tc/<?= $this->tc->file ?>">Please click here to download our standard T's and C's.</a><?php }?></small></p>
                    <a href="{URL:talent}" class="arrow-grey-btn learn-more-btn back-btn">
                    <span><i class="arrow-right"></i><cite>Back To Talent Search</cite></span>
                    </a>
                        
                    </div>
                </div>

                <div class="job-role-right">
                    <div class="job-role-inner">
                        <!--<div class="img-box">
                            <?php if($this->profile->consultant->image!=''){?>
                        <img src="<?php echo _SITEDIR_; ?>data/users/<?= $this->profile->consultant->image; ?>" alt="<?= $this->profile->consultant->firstname . ' ' . $this->profile->consultant->lastname; ?>">
                        <?php }else{ ?>
                        <img src="<?php echo _SITEDIR_; ?>public/images/no-image.png" alt="<?php echo $team->firstname. " ". $team->lastname?>">  
                        <?php } ?>
                              
                        </div>-->
                        <div class="job-role-card">
                            <h5><?= $this->profile->consultant->firstname . ' ' . $this->profile->consultant->lastname; ?></h5>
                             <?php if ($this->profile->consultant->tel) { ?>
                           <a href="tel:<?=$this->profile->consultant->tel; ?>"><p><?=$this->profile->consultant->tel; ?></p></a>
                            </a>
                            <?php } ?>
                             <?php if ($this->profile->consultant->email) { ?>
                            <a href="mailto:<?= $this->profile->consultant->email ?>"><p><?= $this->profile->consultant->email ?></p></a>
                             <?php } ?>
                              <!--<?php if ($this->profile->consultant->linkedin) { ?>
                    <div class="linkdin-conetnt">
                      <a target="_blank" href="<?= $this->profile->consultant->linkedin ?>>"><h4  class="fs-20 ">LINKEDIN</h4></a>
                     
                    </div>
                    <?php } ?>-->
                     <!--<a onclick="load('open-candidate-alert/<?= $this->profile->id; ?>'); return false;"
                           data-toggle="modal" data-target="#candidate_alert" class="btn-yellow btn-inline">
                         <button class="outline-grey-btn"  type="submit"  value="submit">REGISTER NOW</button></a>-->
                            
                        </div>
                    </div>
                </div>


            </div>
        </div></section>
        
        <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>

    function feedback() {
        if (!($('#rating-input').val() || $('#feedback').val()))
            return alert('The rating and feedback field must be filled');

        load('feedback/<?= $this->profile->id ?>');
    }

</script>

   