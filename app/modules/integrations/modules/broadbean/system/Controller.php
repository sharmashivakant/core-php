<?php

class BroadbeanController extends Controller
{
    use Validator;

    public function indexAction()
    {
        header("Content-type:text/plain");

        $data = urldecode(trim(file_get_contents('php://input')));
        $data = file_get_contents(_SYSDIR_ . 'modules/integrations/modules/broadbean/test.xml');


        if ($data) {
            $data = str_replace(array("\r\n", "\n", "\r", "\t"), '', $data);
            $data = str_replace('&amp;', '&', $data);
            $data = str_replace('&nbsp;', ' ', $data);
            $jobData = $this->getdataA2('<job>', '</job>', $data);

            $dataArray = array();
//            $dataArray['job_id'] = $this->getdataA2('<JobID>', '</JobID>', $jobData);
            $dataArray['ref'] = filter(trim($this->getdataA2('<job_reference>', '</job_reference>', $jobData)));
            $dataArray['title'] = filter($this->getdataA2('<job_title>', '</job_title>', $jobData));
            $dataArray['content'] = filter($this->getdataA('<job_description><![CDATA[', ']]></job_description>', $jobData));
            $dataArray['application_email'] = $this->getdataA2('<application>', '</application>', $jobData);
            $dataArray['location'] = filter($this->getdataA2('<job_location>', '</job_location>', $jobData));
            $dataArray['contract_type'] = strtolower($this->getdataA2('<job_listing_type>', '</job_listing_type>', $jobData));
            $dataArray['command'] = filter($this->getdataA2('<command>', '</command>', $jobData));
            $dataArray['tel'] = filter($this->getdataA2('<company_contact_phone>', '</company_contact_phone>', $jobData));
            $dataArray['sector'] = filter($this->getdataA2('<job_industry>', '</job_industry>', $jobData));
            $dataArray['featured'] = filter($this->getdataA2('<featured>', '</featured>', $jobData));
            $dataArray['username'] = filter($this->getdataA2('<username>', '</username>', $jobData));
            $dataArray['company_logo'] = filter($this->getdataA2('<company_logo>', '</company_logo>', $jobData));
            $dataArray['salary_value'] = filter($this->getdataA2('<job_salary>', '</job_salary>', $jobData));
            $dataArray['company_name'] = filter($this->getdataA2('<company_name>', '</company_name>', $jobData));
            $dataArray['time_expire'] = filter($this->getdataA2('<job_expires>', '</job_expires>', $jobData));
            $dataArray['password'] = filter($this->getdataA2('<password>', '</password>', $jobData));
            $dataArray['job_author'] = filter($this->getdataA2('<job_author>', '</job_author>', $jobData));
            $dataArray['company_contact_name'] = filter($this->getdataA2('<company_contact_name>', '</company_contact_name>', $jobData));
            $dataArray['package'] = filter($this->getdataA2('<job_benefits>', '</job_benefits>', $jobData));
            $dataArray['slug'] = makeSlug($dataArray['title']);


//            print_data($dataArray);

//            $dataArray['DatePosted'] = strtolower($this->getdataA2('<DatePosted>', '</DatePosted>', $jobData));
//            $dataArray['ExpiryDate'] = strtolower($this->getdataA2('<ExpiryDate>', '</ExpiryDate>', $jobData));
//            $dataArray['SalaryCurrency'] = strtolower($this->getdataA2('<SalaryCurrency>', '</SalaryCurrency>', $jobData));
//            $dataArray['salary_type'] = strtolower($this->getdataA2('<SalaryPer>', '</SalaryPer>', $jobData));
//            $dataArray['SalaryMaximum'] = strtolower($this->getdataA2('<SalaryMaximum>', '</SalaryMaximum>', $jobData));
//            $dataArray['SalaryMinimum'] = strtolower($this->getdataA2('<SalaryMinimum>', '</SalaryMinimum>', $jobData));
//            $dataArray['salary'] = filter($this->getdataA('<SalaryText><![CDATA[', ']]></SalaryText>', $jobData));
//            $dataArray['postcode'] = strtolower($this->getdataA2('<JobPostcode>', '</JobPostcode>', $jobData));
//            $dataArray['LatLong'] = strtolower($this->getdataA2('<LatLong>', '</LatLong>', $jobData));
//            $dataArray['sector'] = filter($this->getdataA('<IndustrySector><![CDATA[', ']]></IndustrySector>', $jobData));
//            $dataArray['specialism'] = strtolower($this->getdataA2('<Specialism>', '</Specialism>', $jobData));
//            $dataArray['description'] = filter($this->getdataA('<JobDescription><![CDATA[', ']]></JobDescription>', $jobData));
//            $dataArray['ConsultantName'] = $this->getdataA2('<ConsultantName>', '</ConsultantName>', $jobData);
//            $dataArray['ConsultantJobTitle'] = $this->getdataA2('<ConsultantJobTitle>', '</ConsultantJobTitle>', $jobData);
//            $dataArray['ConsultantTelephone'] = $this->getdataA2('<ConsultantTelephone>', '</ConsultantTelephone>', $jobData);
//            $dataArray['consultant_email'] = $this->getdataA2('<ConsultantEmail>', '</ConsultantEmail>', $jobData);
//            $dataArray['username'] = $this->getdataA2('<username>', '</username>', $jobData);
//            $dataArray['password'] = $this->getdataA2('<password>', '</password>', $jobData);
//            $dataArray['slug'] = makeSlug($this->getdataA('<title><![CDATA[', ']]></title>', $jobData));
//            $dataArray['contract_length'] = filter($this->getdataA('<contract_length><![CDATA[', ']]></contract_length>', $jobData));
//            $dataArray['salary_type'] = $this->getdataA2('<salary_type>', '</salary_type>', $jobData);
//            $dataArray['salary'] = filter($this->getdataA(' <salary><![CDATA[', ']]></salary>', $jobData));
//            $dataArray['location'] = filter($this->getdataA('<location><![CDATA[', ']]></location>', $jobData));
//            $dataArray['postcode'] = $this->getdataA2('<postcode>', '</postcode>', $jobData);
//            $dataArray['application_url'] = $this->getdataA('<application_url><![CDATA[', ']]></application_url>', $jobData);
//            $dataArray['sector'] = filter($this->getdataA('<sector><![CDATA[', ']]></sector>', $jobData));
//            $dataArray['application_email'] = $this->getdataA2('<application_email>', '</application_email>', $jobData);
//            $dataArray['consultant'] = filter($this->getdataA('<consultant><![CDATA[', ']]></consultant>', $jobData));
//            print_data($dataArray);

            /*
            echo '<table cellpadding="5" cellpadding="0" border="1">';
            foreach ($dataArray  as $field_title=>$field_value){
                echo "<tr><td><b>".$field_title.":</b></td><td>".$field_value."</td></tr>";
            }
            echo '</table>';
            */

            if ($dataArray['title']) {
                $vacancy_id = NULL;

                $chkVacExists = Model::fetch(Model::select('vacancies', "`ref` = '" . $dataArray['ref'] . "'  LIMIT 1"));


                // Get consultant id
                $chkConsultantExists = BroadbeanModel::getUserByEmail($dataArray['consultant_email']);
                $consultant_id = $chkConsultantExists->id;
                if (!$consultant_id) $consultant_id = 0;


                if (!$chkVacExists->id) {
                    /////////////////////////////////// Insert New record ///////////////////////////////////
                    $k = 0;
                    $chkVacSlug = Model::count('vacancies', "*", "`slug` = '" . $dataArray['slug'] . "'");

                    if ($chkVacSlug > 0) {
                        $k = $chkVacSlug;
                        $dataArray['slug'] = makeSlug($this->getdataA('<title><![CDATA[', ']]></title>', $jobData) . '-' . $dataArray['ref']);
                    }

                    $dataVac = array(
                        'title'             => $dataArray['title'],
                        'ref'               => $dataArray['ref'],
                        'contract_type'     => mb_strtolower($dataArray['contract_type']),
//                        'contract_length'   => $dataArray['contract_length'],
//                        'salary_type'       => $dataArray['salary_type'],
//                        'postcode'          => $dataArray['postcode'],
                        'salary_value'      => $dataArray['salary_value'],
                        'content'           => $dataArray['content'],
                        'content_short'     => mb_substr($dataArray['content'], 0, 250),
                        'consultant_id'     => $consultant_id,
                        'meta_title'        => $dataArray['title'],
                        'meta_keywords'     => $dataArray['title'],
                        'meta_desc'         => $dataArray['title'],
//                        'client_email'      => $dataArray['application_email'],
                        'slug'              => $dataArray['slug'],
                        'time_expire'       => $dataArray['time_expire'],
                        'time'              => time()
                    );

                    $result   = Model::insert('vacancies', $dataVac); // Insert row
                    $insertID = Model::insertID();

                    if (!$result && $insertID) {
                        $vacancy_id = $insertID;
                        echo "Job Added Successfully (ID: " . $insertID . ") " . url('job', $dataArray['slug']) . "\n";
                    } else {
                         print_data('Some error');
                    }
                }
                else {
                    /////////////////////////////////// UPDATE JOB POSTING ///////////////////////////////////

                    $k = 0;
                    $chkVacSlug = Model::count('vacancies', "*", "`slug` = '" . $dataArray['slug'] . "' AND `id` != '$chkVacExists->id'");
//                    print_data('$chkVacSlug');
//                    print_data($chkVacSlug);

                    if ($chkVacSlug > 0) {
                        $k = $chkVacSlug;
                        $dataArray['slug'] = makeSlug($this->getdataA('<title><![CDATA[', ']]></title>', $jobData) . '-' . $dataArray['ref']);
                    }

                    $dataArr = array(
                        'title'             => $dataArray['title'],
                        'ref'               => $dataArray['ref'],
                        'contract_type'     => mb_strtolower($dataArray['contract_type']),
//                        'contract_length'   => $dataArray['contract_length'],
//                        'salary_type'       => $dataArray['salary_type'],
//                        'postcode'          => $dataArray['postcode'],
                        'salary_value'      => $dataArray['salary_value'],
                        'content'           => $dataArray['content'],
                        'content_short'     => mb_substr($dataArray['content'], 0, 250),
                        'consultant_id'     => $consultant_id,
                        'meta_title'        => $dataArray['title'],
                        'meta_keywords'     => $dataArray['title'],
                        'meta_desc'         => $dataArray['title'],
//                        'client_email'      => $dataArray['application_email'],
                        'slug'              => $dataArray['slug'],
                    );

                    Model::update('vacancies', $dataArr, "`ref` = '" . $dataArray['ref'] . "'");

                    $vacancy_id = $chkVacExists->id;
                    echo "Job Updated Successfully (ID: " . $vacancy_id . ") " . url('job', $dataArray['slug']) . "\n";
                }


                if ($vacancy_id) {
                    Model::delete('vacancies_locations', "`vacancy_id` = '$vacancy_id'");
                    $location_names = explode(",", $dataArray['location']);

                    // Add locations
                    foreach ($location_names as $locName) {
                        $chkLocationExists = Model::fetch(Model::select('locations', "`name` = '" . filter($locName) . "' LIMIT 0,1"));
                        $location_id = $chkLocationExists->id;

                        if (!$location_id) {
                            $resultLoc   = Model::insert('locations', ['name' => filter($locName)]); // Insert row
                            $insertIDLoc = Model::insertID();

                            if (!$resultLoc && $insertIDLoc)
                                $location_id = $insertIDLoc;
                        }

                        if ($location_id) {
                            Model::insert('vacancies_locations', [
                                'vacancy_id' => $vacancy_id,
                                'location_id' => $location_id
                            ]); // Insert row
                        }
                    }


                    // Sectors
                    // Deleting of assigned sectors required to be out of validation, because in case of empty sectors values from remote API we need to remove all assigned sectors as well
                    Model::delete('vacancies_sectors', "`vacancy_id` = '$vacancy_id'");

                    if ($dataArray['sector']) {
                        $sector_names = explode(",", $dataArray['sector']);

                        if ($sector_names && is_array($sector_names) && count($sector_names) > 0) {
                            foreach ($sector_names as $sectorName) {
                                $chkLocationExists = Model::fetch(Model::select('sectors', "`name` = '" . filter($sectorName) . "' LIMIT 0,1"));
                                $sector_id = $chkLocationExists->id;

                                if (!$sector_id) {
                                    $resultSec   = Model::insert('sectors', ['name' => filter($sectorName)]); // Insert row
                                    $insertIDSec = Model::insertID();

                                    if (!$resultSec && $insertIDSec)
                                        $sector_id = $insertIDSec;
                                }

                                if ($sector_id) {
                                    Model::insert('vacancies_sectors', [
                                        'vacancy_id' => $vacancy_id,
                                        'sector_id' => $sector_id
                                    ]); // Insert row
                                }
                            }
                        }
                    }

//            $consultant_name = explode(" ", $dataArray['consultant']);
//            if (count($consultant_name) > 1) {
//                $c_firstname = trim($consultant_name[0]);
//                $c_lastname = trim($consultant_name[1]);
//                $chkconsultantExists = $db->prepare("SELECT user_id FROM `team` WHERE `firstname` =:firstname and `lastname` =:lastname LIMIT 0,1");
//                $chkconsultantExists->execute(array('firstname' => $c_firstname, 'lastname' => $c_lastname));
//                $chkconsultantExists = $chkconsultantExists->fetch();
//                $consultant_id = $chkConsultantExists->id;
//
////                if ($consultant_id == 0) {
////                    $createeVac = $db->prepare("INSERT INTO `team` SET  `firstname` =:firstname, `lastname` =:lastname");
////                    $createeVac->execute(array('firstname' => $c_firstname, 'lastname' => $c_lastname));
////                    $consultant_id = $db->lastInsertId();
////                }
//                if ($consultant_id != '') {
//                    $updateVac = $db->prepare("UPDATE `vacancies` SET  `consultant_id` = :consultant_id  WHERE `vacancy_id`= :vacancy_id");
//                    $updateVac->execute(array('consultant_id' => $consultant_id, 'vacancy_id' => $vacancy_id));
//                }
//            }

                }
            }
        } else {
            echo "No data provided" . "\n";
        }

        exit;
    }

