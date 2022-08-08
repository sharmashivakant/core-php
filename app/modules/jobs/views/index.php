<section class="inner-banner">
        <div class="cust-container">
            <h2>Current Jobs</h2>
        </div>
    </section>

    <section class="cust-search-block cust-container">
        <form action="" method="" id="search_form">
        <div class="cust-search-row cust-form">
            <h4>Keyword Search</h4>
            <div class="input-group search-box">
                <input type="text" class="form-control" placeholder="Search Jobs" id="keywords" name="keywords" value="<?= post('keywords') ?>">
                <div class="input-group-append search-ico">
                    <button onclick="load('jobs', 'form:#search_form'); return false;" class="search-btn" type="button">
                    </button>
                </div>
            </div>
        </div>
        </form>
    </section>

    <section class="filter-block yellow-filter cust-container">
        <div class="filter-block-row">

            <div id="accordion" class="filter-accord">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <button class="btn btn-link filter-collapse-btn" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5>Industry
</h5>
                        </button>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                        <div class="card-body filter-accord-card">
                            <div class="filter-item">
                                 <?php foreach ($this->sectors as $key => $item) { ?>
                                <label class="cust-checkbox-container"><?= $item->name ?>
                                    <input onclick="ajaxPagination ();" type="checkbox" name="sector[]" class="sectorCheck" id="checkbox-<?= $key ?>" value="<?= $item->id ?>" <?= (post('sector')) ? in_array($item->id, post('sector')) ? 'checked' : '' : '' ?>>
                                    <span class="checkmark"></span>
                                </label>
                                 <?php } ?>              
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingTwo">

                        <button class="btn btn-link filter-collapse-btn" data-toggle="collapse"
                            data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <h5>Location
</h5>
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
                            <h5> Contract/Perm or any
</h5>
                        </button>

                    </div>
                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree">
                        <div class="card-body filter-accord-card">
                      <div class="filter-item">
                                <label class="cust-checkbox-container">Permanent
                                    <input  onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="type-permanent"
                                                value="permanent"
                                             <?= checkCheckboxValue(post('type'), 'permanent') ?>>
                                         <span class="checkmark"></span>
                                </label>  

                                <label class="cust-checkbox-container">Contract
                                    <input onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="type-contract"
                                                value="contract"
                                             <?= checkCheckboxValue(post('type'), 'contract') ?>>
                                         <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">Temporary
                                    <input onclick="ajaxPagination ();" type="checkbox" name="type[]" class="typeCheck" id="type-contract"
                                                value="temporary"
                                             <?= checkCheckboxValue(post('type'), 'contract') ?>>
                                         <span class="checkmark"></span>     
                                </label>

                            </div>
                            </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingfour">

                        <button class="btn btn-link filter-collapse-btn" data-toggle="collapse"
                            data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                            <h5>Salary/Rate</h5>
                        </button>

                    </div>
                    <div id="collapsefour" class="collapse show" aria-labelledby="headingfour">
                        <div class="card-body filter-accord-card">
                               <div class="filter-item">
                                <label class="cust-checkbox-container">£0 - £10,000
                                   <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary1" value="0-10000"
                                             <?= (post('salary')) ? in_array('0-10000', post('salary')) ? 'checked' : '' : '' ?>>
                                         <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£10,000 - £20,000
                                    <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary2" value="10001-20000"
                                             <?= (post('salary')) ? in_array('10001-20000', post('salary')) ? 'checked' : '' : '' ?>>
                                         <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£20,000 - £30,000
                                    <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary3" value="20001-30000"
                                             <?= (post('salary')) ? in_array('20001-30000', post('salary')) ? 'checked' : '' : '' ?>>
                                         <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£30,000 - £40,000
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary4" value="30001-40000"
                                             <?= (post('salary')) ? in_array('30001-40000', post('salary')) ? 'checked' : '' : '' ?>>
                                         <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£40,000 - £50,000
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="40001-50000"
                                             <?= (post('salary')) ? in_array('40001-50000', post('salary')) ? 'checked' : '' : '' ?>>
                                             <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£50,000 - £60,000
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="50001-60000"
                                             <?= (post('salary')) ? in_array('50001-60000', post('salary')) ? 'checked' : '' : '' ?>>
                                             <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£70,000 - £80,000
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="70001-80000"
                                             <?= (post('salary')) ? in_array('70001-80000', post('salary')) ? 'checked' : '' : '' ?>>
                                             <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£80,000 - £90,000
                                    <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="80001-90000"
                                             <?= (post('salary')) ? in_array('80001-90000', post('salary')) ? 'checked' : '' : '' ?>>
                                             <span class="checkmark"></span>
                                </label>

                                <label class="cust-checkbox-container">£90,000 - £100,000
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="90001-100000"
                                             <?= (post('salary')) ? in_array('90001-100000', post('salary')) ? 'checked' : '' : '' ?>>
                                             <span class="checkmark"></span>
                                </label>
                                <label class="cust-checkbox-container">£100k +
                                     <input onclick="ajaxPagination ();" class="salaryCheck" type="checkbox" name="salary[]" id="salary5" value="100001-1000000"
                                             <?= (post('salary')) ? in_array('100001-1000000', post('salary')) ? 'checked' : '' : '' ?>>
                                         <span class="checkmark"></span>
                                </label>
                            </div>
                     
                        </div>
                    </div>     
                </div>
            </div>

            <div class="filter-right-content" id="search_results_box">
                 <?php if($this->list): foreach ($this->list as $item) { ?>
                <div class="job-content-card  job-content-card-lg green-block">
                    <h4 class="heading"><?= $item->title ?></h4>
                    <span class="location-ico"><?php
                              echo implode(", ", array_map(function ($location) {
                               return $location->location_name;   
                            }, $item->locations)); 
                            ?></span>
                    <span class="money-ico">
                        <?php
                        if($item->salary_value!=''){?>
                            <?= (($item->salary_value) ? CURRENCY_SYMBOL.$item->salary_value : '00.00'); ?>
                       <?php  }else{?>
                        <?= (($item->salary_from) ? CURRENCY_SYMBOL.$item->salary_from . ' - ' : '')  . ( ($item->salary_to) ?CURRENCY_SYMBOL . $item->salary_to : ''); ?>
                    <?php }?></span>
                    <p class="para-heading" ><?= reFilter($item->content_short) ?></p>
                    <a href="{URL:job/<?= $item->slug; ?>}" class="arrow-ico"></a>
                </div>
            <?php }  endif; ?>  
            </div>
        </div>
