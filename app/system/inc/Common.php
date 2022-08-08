<?php
/**
 * Function include
 * @param $path
 */
function incFile($path)
{
    include_once(_SYSDIR_.$path);
}

/**
 * Function redirect
 * @param $url
 */
function redirect($url)
{
    header('Location: '.$url);
    exit;
}

function redirectAny($url)
{
    if (Request::isAjax()) {
        Request::addResponse('redirect', false, $url);
        Request::endAjax();
    } else
        redirect($url);
}

/**
 * Function site_url
 * @param $path
 * @return string
 */
function site_url($path) {
    return _SITEDIR_.$path;
}

/**
 * Function print_data (debug function)
 * @param $data
 */
function print_data($data, $var_dump = false)
{
    echo '<hr/><pre>';
    print_r($data);
    echo '<br>';
    if ($var_dump)
        var_dump($data);
    echo '</pre><hr/>';
}

/**
 * Function errors_control
 */
function errors_control() {
    if (ERRORS_CONTROL == 'all')
        error_reporting(E_ALL);
    else if (ERRORS_CONTROL == 'dev')
        error_reporting(E_ALL & ~E_NOTICE);
    else
        error_reporting(0);

    //ini_set('display_errors', 1);
}

/**
 * Function error404
 * @param null $message
 */
function error404($message = null)
{
    http_response_code(404);
    $template404 = _SYSDIR_ . 'modules/page/views/templates/404.php';

    if (is_file($template404)) {
        include_once($template404);
    } else {
        echo '<div class="wrapper">';
        echo '<center><h1>NOT FOUND</h1></center>';
        echo '<center>'.$message.'</center>';
        echo '</div>';
    }
    exit;
}

/**
 * To display error. Call from Core -> ErrorHandler
 * @param $error
 */
function error_system($error)
{
    echo '<hr>';
        echo '<div><strong style="font-size: 20px;">Error Exception</strong></div>';
        echo '<div><strong>Line:</strong> <span>'. $error['line'] .'</span></div>';
        echo '<div><strong>Message:</strong>'. str_replace(array(PHP_EOL, _BASEPATH_), array('<br>', '../'), $error['message']) .'</div>';
    echo '<hr>';
}

/**
 * To get module path
 * @param $controller
 * @return string|bool
 */
function modulePath($controller)
{
    $controllerRow = trim($controller, '/');
    $controllerArr = explode('/', $controllerRow);

    $path = _SYSDIR_;

    foreach ($controllerArr as $cont) {
        if ($cont)
            $path .= 'modules/' .$cont. '/';
    }

    return $path;
}

/**
 * To get child module name
 * @param $controller
 * @return mixed
 */
function moduleName($controller)
{
    $controllerRow = trim($controller, '/');
    $controllerArr = explode('/', $controllerRow);

    return $controllerArr[ count($controllerArr) - 1 ];
}

/**
 * Function filter
 * @param $data
 * @param bool|string $mode
 * @return array|int|mixed|string
 */
function filter($data, $mode = true)
{
    if ($mode === false) {
        return $data;
    } else {
        if (!is_array($data)) {
            if ($mode == 'string' OR $mode === true) {
                $data = trim($data);
                $data = reFilter($data);

                $search = array("\0", "`");
                $replace = array("", "\`");
                $data = str_replace($search, $replace, trim($data));

                $data = htmlentities($data, ENT_QUOTES, "UTF-8");

                // save \n in table as it is(i.e. not replace to new row separator)
                if (Mysqli_DB::$_db) {
                    $data = Mysqli_DB::$_db->escape_string($data);
                }

                //$data = htmlspecialchars($data);
                //$data = addslashes($data);
                return $data;
            } elseif ($mode == 'float') {
                return floatval($data);
            } else {
                return intval($data);
            }
        } else {
            foreach ($data as $key => $value)
                $data[$key] = filter($value, $mode);

            return $data;
        }
    }
}

/**
 * @param $data
 * @return string
 */
function reFilter($data)
{
    $data = html_entity_decode($data, ENT_QUOTES, 'UTF-8');

    $search = array("`");
    $replace = array("\`");
    $data = str_replace($replace, $search, trim($data));
    //$data = addslashes($data);

    return $data;
}

/**
 * todo ???
 * @param $data
 * @param $mySearch
 * @return mixed
 */
