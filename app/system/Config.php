<?php
/**
 * CONFIG
 */

// Database
define('DB_HOST', 'localhost');

if ($_SERVER['HTTP_HOST'] == 'localhost') {

	define('DB_NAME', 'bolddev7co_genesis'); // bolddev7co_panel
	define('DB_USER', 'root'); // bolddev7co_panel
	define('DB_PASS', ''); // sDI7IbN@&!q0
	define('NOREPLY_MAIL', 'onlyemailtesting3@gmail.com'); // Site side email sender
	define('ADMIN_MAIL', 'boldtest6@gmail.com'); // Admin email to receive email

	if( isset($_SERVER['HTTPS'] ) ) {
		define('SITE_URL', 'https://localhost/genesis/');
	} else{
		define('SITE_URL', 'http://localhost/genesis/');
	}
	
} else {

	define('DB_NAME', 'bolddev7co_genesis'); // bolddev7co_panel
	define('DB_USER', 'bolddev7co_genesis'); // bolddev7co_panel
	define('DB_PASS', 'Ip-N3uTV$sEW'); // sDI7IbN@&!q0	
	if( isset($_SERVER['HTTPS'] ) ) {
		define('SITE_URL', 'https://bolddev7.co.uk/genesis/');
	} else{
		define('SITE_URL', 'https://bolddev7.co.uk/genesis/');
	}
	//define('NOREPLY_MAIL', 'webmaster@bolddev7.co.uk'); // Site side email sender
	// define('ADMIN_MAIL', 'tom@boldidentities.com'); // Admin email to receive email
	define('ADMIN_MAIL', 'boldtest6@gmail.com'); // Admin email to receive email

}

// Site    
define('SITE_NAME', 'genesis');      

// Email settings
define('NOREPLY_NAME', 'genesis'); // Name of email sender


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

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	// SMTP : disabled / enabled
	define('SMTP_MODE', 'enabled');
	define('SMTP_HOST', 'smtp.gmail.com');
	define('SMTP_PORT', 587);
	define('SMTP_USERNAME', 'onlyemailtesting3@gmail.com');
	define('SMTP_PASSWORD', 'teqdeft@123?');
} else {
	// SMTP : disabled / enabled
	define('SMTP_MODE', 'enabled');
	define('SMTP_HOST', 'mail.bolddev7.co.uk');
	define('SMTP_PORT', 587);
	define('SMTP_USERNAME', 'webmaster@bolddev7.co.uk');
	define('SMTP_PASSWORD', 'jt&T6!{LY$qv');
}

// Salt
define('SALT', 'dfh1fgj51fgjg1jk5');

define('DATA_LIMIT',6);
define('CURRENCY_SYMBOL', '£');
/* End of file */