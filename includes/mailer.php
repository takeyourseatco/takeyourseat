<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendAdminMail($subject, $body) {

    $env = parse_ini_file(__DIR__ . '/../.env');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $env['SEND_MAIL_USERNAME'];
        $mail->Password   = $env['SEND_MAIL_PASSWORD'];
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom($env['SEND_MAIL_USERNAME'], 'Take Your Seat');
        // $mail->addAddress($env['RECVE_MAIL_USERNAME']);
        $mail->addAddress($env['SEND_MAIL_USERNAME']);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}