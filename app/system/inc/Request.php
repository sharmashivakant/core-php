<?php
/**
 * REQUEST
 */

class Request
{
    static public $route = array();
    static public $uri = array(); // Array of uri parts

    static public $title = ''; // $title of page
    static public $keywords = ''; // $keywords of page
    static public $description = ''; // $description of page
    static public $canonical = false; // Canonical of page

    static public $param = array();


    static public $ajaxParam = false; // if true - not add responses like: url, title, content, scrollToEl

    static public $ajaxResponse = array(
        'error' => array(),
        'res' => array()
    );


    /**
     * Function isAjax - use when you want check ajax request
     * @return bool
     */
    static public function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            return true;
        else
            return false;
    }

    /**
     * @return bool
     */
    static public function isAjaxPart()
    {
        return self::$ajaxParam;
    }

    /**
     * ajaxPart - call it to not add responses like: url, title, content, scrollToEl
     * @param bool $status
     * @return bool
     */
    static public function ajaxPart($status = true)
    {
        if ($status !== true)
            $status = false;

        self::ajaxOnly();

        return self::$ajaxParam = $status;
    }

    /**
     * Function ajaxOnly - return error404 if not ajax request
     */
    static public function ajaxOnly()
    {
        if (!Request::isAjax())
            error404();
    }

    /**
     * function isError - check added through Request::addError('f_name', 'Name must be filled (max 30 chars)');
     * @return bool
     */
    static public function isError()
    {
        if (self::$ajaxResponse['error'])
            return true;
        else
            return false;
    }

    /**
     * @param bool $key
     * @param bool $value
     */
    static public function addError($key = false, $value = false)
    {
        $error = array(
            'key' => $key,
            'value' => $value
        );

        array_push(self::$ajaxResponse['error'], $error);
    }

    /**
     * @param bool $action
     * @param bool $key
     * @param bool $value
     * @param bool $attrName
     */
    static public function addResponse($action = false, $key = false, $value = false, $attrName = false)
    {
        // $responseID = Request::addResponse('func', 'scrollToEl', false); // addResponse will return message id to we can remove it if need
        // todo Also, need ability to remove or change already added responses --> Controller --> ajaxProcessing

        $res = array(
            'action' => $action,
            'key' => $key,
            'value' => $value
        );
        if ($attrName)
            $res['attrName'] = $attrName;

        array_push(self::$ajaxResponse['res'], $res);
    }

    static public function removeResponse($action = false, $key = false)
    {
        // todo Also, need ability to remove or change already added responses --> Controller --> ajaxProcessing

        $res = array(
            'action' => $action,
            'key' => $key,
            'value' => $value
        );

        array_push(self::$ajaxResponse['res'], $res);
    }

    /**
     * Function responseAjax
     * @param bool $response
     */
    static public function responseAjax($response = false)
    {
//        print_data('$response');
//        print_data($response);
//
//        print_data('Request::$ajaxResponse');
//        print_data(Request::$ajaxResponse);

        if (is_array($response)) {
            foreach ($response AS $key => $value) {
                if (is_array($value)) {
                    Request::$ajaxResponse[$key] = array();

                    foreach ($value AS $k => $v) {
                        Request::$ajaxResponse[$key][$k] = $v;
                    }
                } else {
                    Request::$ajaxResponse[$key] = $value;
                }
            }
            //Request::$ajaxResponse = array_merge(Request::$ajaxResponse, $response);
        }
    }

    /**
     * Function endAjax
     * @param bool $response
     */
    static public function endAjax($response = false)
    {
//        print_data(self::$ajaxResponse);

        if ($response)
            Request::responseAjax($response);

        echo json_encode(Request::$ajaxResponse);
        exit;
    }

    /**
     * Adding error to response and exit from page processing
     * @param string|bool $error
     */
    static public function returnError($error = false)
    {
        if ($error) {
            $response['error'] = $error;
            Request::responseAjax($response);
        }

        echo json_encode(Request::$ajaxResponse);
        exit;
    }

    static public function returnErrors($error = false, $asText = false)
    {
        if (is_array($error)) {
            $response['error'] = "";

            foreach ($error as $err)
                $response['error'] .= "- " . $err . "\n";

            if ($asText === true)
                return $response['error'];

            Request::responseAjax($response);
        }

        echo json_encode(Request::$ajaxResponse);
        exit;
    }


    /**
     * @param array $value
     */
    static public function setRoute($value)
    {
        self::$route = $value;
    }

    /**
     * @param bool|string $key
     * @return array|mixed
     */
    public static function getRoute($key = false)
    {
        if ($key === false)
            return self::$route;
        else
            return self::$route[$key];
    }

    /**
     * @param $value
     */
    static public function setUri($value)
    {
        self::$uri = $value;
    }

//    static public function removeFirstUri()
//    {
//
//    }

    /**
     * @param bool $num
     * @return array
     */
    public static function getUri($num = false)
    {
        if ($num === false)
            return self::$uri;
        else
            return self::$uri[$num];
    }


    /**
     * @param $key
     * @param $value
     */
    static public function setParam($key, $value)
    {
        self::$param[$key] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    static public function getParam($name)
    {
        return isset(self::$param[$name]) ? self::$param[$name] : false;
    }


    // Title, Keywords Description

    /**
     * @param $title
     * @param bool $translate
     */
    static public function setTitle($title, $translate = true)
    {
        if ($translate !== false)
            $title = Lang::translate($title);

        self::$title = $title;
    }

    /**
     * @return mixed
     */
    static public function getTitle()
    {
        return self::$title;
    }

    /**
     * @param $keywords
     * @param bool $translate
     */
    static public function setKeywords($keywords, $translate = true)
    {
        if ($translate !== false)
            $keywords = Lang::translate($keywords);

        self::$keywords = $keywords;
    }

    /**
     * @return string
     */
    static public function getKeywords()
    {
        return self::$keywords;
    }

    /**
     * @param $description
     * @param bool $translate
     */
    static public function setDescription($description, $translate = true)
    {
        if ($translate !== false)
            $description = Lang::translate($description);

        self::$description = $description;
    }

    /**
     * @return string
     */
    static public function getDescription()
    {
        return self::$description;
    }


    /**
     * @param $canonical
     */
    static public function setCanonical($canonical)
    {
        self::$canonical = $canonical;
    }

    /**
     * @return string
     */
    static public function getCanonical()
    {
        return self::$canonical;
    }


    /**
     * @param $name
     * @return mixed
     */
    static public function getSession($name)
    {
        return getSession($name, false);
    }
}
/* End of file */