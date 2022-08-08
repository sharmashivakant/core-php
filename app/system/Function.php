<?php

function numberFormatInStr($str) {
    if (preg_match_all('/\d{4,}/', $str, $m)) {

        $arrSearch = [];
        $arrReplace = [];

        foreach ($m[0] as $val) {
            $arrSearch[] = $val;
            $arrReplace[] = number_format($val);
        }

        $str = str_replace($arrSearch, $arrReplace, $str);
    }

    return $str;
}

function activeIF($module, $page = 'index', $return = 'active', $also = true) {
    $isModule = is_array($module) ? in_array(CONTROLLER_SHORT, $module) : CONTROLLER_SHORT === $module;
    $isPage = $page === false ? true : ( is_array($page) ? in_array(ACTION, $page) : ACTION === $page );

//    if ($page === false) {
//        $isPage = true;
//    } else {
//        if (is_array($page)) {
//            $isPage = in_array(ACTION, $page);
//        } else {
//            $isPage = ACTION === $page;
//        }
//    }

    return ($isModule && $isPage && $also) ? $return : false;

//    if (is_array($page)) {
//        if (CONTROLLER === $module && in_array(ACTION, $page))
//            return $return;
//    } else if (CONTROLLER === $module && ACTION === $page) {
//        return $return;
//    }
//
//    return '';
}

/**
 * <option value="admin" <.?.= checkOptionValue(post('role'), 'admin', User::get('role'); ?.> >Admin</option>
 * @param $field
 * @param $optionValue
 * @param bool $defaultField
 * @param string $default
 * @return string
 */
function checkOptionValue($field, $optionValue, $defaultField = false, $default = '') {

    return (($field && $field === $optionValue) OR (is_array($field) && in_array($optionValue, $field)))
        ? 'selected'
        : ( (($defaultField && $defaultField === $optionValue) OR (is_array($defaultField) && in_array($optionValue, $defaultField)))
            ? 'selected'
            : $default
        );
}

function checkCheckboxValue($field, $optionValue, $defaultField = false, $default = '') {

    return $field && is_array($field) && in_array($optionValue, $field)
        ? 'checked'
        : ($defaultField && is_array($defaultField) && in_array($optionValue, $defaultField)
            ? 'checked'
            : $default
        );
}

/**
 * Transform tags row to search tags
 * @param $tagsRow |php||js||css||html|
 * @return string
 */
function getTags($tagsRow) {
    $html = '';
    $tags = explodeString('||', trim($tagsRow, '|'));

    if ($tags)
        foreach ($tags as $val)
            $html .= '<a onclick="openSearch(\''.$val.'\');">'.$val.'</a>';

    return $html;
}

/**
 * Transform `tags row` to array
 * @param $tagsRow
 * @return array
 */
function tagRowToArray($tagsRow) {
    return explodeString('||', strtolower(trim($tagsRow, '|')));
}


/**
 * Function getAvatar
 * @param $id
 * @param null $size
 * @param string $isAvatar
 * @return string
 */
function getAvatar($id, $check = false)
{
    if ($check) {
        if (file_exists(_SYSDIR_.'data/users/'.$id.'/logo.png'))
            return _SITEDIR_.'data/users/'.$id.'/logo.png';
        else
            return false;
    } else
        return _SITEDIR_.'data/users/'.$id.'/logo.png';
}

function makeSlug($str){
    return preg_replace('/[^a-z0-9-]+/', '-', strtolower(trim($str)));
}

/**
 * Pre-process function of tool url from name
 * @param $name
 * @return string
 */
function processUrlName($name) {
    return urlencode(trim($name));
}


/**
 * Pre-process function of tool description for tool card
 * @param $desc
 * @param int $lenght
 * @return string
 */
function processDesc($desc, $lenght = 122) {
    if (!$lenght)
        return $desc;
    else
        return mb_substr($desc, 0, $lenght);
}

/**
 * Pre-process function of tool description for OPEN tool
 * @param $desc
 * @return string
 */
