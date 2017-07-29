<?php

require_once (__DIR__) . '/phpmailer/PHPMailerAutoload.php';

define('MAIL_HOST', 'mail.batdongsansaigons.com');
define('MAIL_USERNAME', 'contact@batdongsansaigons.com');
define('MAIL_PASSWORD', 'itt@12345');
define('MAIL_CONTACT', 'contact@batdongsansaigons.com');

function createSimpleMail() {
    $mail = new PHPMailer();
    $mail->SetLanguage("vi", 'phpmailer/language/phpmailer.lang-vi.php');
    $mail->IsSMTP();
    $mail->Host = MAIL_HOST;
    
    $mail->SMTPAuth = true;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Username = MAIL_USERNAME;
    $mail->Password = MAIL_PASSWORD;
    $mail->From = MAIL_CONTACT;
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->CharSet = "UTF-8";
    
    return $mail;
}

function sendNewPwd($to, $new_pwd) {
    $subject = 'Khôi phục mật khẩu từ hệ thống';
    $message = '<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Khôi phục mật khẩu</title>
                    </head>
                    <body> Mật khẩu mới của bạn là: ' .
            $new_pwd
            . '</body>
                </html>';
   
    $mail = createSimpleMail();
    $mail->AddAddress($to, $to);
    $mail->Subject = $subject; 
    $mail->Body = $message;
    $mail->AltBody = $message;  
 
    $mail->send();
}

function sendContact($name, $phone, $email, $content) {
    $subject = 'Liên hệ từ khách hàng';
    $message = '<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Liên hệ từ khách hàng</title>
                    </head>
                    <body> 
                        Họ tên khách hàng: ' . $name
            . '         <br/>
                        Số điện thoại: ' . $phone 
            . '         <br/>
                        E-mail: ' . $email 
            . '         <br/>
                        Nội dung: ' . $content
            .'        </body>
                </html>';
                
    $mail = createSimpleMail();
    $mail->AddAddress(MAIL_CONTACT, 'Liên hệ khách hàng');
    $mail->Subject = $subject; 
    $mail->Body = $message;
    $mail->AltBody = $message;  
 
    $mail->send();
}

?>