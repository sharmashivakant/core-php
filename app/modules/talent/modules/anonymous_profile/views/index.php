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
        top: 75px;
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

<section class="head-inner">
        <span class="pattern_6" data-aos="fade-right" data-aos-duration="1500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 204.897 204.899">
              <path id="pattern_6" data-name="pattern_6"
                    d="M1405.292,836.8H1379.53A171.339,171.339,0,0,1,1208.192,665.46V639.7a7.8,7.8,0,0,1,7.8-7.8h58.064a7.8,7.8,0,0,1,7.8,7.8v25.761a97.681,97.681,0,0,0,97.681,97.681h25.761a7.8,7.8,0,0,1,7.8,7.8V829A7.8,7.8,0,0,1,1405.292,836.8Z"
                    transform="translate(-1208.192 -631.9)"/>
            </svg>
        </span>
    <span class="pattern_7" data-aos="fade-down" data-aos-duration="1500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 143.917 143.914">
              <path id="pattern_7" data-name="pattern_7"
                    d="M1550,370.091V337.7a9.054,9.054,0,0,0-9.054-9.055h-32.387a9.054,9.054,0,0,1-9.055-9.054V294.782a9.055,9.055,0,0,1,9.055-9.055h32.387a9.054,9.054,0,0,0,9.054-9.055V244.286a9.055,9.055,0,0,1,9.055-9.054h24.813a9.055,9.055,0,0,1,9.055,9.054v32.387a9.055,9.055,0,0,0,9.055,9.055h32.39a9.055,9.055,0,0,1,9.055,9.055V319.6a9.054,9.054,0,0,1-9.055,9.054h-32.39a9.055,9.055,0,0,0-9.055,9.055v32.387a9.055,9.055,0,0,1-9.055,9.055h-24.813A9.055,9.055,0,0,1,1550,370.091Z"
                    transform="translate(-1499.509 -235.232)"/>
            </svg>
        </span>
    <span class="pattern_8" data-aos="fade-down" data-aos-duration="1500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 263.157 263.157">
              <path id="pattern_8" data-name="pattern_8"
                    d="M1310.64,498.01c-72.552,0-131.578-59.026-131.578-131.579s59.026-131.578,131.578-131.578,131.579,59.026,131.579,131.578S1383.193,498.01,1310.64,498.01Zm0-195.614a64.036,64.036,0,1,0,64.036,64.035A64.108,64.108,0,0,0,1310.64,302.4Z"
                    transform="translate(-1179.062 -234.853)"/>
            </svg>
        </span>
    <span class="pattern_9" data-aos="fade-left" data-aos-duration="1500">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 262.973 263.157">
              <path id="pattern_9" data-name="pattern_9"
                    d="M1067.049,234.853H913.717A54.821,54.821,0,0,0,858.9,289.674V443.189a54.821,54.821,0,0,0,54.821,54.821h153.332a54.821,54.821,0,0,0,54.82-54.821V289.674A54.821,54.821,0,0,0,1067.049,234.853Zm2.252,192.471a18.081,18.081,0,0,1-18.08,18.081H929.545a18.081,18.081,0,0,1-18.081-18.081V305.539a18.082,18.082,0,0,1,18.081-18.082h121.676a18.081,18.081,0,0,1,18.08,18.082Z"
                    transform="translate(-858.896 -234.853)"/>
            </svg>
        </span>
    <header class="header">
        <div class="fixed">
            <div class="top-line">
                <a class="logo_2" href="{URL:/}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 114.946 114.945">
                        <g id="logo_2" data-name="logo_2" transform="translate(-1208.564 -184.28)">
                            <path id="logo_2_1" data-name="logo_2_1"
                                  d="M1473.2,259.673a6.117,6.117,0,0,0-4.309-1.431h-5.8v10.591h5.644a6.275,6.275,0,0,0,4.346-1.4,4.87,4.87,0,0,0,1.565-3.828A5.2,5.2,0,0,0,1473.2,259.673Z"
                                  transform="translate(-170.315 -49.49)" fill-rule="evenodd"/>
                            <path id="logo_2_2" data-name="logo_2_2"
                                  d="M1309.252,184.28h-86.431a14.3,14.3,0,0,0-14.257,14.257v86.431a14.3,14.3,0,0,0,14.257,14.257h86.431a14.3,14.3,0,0,0,14.257-14.257V198.537A14.3,14.3,0,0,0,1309.252,184.28Zm-90.1,20.022h25.1v4.45h-9.865v27.189h-5.459V208.752h-9.775Zm17.4,63.259V279.2h-5.764V267.56l-11.095-20h6.376l7.6,15,7.608-15h6.353Zm15.479-63.259h5.5v13.172h14.144V204.3h5.473v31.64h-5.473V221.924h-14.144v14.018h-5.5Zm17.847,74.9h-5.563l-11.846-31.64h6.283l8.313,24.75,8.4-24.75h6.306Zm41.019,0H1289.3v-31.64h21.445v4.45h-15.7v8.722h13.574V265.1h-13.574v9.7H1310.9Zm.233-43.263h-5.889l-6.341-12.149h-6.126v12.149h-5.5V204.3h11.125q5.474,0,8.448,2.462a8.694,8.694,0,0,1,2.981,7.113,8.915,8.915,0,0,1-1.535,5.325,9.78,9.78,0,0,1-4.272,3.3l7.105,13.157Z"
                                  transform="translate(0 0)" fill-rule="evenodd"/>
                        </g>
                    </svg>
                </a>
                <a class="btn-chat" href="{URL:contact-us}">Fancy a chat?</a>
            </div>
        </div>
    </header>
    <div class="fixed">
        <div class="fixed_2">
            <h3 class="title-name-page fade-scroll top-scroll" data-scroll>Talent Search</h3>
            <h1 class="title-page fade-scroll top-scroll" data-scroll>Browse and search some of our active candidates.</h1>
        </div>
    </div>