    public function deleteAction()
    {
        $data = urldecode(trim(file_get_contents('php://input')));
//        $data = file_get_contents(_SYSDIR_ . "testdelete.xml");

        $dataArray = array();

        if (isset($data)){
            $jobData = $this->getdataA2('<delete>','</delete>',$data);

            $dataArray['id'] = trim($this->getdataA2('<id>','</id>',$jobData));
            $dataArray['username'] = $this->getdataA2('<username>','</username>',$jobData);
            $dataArray['password'] = $this->getdataA2('<password>','</password>',$jobData);

            /*
            echo '<table cellpadding="5" cellpadding="0" border="1">';
            foreach ($dataArray  as $field_title=>$field_value){
                echo "<tr><td><b>".$field_title.":</b></td><td>".$field_value."</td></tr>";
            }
            echo '</table>';
            */

            if (isset($dataArray['id'])) {
                $chkVacExists = Model::fetch(Model::select('vacancies', "`ref` = '" . $dataArray['id'] . "'  LIMIT 0,1"));
                $vacancy_id = $chkVacExists->id;
//                print_data('$chkVacExists');
//                print_data($chkVacExists);

                if ($vacancy_id != '') {
                    Model::update('vacancies', ['time_expire' => time() - 180*24*3600], "`id` = '" . $chkVacExists->id . "'");
//                    $deleteJob = $db->prepare("UPDATE `vacancies` SET `date` = FROM_UNIXTIME(:expire_date) WHERE `vacancy_id`=:vacancy_id ");
//                    $deleteJob->execute(array('expire_date' => time() - 180*24*3600, 'vacancy_id' => $vacancy_id));

//			$deleteJob = $db->prepare("DELETE FROM `vacancies` WHERE `vacancy_id`=:vacancy_id ");
//			$deleteJob->execute(array('vacancy_id' => $vacancy_id));
//
//			$delete_vl = $db->prepare("DELETE FROM `vacancies_locations` WHERE `vacancy_id`= :vacancy_id");
//			$delete_vl->execute(array('vacancy_id' => $vacancy_id));
//
//			$delete_vs = $db->prepare("DELETE FROM `vacancies_sectors` WHERE `vacancy_id`=:vacancy_id");
//			$delete_vs->execute(array('vacancy_id' => $vacancy_id));

                    echo "DELETE - Job Deleted Successfully";
                } else {
                    echo "ERROR - Job Not Found";
                }
            }
        }

        exit;

//        $data['views'] = '++';
//        Model::update('vacancies', $data, "`id` = '" . $this->view->job->id . "'");
//        $this->view->consultant = BroadbeanModel::getUser($this->view->job->consultant_id);
    }


    public function getDataA($strStart, $strEnd, $text)
    {
        for ($i = 0; $i <= strlen($text); $i++) {
            if (substr($text, $i, strlen($strStart)) == $strStart) {
                $st = $i;
                $k = $i;
                while (substr($text, $k, strlen($strEnd)) != $strEnd) {
                    $k++;
                }
                $en = $k + strlen($strEnd);
                $start = $st + strlen($strStart);
                $tmpstr = substr($text, $start, $k - $start);

            }
        }
        return $tmpstr;
    }

    public function getDataA2($strStart, $strEnd, $text)
    {
        $text = preg_replace("/\r\n|\n|\r/", " ", $text);
        $strStart = addslashes($strStart);
        $strEnd = addslashes($strEnd);

        $strStart = str_replace("/", "\\/", $strStart);
        $strEnd = str_replace("/", "\\/", $strEnd);

        $strStart = str_replace("(", "\(", $strStart);
        $strEnd = str_replace("(", "\(", $strEnd);

        $strStart = str_replace(")", "\)", $strStart);
        $strEnd = str_replace(")", "\)", $strEnd);

        $pattern = "/$strStart(.*?)$strEnd/i";
        preg_match($pattern, $text, $matches);

        return $matches[1];
    }
}
/* End of file */