function myReplace($data, $mySearch = false)
{
    if ($mySearch === false) {
        $mySearch['&#039;'] = "\'";
        //$mySearch['"'] = '&quot;';
    }

    foreach ($mySearch as $key => $value)
    {
        $search[] = $key;
        $replace[] = $value;
    }

    $data = str_replace($search, $replace, $data);

    return $data;
}

/**
 * @param $name
 * @param bool|string $mode
 * @param bool $default
 * @return array|bool|int|mixed|string
 */
function post($name, $mode = true, $default = false)
{
    if (isset($_POST[$name]) && $_POST[$name] === '')
        return '';

    if (isset($_POST[$name])) {
        $value = filter($_POST[$name], $mode);
        return ($value) ? $value : $default;
    } else
        return $default;
}

/**
 * For int fields
 * @param $name
 * @param int $default
 * @return int
 */
function post_int($name, $default = 0)
{
    if ($_POST[$name] === 0)
        return 0;

    $value = intval($_POST[$name]);
    return ($value) ? $value : $default;
}


/**
 * Function isPost
 * @return bool
 */
function isPost()
{
    if (count($_POST) > 0)
        return true;

    return false;
}

/**
 * Function allPost
 * @param bool|string $mode
 * @return array|int|mixed|string
 */
function allPost($mode = true)
{
    return filter($_POST, $mode);
}

/**
 * Function get
 * @param $name
 * @param bool $mode
 * @param bool $default
 * @return array|bool|int|mixed|string
 */
function get($name, $mode = true, $default = false)
{
    if ($_GET[$name] === '')
        return '';

    if (isset($_GET[$name])) {
        $value = filter($_GET[$name], $mode);
        return ($value) ? $value : $default;
    } else
        return $default;
}

/**
 * For int fields
 * @param $name
 * @param int $default
 * @return int
 */
function get_int($name, $default = 0)
{
    if ($_GET[$name] === 0)
        return 0;

    $val = intval($_GET[$name]);
    if (!$val)
        return $default;
    else
        return $val;
}

/**
 * Function getSession
 * @param $name
 * @param bool|string $mode
 * @return array|bool|int|mixed|string
 */
function getSession($name, $mode = true)
{
    if (isset($_SESSION[$name]))
        return filter($_SESSION[$name], $mode);
    else
        return false;
}

/**
 * Function setSession
 * @param $name
 * @param $value
 * @param bool|string $mode
 * @return array|int|mixed|string
 */
function setSession($name, $value, $mode = true)
{
    return $_SESSION[$name] = filter($value, $mode);
}

/**
 * Function unsetSession
 * @param $name
 * @return bool
 */
function unsetSession($name)
{
//    $_SESSION[$name] = false;
    unset($_SESSION[$name]);
    return true;
}

/**
 * Function getCookie
 * @param $name
 * @param $value
 * @param $time
 * @param bool|string $mode
 * @return bool
 */
function setMyCookie($name, $value, $time, $mode = true)
{
    return setCookie($name, filter($value, $mode), $time, '/');
}

/**
 * Function getCookie
 * @param $name
 * @param bool|string $mode
 * @return array|bool|int|mixed|string
 */
function getCookie($name, $mode = true)
{
    if (isset($_COOKIE[$name]))
        return filter($_COOKIE[$name], $mode);
    else
        return false;
}

/**
 * Function unsetCookie
 * @param $name
 * @return mixed
 */
function unsetCookie($name)
{
    SetCookie($name, '', time() - 3600, '/');
//    SetCookie($name);
    unset($_COOKIE[$name]);
    return $name;
}


function defaultValue($value = false, $default = false) {
    if (!$value)
        return $default;

    return $value;
}

/**
 * @param array $delimiters todo ???
 * @param $string
 * @return array
 */
function multiExplode($delimiters, $string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}


/**
 * Function checkEmail
 * @param $email
 * @return bool
 */
function checkEmail($email)
{
    if (!preg_match("~^([a-z0-9_\.\-]{1,})@([a-z0-9\.\-]{1,20})\.([a-z\.]{2,6})+$~i", trim($email)))
        return false;
    else
        return true;
}

/**
 * Function checkURL
 * @param string $url
 * @return bool
 */
