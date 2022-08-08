<style>
    .w-dropdown-list a {
        cursor: pointer;
    }
    .w-dropdown {
        width: 100%;
    }

    .suggests_wrap {
        position: relative;
        z-index: 9999;
    }

    .suggests_result {
        position: absolute;
        top: 95px;
        left: 0;
        right: 0;
        background-color: white;
        width: 100%;
        min-height: 0;
        max-height: 300px;
        /*margin-top: -10px;*/
        border: 1px solid #2FAADF;
        border-radius: 10px;
        box-sizing: border-box;
        overflow-y: auto;
        z-index: 99999;
    }

    .suggests_result:empty {
        display: none;
    }

    .suggests_result .pc-item {
        padding: 0 20px;
        line-height: 60px;
        font-size: 20px;
    }

    .suggests_result .pc-item:hover {
        background-color: #2FAADF;
        color: white;
        cursor: pointer;
    }

    .hide {
        display: none;
    }
    #tags {
  float: left;
  border: 1px solid #ccc;
  padding: 0px;
  font-family: Arial;
}

#tags span.tag {
  cursor: pointer;
  display: block;
  float: left;
  color: #555;
 	background-color: #e4e4e4;
 color:#707070;
  padding: 5px 10px;
  padding-right: 30px;
  margin: 4px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
	background-color: #e4e4e4;
	border: 1px solid #ebedf2;
	border-radius: 4px;
	cursor: default;
	float: left;
	margin-right: 5px;
	margin-top: 5px;
	padding: 0 5px;
}

#tags span.tag:hover {
  opacity: 0.7;
}

#tags span.tag::after {
	position: absolute;
	content: "×";
	/* border: 1px solid; */
	border-radius: 10px;
	padding: 0 4px;
	margin: 0px 0 10px 7px;
	font-size: 20px;
}

#tags input {
	background: #fff;
	border: 0;
	margin: 4px;
	padding: 7px 0px;
	width: auto;
	color: #707070;
}
</style>
<script>
    function fillPostcode(el) {
        var code = trim($(el).text());
        $('#postcode').val(code);
        $('.suggests_result').html('');
    }

    function closeSuggest() {
        $('.suggests_result').html('');
    }

    function suggestPostcode(el) {
        if (trim($(el).val())) {
            load('panel/talents/open_profiles/postcode', 'postcode#postcode');
            console.log('suggestPostcode');
        }
    }
</script>

<span class="close-popup" onclick="closePopup();"><span class="icon-close" onclick="closePopup();"></span></span>

<h4 class="title-popup">Register Candidate Alert</h4>
<form id="apply_form" class="popup-form">
    <div class="pf-flex">
        <div class="pf-column">
            <div class="pf-row">
                <label class="pf-label">Your Name</label>
                <input class="pf-text-field" type="text" name="name">
            </div>
            <div class="pf-row">
                <label class="pf-label">Company Name</label>
                <input class="pf-text-field" type="text" name="company_name">
            </div>
            <div class="pf-row" style="position: relative;">
                <label class="pf-label">Postcode/Zip</label>
                <input class="pf-text-field" type="text" name="postcode" id="postcode" placeholder="Please start typing a postcode">
                <!--onkeyup="suggestPostcode(this);"-->
                <div class="suggests_result"></div>
            </div>
            <div class="pf-row">
                <select id="salary_term" tabindex="-1" name="salary_term" class="select pf-text-field">
                    <option value="annum">Per Annum</option>
                    <option value="day">Per Day</option>
                </select>
            </div>
        </div>
        <div class="pf-column">
            <div class="pf-row">
                <label class="pf-label">Email</label>
                <input class="pf-text-field" type="text" name="email" placeholder="Type your email">
            </div>
            <div class="pf-row">
                <label class="pf-label">Skill / Keywords</label>
               <div id="tags">
  
  <input type="text" value="" name="" placeholder="" />
</div>
  
  <!--<input class=" " name="skills_keywords">-->

<!--<div class="clearfix"></div>-->
       <!-- <input class="pf-text-field" type="text" name="skills_keywords" id="tavgs" placeholder="Skill 1, Skill 2, ...">-->
              <!--<select class="pf-text-field form-control tagging" multiple="multiple" id="skills_keywords" name="skills_keywords">
                                
                            </select>-->
            </div>
            <div class="pf-row">
                <label class="pf-label">Max Salary / Day Rate Required</label>
                <input class="pf-text-field" type="number" name="max_salary">
            </div>
        </div>
    </div>

    <label class="checkBox">
        <input type="checkbox" name="check" value="yes">
        <span class="check-title">I consent for The <?= SITE_NAME; ?> to contact me with further information</span>
    </label>

    <button class="outline-grey-btn" type="submit" onclick="load('open-candidate-alert/<?= $this->profile->id; ?>', 'form:#apply_form'); return false;">SUBMIT</button>
</form>
<script src="<?= _SITEDIR_ ?>public/js/backend/select2.min.js"></script>

<script>
    $("body").addClass('popup-open');
    
   jQuery(function($) {

  $('#tags input').on('blur', function() {
    var txt = this.value.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list
     
   if (txt) $(this).before('<span class="tag">' + txt + '<input type="hidden" name="skills_keywords[]" value="'+txt+'"></span>');
    //if (txt) $(this).before('<input  class="tag" name="" value="' + txt + '">');
    this.value = "";
   // this.focus();
  }).on('keyup', function(e) {
    // comma|enter (add more keyCodes delimited with | pipe)
    if (/(188|13)/.test(e.which)) $(this).trigger('focusout');
  });

  $('#tags').on('click', '.tag', function() {
    if (confirm("Really delete this tag?")) $(this).remove();
  });

});
</script>