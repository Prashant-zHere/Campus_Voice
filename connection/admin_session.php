<?php

    session_start();
    
    if(!isset($_SESSION['user']))
        header("location: ../login.php");
    
    if(isset($_POST['logout']))
    {
        unset($_SESSION['user']);
        header("location: ../login.php");
    }

?>