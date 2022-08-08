 <section class="inner-banner">
        <div class="cust-container">
            <h2><?php if($this->job->title!='') { echo $this->job->title; } ?></h2>
        </div>
    </section>

    <section class="job-role-block">
        <div class="cust-container">
            <div class="job-role-row">
                <div class="job-role-left">
                    <div class="job-role-inner">
                        <h4><?php if($this->job->title!='') { echo $this->job->title; } ?></h4>
                        <div class="job-role-details">
                            <div><?php if(!empty($this->job->locations)){?>
                                <span>Location: <?php 

                        echo implode(", ", array_map(function ($location) {
                           return $location->location_name;
                        }, $this->job->locations)); 
                     ?></span>
                                <?php } ?>
                                <span>Salary: <?php
                        if($this->job->salary_value!=''){?>
                            <?= (($this->job->salary_value) ? CURRENCY_SYMBOL.$this->job->salary_value : '00.00'); ?>
                       <?php  }else{?>
                        <?= (($this->job->salary_from) ? CURRENCY_SYMBOL.$this->job->salary_from . ' - ' : '')  . ( ($this->job->salary_to) ?CURRENCY_SYMBOL . $this->job->salary_to : ''); ?>
                    <?php }?></span>
                            </div>
                            <div>
                                <?php if($this->job->time!='' &&  $this->job->time!=0){?>
                                <span>Date Posted: <?= date('d/m/Y',$this->job->time);?></span>
                                <?php }?>
                                <?php if($this->job->time_expire!='' && $this->job->time_expire!=0){?>
                                <span>Expires: <?= date('d/m/Y',$this->job->time_expire);?></span>
                                <?php }?>
                                <!-- <span>Role Type: £00.00</span> -->
                            </div>                
                        </div>
                        <?= reFilter($this->job->content); ?>
                        <a href="javascript:void(0)" class="arrow-grey-btn" data-toggle="modal" data-target="#myModal">
                            apply now
                        </a>

                        <h5>Share this job</h5>
                        <div class="social-icos">
                            <li onclick="share_linkedin(this);"
                    data-url="{URL:job/<?= $this->job->slug; ?>}" class="linkedin"><a href=""></a></li>
                            <li class="mail"><a href=""></a></li>
                            <li onclick="share_facebook(this);"
                    data-url="{URL:job/<?= $this->job->slug; ?>}" class="facebook"><a href=""></a></li>
                            <li onclick="share_twitter(this);"
                    data-url="{URL:job/<?= $this->job->slug; ?>}" class="twitter"><a href=""></a></li>
                        </div>
                    </div>
                </div>
            <?php
            if($this->consultant[0] != "") {
            ?>
                <div class="job-role-right">
                    <div class="job-role-inner">
                        <div class="img-box">
                                 <?php if($this->consultant->image!=''){?>
                           <img  src="<?php echo _SITEDIR_; ?>data/users/<?=$this->consultant->image; ?>" alt="<?php echo  $this->consultant->firstname. " ".$this->consultant->lastname?>">
                        <?php }else{ ?>
                           <img  src="<?php echo _SITEDIR_; ?>public/images/no-image.png" alt="<?php echo $team->firstname. " ". $team->lastname?>">  
                        <?php } ?>
            
                        </div>
                        <div class="job-role-card">
                            <h5><?= $this->consultant->firstname ?> <?= $this->consultant->lastname ?></h5>       
                            <a href="tel:<?= $this->consultant->tel; ?>"><?= $this->consultant->tel; ?></span>
                            <a href="mailto:<?= $this->consultant->email; ?>"><?= $this->consultant->email; ?></span>
                            <a href="javascript:void(0)" class="outline-grey-btn" data-toggle="modal" data-target="#myModal">
                                apply now
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>


            </div>
        </div>
    </section>
<?php if($this->related_jobs[0]!=''):?>
    <section class="current-jobs-block cust-container">
        <div class="current-jobs-row">
             <?php  foreach ($this->related_jobs as $item) { ?> 
            <div class="job-content-card  job-content-card-lg yellow-block">
                <h4 class="heading"><?= $item->title ?></h4>
                 <?php if(!empty($item->locations)){?> 
                <span class="location-ico"><?= implode(", ", array_map(function ($location) {
                return $location->location_name;   
             }, $item->locations)); ?></span>
                <?php }?> 
                <span class="money-ico"><?php
                        if($item->salary_value!=''){?>
                            <?= (($item->salary_value) ? CURRENCY_SYMBOL.$item->salary_value : '00.00'); ?>
                       <?php  }else{?>
                        <?= (($item->salary_from) ? CURRENCY_SYMBOL.$item->salary_from . ' - ' : '')  . ( ($item->salary_to) ?CURRENCY_SYMBOL . $item->salary_to : ''); ?>
                    <?php }?></span>
                <p class="para-heading"><?= reFilter($item->content_short) ?></p>
                <a href="{URL:job/<?= $item->slug; ?>}" class="arrow-ico"></a>
            </div>  
<?php } ?>
            
        </div>

    </section>
    <?php else:?>
    <br>
   <?php endif;?> 
     <!----modal---->
<div class="modal modal-form popup1 cust-modal apply-modal-box" id="myModal">
 <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
   <!-- Modal Header -->
   <div class="modal-header">
    <h4 class="modal-title sub-heading sub-title" data-toggle="modal" data-target="#myModal">Apply <span>Now</span></h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <!-- Modal body -->
 <form id="apply_form" class="popup-form">
    <div class="modal-body">
     <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name*" onKeyPress="return nameonly(event)">
     </div>
     <div class="form-group"> <input class="form-control" type="tel" name="tel" placeholder="Phone*"
       id="Phone" value=""  minlength="8" maxlength="12" required onKeyPress="return contactonly(event)">
       <p id="applyjobphone" style="color:red;"></p>
    </div>
    <div class="form-group"> <input class="form-control" type="text" name="email" placeholder="Email*" onKeyPress="return emailonly(event)">
    </div>
    <div class="form-group"> <input class="form-control" type="text" name="linkedin"
       placeholder="LinkedIn Profile">
    </div>
    <div class="form-group file-upload">
                        <div class="custom-file form-control">
                               <input type="file" class="custom-file-input pf-text-field" id="validatedCustomFile" required
                               name="cv_field" style="border: none; padding: 0;"
                               accept=".doc, .docx, .txt, .pdf, .fotd"
                               onchange="initFile(this); load('cv/upload/', 'field=#cv_field', 'preview=.cv_file_name');">
                               <label class="custom-file-label pf-label" for="validatedCustomFile">Choose CV file...<span
                                 class="cv_file_name" style="color: #64C2C8;"></span></label>
                              </div>
                              <input type="hidden" name="cv_field" id="cv_field" value="<?= post('cv_field', false); ?>">
                           </div>    
                    
                  <div class="form-group sub-btn text-center mb-0">
                   <button class="primary-btn" type="submit"
                   onclick="load('jobs/apply_now/<?= $this->job->slug; ?>', 'form:#apply_form'); return false;">Apply Now<span></span>
                </button>
                <div class="clearfix"></div>
    
             </div>
          </div>
       </form>
    </div>
 </div>
</div>

<!---end modal-->