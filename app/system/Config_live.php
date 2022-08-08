<?php
/**
 * CONFIG
 */

// Database
define('DB_HOST', 'localhost');
define('DB_NAME', 'bolddev7co_genesis'); // bolddev7co_panel
define('DB_USER', 'bolddev7co_panel'); // bolddev7co_panel
define('DB_PASS', 'sDI7IbN@&!q0'); // sDI7IbN@&!q0

// Site
define('SITE_URL', 'http://bolddev7.co.uk/panel/');
define('SITE_NAME', 'cms.loc');

// Email settings
define('NOREPLY_MAIL', 'webmaster@bolddev7.co.uk'); // Site side email sender
define('NOREPLY_NAME', 'CMS'); // Name of email sender
define('ADMIN_MAIL', 'info@bolddev7.co.uk'); // Admin email to receive email

// Default controller, action
define('DEFAULT_CONTROLLER', 'page');
define('DEFAULT_ACTION', 'index');

// Errors control
define('ERRORS_CONTROL', 'dev'); // all | dev | live

// Default language
define('LANGUAGE', 'en');

// Default timezone
define('TIMEZONE', 'UTC');

// Template parser
define('TEMPLATE_PARSER', true);

// Checking
define('SESSION_SWITCH', true);

// Default Character Set
define('CHARSET', 'UTF-8');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATION', 'utf8mb4_unicode_ci');

// SMTP : disabled / enabled
define('SMTP_MODE', 'disabled');
define('SMTP_HOST', null);
define('SMTP_PORT', null);
define('SMTP_USERNAME', null);
define('SMTP_PASSWORD', null);

// Salt
define('SALT', 'dfh1fgj51fgjg1jk5');

/* End of file */