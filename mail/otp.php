<?php
    include "../connection/conn.php";

    session_start();    
    if(!isset($_SESSION['status']))
        header("location: ../login.php");
    
    // echo $_SESSION['status'];
    // $conn = mysqli_connect("localhost","root","","complaintBox");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="../css/otp.css">
</head>
<body>
    <h4 class="back"><button onclick="goBack()" style="border:none"><img src="../Img/back.jpg" alt=""></button></h4><br>
    <div class="form">
        <form action="" method="post">
            <div class="heading">
                <h1 style="font-size: 35px;"><b>OTP Verification</b></h1><br>
                <h3 style="color:#36454f">Enter the verfication code we have sent to </h3>
                <h2><b><?php echo $_SESSION['user'][1] ?></b></h2><br>
            </div>
            <h4 style="color:#36454f">Type 6 digit security code.</h4>
            <input type="number" maxlength="1" name=n1 class="otpi" id=otp1 oninput="moveFocus(otp1, otp2)">
            <input type="number" maxlength="1" name=n2 class="otpi" id=otp2 oninput="moveFocus(otp2, otp3)">
            <input type="number" maxlength="1" name=n3 class="otpi" id=otp3 oninput="moveFocus(otp3, otp4)">
            <input type="number" maxlength="1" name=n4 class="otpi" id=otp4 oninput="moveFocus(otp4, otp5)">
            <input type="number" maxlength="1" name=n5 class="otpi" id=otp5 oninput="moveFocus(otp5, otp6)">
            <input type="number" maxlength="1" name=n6 class="otpi" id=otp6 oninput="moveFocus(otp6, null)"><br><br>
            
            <h3 style="color:#36454f">Didn't you receive otp? <input type="submit" name="resend" value="Resend OTP" style="color:#2563ea" class=resend></h3><br>
            <input type="submit" name="verify" value="Verify" class="verify">
        </form>
    </div>
</body>
<script>
    function goBack() 
    {
      window.history.back();
    }

    function moveFocus(currentInput, nextInput) 
    {
        if (currentInput.value.length == currentInput.maxLength && nextInput) 
            nextInput.focus();
    }

</script>
</html>

<?php

    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    function sendmail()
    {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        //Create an instance; passing `true` enables exceptions
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
            $mail->addReplyTo($_SESSION['user'][1],$_SESSION['user'][2]);

            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('./Img/admin.png');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
        
            if($_SESSION['status']=="signup")
            {
                $mail->Subject = 'OTP for Sign-in Verification';
            
                $message = "Dear ".$_SESSION['user'][2].",<br>
                We received a sign-in request for your account. To complete the process, please use the following One-Time Password (OTP):<br>
                <h3><b>".$_SESSION['otp']."</b></h3>If you did not request this sign-in, please disregard this email.<br>
                If you need any assistance, feel free to contact us.<br><br>Best Regards,<br>Team CampusVoice"; 
            }       
            else if($_SESSION['status']=="reset")
            {
                $mail->Subject =  "OTP for Password Reset";
                $message = "Dear ".$_SESSION['user'][2].",<br>
                We received a request to reset your password. To proceed, please use the following One-Time Password (OTP):<br>
                <h3><b>".$_SESSION['otp']."</b></h3>If you didn’t request a password reset, please ignore this email.<br>
                If you need further assistance, feel free to reach out.<br><br>Best Regards,<br>Team CampusVoice";

            }   
        
            $mail->Body  = $message;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            // echo 'Message has been sent';
            // header("location: ./otp.php");
        }catch(Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    

    if(isset($_SESSION['status']) && $_SESSION['attempt']==1)
    {
      $_SESSION['attempt']++;
      sendmail();
    }

    if(isset($_POST['resend']))
        sendmail();

    if(isset($_POST['verify']))
    {
        $userotp = (int)$_POST['n1'].$_POST['n2'].$_POST['n3'].$_POST['n4'].$_POST['n5'].$_POST['n6'];
                
        if($userotp == $_SESSION['otp'])
        {
            unset($_SESSION['otp']);
            unset($_SESSION['attempt']);
            if($_SESSION['status']=='signup')
            {
                $user = $_SESSION['user'];

                // print_r($user);
                if($_SESSION["user"][0]=="student")
                {
                    $query = "insert into student values('{$user[3]}','{$user[4]}','{$user[2]}','{$user[5]}','{$user[6]}','{$user[1]}','{$user[7]}')";
                    mysqli_query($conn,$query);    
                }
                else
                {
                    $query = "insert into admin (id,name,email,password,department) values('{$user[3]}','{$user[2]}','{$user[1]}','{$user[4]}','{$user[5]}')";
                    mysqli_query($conn,$query);
                    $query = "select * from admin where email='{$user[1]}'";
                    $result = mysqli_query($conn,$query);
                    $row = mysqli_fetch_assoc($result);

                    $_SESSION['user'] = ["admin",$row['email'],$row['name'],$row['id'],$row['password'],$row['department']];
                } 
                
                header("location: ./sendDetails.php");
                exit();
            }
            else
            {
                header("location: ../reset.php");
                exit();
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('OTP Doesn\'t match');</script>";
        }
    }
?>