function checkURL($url)
{
    $pattern = "~^(https?:\/\/)?([0-9a-z][0-9a-z\-]+\.[0-9a-z]+)+(.*?)$~i"; // all length
    if (preg_match($pattern, trim($url)))
        return true;
    else
        return false;
}

/**
 * Function checkLength
 * @param $text
 * @param int $min
 * @param bool $max
 * @return bool
 */
function checkLength($text, $min = 0, $max = FALSE)
{
    $length = mb_strlen($text);

    if ($length >= $min) {
        if ($max != false AND $length > $max)
            return false;

        return true;
    }

    return false;
}


function convertStringTimeToInt($time) {
    if (!$time)
        return false;

    date_default_timezone_set('UTC');

    // Date
    $dateArr = explode('/', $time);
    if (count($dateArr) !== 3)
        $dateArr = array(0, 0, 0);

    return mktime(0, 0, 0, $dateArr[1], $dateArr[0], $dateArr[2]);
}

/**
 * Function timePassed
 * @param $time
 * @param bool $timeEnd
 * @param bool $suffix
 * @return string
 */
function timePassed($time, $timeEnd = false, $suffix = false)
{
    if ($timeEnd === false)
        $timeEnd = time();

    $time = intval($time);
    $passed = $timeEnd - $time;

    if ($passed < 60) {
        $value = $passed; // sec
        $unit = 'sec';
    } elseif ($passed < 60*60) {
        $value = floor($passed / 60); // min
        $unit = 'min';
    } elseif ($passed < 24*60*60) {
        $value = floor($passed / (60*60)); // hour
        $unit = 'hour';
    } elseif ($passed < 7*24*60*60) {
        $value = floor($passed / (24*60*60)); // day
        $unit = 'day';
    } elseif ($passed < 30*24*60*60) {
        $value = floor($passed / (7*24*60*60)); // week
        $unit = 'week';
    } elseif ($passed < 365*24*60*60) {
        $value = floor($passed / (30*24*60*60)); // month
        $unit = 'month';
    } else {
        $value = floor($passed / (365*24*60*60)); // year
        $unit = 'year';
    }

    if ($suffix !== false)
        return $value . '' . substr($unit, 0, $suffix);
    else
        return $value . '' . $unit . isPlural($value);
}

function timeDetails($sec)
{
    $detailRow = '';

    if ($sec > 60 * 60) {
        $h = floor($sec / (60 * 60));
        $sec = $sec - ($h * 60 * 60);

        $detailRow .= ' '.$h.'h';
    }

    if ($sec > 60) {
        $m = floor($sec / 60);
        $sec = $sec - ($m * 60);

        $detailRow .= ' '.$m.'m';
    }

    if ($sec > 0) {
        $s = $sec;

        $detailRow .= ' '.$s.'s';
    }

    return $detailRow;
}

function countDown($s, $format = null, $phrase = 'Ended')
{
    if ($s <= 0)
        return $phrase;

    $countDown = $s;

    if (is_null($format)) {
        $h = floor($s / 3600);
        $s = $s - $h * 3600;

        $m = floor($s / 60);
        $s = $s - $m * 60;

        $countDown = '';

        if ($h >= 24) {
            $days = intval($h / 24);
            $h -= $days * 24;

            $countDown .= $days;
            if ($days > 1)
                $countDown .= ' days ';
            else
                $countDown .= ' day ';
        }

        if ($h > 0) {
            if ($h > 0)
                $countDown .= $h.':';
            else
                $countDown .= '00:';
        }

        if ($m > 0) {
            if ($m < 10)
                $countDown .= '0'.$m.':';
            else
                $countDown .= $m . ':';
        } else
            $countDown .= '00:';

        if ($s > 0) {
            if ($s < 10)
                $countDown .= '0'.$s;
            else
                $countDown .= $s;
        } else
            $countDown .= '00';
    }

    return $countDown;
}

/**
 * isPlural - check if is plural return part of text
 * @param $int
 * @param string $text
 * @param string $default
 * @return string
 */
function isPlural($int, $text = 's', $default = '') {

    if (intval($int) > 1)
        return $text;
    else
        return $default;
}

/**
 * Function printTime
 * @param $time
 * @param null $format
 * @return string
 */
