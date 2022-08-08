<?php
class AnalyticsController extends Controller
{
    protected $layout = 'layout_panel';

    use Validator;

    public function indexAction()
    {
        //$this->view->list = AnalyticsModel::getAll();
        Request::setTitle('Google Analytics');
    }


    public function refersAction()
    {
        $this->view->list = Model::fetchAll(Model::select('refer_friend', " `deleted` = 'no' ORDER BY `time`"));

        Request::setTitle('Uploaded CVs');
    }

    public function export_dataAction()
    {
        Request::ajaxPart();

        $data = Model::fetchAll(Model::select('refer_friend'));

        if (is_array($data) && count($data) > 0) {

            //prepare data
            $dataToCsv = [];
            $i = 0;
            foreach ($data as $item) {
                $dataToCsv[$i]['id'] = $item->id;
                $dataToCsv[$i]['name'] = $item->name;
                $dataToCsv[$i]['email'] = $item->email;
                $dataToCsv[$i]['tel'] = $item->tel;
                $dataToCsv[$i]['friend_name'] = $item->name;
                $dataToCsv[$i]['friend_email'] = $item->email;
                $dataToCsv[$i]['friend_tel'] = $item->tel;
                $dataToCsv[$i]['date submitted'] = date('m.d.Y', $item->time);
                $dataToCsv[$i]['cv link'] = SITE_NAME . _SITEDIR_ . 'data/cvs/' . $item->cv;

                $i++;
            }

            $df = fopen("app/data/tmp/export.csv", 'w');
            fputcsv($df, array_keys(reset($dataToCsv)), ';');
            foreach ($dataToCsv as $row) {
                fputcsv($df, $row, ';');
            }
            fclose($df);

            Request::addResponse('func', 'downloadFile', _SITEDIR_ . 'data/tmp/export.csv');
            Request::endAjax();
        } else {
            Request::returnError('No Data');
        }
    }


