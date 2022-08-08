<?php
/**
 * VIEW
 */

class View
{
    public $viewParser = TEMPLATE_PARSER;

    public $simulateAction = false; // to simulate

    /**
     * To get view file by url. ex: echo View::get('panel/index', 'left'); // Left menu
     * @param $viewPath
     * @param bool $viewDir ex: 'left' - if file in views/left
     * @return mixed|string
     */
    public static function get($viewPath, $viewDir = false)
    {
        $modulesLevel = explode('/', $viewPath);

        if ($viewDir)
            $viewDir .= '/';

        // todo deep in included controllers

        $fileUrl = 'modules/' . $modulesLevel[0] . '/views/' . $viewDir . $modulesLevel[1] . '.php';

        if (file_exists(_SYSDIR_.$fileUrl)) {
            ob_start("viewParser");
            include(_SYSDIR_.$fileUrl);
            ob_end_flush();

            return processTemplate(Request::getParam('buffer'));
        } else {
            return 'No view file: ' . $fileUrl;
        }
    }

    /**
     * Load layout
     * @param string $layout
     */
    public function Layout($layout = 'layout')
    {
        if ($this->viewParser) { // if true - process template: {URL:page}, {L:MENU}
            ob_start("viewParser");
            include(_SYSDIR_.'layout/'.$layout.'.php');
            ob_end_flush();

            echo processTemplate(Request::getParam('buffer'));
        } else {
            include(_SYSDIR_.'layout/'.$layout.'.php');
        }
    }

    /**
     * Return layout for ajax
     * @param string $layout
     * @return mixed
     */
    public function ajaxLayout($layout = 'layout')
    {
        if ($this->viewParser) { // if true - process template: {URL:page}, {L:MENU}
            ob_start("viewParser");
            include(_SYSDIR_ . 'layout/' . $layout . '.php');
            ob_end_flush();
        } else {
            ob_start();
            include(_SYSDIR_ . 'layout/' . $layout . '.php');
            ob_end_flush();
        }

        return processTemplate(Request::getParam('buffer'));
    }

    /**
     * Load view method from [ModuleView|View] class, called in Layout to call view parts
     * @param $method
     * @param bool $obReturn - for return ob
     */
    public function Load($method = 'contentPart', $obReturn = false)
    {
        if ($obReturn == true)
            ob_start();

        if (method_exists($this, $method))
            $this->$method();
        else
            print_data('! ' . $method . ' !');

        if ($obReturn == true)
            ob_end_flush();
    }

    /**
     * Function can be redefined at ModuleView
     */
    public function contentPart()
    {
        echo $this->Content();
    }

    /**
     * Simulate Content function
     */
    public function simulateContent($action)
    {
        $this->simulateAction = $action;
    }

    /**
     * Main load viewer
     * @param bool $obReturn - for return ob
     */
    public function Content($obReturn = false)
    {
        if ($this->simulateAction === false)
            $this->simulateAction = ACTION;

        if ($obReturn == true)
            ob_start();

        include(modulePath(CONTROLLER) . 'views/'.$this->simulateAction.'.php'); // todo

        if ($obReturn == true)
            ob_end_flush();
    }

    /**
     * Get any template
     * @param $path
     * @return string|string[]
     */
    public function getAnyView($path)
    {
        if (file_exists(_SYSDIR_ . $path)) {
            ob_start("viewParser");
            include(_SYSDIR_ . $path);
            ob_end_flush();

            return processTemplate(Request::getParam('buffer'));
        } else {
            return 'No view file: ' . $path;
        }
    }
}

/* End of file */