<?php
/**
 * PhpMailer
 *
 */
require_once(_SYSDIR_.'system/lib/phpmailer/class.phpmailer.php');

class SysMailer extends PHPMailer
{
    public $priority = 3; // 1 = High, 3 = Medium, 5 = Low
    public $to_name;
    public $to_email;
    public $From = null;
    public $FromName = null;
    public $Sender = null;


    public function FreakMailer()
    {
        if (SMTP_MODE == 'enabled') {

            $this->SMTPDebug = 0; // Enable verbose debug output /2
            $this->isSMTP();
            $this->SMTPSecure = 'tls';

            $this->Host = SMTP_HOST;
            $this->Port = SMTP_PORT;
            if (SMTP_USERNAME != '') {
                $this->SMTPAuth  = true;
                $this->Username  = SMTP_USERNAME;
                $this->Password  =  SMTP_PASSWORD;
            }
        }

        if (!$this->From) {
            $this->From = NOREPLY_MAIL;
        }

        if (!$this->FromName) {
            $this->FromName = MAIL_NAME;
        }

        if (!$this->Sender) {
            $this->Sender = NOREPLY_MAIL;
        }


        $this->Priority = $this->priority;

        // MS Outlook custom header // May set to "Urgent" or "Highest" rather than "High"
        $this->AddCustomHeader("X-MSMail-Priority: Normal");
        $this->AddCustomHeader("X-MimeOLE", "Produced By Microsoft MimeOLE V6.00.2800.1441");

        // Not sure if Priority will also set the Importance header:
        $this->AddCustomHeader("Importance: Normal");
    }

}
/* End of file */