    public function configAction()
    {
        if ($this->startValidation()) {
            $this->validatePost('view_id',          'View ID',          'required|trim|min_length[1]');
            $this->validatePost('credentials_json', 'Credentials JSON', 'required|trim|min_length[1]');
            $this->validatePost('include_code',     'Include JS Code',  'trim|min_length[1]');

            if ($this->isValid()) {
                // View ID
                if (!AnalyticsModel::count_rows('analytics_view_id')) {
                    Model::insert('settings', array(
                        'name' => 'analytics_view_id',
                        'title' => 'Google Analytics View ID',
                        'value' => post('view_id')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Google Analytics View ID',
                        'value' => post('view_id')
                    ), "`name` = 'analytics_view_id'");
                }

                // Credentials JSON
                if (!AnalyticsModel::count_rows('analytics_credentials_json')) {
                    Model::insert('settings', array(
                        'name'  => 'analytics_credentials_json',
                        'title' => 'Google Analytics Credentials JSON',
                        'value' => post('credentials_json')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Google Analytics Credentials JSON',
                        'value' => post('credentials_json')
                    ), "`name` = 'analytics_credentials_json'");
                }


                // Include JS Code
                if (!AnalyticsModel::count_rows('analytics_include_code')) {
                    Model::insert('settings', array(
                        'name' => 'analytics_include_code',
                        'title' => 'Google Analytics Include Code',
                        'value' => post('include_code')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Google Analytics Include Code',
                        'value' => post('include_code')
                    ), "`name` = 'analytics_include_code'");
                }

                Request::addResponse('func', 'noticeSuccess', 'Saved');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        // Values
        $this->view->view_id          = AnalyticsModel::get('analytics_view_id');
        $this->view->credentials_json = AnalyticsModel::get('analytics_credentials_json');
        $this->view->include_code     = AnalyticsModel::get('analytics_include_code');

        Request::setTitle('Add Industry Sector');
    }

    public function include_codeAction()
    {
        if ($this->startValidation()) {

            $this->validatePost('include_code_top',     'Include JS Code',  'trim|min_length[1]');
            $this->validatePost('include_code_bottom',  'Include JS Code',  'trim|min_length[1]');

            if ($this->isValid()) {

                // Include JS Code Top
                if (!AnalyticsModel::count_rows('include_code_top')) {
                    Model::insert('settings', array(
                        'name' => 'include_code_top',
                        'title' => 'Include JS Code Top',
                        'value' => post('include_code_top')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Include JS Code Top',
                        'value' => post('include_code_top')
                    ), "`name` = 'include_code_top'");
                }

                // Include JS Code Bottom
                if (!AnalyticsModel::count_rows('include_code_bottom')) {
                    Model::insert('settings', array(
                        'name' => 'include_code_bottom',
                        'title' => 'Include JS Code Bottom',
                        'value' => post('include_code_bottom')
                    ));
                } else {
                    Model::update('settings', array(
                        'title' => 'Include JS Code Bottom',
                        'value' => post('include_code_bottom')
                    ), "`name` = 'include_code_bottom'");
                }

                Request::addResponse('func', 'noticeSuccess', 'Saved');
                Request::endAjax();
            } else {
                if (Request::isAjax())
                    Request::returnErrors($this->validationErrors);
            }
        }

        $this->view->include_code_top = AnalyticsModel::get('include_code_top');
        $this->view->include_code_bottom = AnalyticsModel::get('include_code_bottom');

        Request::setTitle('Include JS code');
    }

    public function ajaxAction()
    {
        Request::ajaxPart();

        $source = Request::getUri(0);
        if (!$source) $source = NULL;

        $view_id          = AnalyticsModel::get('analytics_view_id');
        $credentials_json = AnalyticsModel::get('analytics_credentials_json');

        if (!$credentials_json || !isset($credentials_json->value) || empty($credentials_json->value)) {
            Request::returnError('Analytics module will not work without login credentials - to get credentials use instruction here - https://developers.google.com/analytics/devguides/reporting/core/v4/quickstart/service-php and save at Configure page.');
        } else {
            $credentials = json_decode(reFilter($credentials_json->value), TRUE);

            if (!$credentials) {
                Request::returnError('Analytics module will not work without CORRECT login credentials -  to get credentials use instruction here - https://developers.google.com/analytics/devguides/reporting/core/v4/quickstart/service-php and save at Configure page.');
            } else {

                if (!$view_id || !isset($view_id) || empty($view_id)) {
                    Request::returnError('Analytics module will not work without View ID - get it at Developers Console and save at Configure page.');
                } else {

                    try {
                        include _SYSDIR_ . 'system/lib/google-api-php-client/vendor/autoload.php';

                        $client = new Google_Client();
                        $client->setApplicationName(SITE_NAME . ' Analytics');
                        $client->setAuthConfig($credentials);
                        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
                        $analytics = new Google_Service_AnalyticsReporting($client);

                        $metrics = array();
                        $dimensions = array();
                        $orderBys = array();
                        $pageSize = NULL;

                        switch ($source) {
                            case 'top':
                                $pageviews = new Google_Service_AnalyticsReporting_Metric();
                                $pageviews->setExpression("ga:pageviews");
                                $pageviews->setAlias("pageviews");
                                $metrics[] = $pageviews;

                                $pagePath = new Google_Service_AnalyticsReporting_Dimension();
                                $pagePath->setName("ga:pagePath");
                                $dimensions[] = $pagePath;

                                $order_pageviews = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_pageviews->setFieldName('ga:pageviews');
                                $order_pageviews->setSortOrder('DESCENDING');
                                $orderBys[] = $order_pageviews;
                                break;
                            case 'sources':
                                $sessions = new Google_Service_AnalyticsReporting_Metric();
                                $sessions->setExpression("ga:visits");
                                $metrics[] = $sessions;

                                $pageSize = 10;

                                $sources = new Google_Service_AnalyticsReporting_Dimension();
                                $sources->setName("ga:source");
                                $dimensions[] = $sources;

                                $order_visits = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_visits->setFieldName('ga:visits');
                                $order_visits->setSortOrder('DESCENDING');
                                $orderBys[] = $order_visits;
                                break;
                            case 'country':
                                $sessions = new Google_Service_AnalyticsReporting_Metric();
                                $sessions->setExpression("ga:visits");
                                $metrics[] = $sessions;

                                $pageSize = 10;

                                $country = new Google_Service_AnalyticsReporting_Dimension();
                                $country->setName("ga:country");
                                $dimensions[] = $country;

                                $order_visits = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_visits->setFieldName('ga:visits');
                                $order_visits->setSortOrder('DESCENDING');
                                $orderBys[] = $order_visits;
                                break;
                            case 'devices':
                                $sessions = new Google_Service_AnalyticsReporting_Metric();
                                $sessions->setExpression("ga:visits");
                                $metrics[] = $sessions;

                                $pageSize = 10;

                                $deviceCategory = new Google_Service_AnalyticsReporting_Dimension();
                                $deviceCategory->setName("ga:deviceCategory");
                                $dimensions[] = $deviceCategory;

                                $order_visits = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_visits->setFieldName('ga:visits');
                                $order_visits->setSortOrder('DESCENDING');
                                $orderBys[] = $order_visits;
                                break;
                            case 'sessions':
                                $sessions = new Google_Service_AnalyticsReporting_Metric();
                                $sessions->setExpression("ga:sessions");
                                $sessions->setAlias("sessions");
                                $metrics[] = $sessions;

                                $date = new Google_Service_AnalyticsReporting_Dimension();
                                $date->setName("ga:date");
                                $dimensions[] = $date;
                                break;
                            case 'pageviews':
                                $pageviews = new Google_Service_AnalyticsReporting_Metric();
                                $pageviews->setExpression("ga:pageviews");
                                $pageviews->setAlias("pageviews");
                                $metrics[] = $pageviews;

                                $date = new Google_Service_AnalyticsReporting_Dimension();
                                $date->setName("ga:date");
                                $dimensions[] = $date;
                                break;
                            case 'new_users':
                                $users = new Google_Service_AnalyticsReporting_Metric();
                                $users->setExpression("ga:newUsers");
                                $users->setAlias("new_users");
                                $metrics[] = $users;

                                $users = new Google_Service_AnalyticsReporting_Metric();
                                $users->setExpression("ga:users");
                                $users->setAlias("users");
                                $metrics[] = $users;

                                $date = new Google_Service_AnalyticsReporting_Dimension();
                                $date->setName("ga:date");
                                $dimensions[] = $date;

                                $userType = new Google_Service_AnalyticsReporting_Dimension();
                                $userType->setName("ga:userType");
                                $dimensions[] = $userType;
                                break;
                            case 'bounceRate':
                                $pageviews = new Google_Service_AnalyticsReporting_Metric();
                                $pageviews->setExpression("ga:bounceRate");
                                $pageviews->setAlias("bounceRate");
                                $metrics[] = $pageviews;

                                $pagePath = new Google_Service_AnalyticsReporting_Dimension();
                                $pagePath->setName("ga:pagePath");
                                $dimensions[] = $pagePath;

                                $order_pageviews = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_pageviews->setFieldName('ga:bounceRate');
                                $order_pageviews->setSortOrder('ASCENDING');
                                $orderBys[] = $order_pageviews;

                                break;
                            case 'avgSessionDuration':
                                $pageviews = new Google_Service_AnalyticsReporting_Metric();
                                $pageviews->setExpression("ga:avgSessionDuration");
                                $pageviews->setAlias("avgSessionDuration");
                                $metrics[] = $pageviews;

                                $pagePath = new Google_Service_AnalyticsReporting_Dimension();
                                $pagePath->setName("ga:pagePath");
                                $dimensions[] = $pagePath;

                                $order_pageviews = new Google_Service_AnalyticsReporting_OrderBy();
                                $order_pageviews->setFieldName('ga:avgSessionDuration');
                                $order_pageviews->setSortOrder('DESCENDING');
                                $orderBys[] = $order_pageviews;
                                break;
                            case 'users':
                            default:
                                $users = new Google_Service_AnalyticsReporting_Metric();
                                $users->setExpression("ga:users");
                                $users->setAlias("users");
                                $metrics[] = $users;

                                $date = new Google_Service_AnalyticsReporting_Dimension();
                                $date->setName("ga:date");
                                $dimensions[] = $date;
                        }


                        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
                        $dateRange->setStartDate("30daysAgo");
                        $dateRange->setEndDate("today");

                        $request = new Google_Service_AnalyticsReporting_ReportRequest();
                        $request->setViewId((string)$view_id->value);
                        $request->setDateRanges($dateRange);
                        $request->setMetrics($metrics);
                        $request->setDimensions($dimensions);
                        $request->setOrderBys($orderBys);
                        if ($pageSize !== NULL)
                            $request->setPageSize($pageSize);


                        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
                        $body->setReportRequests(array($request));
                        $reports = $analytics->reports->batchGet($body);


                        switch ($source) {
                            case 'bounceRate':
                            case 'avgSessionDuration':
                            case 'top':
                                for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
                                    $report = $reports[$reportIndex];
                                    $header = $report->getColumnHeader();
                                    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
                                    $rows = $report->getData()->getRows();

                                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                                        $row = $rows[$rowIndex];
                                        $dimensions = $row->getDimensions();
                                        $metrics = $row->getMetrics();
                                        $date_values = array();
                                        $date_values['path'] = $dimensions[0];
                                        if ($metrics) {
                                            for ($j = 0; $j < count($metrics); $j++) {
                                                $values = $metrics[$j]->getValues();
                                                for ($k = 0; $k < count($values); $k++) {
                                                    $entry = $metricHeaders[$k];
                                                    $date_values[$entry->getName()] = (int)$values[$k];
                                                }
                                            }
                                        }
                                        $response[] = $date_values;
                                    }
                                }
                                break;
                            case 'sources':
                            case 'country':
                            case 'devices':
                                for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
                                    $report = $reports[$reportIndex];
                                    $header = $report->getColumnHeader();
                                    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
                                    $rows = $report->getData()->getRows();

                                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                                        $row = $rows[$rowIndex];
                                        $dimensions = $row->getDimensions();
                                        $metrics = $row->getMetrics();
                                        $date_values = array();
                                        $date_values['base'] = $dimensions[0];
                                        if ($metrics) {
                                            for ($j = 0; $j < count($metrics); $j++) {
                                                $values = $metrics[$j]->getValues();
                                                for ($k = 0; $k < count($values); $k++) {
                                                    $entry = $metricHeaders[$k];
                                                    $date_values[$entry->getName()] = (int)$values[$k];
                                                }
                                            }
                                        }
                                        $response[] = $date_values;
                                    }
                                }
                                break;
                            case 'new_users':
                                for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
                                    $report = $reports[$reportIndex];
                                    $header = $report->getColumnHeader();
                                    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
                                    $rows = $report->getData()->getRows();

                                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                                        $row = $rows[$rowIndex];
                                        $dimensions = $row->getDimensions();
                                        $date = $dimensions[0];
                                        $userType = $dimensions[1];
                                        $metrics = $row->getMetrics();
                                        $date_values = array();
                                        $date_values['date'] = $date;
                                        $date_values['user_type'] = $userType;
                                        if ($metrics) {
                                            for ($j = 0; $j < count($metrics); $j++) {
                                                $values = $metrics[$j]->getValues();
                                                for ($k = 0; $k < count($values); $k++) {
                                                    $entry = $metricHeaders[$k];
                                                    $date_values[$entry->getName()] = (int)$values[$k];
                                                }
                                            }
                                        }
                                        $response[] = $date_values;
                                    }
                                }
                                break;
                            case 'sessions':
                            case 'pageviews':
                            case 'users':
                            default:
                                for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
                                    $report = $reports[$reportIndex];
                                    $header = $report->getColumnHeader();
                                    $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
                                    $rows = $report->getData()->getRows();

                                    for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                                        $row = $rows[$rowIndex];
                                        $dimensions = $row->getDimensions();
                                        $date = $dimensions[0];
                                        $metrics = $row->getMetrics();
                                        $date_values = array();
                                        $date_values['date'] = $date;
                                        if ($metrics) {
                                            for ($j = 0; $j < count($metrics); $j++) {
                                                $values = $metrics[$j]->getValues();
                                                for ($k = 0; $k < count($values); $k++) {
                                                    $entry = $metricHeaders[$k];
                                                    $date_values[$entry->getName()] = (int)$values[$k];
                                                }
                                            }
                                        }
                                        $response[] = $date_values;
                                    }
                                }
                        }

                    } catch (Exception $e) {
                        Request::returnError($e->getMessage());
                    }
                }
            }
        }

        header("Content-type:application/json");
        echo json_encode($response);
        exit;
    }
}
/* End of file */