<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice Student Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
<div class="left">
        <img src="./Img/login.jpg" alt="" class="login_img">
    </div>
    <div class="right">
        <h1>Welcome Back</h1>
        <p>Please enter your credentials to access your account.</p>
        
        <form action="" method="post">
            <label for="id">Student Id</label><br>
            <input type="text" placeholder="Enter your Student ID OR Email address" name="id" class="input id"><br><br>
            <label for="password">Password:</label><br>
            <input type="password" placeholder="Enter your password" name="password" class="input password"><br><br>
            <input type="submit" value="Sign In" name="signin" class="login">
            <label class="anchor">Don' t have an account? <a href="signup.php">Sign Up</a></label><br>
    <button class="adminlogin"><a class="adminlogin" href="./Admin/admin_login.php"> Admin Login</a></button>
    </form>
    </div>
    </div>
    </body>

</html>

<?php

// $conn = mysqli_connect("localhost","root","","complaintBox") or die("Can't connect");
include "./connection/conn.php";
session_start();

if (isset($_POST['signin'])) {
    // echo "asdkljfjklf";
    $id = $_POST['id'];
    $pass = $_POST['password'];

    $query = "select * from student where (id = '{$id}' or email = '{$id}') and password = '{$pass}'";

    // echo "$query";
    $result = mysqli_query($conn, $query);

    // echo mysqli_num_rows($result);
    // echo $id.$pass;
    if (mysqli_num_rows($result) == 1) {
        // echo "jgjasd";
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = ["student", $row['email'], $row['name'], $row['id'], $row['rno'], $row['class'], $row['year'], $row['password']];
        header("location: ./User/dashboard.php");
        exit();
    } else {
        echo "<script type='text/javascript'>alert('Login failed! Wrong username or password. Please try again');
        </script>";
    }
}


?>