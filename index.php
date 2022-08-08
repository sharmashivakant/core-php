<?php
/*
  ____        _     _    ____ __  __ ____
 | __ )  ___ | | __| |  / ___|  \/  / ___|
 |  _ \ / _ \| |/ _` | | |   | |\/| \___ \
 | |_) | (_) | | (_| | | |___| |  | |___) |
 |____/ \___/|_|\__,_|  \____|_|  |_|____/   .v3 2020

 Copyright Bold Identities Ltd - All Rights Reserved

 Author: Bold Identities Ltd

*/

ini_set('session.gc_maxlifetime', 172800);
ini_set('session.cookie_lifetime', 172800);

define('_START_MEMORY_', memory_get_usage(true));
define('_START_TIME_', microtime(1));
/**
 * Error constants
 */
define('ERROR_NO_BASEPATH', 'No direct script access allowed');

/**
 * The main path constants
 */
// DIR
define('_DIR_', '/genesis/');

// Path to the application folder
define('_BASEPATH_', $_SERVER['DOCUMENT_ROOT']._DIR_);

// The name of THIS file
define('_SELF_', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the front controller (this file in filesystem)
define('_FCPATH_', str_replace(_SELF_, '', __FILE__));

// Path to the application folder
define('_SYSDIR_', _BASEPATH_.'app/');

// Path to the styles folder
define('_SITEDIR_', _DIR_.'app/');

// URI
define('_URI_', mb_substr($_SERVER['REQUEST_URI'], mb_strlen(_DIR_)-1));

/**
 * LOAD SYSTEM
 */

require_once(_SYSDIR_.'system/Core.php');
$core = new Core;

//if (User::get('id') == 1) {
//    echo 'Time: '.(microtime(1) - _START_TIME_).' s<br/>';
//    echo 'Memory: '.(memory_get_usage(true) - _START_MEMORY_).' bytes<br/>';
//}

/* End of file */
