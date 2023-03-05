<?php
// use vendor\PHPMailer\PHPMailer;
// use vendor\PHPMailer\SMTP;
// use vendor\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 

require '../vendor/PHPMailer/src/Exception.php'; 
require '../vendor/PHPMailer/src/PHPMailer.php'; 
require '../vendor/PHPMailer/src/SMTP.php'; 

$mail = new PHPMailer;

$mail->isSMTP();                                       // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                                // Enable SMTP authentication 
$mail->Username = 'ashar.muhammad74@gmail.com';        // SMTP username 
$mail->Password = 'yffrskmiabosxiee';                  // SMTP password 
$mail->SMTPSecure = 'ssl';                             // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465;                                     // TCP port to connect to 