<?php if (!empty($this->total_pages) && $this->total_pages > 1) { ?>
        <div class="cust-pagination" id="pagination">
            <span class="prev" data-id="0"  id="prevPage" ><a href="#" class="back-arrow"></a></span>
             <?php for ($i=1; $i <= $this->total_pages; $i++): ?>
                     <?php if ($i == 1): ?>
            <span class="para-heading page-item disabled" id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="-1"><?= $i ?></a></span>
             <?php else: ?>
                 <span class="para-heading page-item" id="pageContent<?= $i ?>" data-id="<?= $i ?>"><a class="page-link" href="javascript:void(0)" tabindex="-1"><?= $i ?></a></span>
           
            <?php endif;?> 
            <?php endfor; ?> 
             <span class="next" data-id="2"  id="nextPage" >
             <a href="#" class="next-arrow "></a></span>
             </div>
             <?php } else { ?>
            <?php if (empty($this->list)) { ?>
             <!-- <center class="no-data no-data-job">
               <h4> No Result found</h4>
            </center>-->
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
       
       $(".no-record").html('');
        $(".no-data no-data-job").html('');
     let salary = "";

     let sectors = [];
     $('.sectorCheck:checkbox:checked').each(function(i) {
      sectors[i] = $(this).val();
   });

     let location = [];
     $('.locationCheck:checkbox:checked').each(function(i) {
      location[i] = $(this).val();
   });

     let salary_range = [];
     $('.salaryCheck:checkbox:checked').each(function(i) {
      salary_range[i] = $(this).val();
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
      url: '{URL:jobs/search}',
      data: 'sector=' + sectors + '&keywords=' + keywords + '&location=' + location + '&salary=' + salary_range + '&page=' + page + '&type=' + type,
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
          $("#prevPage").attr('data-id', prevpagenum);
      }
      }
   });
}
</script>