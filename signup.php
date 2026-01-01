<?php
    // $conn = mysqli_connect("localhost","root","","complaintBox") or die("connection falied");\
    include "./connection/conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice Student Signup</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div class="left">
        <img src="./Img/login.jpg" alt="" class="login_img">
    </div>
    <div class="right">
        <h1>Create Account</h1>
        <p>Please enter your credentials to access your account.</p>
        <form action="" method="post">
            <label for="name">Name:</label><br>
            <input type="text" placeholder="Enter your Fullname" class="i name" name="name" required><br><br>

            <label for="rno">Roll No:.</label><br>
            <input type="number" placeholder="Enter Roll Number" name="rno" class="i rno" required><br><br>

            <label for="class">Class</label>
            <select name="class" class="class" required>
                <option value="" selected disabled>Select Class</option>
            <?php
                $query = "select * from class";
                $result = mysqli_query($conn,$query);

                if(mysqli_num_rows($result)>0)
                {
                    while($row=mysqli_fetch_assoc($result))
                    {
            ?>
                        <option value="<?php echo $row['cid']?>"><?php echo $row['cname']?></option>
            <?php
                    }
                }
            ?>
            </select>

            <label for="year">Year</label>
            <select name="year" id="" class="class">
                <option value="" selected disabled>Select Year</option>
                <option value="1">First year</option>
                <option value="2">Second year</option>
                <option value="3">Third year</option>
                <option value="4">Fourth year</option>
                <option value="5">Fifth year</option>
            </select><br><br>
            
            <label for="email">Email</label><br>
            <input type="email" placeholder="Example: abc@gmail.com" name="email" class="i email" required><br><br>
            
            <label for="password" required>Password</label><br>
            <input type="password" name="password1" class="i password" placeholder="Enter Password"><br><br>
            
            <label for="password" required>Password</label><br>
            <input type="password" name="password2" class="i password" placeholder="Re enter Password"><br><br>

            <input type="submit" value="Sign Up" name="signup" class="studentlogin login">
            <label class="anchor">Already have an account? <a href="login.php">Sign In</a></label><br>
            
            <button class="studentlogin"><a class="adminlogin" href="./Admin/admin_login.php">Admin Login</a></button>
        
        </form>
</body>
</html>

<?php

if(isset($_POST['signup']))
{
    $rno = $_POST['rno'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $year = $_POST['year'];
    $email = $_POST['email'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];
    
    $id = "ST-"; 

    $id .= $year.$class;
        if(strlen($rno) == 2)
            $id .= "0".$rno;
        else if(strlen($rno) == 1)
            $id .= "00".$rno;
        else
            $id .= $rno;

    function validation($conn,$rno,$email,$pass1,$pass2,$id)
    {   
        
        $pattern = "/^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        $query = "select * from student,class where email='{$email}' or id='{$id}'";

        $result = mysqli_query($conn,$query);
    
        if (!preg_match($pattern, $email))
        {
            echo "<script type='text/javascript'>alert('Invalid Email');</script>";
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
            echo "<script type='text/javascript'>alert('Email ID already used or User already exists');</script>";
            return 0;
        }

        return 1;
    }
    
    if((validation($conn,$rno,$email,$pass1,$pass2,$id)))
    {
        $query = "select cname from class where class.cid = '$class'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);

        $class = $row['cname'];

        session_start();
        $_SESSION['status'] = "signup";
        $_SESSION['attempt'] = 1;
        $_SESSION['user'] = ["student",$email,$name,$id,$rno,$class,$year,$pass1];
        header("location: ./mail/otp.php");
        // $result = mysqli_query($conn,$query);
    }
}

?>