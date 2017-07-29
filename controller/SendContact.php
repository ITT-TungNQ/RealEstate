<?php

require_once (__DIR__) . '/../admin/util/SendMail.php';

$btnSend = filter_input(INPUT_POST, 'client-contact');
if (isset($btnSend)) {
    $name = filter_input(INPUT_POST, 'contact_name');
    $email = filter_input(INPUT_POST, 'contact_email');
    $phone = filter_input(INPUT_POST, 'contact_phone');
    $content = filter_input(INPUT_POST, 'contact_content');
    
    sendContact($name, $phone, $email, $content);
    header("Location: http://192.168.1.220:8080/RealEstate/");
} else {
    header("Location: http://192.168.1.220:8080/RealEstate/page-not-found");
}