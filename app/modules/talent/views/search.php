<section class="head-block mar head-block-small"><!-- style="background-image: url('<?= _SITEDIR_?>public/images/head-inner_bg5.jpg')"-->
    <div class="fixed">
        <div class="head-cont">
            <div>
                <div class="gen-title"><span>Talent Search</span></div>
                <br>
                <div class="gen-title-name">Browse and search some of our active candidates.</div>
            </div>
        </div>
    </div>
</section>

<!-- SEARCH -->
<div class="skill-sec" data-select2-id="5">
    <div class="fixed" data-select2-id="4">

        <div class="skill-inner">
            <form onsubmit="return search();">
                <ul>

                    <li>
                        <h3>
                            Postcode/Zip
                            <i class="fa fa-info-circle form-tooltip"
                               title="Please start typing a postcode and select from the dropdown list"
                               aria-hidden="true"></i><span class="sr-only">Please start typing a postcode and select from the dropdown list</span>
                        </h3>
                        <div class="si-text-field">
                            <input type="text">
                        </div>
                    </li>
                    <li class="form-advanced" style="display: none;">
                        <h3>
                            Languages Spoken
                        </h3>
                        <select id="languages-spoken" tabindex="-1" class="select">
                            <option>English</option>
                            <option>Mandarin</option>
                            <option>Hindi</option>
                            <option>Spanish</option>
                            <option>Arabic</option>
                        </select>
                        <!--
                        <select id="languages-spoken" tabindex="-1" class="selectized" style="display: none;">
                            <option value="4" selected="selected">Spanish</option>
                        </select>
                        <div class="selectize-control single">

                            <div class="selectize-input items has-options full has-items">
                                <div class="item" data-value="4">Spanish</div>
                                <input type="select-one" autocomplete="off" tabindex="" id="languages-spoken-selectized"
                                       style="width: 4px; opacity: 0; position: absolute; left: -10000px;"></div>
                            <div class="selectize-dropdown single"
                                 style="display: none; visibility: visible; width: 518.086px; top: 41.9922px; left: 0px;">
                                <div class="selectize-dropdown-content">
                                    <div class="option" data-selectable="" data-value="1">English</div>
                                    <div class="option" data-selectable="" data-value="2">Mandarin</div>
                                    <div class="option" data-selectable="" data-value="3">Hindi</div>
                                    <div class="option selected active" data-selectable="" data-value="4">Spanish</div>
                                    <div class="option" data-selectable="" data-value="5">Arabic</div>
                                    <div class="option" data-selectable="" data-value="6">Portuguese</div>
                                    <div class="option" data-selectable="" data-value="7">Bengali</div>
                                    <div class="option" data-selectable="" data-value="8">Russian</div>
                                    <div class="option" data-selectable="" data-value="9">Japanese</div>
                                    <div class="option" data-selectable="" data-value="10">German</div>
                                    <div class="option" data-selectable="" data-value="11">Panjabi</div>
                                    <div class="option" data-selectable="" data-value="12">Javanese</div>
                                    <div class="option" data-selectable="" data-value="13">Korean</div>
                                    <div class="option" data-selectable="" data-value="14">Vietnamese</div>
                                    <div class="option" data-selectable="" data-value="15">Telugu</div>
                                    <div class="option" data-selectable="" data-value="16">Marathi</div>
                                    <div class="option" data-selectable="" data-value="17">Tamil</div>
                                    <div class="option" data-selectable="" data-value="18">French</div>
                                    <div class="option" data-selectable="" data-value="19">Urdu</div>
                                    <div class="option" data-selectable="" data-value="20">Italian</div>
                                    <div class="option" data-selectable="" data-value="21">Turkish</div>
                                    <div class="option" data-selectable="" data-value="22">Persian</div>
                                    <div class="option" data-selectable="" data-value="23">Gujarati</div>
                                    <div class="option" data-selectable="" data-value="24">Polish</div>
                                    <div class="option" data-selectable="" data-value="25">Ukrainian</div>
                                    <div class="option" data-selectable="" data-value="26">Malayalam</div>
                                    <div class="option" data-selectable="" data-value="27">Kannada</div>
                                    <div class="option" data-selectable="" data-value="28">Oriya</div>
                                    <div class="option" data-selectable="" data-value="29">Burmese</div>
                                    <div class="option" data-selectable="" data-value="30">Thai</div>
                                </div>
                            </div>

                        </div> -->
                    </li>
                    <li class="form-advanced" style="display: none;">
                        <h3>
                            Maximum Salary / Day Rate <span>($)</span>
                            <i class="fa fa-info-circle form-tooltip"
                               title="Please type in the maximum Salary or Day Rate you are willing to pay to the nearest $. Eg - simply type 50000 if you are willing to pay up to $ 50000 per annum."
                               aria-hidden="true"></i><span class="sr-only">Please type in the maximum Salary or Day Rate you are willing to pay to the nearest $. Eg - simply type 50000 if you are willing to pay up to $ 50000 per annum.</span>
                        </h3>
                        <div class="si-text-field">
                            <input type="number" pattern="^[0-9]*$" class="search-input" id="salary">
                        </div>

                    </li>
                    <li class="form-advanced" style="display: none;">
                        <h3>&nbsp;

                        </h3>
                        <select id="salary_term" tabindex="-1" class="select">
                            <option>Per Annum</option>
                            <option>Per Day</option>
                            <option>Per Hour</option>
                        </select>
                        <!--
                        <select id="salary_term" tabindex="-1" class="selectized" style="display: none;">
                            <option value="annum" selected="selected">Per Annum</option>
                        </select>
                        <div class="selectize-control single">
                            <div class="selectize-input items full has-options has-items">
                                <div class="item" data-value="annum">Per Annum</div>
                                <input type="select-one" autocomplete="off" tabindex="" id="salary_term-selectized"
                                       style="width: 4px; opacity: 0; position: absolute; left: -10000px;"></div>
                            <div class="selectize-dropdown single"
                                 style="display: none; visibility: visible; width: 518.086px; top: 41.9922px; left: 0px;">
                                <div class="selectize-dropdown-content">
                                    <div class="option selected" data-selectable="" data-value="annum">Per Annum</div>
                                    <div class="option" data-selectable="" data-value="day">Per Day</div>
                                    <div class="option" data-selectable="" data-value="hour">Per Hour</div>
                                </div>
                            </div>
                        </div>
                        -->
                    </li>
                    <li>
                        <button type="submit"  class="btn-yellow">search candidates</button>
                        <button type="reset" onclick="reset_form();" class="btn-yellow">reset search</button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </form>
        </div>
        <a href="#" onclick="advanced_search_form();" class="advance-link" id="advanced-search">advanced search</a>
    </div>
