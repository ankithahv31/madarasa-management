<?php

require_once '../mailer/Exception.php';
require_once '../mailer/PHPMailer.php';
require_once '../mailer/SMTP.php';
define('PROJECT_NAME', 'Madarasa Management System');
define('FROM_Mail', 'headmaster00001@gmail.com');
define('MAIL_PASSWORD', 'ptahjqgprvtlbigf');
define('EVENT_SUBJECT', 'Event Invitation');
define('RESULT_SUBJECT', 'NEW RESULT');
define('RESULT_BODY', 'Results Are Out Please Check Right Now');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($subject, $mailBody, $toAddress)
{

    try {

        $mail = new PHPMailer(true);

        //        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = FROM_Mail;                 // SMTP username
        $mail->Password = MAIL_PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->From = FROM_Mail;
        $mail->FromName = PROJECT_NAME;
        $mail->addAddress($toAddress, '');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $mailBody;
        $mail->AltBody = $mailBody;

        if (!$mail->send()) {
            throw new Exception('Message could not be sent.: ' . $mail->ErrorInfo);
        } else {
            return true;
        }
    } catch (\Exception $ex) {
        throw $ex;
    }
}


function SendEventMail($title, $date, $time, $Venue, $description, $targetFilePath, $emailData, $filename)
{
    try {

        $message = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
          <meta charset='UTF-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <title>Event Invitation</title>
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css'>
        </head>
        <body>
          <div class='container'>
            <div class='card rounded-0'>
              <div class='card-body'>
                <h3 class='card-title'>Event Invitation</h3>
                <p class='card-text'>You are cordially invited to our $title  special event!</p>
                <p>Date: $date</p>
                <p>Time: $time</p>
                <p>Venue: $Venue</p>
                <p>About: $description</p>
                <hr>
                <h5 class='card-subtitle mb-2'>
                <img src='cid:logo' alt='Logo' style='width: 200px; height: auto;'>
                </h5>
               
              </div>
            </div>
          </div>
        </body>
        </html>
        ";


        $mail = new PHPMailer(true);
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = FROM_Mail;                 // SMTP username
        $mail->Password = MAIL_PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->From = FROM_Mail;
        $mail->FromName = PROJECT_NAME;
        foreach ($emailData as $row) {
            $mail->addAddress($row['email'], '');
        }
        // $mail->addAddress($toAddress, '');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = EVENT_SUBJECT;
        $mail->Body = $message;
        $mail->AltBody = $message;

        // Attach the image file
        $mail->addAttachment($targetFilePath, $filename, 'base64', 'image/jpeg');

        // Embed the image within the HTML content
        $mail->addEmbeddedImage($targetFilePath, 'logo', $filename, 'base64', 'image/jpeg');

        if (!$mail->send()) {
            throw new Exception('Message could not be sent.: ' . $mail->ErrorInfo);
        } else {
            return true;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}


function SendResultMail($emailData, $filename, $targetFilePath)
{

    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = FROM_Mail;                 // SMTP username
        $mail->Password = MAIL_PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->From = FROM_Mail;
        $mail->FromName = PROJECT_NAME;
        foreach ($emailData as $row) {
            $mail->addAddress($row['email'], '');
        }
        // $mail->addAddress($toAddress, '');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = RESULT_SUBJECT;
        $mail->Body = RESULT_BODY;
        $mail->AltBody = RESULT_BODY;

        $mail->addAttachment($targetFilePath, $filename);


        if (!$mail->send()) {
            throw new Exception('Message could not be sent.: ' . $mail->ErrorInfo);
        } else {
            return true;
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}


function SendAttendanceMail(){
    try {
        
    } catch (\Throwable $th) {
        throw $th;
    }
}