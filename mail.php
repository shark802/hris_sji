<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
function userAccountEmail($emailAddress, $employeeName, $username, $password){
  
    
    require 'vendor/autoload.php';
    
    $mail = new PHPMailer(true);
    
    try {
        $mail->SMTPDebug = 2;                                       
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com;';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = 'hris@sji.edu.ph';                 
        $mail->Password   = 'hrissji2022';                        
        $mail->SMTPSecure = 'tls';                              
        $mail->Port       = 25;  
    
        $mail->setFrom('hris@sji.edu.ph', 'HRIS SJI');           
        //$mail->addAddress('receiver1@gfg.com');
        $mail->addAddress('jasondelosreyes914@gmail.com', 'Seon');
        
        $mail->isHTML(true);                                  
        $mail->Subject = 'HRIS SJI Account';
        $mail->Body    = 'Hi, <br><br>
                        
                        Your HRIS SJI Account has been activated successfully. You may now login your account to using this username and password: <br><br>
                        
                        Username: test 
                        <br>
                        Password: test

                        <br><br>
                        Thank you, <br>
                        HRIS SJI
                        ';
        //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

  
?>