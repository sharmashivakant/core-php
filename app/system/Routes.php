<?php
/**
* ROUTE
*/

$routesArray[] = array(
    'pattern' => '~^microsite~',
    'controller' => 'microsite',
    'action' => 'index',
);
$routesArray[] = array(
    'pattern' => '~^sitemap.xml~',
    'controller' => 'page',
    'action' => 'sitemap',
);
// Blog   
$routesArray[] = array(
    'pattern' => '~^blog/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'blogs',
    'action' => 'view',
);

$routesArray[] = array(
    'pattern' => '~^join-team~',
    'controller' => 'common',
    'action' => 'join_team',  
);
$routesArray[] = array(    
    'pattern' => '~^bio~',
    'controller' => 'page',
    'action' => 'bio',       
);
$routesArray[] = array(
    'pattern' => '~^engineering~',
    'controller' => 'page',
    'action' => 'engineering',
);

$routesArray[] = array(
    'pattern' => '~^terms-and-conditions~',
    'controller' => 'page',
    'action' => 'terms-and-conditions',
);
$routesArray[] = array(
    'pattern' => '~^privacy-policy~',
    'controller' => 'page',
    'action' => 'privacy-policy',
);
$routesArray[] = array(
    'pattern' => '~^terms-conditions~',
    'controller' => 'page',
    'action' => 'terms_conditions',
);  
$routesArray[] = array(
    'pattern' => '~^data-generator/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'panel/data_generator',
    'action' => 'execute',
);
/*$routesArray[] = array(
    'pattern' => '~^form_tester/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'panel/form_tester',
    'action' => 'send',   
);*/

// Job
$routesArray[] = array(
    'pattern' => '~^job/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'jobs',
    'action' => 'view',
);

$routesArray[] = array(
    'pattern' => '~^team-details/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'common',
    'action' => 'view',
);

$routesArray[] = array(
    'pattern' => '~^team-member/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'common',
    'action' => 'member_view',
);

$routesArray[] = array(
    'pattern' => '~^meet-the-team~',
    'controller' => 'common',
    'action' => 'team',
);



/*$routesArray[] = array(
    'pattern' => '~^case-studies/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'common',
    'action' => 'case_studies',
);*/

// Event
$routesArray[] = array(
    'pattern' => '~^event/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'blogs',
    'action' => 'event_view',  
);

$routesArray[] = array(
    'pattern' => '~^speaker/([A-Za-z0-9\+\-\.\,_%]{1,150})/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'blogs',
    'action' => 'speaker_view',
);

$routesArray[] = array(
    'pattern' => '~^contact-us~',
    'controller' => 'contact',
    'action' => 'contact_us',
);
$routesArray[] = array(
    'pattern' => '~^join-us~',
    'controller' => 'contact',
    'action' => 'join_us',
);
$routesArray[] = array(
    'pattern' => '~^nuclear-community~',
    'controller' => 'blogs',
    'action' => 'index',
);
$routesArray[] = array(
    'pattern' => '~^blog/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'blogs',
    'action' => 'view',    
);  
$routesArray[] = array(
    'pattern' => '~^latest-jobs~',
    'controller' => 'jobs',
    'action' => 'latest_jobs',      
);
$routesArray[] = array(
    'pattern' => '~^about-us~',
    'controller' => 'About-us',
    'action' => 'index',    
);
$routesArray[] = array(
    'pattern' => '~^what-we-do~',
    'controller' => 'About-us',
    'action' => 'what_we_do',    
);
$routesArray[] = array(
    'pattern' => '~^who-we-are~',
    'controller' => 'About-us',
    'action' => 'who_we_are',    
);
$routesArray[] = array(
    'pattern' => '~^clients~',
    'controller' => 'page',
    'action' => 'clients',
);
$routesArray[] = array(
    'pattern' => '~^permanent~',
    'controller' => 'page',
    'action' => 'permanent',
);
$routesArray[] = array(
    'pattern' => '~^contract~',
    'controller' => 'page',
    'action' => 'contract',
);
$routesArray[] = array(
    'pattern' => '~^project-delivery~',
    'controller' => 'page',
    'action' => 'project_delivery',
);
$routesArray[] = array(
    'pattern' => '~^service-alliance~',
    'controller' => 'page',
    'action' => 'service_alliance',
);
$routesArray[] = array(
    'pattern' => '~^talent-vault~',
    'controller' => 'talent',
    'action' => 'index',
);
$routesArray[] = array(
    'pattern' => '~^talent/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'talent',  
    'action' => 'talentdetails',
);
$routesArray[] = array(
    'pattern' => '~^candidate~',
    'controller' => 'jobs',
    'action' => 'candidate',
);
$routesArray[] = array(
    'pattern' => '~^statement~',
    'controller' => 'page',
    'action' => 'statement',
);

 //talent routing
/*$routesArray[] = array(
    'pattern' => '~^search-anon-profile~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'search',
);*/

$routesArray[] = array(
    'pattern' => '~^candidate-alert~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'candidate_alert',
);
$routesArray[] = array(
    'pattern' => '~^open-candidate-alert~',
    'controller' => 'talent/open_profile',
    'action' => 'candidate_alert',
);
$routesArray[] = array(
    'pattern' => '~^request-cv~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'request_cv',
);
$routesArray[] = array(
    'pattern' => '~^request-interview~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'request_interview',
);
$routesArray[] = array(
    'pattern' => '~^request-info~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'request_info',
);
$routesArray[] = array(
    'pattern' => '~^feedback~',
    'controller' => 'talent/open_profile',
    'action' => 'feedback',
);

$routesArray[] = array(
    'pattern' => '~^open-book~',
    'controller' => 'talent/open_profile',
    'action' => 'book',
);
$routesArray[] = array(
    'pattern' => '~^open-request-interview~',
    'controller' => 'talent/open_profile',
    'action' => 'request_interview',
);
$routesArray[] = array(
    'pattern' => '~^open-request-info~',
    'controller' => 'talent/open_profile',
    'action' => 'request_info',
);
$routesArray[] = array(
    'pattern' => '~^talent/hotlist/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'talent/hotlist',
    'action' => 'index',
);
$routesArray[] = array(
    'pattern' => '~^talent/shortlist/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'talent/shortlist',
    'action' => 'index',
);
$routesArray[] = array(
    'pattern' => '~^talent/anonymous_profile/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'talent/anonymous_profile',
    'action' => 'view',
);
$routesArray[] = array(
    'pattern' => '~^talent/open_profile/([A-Za-z0-9\+\-\.\,_%]{1,150})~',
    'controller' => 'talent/open_profile',
    'action' => 'view',
);
$routesArray[] = array(
    'pattern' => '~^talentsearch~',
    'controller' => 'talent',
    'action' => 'talentsearch',
);
 
$routesArray[] = array(
    'pattern' => '~^import-jobs~',
    'controller' => 'vincere',
    'action' => 'cronjob',
);
$routesArray[] = array(
    'pattern' => '~^export-cv~',
    'controller' => 'vincere',
    'action' => 'exportCv',
);
/* End of file */
