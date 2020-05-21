<?php
include('../functions.php');
require 'PHPMailerAutoload.php';

$sendTo = e($_POST['sendTo']);
$sendSubject = e($_POST['sendSubject']);
$sendMessage = e($_POST['sendMessage']);
$originalSender = $_SESSION['user']['email'];

if (empty($sendTo)) {
    array_push($errors, "mail address is required");
}
if (empty($sendMessage)) {
    array_push($errors, "Message is required");
}


if (count($errors) == 0) {  // Check if no errors
    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'vlasic.mailsender@gmail.com';      // SMTP username
    $mail->Password = 'VlasicMailSender5';                // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail->SMTPDebug = 3;
    $mail->setFrom('vlasic.mailsender@gmail.com', 'Vlasic Mailer - TSC');
    $mail->addAddress($sendTo);                           // Add a recipient
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sendSubject;
    $mail->Body    = $sendMessage . "<br><br><br> Please respond to this mail: " . $originalSender;
    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}
header('location: mail_sender.php');

?>