<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
//Server settings
$mail->setLanguage('ru', 'vendor/phpmailer/phpmailer/language/'); // Перевод на русский язык

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 1;                                 // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->SMTPAuth = true;                               // Enable SMTP authentication

//$mail->SMTPSecure = 'ssl';                          // secure transfer enabled REQUIRED for Gmail
//$mail->Port = 465;                                  // TCP port to connect to
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->Username = 'zachtomneetoaaa@gmail.com';               // SMTP username
$mail->Password = 'qwerty___666';                         // SMTP password

//Recipients
$mail->setFrom('zachtomneetoaaa@gmail.com', 'zachtomneetoaaa');
$mail->addAddress('irresjeny@gmail.com');              // Name is optional

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Test mail to user';
$mail->Body    = 'This is the very simple HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->send();
echo 'Message has been sent';
} catch (Exception $e) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $mail->ErrorInfo;
}