function printTime($time, $format = null)
{
    if (is_null($format)) {
        $format = "d.m / H:i";
        return date($format, $time);
    } else {
        return date($format, $time);
    }
}

/**
 * Function randomHash
 * @return string
 */
function randomHash()
{
    return md5(time().'_'.rand(1000000, 9999999));
}

/**
 * Function createURL
 * @return string
 */
function url()
{
    $url = '';

    if (func_num_args() > 0)
        $url = implode('/', func_get_args());

    $url = ltrim($url, '/');

    return rtrim(SITE_URL, '/') . '/' . $url;
}

if (!function_exists('mb_ucfirst')) {
    /**
     * Function mb_ucfirst
     * @param $string
     * @return string
     */
    function mb_ucfirst($string)
    {
        return mb_strtoupper(mb_substr($string, 0, 1))
            . mb_substr($string, 1, mb_strlen($string));
    }
}

/**
 * Function printError
 * @param $error
 * @param bool $prefix
 * @param string $separate
 * @return string
 */
function printError($error, $prefix = false, $separate = 'p')
{
    $data = '';
    if ($error) {
        if (is_array($error)) {
            foreach ($error as $value)
            {
                $data .= '<'.$separate.'>';
                $data .= Lang::translate($prefix.$value);
                $data .= '</'.$separate.'>';
            }
        } else {
            $data .= '<'.$separate.'>';
            $data .= Lang::translate($prefix.$error);
            $data .= '</'.$separate.'>';
        }
    }

    return $data;
}

/**
 * Function setNotice
 * @param $value
 * @param array|string|string[] $name
 * @param bool $mode
 */
function setNotice($value, $name = ACTION, $mode = true)
{
    // todo make array for notices and it MUST removing at the end of script, something like this - but working xD
    // wrote it without test, but I afraid it will call "reFilter x N" problem, bette use other array and save it after controller work
    // $noticesArray[mb_strtoupper($name.'_')] = $value;
    // setSession($noticesArray, $noticesArray, $mode);

    setSession(mb_strtoupper($name.'_'), $value, $mode);
}

/**
 * Function getNotice // todo  ???
 * @param array|string|string[] $name
 * @param bool $prefix
 * @param bool $mode
 * @param string $separate
 * @return bool|string
 */
function getNotice($name = ACTION, $prefix = false, $mode = true, $separate = 'p')
{
    $name = mb_strtoupper($name.'_');
    $prefix = mb_strtoupper($prefix);
    $array = getSession($name, $mode);
    $data = '';

    if (!$array)
        return false;

    if (is_array($array)) {
        foreach ($array as $value)
        {
            $data .= '<'.$separate.'>';
            $data .= Lang::translate($prefix.$value);
            $data .= '</'.$separate.'>';
        }
    } else {
        $data .= '<'.$separate.'>';
        $data .= Lang::translate($prefix.$array);
        $data .= '</'.$separate.'>';
    }
    unsetSession($name);

    return $data;
}

/**
 * Function viewParser
 * @param $buffer
 */
function viewParser($buffer)
{
    // Replace {URL:page/support} to url('page','support')
    // and {L:HOME} to Lang::translate('HOME')
    $arr1 = array();
    $arr2 = array();
    preg_match_all("~{([0-9A-Z_]{1,12}):([0-9A-Za-z_\-//#]+)}~", $buffer, $m);

    foreach ($m[1] as $key => $value) {
        if ($value == 'L') {
            $arr1[] = '{'.$value.':'.$m[2][$key].'}';
            $arr2[] = Lang::translate($m[2][$key]);
        } else if ($value == 'URL') {
            $arr1[] = '{'.$value.':'.$m[2][$key].'}';
            $arr2[] = url($m[2][$key]);
        }
    }

    $buffer = str_replace($arr1, $arr2, $buffer);

    Request::setParam('buffer', $buffer);
}

/**
 * Process template for content pages system
 * @param $content
 * @return string|string[]
 */
function processTemplate($content) {
    // Replace <contentElement name="client-title" type="input"></contentElement>
    // to contentElement('filed-name-in-admin-content', 'type-input-textarea', 'Default text')

    $arr1 = array();
    $arr2 = array();
    preg_match_all("~<contentElement (.*?)>(.*?)</contentElement>~sm", $content, $m);

    $counter = 0;
    foreach ($m[1] as $key => $value) {
        $arr1[] = $m[0][$key];
        $arr2[] = getContentElement($value, $m[2][$key], $counter);
        $counter++;
    }

    return str_replace($arr1, $arr2, $content);
}

