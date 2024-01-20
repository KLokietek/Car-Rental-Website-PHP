<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                   
    $mail->SMTPAuth   = true;  
    $mail->Username = 'testycovid7@gmail.com';
    $mail->Password = 'apqfuadiktnlneem';
    $mail->SMTPSecure = 'tls';                              
    $mail->Port = 587;                                   
    $mail->setFrom('testycovid7@gmail.com', 'RentIt');

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}