</section>

<!-- SEARCH -->
<div class="skill-sec" data-select2-id="5">
    <div class="fixed" data-select2-id="4">
        <div class="fixed_2">

            <div class="skill-inner">
                <form onsubmit="return search();" id="search_form">
                    <ul>

                        <li>
                            <h3>
                            Skills / Keywords
                            <i class="fa fa-info-circle form-tooltip"
                               title='To search for a specific phrase please use speech marks. E.G "PHP Developer"'></i>
                            </h3>
                            <div class="si-text-field">
                                <input class="fj-text-field" type="text" id="keywords" name="keywords">
                            </div>
                        </li>
                        <li>
                            <h3>
                                Postcode/Zip
                                <i class="fa fa-info-circle form-tooltip"
                                   title="Please start typing a postcode and select from the dropdown list"
                                   aria-hidden="true"></i><span class="sr-only">Please start typing a postcode and select from the dropdown list</span>
                            </h3>
                            <div class="si-text-field">
                                <input class="fj-text-field" type="text" name="postcode" id="postcode" onkeyup="suggestPostcode(this);">
                                <div class="suggests_result"></div>
                            </div>
                        </li>
                        <li class="form-advanced" style="display: none;">
                            <h3>
                                Languages Spoken
                            </h3>
                            <select id="languages-spoken" name="language" class="select">
                                <option value=""></option>
                                <?php if (is_array($this->languages) && count($this->languages) > 0) { ?>
                                    <?php foreach ($this->languages as $item) { ?>
                                        <option value="<?= $item->id ?>"><?= $item->name?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="form-advanced" style="display: none;">
                            <h3>
                                Maximum Salary / Day Rate <span>($)</span>
                                <i class="fa fa-info-circle form-tooltip"
                                   title="Please type in the maximum Salary or Day Rate you are willing to pay to the nearest $. Eg - simply type 50000 if you are willing to pay up to $ 50000 per annum."
                                   aria-hidden="true"></i><span class="sr-only">Please type in the maximum Salary or Day Rate you are willing to pay to the nearest $. Eg - simply type 50000 if you are willing to pay up to $ 50000 per annum.</span>
                            </h3>
                            <div class="si-text-field">
                                <input class="fj-text-field" type="number" pattern="^[0-9]*$" class="search-input" name="salary" id="salary">
                            </div>

                        </li>
                        <li class="form-advanced" style="display: none;">
                            <h3>&nbsp;

                            </h3>
                            <select id="salary_term" tabindex="-1" name="salary_term" class="select">
                                <option value="annum">Per Annum</option>
                                <option value="day">Per Day</option>
                                <option value="hour">Per Hour</option>
                            </select>
                        </li>
                        <li>
                            <div class="skill-btn-block">
                                <button type="submit"  class="btn" onclick="load('search-anon-profile', 'form:#search_form'); return false;">search candidates</button>
                                <a type="reset" href="{URL:talent/anonymous_profile}" class="btn">reset search</a>
                            </div>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </form>
            </div>
            <a href="#" onclick="advanced_search_form();" class="advance-link" id="advanced-search">advanced search</a>

        </div>
    </div>
</div>

<!-- RESULTS -->
<div class="develop-sec">
    <div class="fixed">
        <div class="fixed_2">

            <div class="develop-cont">
                <ul id="anonymous-profiles">
                    <?php if (is_array($this->list) && count($this->list) > 0) { ?>
                        <?php foreach ($this->list as $item) { ?>
                            <li>
                                <div class="box-sec">
                                    <h2 class="title-small"><?= $item->job_title ?></h2>
                                    <ul>
                                        <li>
                                            <p class="bs-title">Salary / Rate Required:</p>
                                            <p class="bs-title-cont"><?= SalaryJoin($item->annual_currency, $item->min_annual_salary,
                                                    $item->daily_currency, $item->min_daily_salary, $item->hourly_currency, $item->min_hourly_salary) ?></p>
                                        </li>
                                        <li>
                                            <p class="bs-title">Skills:</p>
                                            <p class="bs-title-cont"><?= str_replace(',', ', ', $item->keywords) ?></p>
                                        </li>
                                        <li>
                                            <p class="bs-title">Current Location:</p>
                                            <p class="bs-title-cont">
                                                <?= implode(", ", array_map(function ($location) {
                                                        return $location->location_name;
                                                    }, $item->locations )
                                                ); ?>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="bs-title">Contract Preference:</p>
                                            <p class="bs-title-cont"><?= ucfirst($item->contract) ?></p>
                                        </li>
                                    </ul>

                                    <div class="box-bottom-line">
                                        <div class="bs-flex">
                                            <h2 class="bs-sub-head">Represented by<br><?= $item->consultant->firstname . ' ' .  $item->consultant->lastname?></h2>
                                            <div class="bs-pic">
                                                <div style="background-image: url(<?= _SITEDIR_ ?>data/users/<?= $item->consultant->image ?>)"></div>
                                            </div>
                                        </div>
                                        <a href="{URL:talent/anonymous_profile/<?= $item->id ?>}" class="btn-center btn-yellow">View Candidate</a>
                                    </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>

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
                        <a href="#" data-toggle="modal"  onclick="load('candidate-alert'); return false;" class="">register candidate alert</a>
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
