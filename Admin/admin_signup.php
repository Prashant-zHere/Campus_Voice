<?php
    // $conn = mysqli_connect("localhost","root","","complaintBox") or die("connection falied");
    include "../connection/conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice Admin Signup</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="left">
        <img src="../Img/login.jpg" alt="" class="login_img">
    </div>
    <div class="right">
        <h1>Create Account</h1>
        <p>Please enter your credentials to access your account.</p>
        <form action="" method="post">
            <label for="name">Name</label><br>
            <input type="text" placeholder="Enter your Fullname" class="i name" name="name" required><br><br>
            
            <label for="department">Department</label><br>
            <input type="text" placeholder="Enter department" class="i department" name="department" required><br><br>

            <label for="email">Email</label><br>
            <input type="email" placeholder="Example: abc@gmail.com" name="email" class="i email" required><br><br>
            
            <label for="password" required>Password</label><br>
            <input type="password" name="password1" class="i password" placeholder="Enter Password"><br><br>
            
            <label for="password" required>Password</label><br>
            <input type="password" name="password2" class="i password" placeholder="Re enter Password"><br><br>

            <input type="submit" value="Sign Up" name="signup" class="studentlogin login">
            <label class="anchor">Already have an account? <a href="admin_login.php">Sign In</a></label><br>
            
            <button class="studentlogin"><a class="adminlogin" href="../login.php">Student Login</a></button>
        </form>
</body>
</html>

<?php

if(isset($_POST['signup']))
{
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];
    $id = "AD-".str_replace(':', '', date("H:i:s")).rand(100, 999);
    
    function validation($conn,$email,$pass1,$pass2)
    {   
        $pattern = "/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $query = "select * from admin where email='{$email}'";

        $result = mysqli_query($conn,$query);
    
        if (!preg_match($pattern, $email))
        {
            echo "<script type='text/javascript'>alert('Invalid Email!');</script>";
            return 0;
        }
        else if($pass1 != $pass2)
        {
            echo "<script type='text/javascript'>alert('Password doesn\'t match ');</script>";
            return 0;
        }
        else if(strlen($pass1) < 8)
        {
            echo "<script type='text/javascript'>alert('Password should be minimum 8 characters or more');</script>";
            return 0;
        }
        else if(mysqli_num_rows($result)>=1)
        {
            echo "<script type='text/javascript'>alert('Email ID already used');</script>";
            return 0;
        }

        return 1;
    }
    
    if(validation($conn,$email,$pass1,$pass2)==1)
    {   
        session_start();
        $_SESSION['status'] = "signup";
        $_SESSION['attempt'] = 1;
        $_SESSION['user'] = ["admin",$email,$name,$id,$pass1,$department];
        header("location: ../mail/otp.php");
        exit();
        // $query = "insert into student values('{$id}','{$rno}','{$name}','{$class}','{$year}','{$email}','{$pass1}')";
        // $result = mysqli_query($conn,$query);
    }
}

?>