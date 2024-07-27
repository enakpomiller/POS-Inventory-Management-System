<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (!function_exists('send_email')) {
    function send_email($to, $subject, $message, $from = 'your-email@example.com', $fromName = 'Your Name') {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'ennaxtechnologies@gmail.com';  // Set the SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'ennaxtechnologies@gmail.com';  // SMTP username
            $mail->Password = 'Ennax8899xx';  // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;  // TCP port to connect to

            //Recipients
            $mail->setFrom($from, $fromName);
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = strip_tags($message);

            $mail->send();
            return true;
        } catch (Exception $e) {
            log_message('error', "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