function processDescription($desc) {
//    $searchArr = array("\n", "  ");
//    $replaceArr = array("<br>", "&nbsp;&nbsp;");
//    $desc = str_replace($searchArr, $replaceArr, $desc);

    return processNote($desc);
}



function explodeString($delimiter, $str) {
    $array = explode($delimiter, $str);

    foreach ($array as $key => $value) {
        if (empty($value))
            unset($array[$key]);
        else
            $array[$key] = trim($value);
    }

    return $array;
}

function ob($fn){
    ob_start();
    $fn();
    return ob_get_clean();
}




// Имена шардов
function getUserTableName($userid) {
    return floor($userid / 10000) +1;
}

function getTableName1000($id) {
    return floor($id / 1000) +1;
}

// Время рождения в сек.
function getBirthTime($yyyy, $mm = 0, $dd = 0) {
    return mktime(0, 0, 0, $mm, $dd, $yyyy);
}


/**
 * @param $response
 * @param string $msg
 * @return mixed
 */
function returnSysNotice($response, $msg = 'Notice message') {
    $noticeID = time();
    $response['target_h']['#notification'] = '<div id="'.$noticeID.'" class="notice">'.$msg.'</div>';
    $response['func']['hideNotice'] = $noticeID;

    return $response;
}


/**
 * conditionAction(getActionChance(5, 7), 20, 3); // поверне 20 якщо $cond == true або 3 якщо $cond == false
 * @param $cond
 * @param int $then
 * @param int $else
 * @return int
 */
function conditionAction($cond, $then = 1, $else = 0) {
    if ($cond)
        return $then;
    else
        return $else;
}

/**
 * @param $duration
 * @param bool $hours
 * @param string $returnEndMsg
 * @return string
 */
function showTimer($duration, $hours = true, $returnEndMsg = 'Ended') {

    $hh = 0;
    $return = '';

    if ($hours) {
        $hh = floor($duration / 3600);
        if (mb_strlen($hh) < 2)
            $hh = '0'.$hh;

        $return .= $hh.':';
    }

    $mm = floor(($duration - $hh * 3600) / 60);
    if (mb_strlen($mm) < 2)
        $mm = '0'.$mm;

    $ss = floor($duration - $hh * 3600 - $mm * 60);
    if (mb_strlen($ss) < 2)
        $ss = '0'.$ss;

    $return .= $mm.':'.$ss;

    if ($duration <= 0)
        return $returnEndMsg;
    else
        return $return;
}


function addZero($value) {
    if ($value < 10)
        return $value = '0'.$value;

    return $value;
}


function userDirectory($steamid)
{
    $dir = substr($steamid, -3);
    return _SYSDIR_.'public/users/'.$dir.'/'.$steamid.'/';
}

function logsDirectory($file)
{
    return _SYSDIR_.'public/logs/'.$file;
}


function objectToArray($obj)
{
    $array = array();
    $arrayObj = (array)$obj;
    unset($obj);

    foreach ($arrayObj as $key => $value)
    {
        $array[$key]['id'] = $value->id;
        $array[$key]['classid'] = $value->classid;
        $array[$key]['instanceid'] = $value->instanceid;
    }
    unset($arrayObj);

    return $array;
}


/**
 * @param $text
 * @return mixed
 */
function bb($text)
{
    $text = preg_replace('#\[b\](.*?)\[/b\]#si', '<b>\1</b>', $text);
    $text = preg_replace('#\[i\](.*?)\[/i\]#si', '<i>\1</i>', $text);
    $text = preg_replace('#\[u\](.*?)\[/u\]#si', '<u>\1</u>', $text);
    $text = preg_replace('#\[red\](.*?)\[/red\]#si', '<span style="color:#FF0000">\1</span>', $text);
    $text = preg_replace('#\[green\](.*?)\[/green\]#si', '<span style="color:#00FF00">\1</span>', $text);
    $text = preg_replace('#\[blue\](.*?)\[/blue\]#si', '<span style="color:#0000FF">\1</span>', $text);
    $text = preg_replace('#\[yellow\](.*?)\[/yellow\]#si', '<span style="color:yellow">\1</span>', $text);
    $text = preg_replace('#\[center\](.*?)\[/center\]#si', '<center>\1</center>', $text);
    $text = preg_replace('#\[url=(.*?)\](.*?)\[/url\]#si', '<a href="\1">\2</a>', $text);
    $text = preg_replace('#\[code\](.*?)\[/code\]#si', '<div class="code">\1</div>', $text);
    $text = preg_replace('#\[hr]#si', '<hr/>', $text);
    $text = preg_replace('#\[br]#si', '<br/>', $text);
    $text = preg_replace('#\r\n#si', '<br/>', $text);

    return $text;
}    

