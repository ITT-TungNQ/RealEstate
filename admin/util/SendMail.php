<?php

function sendNewPwd($to, $new_pwd) {
    $subject = 'Khôi phục mật khẩu từ hệ thống';
    $message = '<html>
                    <head>
                        <meta charset="UTF-8" />
                        <title>Khôi phục mật khẩu</title>
                    </head>
                    <body> Mật khẩu mới của bạn là: '.
                        $new_pwd
                    .'</body>
                </html>';
    $headers = 'From: tokon994@gmail.com' . "\r\n" .
            'Reply-To: tokon994@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    mail($to, $subject, $message, $headers);
}

?>