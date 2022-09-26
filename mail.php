<?php
  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
  
require 'vendor/autoload.php';
  
$mail = new PHPMailer(true);
  
try {
    $mail->SMTPDebug = 2;                                       
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com;';                    
    $mail->SMTPAuth   = true;                             
    $mail->Username   = 'kyocera@sji.edu.ph';                 
    $mail->Password   = 'kyocerasji2022';                        
    $mail->SMTPSecure = 'tls';                              
    $mail->Port       = 25;  
  
    $mail->setFrom('kyocera@sji.edu.ph', 'test');           
    //$mail->addAddress('receiver1@gfg.com');
    $mail->addAddress('jasondelosreyes914@gmail.com', 'Seon');
       
    $mail->isHTML(true);                                  
    $mail->Subject = 'HRIS SJI Password Reset';
    $mail->Body    = 'HTML message body in <b>bold</b> ';
    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
    $mail->send();
    echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
  
?>