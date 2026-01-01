<?php
    session_start();    
    if(!isset($_SESSION['status']))
        header("location: ../login.php");
    
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    session_start();

    if(isset($_SESSION['status']))
    {
        $mail = new PHPMailer(true);

        try 
        {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'fakeacc.9867@gmail.com';                     //SMTP username
            $mail->Password   = 'vkwnkmwqwumgiics';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            $mail->setFrom('fakeacc.9867@gmail.com', 'CampusVoice');

            $mail->addAddress($_SESSION['user'][1],$_SESSION['user'][2]);     //Add a recipient
            // $mail->addReplyTo($_SESSION['user'][1],$_SESSION['user'][2]);

            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('./Img/admin.png');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'CampusVoice Login credentials';
        
            if($_SESSION['user'][0]=="student")
            {
                $message = "Dear ".$_SESSION['user'][2].",<pre>
You have successfully registered on CampusVoice Online Portal
Following are Your login details.
    Student Id : ".$_SESSION['user'][3].
    "<br>    Roll No : ".$_SESSION['user'][4].
    "<br>    Class : ".$_SESSION['user'][5].
    "<br>    Password : ".$_SESSION['user'][7]."
    </pre>Please use these credentials to login to your account to fill 
and submit Online Complaint/Suggestion forms at CampusVoice portal.<br><br>Best Regards,<br>Team CampusVoice"; 
            }       
            else if($_SESSION['user'][0]=="admin")
            {
                $message = "Dear ".$_SESSION['user'][2].",<pre>
You have successfully registered on CampusVoice Online Portal
Following are Your login details.
    <br>    ID : ".$_SESSION['user'][3].
    "<br>    Password : ".$_SESSION['user'][4].
    "<br>    Department : ".$_SESSION['user'][5]."
    </pre>Please use these credentials to login to your account to fill 
and submit Online Complaint/Suggestion forms at CampusVoice portal.<br><br>Best Regards,<br>Team CampusVoice";
            }   
        
            $mail->Body  = $message;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';
            // header("location: ./otp.php");
            unset($_SESSION['status']);

            if($_SESSION['user'][0]=="admin")
                header("location: ../Admin/dashboard.php");
            else
                header("location: ../User/dashboard.php");
        }catch(Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>