function processNote($text) {
    PHP_EOL;
    $text = preg_replace('#(^-|\n-)\s#si', '<br><i class="lis"></i>', $text); // list mark
    $text = preg_replace('#(^--|\n--)\s#si', '<br>- ', $text); // hyphen
    $text = preg_replace('#\*{2,}([^*|^\n].*?)\*{2,}#si', '<strong>\1</strong>', $text);
    $text = preg_replace('#\*([^*|^\n].*?)\*#si', '<em>\1</em>', $text);
//    $text = preg_replace('#\*(.*?)\*#si', '<em>\1</em>', $text);

    $text = preg_replace('#[\-]{3,}(\n)?#si', '<hr>', $text); // <hr>

    $text = preg_replace('#\\\`([rgby])\\\`(.*?)\\\`#si', '<span class="color \1">\2</span>', $text); // `(r|g|b|y)Text` // r - red, g - green, b - blue, y - yellow
    $text = preg_replace('#\\\`(.*?)\\\`#si', '<span class="color">\1</span>', $text); // `Text` // red text
    $text = preg_replace('#`([rgby])`(.*?)`#si', '<span class="color \1">\2</span>', $text); // `(r|g|b|y)Text` // r - red, g - green, b - blue, y - yellow
    $text = preg_replace('#`(.*?)`#si', '<span class="color">\1</span>', $text); // `Text` // red text

//    $text = preg_replace('#\n(.*?)\n[=]{3,}\n#si', '<h1>\1</h1>', $text);

    $text = preg_replace('#\[\((.*?)\)(.*?)\]#si', '<a href="\1" target="_blank">\2</a>', $text); // Link
    $text = preg_replace('#\[code\](.*?)\[/code\]#si', '<div class="code">\1</div>', $text); // Code


    $searchArr = array(PHP_EOL, "  ");
    $replaceArr = array("<br>", "&nbsp;&nbsp;");
    $text = str_replace($searchArr, $replaceArr, $text);

    $text = preg_replace('#^(<br>){1,}#si', '', $text); // first <br>

    return $text;
}


/**
 * @param $text
 * @return mixed
 */
function smiles($text)
{
    $pattern = "~(https?:\/\/)?hubskins.com/([0-9A-Za-z\-\.\/]+)~";
    $replace = "<a href='http://hubskins.com/$2'>hubskins.com/$2</a>";

    $text = preg_replace($pattern, $replace, $text);

    $tags = array(
        ':)',
        ':D',
        ':P',
        ':shit:',
        ':bowl:',
        ':help:',
        ':mosking:',
        ':pray:',
    );

    $smiles = array(
        '<img src="'._SITEDIR_.'public/images/smiles/smile.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/biggrin.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/beee.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/shit.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/bowl.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/help.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/mosking.gif">',
        '<img src="'._SITEDIR_.'public/images/smiles/pray.gif">',
    );

    $text = str_replace($tags, $smiles, $text);

    return $text;
}
function checkLocation($lang)
{
    
    switch ($lang) {
        case 'en': return 'UK';
        case 'us': return 'US';
       /* case 'es': return 'Español';
        case 'fr': return 'Français';
        case 'it': return 'Italiano';
        case 'ru': return 'Pусский';*/
    }
     /*case 'du': return 'Dutch';*/

}
/* End of file */