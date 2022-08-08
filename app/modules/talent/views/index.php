<section class="cust-search-block cust-container">
    <div class="cust-search-row cust-form">
        <h4>Keyword Search</h4>
        <div class="input-group search-box">
            <input type="text" class="form-control" placeholder="Search Candidates" id="keywords">
            <div class="input-group-append search-ico">
                <button class="search-btn" type="button" onclick="ajaxPagination ();">
                </button>
            </div>
        </div>
    </div>
</section>

<section class="filter-block green-filter cust-container">
    <div class="filter-block-row">

        <div id="accordion" class="filter-accord">

            <div class="card">
                <div class="card-header" id="headingTwo">

                    <button class="btn btn-link filter-collapse-btn" data-toggle="collapse"
                    data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <h5> Location </h5>
                </button>

            </div>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                <div class="card-body filter-accord-card">
                  <div class="filter-item">
                   <?php foreach ($this->locations as $key => $item) { ?>
                                <label class="cust-checkbox-container"><?= $item->name ?>
                                    <input onclick="ajaxPagination ();"type="checkbox" name="location[]" class="locationCheck" value="<?= $item->id ?>" id="checkbox-location-<?= $key ?>" <?= (post('location')) ? in_array($item->id, post('location')) ? 'checked' : '' : '' ?>>
                                    <span class="checkmark"></span>
                                </label>
                                <?php } ?>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingThree">

            <button class="btn btn-link filter-collapse-btn" data-toggle="collapse"
            data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <h5> Contract Types
            </h5>
        </button>

    </div>
    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
        <div class="card-body filter-accord-card">
           <div class="filter-item">
            <label class="cust-checkbox-container">Permanent
                <input  onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="EmergingTalent"
                                                value="Permanent"
                                             <?= checkCheckboxValue(post('type'), 'Permanent') ?>>
                <span class="checkmark"></span>
            </label>
             <label class="cust-checkbox-container">Contract
                <input  onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="ContractTalent"
                                                value="Contract"
                                             <?= checkCheckboxValue(post('type'), 'Contract') ?>>
                <span class="checkmark"></span>
            </label>
            <label class="cust-checkbox-container">Temporary
                <input  onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="TemporaryTalent"
                                                value="Temporary"
                                             <?= checkCheckboxValue(post('type'), 'Temporary') ?>>
                <span class="checkmark"></span>
            </label>
            

        </div>
    </div>
</div>
</div>
</div>

<div class="filter-right-content" id="search_results_box">
    <?php 
    if(!empty($this->openprofiles)){
      foreach($this->openprofiles as $profile){
         ?>
         <div class="job-content-card  job-content-card-lg green-block">
            <h4 class="heading"><?= $profile->job_title;?></h4>
            <?php if(!empty($profile->locations)){?>
                <h6>location</h6>
                <span class="location-ico"><?php
                echo implode(", ", array_map(function ($location) {
                 return $location->location_name;
             },$profile->locations));  
         ?> </span>
     <?php }?>
     <!-- <span class="money-ico">£00.00</span> -->
     <div class="rep-cont">
      <h6>top 3 skills</h6>
      <h5><?= $profile->keywords;?></h5>
  </div>
  <p class="para-heading" ><?= reFilter(substr($profile->quote, 0,180)); ?></p>
  <a href="{URL:talent/<?= $profile->id;?>}" class="arrow-ico"></a>
</div>
<?php }} else {?>
 <div class="no-data"> No Data Found</div>
<?php }?>
</div>   
</div>

<?php  
if (!empty($this->total_pages) && $this->total_pages > 1) { ?>
    <div class="cust-pagination" id="pagination">
        <span class="prev" data-id="0"  id="prevPage" ><a href="#" class="back-arrow"></a></span>
        <?php for ($i=1; $i <= $this->total_pages; $i++): ?>
           <?php if ($i == 1): ?>    
            <span class="para-heading page-item disabled" id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="-1"><?= $i ?></a></span>
        <?php else: ?>
           <span class="para-heading page-item" id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="+1"><?= $i ?></a></span>
           
       <?php endif;?> 
   <?php endfor; ?> 
   <span class="next" data-id="2"  id="nextPage" >
       <a href="#" class="next-arrow "></a></span>   
   </div>
<?php } else { ?>
    <?php if (empty($this->openprofiles)) { ?>
      <center class="no-data no-data-job">
         <h4> No Result found</h4>
     </center>
 <?php } ?>
<?php } ?>
<input type="hidden" id="pageNumber" value="1">

</section>
<script>
  $(document).on('click','#pagination span',function(e) {
    e.preventDefault();
    $("#pagination span").removeClass('active');
    $(this).addClass('active');
    var curruntPage=$("#pageNumber").val();
    var pageNum = $(this).data('id');
    var nextpagenum=+pageNum+1;
    var prevpagenum=pageNum-1;
    $("#nextPage").attr('data-id', nextpagenum);
    $("#prevPage").attr('data-id', prevpagenum);
    $("#pageNumber").val(pageNum);
    var totalPage=$("#totalPage").val();
    if(curruntPage==0 ||curruntPage < 0){
        $("#prevPage").addClass('disabled');
        return false;    
    }else if(prevpagenum==totalPage ||prevpagenum >totalPage ){
        $("#nextPage").addClass('disabled');
        return false;
    }else{
     ajaxPagination();  
 };
});


  function ajaxPagination() {
   let location = [];
   $('.locationCheck:checkbox:checked').each(function(i) {
      location[i] = $(this).val();
  });


   let type = [];
   $('.typeCheck:checkbox:checked').each(function(i) {
      type[i] = $(this).val();
  });
   let keywords = $("#keywords").val();
   if (typeof keywords === "undefined") {
      keywords = "";
  }
   let page = $("#pageNumber").val();  
$.ajax({
  type: 'POST',
  url: '{URL:/talentsearch}',
  data: 'keywords=' + keywords + '&location=' + location + '&page=' + page + '&type=' +type,          
  success: function(response) {
     jsonObj = $.parseJSON(response);
         $('html, body').animate({ 'scrollTop' : $("#search_results_box").position().top - 10 });
         $('#search_results_box').html(jsonObj.html);
         $('#pagination').html(jsonObj.pagination);
         $('.page-item').removeClass('active');
         var pageNum=$("#pageNumber").val();
         var totalPage=$("#totalPage").val();
         if(pageNum!=totalPage ||pageNum < totalPage ){
            var nextpagenum=+pageNum+1;
            $("#nextPage").attr('data-id', nextpagenum);
        }

        if(pageNum !=0 ||pageNum > 0){
           var prevpagenum=pageNum-1;   
           $("#prevPage").attr('data-id',prevpagenum);  
       }

   }
});
}
</script>