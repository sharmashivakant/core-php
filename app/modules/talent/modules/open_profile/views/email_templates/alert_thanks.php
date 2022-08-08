<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="x-apple-disable-message-reformatting">
      <title><?php echo SITE_NAME;?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
      <!-- CSS Reset : BEGIN -->
      <style type="text/css">
       
         /* What it does: Remove spaces around the email design added by some email clients. */
         /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
         html,
         body {
         margin: 0 auto !important;   
         padding: 0 !important;
         height: 100% !important;      
         width: 100% !important;
         font-family: 'Montserrat', sans-serif;
         }  
         /* What it does: Stops email clients resizing small text. */   
         * {
         -ms-text-size-adjust: 100%;
         -webkit-text-size-adjust: 100%;
         }
         /* What it does: Centers email on Android 4.4 */
         div[style*="margin: 16px 0"] {
         margin: 0 !important;
         }
         /* What it does: Stops Outlook from adding extra spacing to tables. */
         table,
         td {
         mso-table-lspace: 0pt !important;
         mso-table-rspace: 0pt !important;
         }
         /* What it does: Fixes webkit padding issue. */
         table {
         border-spacing: 0 !important;
         border-collapse: collapse !important;
         }
         /* What it does: Uses a better rendering method when resizing images in IE. */
         img {
         -ms-interpolation-mode: bicubic;
         }
         /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
         a {
         text-decoration: none;
         }
         /* What it does: A work-around for email clients meddling in triggered links. */
         a[x-apple-data-detectors],
         /* iOS */
         .unstyle-auto-detected-links a,
         .aBn {
         border-bottom: 0 !important;
         cursor: default !important;
         color: inherit !important;
         text-decoration: none !important;
         font-size: inherit !important;
         font-family: inherit !important;
         font-weight: inherit !important;
         line-height: inherit !important;
         }
         /* What it does: Prevents Gmail from changing the text color in conversation threads. */
         .im {
         color: inherit !important;
         }
         /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
         .a6S {
         display: none !important;
         opacity: 0.01 !important;
         }
         /* If the above doesn't work, add a .g-img class to any image in question. */
         img.g-img+div {
         display: none !important;
         }
         body {
         font-family: 'Montserrat', sans-serif;
         }
         html,
         table,
         tr,
         td {
         margin: 0;
         padding: 0;
         }
         h2 {
         margin: 0;
         padding: 0
         }
         img {
         max-width: 100%
         }
         .container-inner {
         padding-left: 30px;
         padding-right: 30px;
         }
         @media (max-width:600px) {
        
         .responsive-table {
         width: 100%;
         min-width: 100% !important;
         }
         .responsive-table .container-inner {
         padding-left: 20px !important;
         padding-right: 20px !important;
         }
         .responsive-table .table-top {
         padding: 40px 20px 49px !important;
         }
         .responsive-table .table-tagline {
         font-size: 37px !important;
         line-height: 47px !important;
         }
         .responsive-table .table-logo {
         padding: 0 0 22px !important;
         }
         table.table-center td p,
         table.table-center td:not(:nth-child(2n)) {
         width: 80px !important;
         height: 80px !important;
         font-size: 30px !important;
         line-height: 80px !important;
         }
         table.table-center td:not(:nth-child(2n)) {
         padding: 0 3px !important;
         }
         table.table-center td:first-child {
         padding-left: 0 !important;
         }
         }
      </style>
   </head>
   <body>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" role="presentation">
         <tr>
            <td align="center" valign="top">
               <!--[if (mso)|(IE)]>
               <table width="600" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                     <td align="left" valign="top" width="100%">
                        <![endif]-->
                        <!--[if mso 16]>
                        <table width="600" border="0" cellspacing="0" cellpadding="0">
                           <tr>
                              <td align="left" valign="top" width="100%">
                                 <![endif]-->
                                 <table class="responsive-table" width="100%" style="max-width:650px;" border="0" cellspacing="0"
                                    cellpadding="0">
                                    <tr>
                                       <td class="container-inner" bgcolor="#ffff00">
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                             <tr>
                                                <td
                                                   style="font-family: 'Open Sans', sans-serif; font-size: 42px; line-height: 52px; color: #000; font-weight: 700; padding: 120px 0 30px; text-transform: uppercase;">
                                                   <?php if ($this->data['name']) { echo 'Hi '.$this->data['name']; } ?>
                                                </td>
                                             </tr>
                                           
                                             <tr>
                                                <td
                                                   style="font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; font-weight: 500; color: #000; width: 74%; display: inline-block; padding-bottom: 20px;">
                                                  Thankyou for signing up to the <?php echo SITE_NAME;?>  Talent Vault candidate alerts.
                                                </td>
                                             </tr>
                                             <tr>
                                                <td
                                                   style="font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; font-weight: 500; color: #000; width: 74%; display: inline-block; padding-bottom: 20px;">
                                                Keep a lookout for email notifications on candidates that match your requirements.
                                                </td>
                                             </tr>
                                             <tr>
                                                <td
                                                   style="font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; font-weight: 500; color: #000; padding-bottom: 20px;">
                                                   Thank you,
                                                </td>
                                             </tr>
                                             <tr>
                                                <td
                                                   style="font-family: 'Montserrat', sans-serif; font-size: 18px; line-height: 28px; font-weight: 500; color: #000; padding-bottom: 20px;">
                                                   The <?php echo SITE_NAME;?> Team.        
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="padding: 25px 0 0;">
                                                   <a href="#" target="_blank" style="display: block;">
                                                   <img src="<?=SITE_URL?>app/public/images/email-logo.png" style="width: 140px; height: auto;" alt="<?php echo SITE_NAME;?>" />
                                                   </a>
                                                </td>
                                             </tr>
                                             <tr>
                                                <td style="padding: 0 5px 60px;"></td>  
                                             </tr>
                                          </table>
                                       </td>
                                    </tr>
                                 </table>
                                 <!--[if mso 16]>
                              </td>
                           </tr>
                        </table>
                        <![endif]-->
                        <!--[if (mso)|(IE)]>
                     </td>
                  </tr>
               </table>
               <![endif]-->
            </td>
         </tr>
      </table>
   </body>
</html>