/**
 * getContentElement - process template element for content pages system
 * @param $options
 * @param bool $defaultContent
 * @param int $position
 * @return bool|string
 */
function getContentElement($options, $defaultContent = false, $position = 0) {
   
    $properties = array(); // properties of tag contentElement
    preg_match_all("~([0-9a-zA-Z_\-]{0,50})=\"([0-9a-zA-Z_\-| ]{0,50})\"~i", trim($options), $m);

    foreach ($m[1] as $key => $value) {
        $properties[$value] = $m[2][$key];
    }

    // Default type
    if (!isset($properties['type']))
        $properties['type'] = 'textarea';

  if(CONTROLLER=='page' && ACTION=='index'){
    
    $contentElement = PageModel::checkContentPage($properties['name'], CONTROLLER, ACTION,Lang::$language);
  } else {
       
    $contentElement = PageModel::checkContentPage($properties['name']);
  }

   
    if (!$contentElement) {
        if(CONTROLLER=='page' && ACTION=='index'){
            $elData = array(
            'module'   => CONTROLLER,
            'page'     => ACTION,
            'name'     => $properties['name'],
            'content'  => filter($defaultContent),
            'type'     => $properties['type'],
            'lang'     => Lang::$language,
            'position' => $position,
            'time'     => time(),
        );
        }else{
            $elData = array(
            'module'   => CONTROLLER,
            'page'     => ACTION,
            'name'     => $properties['name'],
            'content'  => filter($defaultContent),
            'type'     => $properties['type'],
            'lang'     => 'en',
            'position' => $position,
            'time'     => time(),
        );

        }

        

        Model::insert('content_pages_tree', $elData);
    } else {
        $defaultContent = reFilter($contentElement->content);
        // Update position and type
        if ($contentElement->position != $position OR $contentElement->type != $properties['type'])
            Model::update('content_pages_tree', array('position' => $position, 'type' => $properties['type']), "`id` = '$contentElement->id' ");
    }
/*print_r($elData);
        die;*/
    return $defaultContent;
}


function getImageElement($name, $path, $position = 0, $width = false, $height = false) {
    
    if(CONTROLLER=='page' && ACTION=='index'){
    $imageElement = PageModel::checkContentPage($name, CONTROLLER, ACTION, Lang::$language);
  } else {
    $imageElement = PageModel::checkContentPage($name);
  }

    //$imageElement = PageModel::checkContentPage($name);
    if (!$imageElement) {
         if(CONTROLLER=='page' && ACTION=='index'){
        $elData = array(
            'module'       => CONTROLLER,
            'page'         => ACTION,
            'name'         => $name,
            'content'      => $path,
            'type'         => 'image',
            'lang'     => Lang::$language,
            'image_width'  => $width,
            'image_height' => $height,
            'position'     => $position,
            'time'         => time(),
        );
         }else{
              $elData = array(
            'module'       => CONTROLLER,
            'page'         => ACTION,
            'name'         => $name,
            'content'      => $path,
            'type'         => 'image',
            'lang'     => 'en',
            'image_width'  => $width,
            'image_height' => $height,
            'position'     => $position,
            'time'         => time(),
        );
         }

        Model::insert('content_pages_tree', $elData);
    } else {
        $defaultContent = reFilter($imageElement->content);
        // Update position and type
        if ($imageElement->position != $position)
            Model::update('content_pages_tree', ['position' => $position], "`id` = '$imageElement->id'");
    }

    return $defaultContent;
}

function getVideoElement($name, $path, $position = 0, $video_type = 'youtube') {

    $videoElement = PageModel::checkContentPage($name);
    if (!$videoElement) {
        $elData = array(
            'module'     => CONTROLLER,
            'page'       => ACTION,
            'name'       => $name,
            'content'    => $path,
            'type'       => 'video',
            'video_type' => $video_type,
            'position'   => $position,
            'time'       => time(),
        );

        Model::insert('content_pages_tree', $elData);
    } else {

        $defaultContent = reFilter($videoElement->content);

        // Update position and type
        if ($videoElement->position != $position)
            Model::update('content_pages_tree', ['position' => $position], "`id` = '$videoElement->id'");
    }

    return $defaultContent;
}

