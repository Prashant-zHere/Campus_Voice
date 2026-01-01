<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice Admin Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="left">
        <img src="../Img/login.jpg" alt="" class="login_img">
    </div>
    <div class="right">
        <h1>Welcome Back</h1>
        <p>Please enter your credentials to access your account.</p>
        
        <form action="" method="post">
            <label for="id">Admin ID</label><br>
            <input type="text" placeholder="Enter your ID or Email id" name="id" class="input id"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" placeholder="Enter your password" name="password" class="input password"><br><br>
            <input type="submit" value="Sign In" name="signin" class="login">
            <label class="anchor">Don't have an account? <a href="admin_signup.php">Sign Up</a></label><br>
            <button class="adminlogin"><a class="adminlogin" href="../login.php">Student Login</a></button>
        </form>
    </div>
</body>
</html>

<?php

include "../connection/conn.php";

if(isset($_POST['signin']))
{
    $id = $_POST['id'];
    $pass = $_POST['password'];

    $query = "select * from admin where (id = '$id' or email='$id') and password='$pass'";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1)
    {
        session_start();
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = ['admin',$row['email'],$row['name'],$row['id'],$row['password'],$row['department']];
        header("location: ./dashboard.php");
        exit();
    }
    else
    {
        echo "<script>alert('Failed to login');</script>";
    }
}

?>