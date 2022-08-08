<?php
/**
 * PRE DISPATCH
 */

// UserInc
incFile('modules/page/system/inc/User.inc.php');
UserInc::start();

// Email/include JS code
Model::import('panel/analytics');
Request::setParam('include_code_top', AnalyticsModel::get('include_code_top')); // Top JS code
Request::setParam('include_code_bottom', AnalyticsModel::get('include_code_bottom')); // Bottom JS code
Request::setParam('admin_mail', AnalyticsModel::get('admin_mail')); // Admin Email
Request::setParam('noreply_mail', AnalyticsModel::get('noreply_mail')); // Admin Email
Request::setParam('noreply_name', AnalyticsModel::get('noreply_name')); // Admin Email
Request::setParam('tracker', AnalyticsModel::get('tracker')); // tracker
Request::setParam('tracker_api', AnalyticsModel::get('tracker_api')); // tracker_api

// Get META for page
Model::import('panel/content_pages');
$metaTitle = Content_pagesModel::getBlock(CONTROLLER, ACTION, 'meta_title');
if ($metaTitle) Request::setTitle($metaTitle->content, false);

$metaKeywords = Content_pagesModel::getBlock(CONTROLLER, ACTION, 'meta_keywords');
if ($metaKeywords) Request::setKeywords($metaKeywords->content, false);

$metaDesc = Content_pagesModel::getBlock(CONTROLLER, ACTION, 'meta_desc');
if ($metaDesc) Request::setDescription($metaDesc->content, false);


// Popup
incFile('modules/page/system/inc/Popup.inc.php');

/* End of file */