</div>

<!-- RESULTS -->
<div class="develop-sec">
    <div class="fixed">
        <div class="develop-cont">
            <ul id="anonymous-profiles">
                <li>
                    <div class="box-sec">
                        <h2 class="title-small">Assistant Controller</h2>
                        <ul>
                            <li>
                                <p class="bs-title">Salary / Rate Required:</p>
                                <p class="bs-title-cont">$120000 per annum<br>$65000 per hour</p>
                            </li>
                            <li>
                                <p class="bs-title">Skills:</p>
                                <p class="bs-title-cont">SEC Reporting, SOX Internal Controls, General Ledger Accounting</p>
                            </li>
                            <li>
                                <p class="bs-title">Current Location:</p>
                                <p class="bs-title-cont">Massachusetts</p>
                            </li>
                            <li>
                                <p class="bs-title">Contract Preference:</p>
                                <p class="bs-title-cont capitalise">both</p>
                            </li>
                        </ul>
                        <div class="box-bottom-line">
                            <div class="bs-flex">
                                <h2 class="bs-sub-head">Represented by<br>John Gouthro</h2>
                                <div class="bs-pic">
                                    <div style="background-image: url(http://www.bolddev.co.uk/incendia/talent/uploads/images/e4737ba57021d2e88eee07ee1c33dbf1.jpg)"></div>
                                </div>
                            </div>
                            <a href="http://www.bolddev.co.uk/incendia/talent/anonymous_profiles/view/2" class="btn-center btn-yellow">view candidate</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box-sec">
                        <h2 class="title-small">Ruby software test</h2>
                        <ul>
                            <li>
                                <p class="bs-title">Salary / Rate Required:</p>
                                <p class="bs-title-cont">£10 per annum<br>£5 per day<br>£3 per hour</p>
                            </li>
                            <li>
                                <p class="bs-title">Skills:</p>
                                <p class="bs-title-cont">ruby, rails, php</p>
                            </li>
                            <li><p class="bs-title">Current Location:</p>
                                <p class="bs-title-cont">leeds</p>
                            </li>
                            <li>
                                <p class="bs-title">Contract Preference:</p>
                                <p class="bs-title-cont capitalise">permanent</p>
                            </li>
                        </ul>
                        <div class="box-bottom-line">
                        <div class="bs-flex">
                            <h2 class="bs-sub-head">Represented by<br>tom Wilde</h2>
                            <div class="bs-pic">
                                <div style="background-image: url(http://www.bolddev.co.uk/incendia/talent/uploads/images/94adc0f01973cb20c2588d26cebea8eb.png)"></div>
                            </div>
                        </div>
                        <a href="http://www.bolddev.co.uk/incendia/talent/anonymous_profiles/view/1" class="btn-yellow btn-center">view candidate</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- INFO -->
<div class="candidate-sec">
    <div class="container">
        <div class="candidate-cont">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="sub-head">Are you a hiring manager<br> looking for that perfect candidate?</h1>
                    <br>
                    <p>Then browse and search to view our active candidates.</p>
                </div>
                <div class="col-md-6 col-12">
                    <div class="cc-flex">
                        <h1 class="sub-head">Can't find that  perfect candidate?</h1>
                        <a href="#" data-toggle="modal" data-target="#candidate_alert" class="btn-yellow btn-inline">register candidate alert</a>
                    </div>
                    <p>Simply sign up for "candidate alerts" here, and as soon as we find your ideal candidate profile, you'll immediately be alerted!</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function advanced_search_form() {
        if ($('#advanced-search').text() == 'advanced search')
            $('#advanced-search').text('simple search');
        else
            $('#advanced-search').text('advanced search');
        $('.form-advanced').toggle();
    }
</script>