/**
 * @param $url
 * @param null $get
 * @param null $post
 * @param false $headers
 * @param null $custom_method
 * @return bool|string
 */
function get_contents($url, $get = NULL, $post = NULL, $headers = FALSE, $custom_method = NULL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . ($get ? "?" . http_build_query($get) : ""));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64; rv:47.0) Gecko/20100101 Firefox/47.0');
    curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);

    if ($headers && is_array($headers))
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($post) {
        curl_setopt($ch, CURLOPT_POST, TRUE);
        if (is_array($post))
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        else
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    if ($custom_method)
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom_method);

    $output = curl_exec($ch);
    $info = curl_getinfo($ch);
    $headers = curl_getinfo($ch, CURLINFO_HEADER_OUT);
    if ($ch) curl_close($ch);

    if ($info['http_code'] == 301 || $info['http_code'] == 302) {
        $url = $info['redirect_url'];
        $url_parsed = parse_url($url);
        return (isset($url_parsed)) ? get_contents($url, $get, $post, $headers, $custom_method) : '';
    }

    return $output;
}

///**
// * Function get_contents
// * @param $url
// * @param bool|array $post
// * @param bool $cookie
// * @return mixed|string
// */
//function get_contents($url, $post = false, $cookie = false) {
//    if (!$cookie)
//        $cookie = tempnam(sys_get_temp_dir(), "CURLCOOKIE");
//
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 5);
//    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
//    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//    curl_setopt($ch, CURLOPT_MAXREDIRS, 15);
//    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36');
//    curl_setopt($ch, CURLOPT_HEADER, false);
//
//
//    if ($post !== false) {
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
//    }
//
//    if ($cookie) {
//        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
//        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
//        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
//    }
//
//    $output = curl_exec($ch);
//    $info = curl_getinfo($ch);
//    curl_close($ch);
//
//    if ($info['http_code'] == 301 || $info['http_code'] == 302) {
//        $url = $info['redirect_url'];
//        $url_parsed = parse_url($url);
//        return (isset($url_parsed))? get_contents($url, $post, $cookie) : '';
//    }
//
//    return $output;
//}

/**
 * Function getSiteOG
 * @param $html // receive get_contents() ot file_get_contents() return
 * @param int $specificTags
 * @return array
 */
function getSiteOG($html, $specificTags = 0)
{
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $res['title'] = $doc->getElementsByTagName('title')->item(0)->nodeValue;

    foreach ($doc->getElementsByTagName('meta') as $m) {
        $tag = $m->getAttribute('name') ?: $m->getAttribute('property');
        if (in_array($tag, ['description', 'keywords']) || strpos($tag, 'og:') === 0)
            $res[str_replace('og:', '', $tag)] = $m->getAttribute('content');
    }
    return $specificTags ? array_intersect_key($res, array_flip($specificTags)) : $res;
}

/**
 * Function getYouTube
 * @param $id
 * @param string $part
 * @return mixed
 */
function getYouTube($id, $part = 'snippet,contentDetails,statistics,status')
{
    $url = 'https://www.googleapis.com/youtube/v3/videos?id='.$id.'&key='.YOUTUBE_DEVELOPER_KEY.'&part='.$part;
    $result = get_contents($url);
    return json_decode($result);
}

/**
 * Function checkYouTubeURL
 * @param $url
 * @return bool
 */
function checkYouTubeURL($url)
{
    if (stripos($url, 'youtube.com') !== false) {
        preg_match('#v=([^\&]+)#is', $url, $m);
        $videoID = $m[1];
    } elseif (stripos($url, 'youtu.be') !== false) {
        preg_match('#/([^?\/]{11})#is', $url, $m);
        $videoID = $m[1];
    } else
        $videoID = false;

    if ($videoID)
        return $videoID;
    else
        return false;
}


/**
 * Function generate random password
 * @param int $length
 * @param bool $alphabet
 * @return string
 */
function randomPassword($length = 6, $alphabet = false) {
    if (!$alphabet)
        $alphabet = '!$@$%;abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = array();
    $alphaLength = mb_strlen($alphabet) - 1;

    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }

    return implode($pass);
}

/* End of file */