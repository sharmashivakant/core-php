<?php
/**
 * REQUEST
 *
 */

require_once(_SYSDIR_.'system/inc/SysMailer.php');

class Mail
{
    /**
     * @param $email
     * @param $subject
     * @param $messageTemplate
     * @param bool $headers
     * @param array $options
     * @return bool
     * @throws phpmailerException
     */
    public static function send($email, $subject, $messageTemplate, $headers = false, $options = array())
    {
        $mailer = new SysMailer();

        $mailer->FreakMailer();
        $mailer->ContentType = 'text/html';
        $mailer->CharSet = 'utf8';
        $mailer->Encoding = 'base64';

        $mailer->isHTML(true);
        $mailer->Subject = $subject;
        $mailer->Body = $messageTemplate;

        if ($options['AltBody'])
            $mailer->AltBody = $options['AltBody'];

        $mailer->setFrom(NOREPLY_MAIL, MAIL_NAME);
        $mailer->AddAddress($email, $options['name']);

        if ($options['embed']['path']) {
            // If is embed file
            $mailer->addEmbeddedImage($options['embed']['path'], $options['embed']['cid'], $options['embed']['name']); //, $options['embed']['encoding'], $options['embed']['type']
        }

        if ($options['file']['path']) {
            $mailer->AddAttachment($options['file']['path'], $options['file']['name']);
        }

        if (!$mailer->Send())
            $status = false;
        else
            $status = true;

        $mailer->ClearAddresses();
        $mailer->ClearAttachments();


        return $status;
    }

//    public static function send_by_php($email, $subject, $messageTemplate, $headers = false)
//    {
//        if (!$headers) {
//            $headers = "From: Ajax Gaming Academy <noreplyajax@ajaxgamingacademy.com>\r\n";
//            $headers .= "Mime-Version: 1.0 \r\n";
//            $headers .= "Content-Type: multipart/related; boundary=\"###\"; type=\"text/html\" \r\n";
////            $headers .= "Content-type: text/html; charset=utf-8 \r\n";
//
//
//            $message = "--###\r\n";
//            $message .= "Content-Type: text/html; charset=utf-8 \r\n";
//            $message .= $messageTemplate."\r\n";
//
//
//            $message .= "--###\r\n";
//            $message .= "Content-Location: CID:somethingatelse\r\n"
//            ."Content-ID: <image_mail>\r\n"
//            ."Content-Type: IMAGE/GIF\r\n"
//            ."Content-Transfer-Encoding: BASE64\r\n\r\n";
//
//            $file = file_get_contents("http://dev.ajaxgamingacademy.com/app/public/images/email_header.png");
//            $message .= chunk_split(base64_encode($file));
//
//            $message .= "\r\n--###--";
//        }
//
//        // Sending
//        return mail($email, $subject, $message, $headers);
//    }
//
//
}
/* End of file */