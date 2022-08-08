<div class="shadow-bottom"></div>
<ul class="list-unstyled menu-categories" id="accordionExample">

    <li class="menu">
        <a <?= activeIF(['panel'], 'index', 'data-active="true" aria-expanded="false"') ?> href="{URL:panel}" class="dropdown-toggle">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Dashboard</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a <?= $show = activeIF(['content_pages', 'categories', 'blog', 'testimonials', 'event_card', 'case_studies', 'client_logos', 'employer_page_logos', 'home_page_images', 'cititec_way', 'communities', 'cititec_benefits'], false, 'data-active="true" aria-expanded="true"') ?> href="#tab_content_manager" data-toggle="collapse" class="dropdown-toggle">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-monitor">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                <span>Content Management</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_content_manager" data-parent="#accordionExample">
            <li class="<?= activeIF('content_pages', false, 'active') ?>">
                <a href="{URL:panel/content_pages}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>-->
                    Content Pages
                </a>
            </li>
          <li class="">
                <a href="{URL:panel/blog/categories}">
                    Blog Categories
                </a>
            </li>
            <li class="<?= activeIF('blog', false, 'active') ?>">
                <a href="{URL:panel/blog}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>-->
                    Blog / News
                </a>
            </li>
            <!--<li class="<?= activeIF('testimonials', false, 'active') ?>">
                <a href="{URL:panel/testimonials}">
                    Testimonials
                </a>
            </li>
            <li class="<?= activeIF('client_logos', false, 'active') ?>">
                <a href="{URL:panel/client_logos}">
                    Client Logos
                </a>
            </li>
            <!-- <li class="<?= activeIF('thor_journeys', false, 'active') ?>">
                <a href="{URL:panel/thor_journeys}">
                    Thor Journeys
                </a>
            </li> -->
            <!-- <li class="<?= activeIF('home_page_images', false, 'active') ?>">
        <a href="{URL:panel/home_page_images}">
         Commitment Images
        </a>
    </li>
    <li class="<?= activeIF('cititec_way', false, 'active') ?>">
        <a href="{URL:panel/cititec_way}">
            The Cititec Way 
        </a>
    </li>
    <li class="<?= activeIF('communities', false, 'active') ?>">   
        <a href="{URL:panel/communities}">
            Communities  
        </a>
    </li>
    -->

            <!--  <li class="<?= activeIF('employer_page_logos', false, 'active') ?>">
        <a href="{URL:panel/employer_page_logos}">
            Employer Page Logos
        </a>
    </li> -->

            <!--  <li class="<?= activeIF('event_card', false, 'active') ?>">
        <a href="{URL:panel/event_card}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            Events
        </a>
    </li> -->

            <!-- <li class="<?= activeIF('case_studies', false, 'active') ?>">
        <a href="{URL:panel/case_studies}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Case Studies
        </a>
    </li>  -->

        </ul>
    </li>
    <li class="menu">
        <a <?= $show = activeIF(['services'], false, 'data-active="true" aria-expanded="false"') ?> href="#tab_product" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <span>Services Management</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_product" data-parent="#accordionExample">
            <li class="<?= activeIF('services', false, 'active') ?>">
                <a href="{URL:panel/Services}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>-->
                    Services Manager
                </a>
            </li>


        </ul>
    </li>
    <li class="menu">
        <a <?= $show = activeIF(['microsites'], false, 'data-active="true" aria-expanded="false"') ?> href="#tab_microsites" data-toggle="collapse" class="dropdown-toggle">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                <span>Client Microsites</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_microsites" data-parent="#accordionExample">
            <li class="<?= activeIF('microsites', false, 'active') ?>">
                <a href="{URL:panel/microsites}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>-->
                    Manage Microsites
                </a>
            </li>
        </ul>
    </li>
    <li class="menu">
        <a <?= $show = activeIF(['sectors', 'locations', 'vacancies'], false, 'data-active="true" aria-expanded="false"') ?> href="#tab_vacancy" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                </svg>
                <span>Vacancy Management</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_vacancy" data-parent="#accordionExample">
            <li class="<?= activeIF('vacancies', false, 'active') ?>">
                <a href="{URL:panel/vacancies}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>-->
                    Vacancy Manager
                </a>
            </li>
            <li class="<?= activeIF('sectors', false, 'active') ?>">
                <a href="{URL:panel/sectors}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-codesandbox"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline><polyline points="7.5 19.79 7.5 14.6 3 12"></polyline><polyline points="21 12 16.5 14.6 16.5 19.79"></polyline><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>-->
                    Sectors / Industries
                </a>
            </li>
            <li class="<?= activeIF('locations', false, 'active') ?>">
                <a href="{URL:panel/locations}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>-->
                    Locations
                </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a <?= $show = activeIF(['candidates', 'uploaded_vacancies', 'job_post_request'], ['index', 'submited_cv', 'employer_list', 'candidate_list'], 'data-active="true" aria-expanded="false"') ?> href="#tab_talent_pool" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <polyline points="17 11 19 13 23 9"></polyline>
                </svg>
                <span>Talent Pool</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_talent_pool" data-parent="#accordionExample">

            <li class="<?= activeIF('uploaded_vacancies', ['index'], 'active') ?>">
                <a href="{URL:panel/uploaded_vacancies}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>-->
                    Vacancy Applications
                </a>
            </li>
            <!-- <li class="<?= activeIF('job_post_request', ['index'], 'active') ?>">
        <a href="{URL:panel/job_post_request}">
            Job Post Request
        </a>
    </li>    -->
            <!--  <li class="<?= activeIF('uploaded_vacancies', 'submited_cv', 'active') ?>">
        <a href="{URL:panel/uploaded_vacancies/submited_cv}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
            Uploaded CVs
        </a>
    </li> -->
            <!-- <li class="<?= activeIF('uploaded_vacancies', 'employer_list', 'active') ?>">
        <a href="{URL:panel/uploaded_vacancies/employer_list}">
            Request from employer
        </a>
    </li> -->
            <!--  <li class="<?= activeIF('uploaded_vacancies', 'candidate_list', 'active') ?>">
        <a href="{URL:panel/uploaded_vacancies/candidate_list}">
            Request from candidate
        </a>
    </li> -->
        </ul>
    </li>
    <li class="menu">
        <a <?= $show = activeIF(['talents', 'skills', 'languages', 'your_tc', 'talent_requests', 'open_profiles', 'contract_requests', 'interview_requests', 'furtherinfo_requests', 'candidate_alerts', 'password_protection'], false, 'data-active="true" aria-expanded="false"') ?> href="#tab_talents" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <polyline points="17 11 19 13 23 9"></polyline>
                </svg>
                <span>Talent Vault</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_talents" data-parent="#accordionExample">
            <li class="<?= activeIF('your_tc', false, 'active') ?>">
                <a href="{URL:panel/talents/your_tc}">
                    Your Terms & Conditions
                </a>
            </li>

            <li class="<?= activeIF('open_profiles', false, 'active') ?>">
                <a href="{URL:panel/talents/open_profiles}">
                    Open Profiles
                </a>
            </li>
            <li class="<?= activeIF('talents/talent_requests/contract_requests', false, 'active') ?>">
                <a href="{URL:panel/talents/talent_requests/contract_requests}">
                    Talent Request Contract
                </a>
            </li>
            <li class="<?= activeIF('talents/talent_requests/interview_requests', false, 'active') ?>">
                <a href="{URL:panel/talents/talent_requests/interview_requests}">
                    Talent Request Interview
                </a>
            </li>
            <li class="<?= activeIF('talents/talent_requests/furtherinfo_requests', false, 'active') ?>">
                <a href="{URL:panel/talents/talent_requests/furtherinfo_requests}">
                    Talent Request Further Info
                </a>
            </li>

            <li class="<?= activeIF('candidate_alerts', false, 'active') ?>">
                <a href="{URL:panel/talents/candidate_alerts}">
                    Candidate Alerts
                </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a <?= $show = activeIF(['team'], false, 'data-active="true" aria-expanded="false"') ?> href="#tab_team" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Team Management</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_team" data-parent="#accordionExample">
            <li class="<?= activeIF('team', false, 'active') ?>">
                <a href="{URL:panel/team}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>-->
                    Team Manager
                </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a <?= $show = activeIF(['analytics', 'subscribers', 'panel'], false, 'data-active="true" aria-expanded="false"', (CONTROLLER == 'panel' && ACTION == 'logs') || !(CONTROLLER == 'panel')) ?> href="#tab_analytics" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart">
                    <line x1="12" y1="20" x2="12" y2="10"></line>
                    <line x1="18" y1="20" x2="18" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="16"></line>
                </svg>
                <span>Analytics & Reporting</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_analytics" data-parent="#accordionExample">
            <li class="<?= activeIF('analytics', 'index', 'active') ?>">
                <a href="{URL:panel/analytics}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>-->
                    Google Analytics
                </a>
            </li>
            <!--  <li class="<?= activeIF('subscribers', false, 'active') ?>">
        <a href="{URL:panel/analytics/subscribers}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
            Email Subscribers
        </a>
    </li> -->
            <li class="<?= activeIF('panel', 'logs', 'active') ?>">
                <a href="{URL:panel/logs}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>-->
                    Logs
                </a>
            </li>
            <li class="<?= activeIF('analytics', 'include_code', 'active') ?>">
                <a href="{URL:panel/analytics/include_code}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>-->
                    Include JS
                </a>
            </li>
        </ul>
    </li>

    <!--<li class="menu">
        <a <?= activeIF(['panel'], 'contact', 'data-active="true" aria-expanded="false"') ?> href="{URL:panel/contact}" class="dropdown-toggle">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                    <polyline points="17 11 19 13 23 9"></polyline>
                </svg>
                <span>Contact Forms</span>
            </div>
        </a>
    </li>-->

    <li class="menu">
        <a <?= $show = activeIF(['panel', 'data_generator', 'dashboard_settings', 'sitemap'], false, 'data-active="true" aria-expanded="false"', !(CONTROLLER == 'panel' && ACTION == 'index') && !(CONTROLLER == 'panel' && ACTION == 'logs')) ?> href="#tab_settings" data-toggle="collapse" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                    <circle cx="12" cy="12" r="3"></circle>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                </svg>
                <span>Settings</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="tab_settings" data-parent="#accordionExample">
            <li class="<?= activeIF('panel', 'setting', 'active') ?>">
                <a href="{URL:panel/setting}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>-->
                    Settings
                </a>
            </li>
            <li class="<?= activeIF('panel', 'modules', 'active') ?>">
                <a href="{URL:panel/modules}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>-->
                    Modules
                </a>
            </li>
            <?php /*
            <li class="<?= activeIF('data_generator', false, 'active') ?>">
                <a href="{URL:panel/data_generator}">
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-database"><ellipse cx="12" cy="5" rx="9" ry="3"></ellipse><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path></svg>-->
                    Data generator
                </a>
            </li>
 */ ?>
            <li class="<?= activeIF('dashboard_settings', false, 'active', !(CONTROLLER_SHORT == 'dashboard_settings' && ACTION == 'maps')) ?>">
                <a href="{URL:panel/dashboard_settings}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>-->
                    Dashboard
                </a>
            </li>
            <li class="<?= activeIF('dashboard_settings', 'maps', 'active') ?>">
                <a href="{URL:panel/dashboard_settings/maps}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>-->
                    Google Maps
                </a>
            </li>
            <li class="<?= activeIF('sitemap', false, 'active') ?>">
                <a href="{URL:panel/sitemap}">
                    <!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg>-->
                    Sitemap
                </a>
            </li>
            <li class="<?= activeIF('panel', 'robots', 'active') ?>">
                <a href="{URL:panel/robots}">
                    Robots.txt
                </a>
            </li>
        </ul>
    </li>

    <?php if (Request::getParam('tracker')->value == 'yes') { ?>
        <li class="menu">
            <a class="dropdown-toggle report" onclick="load('issue_manager/create_task', 'project=<?= Request::getParam('tracker_api')->value ?>', 'url=' + window.location.href);">
                <div>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bug" class="svg-inline--fa fa-bug fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M511.988 288.9c-.478 17.43-15.217 31.1-32.653 31.1H424v16c0 21.864-4.882 42.584-13.6 61.145l60.228 60.228c12.496 12.497 12.496 32.758 0 45.255-12.498 12.497-32.759 12.496-45.256 0l-54.736-54.736C345.886 467.965 314.351 480 280 480V236c0-6.627-5.373-12-12-12h-24c-6.627 0-12 5.373-12 12v244c-34.351 0-65.886-12.035-90.636-32.108l-54.736 54.736c-12.498 12.497-32.759 12.496-45.256 0-12.496-12.497-12.496-32.758 0-45.255l60.228-60.228C92.882 378.584 88 357.864 88 336v-16H32.666C15.23 320 .491 306.33.013 288.9-.484 270.816 14.028 256 32 256h56v-58.745l-46.628-46.628c-12.496-12.497-12.496-32.758 0-45.255 12.498-12.497 32.758-12.497 45.256 0L141.255 160h229.489l54.627-54.627c12.498-12.497 32.758-12.497 45.256 0 12.496 12.497 12.496 32.758 0 45.255L424 197.255V256h56c17.972 0 32.484 14.816 31.988 32.9zM257 0c-61.856 0-112 50.144-112 112h224C369 50.144 318.856 0 257 0z"></path>
                    </svg>
                    <span>Report Issue</span>
                </div>
            </a>
        </li>
    <?php } ?>

    <li style="margin-bottom: 100px;"></li>

    <?php /*
    <li class="menu">
        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                <span>Apps</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled <?= $show ? 'show' : '' ?>" id="app" data-parent="#accordionExample">
            <li>
                <a href="apps_chat.html"> Chat </a>
            </li>
            <li>
                <a href="apps_mailbox.html"> Mailbox  </a>
            </li>
            <li>
                <a href="apps_todoList.html"> Todo List </a>
            </li>
            <li>
                <a href="apps_notes.html"> Notes </a>
            </li>
            <li>
                <a href="apps_scrumboard.html">Scrumboard</a>
            </li>
            <li>
                <a href="apps_contacts.html"> Contacts </a>
            </li>
            <li>
                <a href="apps_invoice.html"> Invoice List </a>
            </li>
            <li>
                <a href="apps_calendar.html"> Calendar </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                <span>Components</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
            <li>
                <a href="component_tabs.html"> Tabs </a>
            </li>
            <li>
                <a href="component_accordion.html"> Accordions  </a>
            </li>
            <li>
                <a href="component_modal.html"> Modals </a>
            </li>
            <li>
                <a href="component_cards.html"> Cards </a>
            </li>
            <li>
                <a href="component_bootstrap_carousel.html">Carousel</a>
            </li>
            <li>
                <a href="component_blockui.html"> Block UI </a>
            </li>
            <li>
                <a href="component_countdown.html"> Countdown </a>
            </li>
            <li>
                <a href="component_counter.html"> Counter </a>
            </li>
            <li>
                <a href="component_sweetalert.html"> Sweet Alerts </a>
            </li>
            <li>
                <a href="component_timeline.html"> Timeline </a>
            </li>
            <li>
                <a href="component_snackbar.html"> Notifications </a>
            </li>
            <li>
                <a href="component_session_timeout.html"> Session Timeout </a>
            </li>
            <li>
                <a href="component_media_object.html"> Media Object </a>
            </li>
            <li>
                <a href="component_list_group.html"> List Group </a>
            </li>
            <li>
                <a href="component_pricing_table.html"> Pricing Tables </a>
            </li>
            <li>
                <a href="component_lightbox.html"> Lightbox </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#elements" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                <span>Elements</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="elements" data-parent="#accordionExample">
            <li>
                <a href="element_alerts.html"> Alerts </a>
            </li>
            <li>
                <a href="element_avatar.html"> Avatar </a>
            </li>
            <li>
                <a href="element_badges.html"> Badges </a>
            </li>
            <li>
                <a href="element_breadcrumbs.html"> Breadcrumbs </a>
            </li>
            <li>
                <a href="element_buttons.html"> Buttons </a>
            </li>
            <li>
                <a href="element_buttons_group.html"> Button Groups </a>
            </li>
            <li>
                <a href="element_color_library.html"> Color Library </a>
            </li>
            <li>
                <a href="element_dropdown.html"> Dropdown </a>
            </li>
            <li>
                <a href="element_infobox.html"> Infobox </a>
            </li>
            <li>
                <a href="element_jumbotron.html"> Jumbotron </a>
            </li>
            <li>
                <a href="element_loader.html"> Loader </a>
            </li>
            <li>
                <a href="element_pagination.html"> Pagination </a>
            </li>
            <li>
                <a href="element_popovers.html"> Popovers </a>
            </li>
            <li>
                <a href="element_progress_bar.html"> Progress Bar </a>
            </li>
            <li>
                <a href="element_search.html"> Search </a>
            </li>
            <li>
                <a href="element_tooltips.html"> Tooltips </a>
            </li>
            <li>
                <a href="element_treeview.html"> Treeview </a>
            </li>
            <li>
                <a href="element_typography.html"> Typography </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="fonticons.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                <span>Font Icons</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="widgets.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                <span>Widgets</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="table_basic.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                <span>Tables</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="#datatables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span>DataTables</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
            <li>
                <a href="table_dt_basic.html"> Basic </a>
            </li>
            <li>
                <a href="table_dt_basic-dark.html"> Dark </a>
            </li>
            <li>
                <a href="table_dt_ordering_sorting.html"> Order Sorting </a>
            </li>
            <li>
                <a href="table_dt_multi-column_ordering.html"> Multi-Column </a>
            </li>
            <li>
                <a href="table_dt_multiple_tables.html"> Multiple Tables</a>
            </li>
            <li>
                <a href="table_dt_alternative_pagination.html"> Alt. Pagination</a>
            </li>
            <li>
                <a href="table_dt_custom.html"> Custom </a>
            </li>
            <li>
                <a href="table_dt_range_search.html"> Range Search </a>
            </li>
            <li>
                <a href="table_dt_html5.html"> HTML5 Export </a>
            </li>
            <li>
                <a href="table_dt_live_dom_ordering.html"> Live DOM ordering </a>
            </li>
            <li>
                <a href="table_dt_miscellaneous.html"> Miscellaneous </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                <span>Forms</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
            <li>
                <a href="form_bootstrap_basic.html"> Basic </a>
            </li>
            <li>
                <a href="form_input_group_basic.html"> Input Group </a>
            </li>
            <li>
                <a href="form_layouts.html"> Layouts </a>
            </li>
            <li>
                <a href="form_validation.html"> Validation </a>
            </li>
            <li>
                <a href="form_input_mask.html"> Input Mask </a>
            </li>
            <li>
                <a href="form_bootstrap_select.html"> Bootstrap Select </a>
            </li>
            <li>
                <a href="form_select2.html"> Select2 </a>
            </li>
            <li>
                <a href="form_bootstrap_touchspin.html"> TouchSpin </a>
            </li>
            <li>
                <a href="form_maxlength.html"> Maxlength </a>
            </li>
            <li>
                <a href="form_checkbox_radio.html"> Checkbox &amp; Radio </a>
            </li>
            <li>
                <a href="form_switches.html"> Switches </a>
            </li>
            <li>
                <a href="form_wizard.html"> Wizards </a>
            </li>
            <li>
                <a href="form_fileupload.html"> File Upload </a>
            </li>
            <li>
                <a href="form_quill.html"> Quill Editor </a>
            </li>
            <li>
                <a href="form_markdown.html"> Markdown Editor </a>
            </li>
            <li>
                <a href="form_date_range_picker.html"> Date &amp; Range Picker </a>
            </li>
            <li>
                <a href="form_clipboard.html"> Clipboard </a>
            </li>
            <li>
                <a href="form_typeahead.html"> Typeahead </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Users</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
            <li>
                <a href="user_profile.html"> Profile </a>
            </li>
            <li>
                <a href="user_account_setting.html"> Account Settings </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#pages" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                <span>Pages</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="pages" data-parent="#accordionExample">
            <li>
                <a href="pages_helpdesk.html"> Helpdesk </a>
            </li>
            <li>
                <a href="pages_contact_us.html"> Contact Form </a>
            </li>
            <li>
                <a href="pages_faq.html"> FAQ </a>
            </li>
            <li>
                <a href="pages_faq2.html"> FAQ 2 </a>
            </li>
            <li>
                <a href="pages_privacy.html"> Privacy Policy </a>
            </li>
            <li>
                <a href="pages_coming_soon.html"> Coming Soon </a>
            </li>
            <li>
                <a href="#pages-error" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Error <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                <ul class="collapse list-unstyled sub-submenu" id="pages-error" data-parent="#pages">
                    <li>
                        <a href="pages_error404.html"> 404 </a>
                    </li>
                    <li>
                        <a href="pages_error500.html"> 500 </a>
                    </li>
                    <li>
                        <a href="pages_error503.html"> 503 </a>
                    </li>
                    <li>
                        <a href="pages_maintenence.html"> Maintanence </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="#authentication" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span>Authentication</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="authentication" data-parent="#accordionExample">
            <li>
                <a href="auth_login_boxed.html"> Login Boxed </a>
            </li>
            <li>
                <a href="auth_register_boxed.html"> Register Boxed </a>
            </li>
            <li>
                <a href="auth_lockscreen_boxed.html"> Unlock Boxed </a>
            </li>
            <li>
                <a href="auth_pass_recovery_boxed.html"> Recover ID Boxed </a>
            </li>
            <li>
                <a href="auth_login.html"> Login Cover </a>
            </li>
            <li>
                <a href="auth_register.html"> Register Cover </a>
            </li>
            <li>
                <a href="auth_lockscreen.html"> Unlock Cover </a>
            </li>
            <li>
                <a href="auth_pass_recovery.html"> Recover ID Cover </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="dragndrop_dragula.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
                <span>Drag and Drop</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="map_jvector.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon><line x1="8" y1="2" x2="8" y2="18"></line><line x1="16" y1="6" x2="16" y2="22"></line></svg>
                <span>Maps</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="charts_apex.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
                <span>Charts</span>
            </div>
        </a>
    </li>

    <li class="menu">
        <a href="#starter-kit" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                <span>Starter Kit</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </div>
        </a>
        <ul class="collapse submenu list-unstyled" id="starter-kit" data-parent="#accordionExample">
            <li>
                <a href="starter_kit_blank_page.html"> Blank Page </a>
            </li>
            <li>
                <a href="starter_kit_breadcrumbs.html"> Breadcrumbs </a>
            </li>
            <li>
                <a href="starter_kit_boxed.html"> Boxed </a>
            </li>
            <li>
                <a href="starter_kit_alt_menu.html"> Alternate Menu </a>
            </li>
        </ul>
    </li>

    <li class="menu">
        <a href="../../documentation/index.html" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                <span>Documentation</span>
            </div>
        </a>
    </li>
    */ ?>
</ul>
<!-- <div class="shadow-bottom"></div> -->