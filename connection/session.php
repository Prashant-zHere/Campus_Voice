<?php

    session_start();
    
    if(!isset($_SESSION['user']))
        header("location: ../login.php");
    

    if($_SESSION['user'][0] == "admin")
        header("location: ../Admin/dashboard.php");
    
    if(isset($_POST['logout']))
    {
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

?>