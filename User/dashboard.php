<?php
include "../connection/conn.php";
include "../connection/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        .nobtn{
            border: none;
            background-color: white;
            height: auto;
            width: 100%;
            border-radius: 0px;
            margin:0px;
            padding:0px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" id="mobileMenuBtn">
        <span></span>
        <span></span>
        <span></span>
    </button>
    
<!-- Mobile Sidebar -->
<div class="mobile-sidebar" id="mobileSidebar">
        <a href="./dashboard.php" class="sidebarbtn">
            <img src="../Img/home.png" alt="dashboard">
            Dashboard
        </a>
        
        <a href="./view.php" class="sidebarbtn">
            <img src="../Img/page.png" alt="complaints">
            My Complaints
        </a>

        <a href="./complaint.php?event=Complaint" class="sidebarbtn">
            <img src="../Img/add.png" alt="new complaint">
            New Complaint
        </a>

        <a href="./complaint.php?event=Suggestion" class="sidebarbtn">
            <img src="../Img/add.png" alt="new suggestion">
            New Suggestion
        </a>

        <form method="post" class="sidebarbtn" style="padding: 0;">
            <button type="submit" name="logout" style="all: unset; width: 100%; display: flex; align-items: center; padding: 15px;">
                <img src="../Img/logout.png" alt="logout">
                Logout
            </button>
        </form>
    </div>


    <div class="sidebar">
        <div class="header" >
            <img src="../Img/logo.jpg" alt=""><h2 class="logo" style="margin-top:8px;font-size:24px">Campus Voice</h2>
            <p class="logo">Your Voice matter' s to us</p>
    </div>
    <img src="../Img/home.png" alt="home" style="height:40px;width:40px;cursor:pointer">
    <h2 style="margin:25px 0px 0px 70px;cursor:pointer" class=sidebarbtn>Dashboard</h2><br>
    <img src="../Img/page.png" alt="page" style="height:40px;width:40px;margin:10px 0px 0px 15px;border-radius:0px">
    <h3 style="margin:20px 0px 0px 10px;" class=sidebarbtn><a href="./view.php" style="text-decoration:none;color:black;cursor:pointer;">My Complaint and Suggestion</a></h3><br>
    <form action="./complaint.php" method="get">
        <img src="../Img/add.png" alt="add.png" style="height:35px;width:35px;cursor:pointer;">
        <button name="event" value="Complaint" class="sidebarbtn">New Complaint</button>
    </form>

    <form action="./complaint.php" method="get">
        <img src="../Img/add.png" alt="add.png" style="height:35px;width:35px;cursor:pointer" for=event>
        <button name="event" value="Suggestion" class="sidebarbtn">New Suggestion</button>
    </form>

    <form action="" method="post">
        <label for="logout">
            <img src="../Img/logout.png" alt="logout" style="height:35px;width:35px;cursor:pointer;border-radius:0px"></label>
        <input type="submit" name=logout value="Logout" class="sidebarbtn">
    </form>

    </div>
    <div class="main">
        <div class="header">
            <h1 style="padding-top:5px;margin:0px;padding-left:5px">Welcome back, <?php echo " " . $_SESSION['user'][2] ?></h1>
            <h3 style="padding:5px 0px 16px;margin:0px;padding-left:5px;color:grey">Student ID: <?php echo " " . $_SESSION['user'][3] ?></h3>
        </div>
        <div class="complaint" style="height:auto;float:left;">
            <form action="./complaint.php" method="get">
                <button class="fileComplaint" name="event" value="Complaint" style="padding:0px">
                    <img src="../Img/add.jpg" alt="add" class=add>
                    <h1 style="margin-left:10px;margin-top:5px;">File New Complaint</h1>
                    <h4 style="margin-left:10px;margin-top:5px;">Please submit a new complaint to help us address any issues or concerns</h4>
                </button>
            </form>
            <form action="./complaint.php" method="get">
                <button class="fileSuggestion" name="event" value="Suggestion" style="padding:0px">
                    <img src="../Img/add.jpg" alt="add" class=add>
                    <h1 style="margin-left:10px;margin-top:5px;">File New Suggestion</h1>
                    <h4 style="margin-left:10px;margin-top:5px;">Please submit a new suggestion to help us improve and address any ideas or concerns.</h4>
                </button>
            </form>
        </div>
        <a href="./view.php">
            <button class="view">
                <img src="../Img/notebook.png" alt="notebook" style="height:50px;width:60px;margin-top:-70px;">
                <h1 style="margin-left:10px;margin-top:5px;">My Complaint and suggestion</h1><br>
                <h3 style="margin-left:10px;margin-top:5px; color:rgba(160, 157, 157, 0.959);">Track and monitor the progress of your complaints and suggestions.</h3>
            </button>
        </a>

        <div class="status">
            <img src="../Img/clock.png" alt="clock" style="height:30px;width:30px;margin:5px 8px 0px 5px">
            <h2 style="margin-top:7px;color:rgba(26, 25, 25, 0.975)">Pending</h2>
            <?php
            $stud_id = $_SESSION['user'][3];
            $query = "select * from complaint_suggestion where stud_id='$stud_id' and status='pending'";
            $result = mysqli_query($conn, $query);
            echo "<h1>" . mysqli_num_rows($result) . "</h1>"
            ?>
        </div>
        <div class="status">
            <img src="../Img/tick.png" alt="clock" style="height:40px;width:40px;margin:2px 8px 0px 5px">
            <h2 style="margin-top:7px;color:rgba(26, 25, 25, 0.975)">Resolved</h2>
            <?php
            $stud_id = $_SESSION['user'][3];
            $query = "select * from complaint_suggestion where stud_id='$stud_id' and status='resolved'";
            $result = mysqli_query($conn, $query);
            echo "<h1>" . mysqli_num_rows($result) . "</h1>"
            ?>
        </div>
        <div class="status">
            <img src="../Img/alert.png" alt="clock" style="height:30px;width:30px;margin:5px 8px 0px 5px">
            <h2 style="margin-top:7px;color:rgba(26, 25, 25, 0.975)">Invalid</h2>
            <?php
            $stud_id = $_SESSION['user'][3];
            $query = "select * from complaint_suggestion where stud_id='$stud_id' and status='invalid'";
            $result = mysqli_query($conn, $query);
            echo "<h1>" . mysqli_num_rows($result) . "</h1>"
            ?>
        </div>

        <div class="display">
            <h2 style="float:left">Recent Complaint and Suggestion</h2>
            <a href="./view.php" style="float:right;text-decoration:none;font-size:18px;margin-top:2px">View All</a>
            <br><br>
            <hr>
            <?php
            $query = "select * from complaint_suggestion where stud_id='$stud_id' order by date,time desc";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo "<form action='./view.php' method='get'>";
                    echo "<button class='nobtn' value=" . $rows['complaint_id'] . " name='cmp_id'>";
                    echo "<h3 style='float:left;margin:0px;padding:0px;'>Camplaint ID: " . $rows['complaint_id'] . "</h3><br><br>";
                    echo "<h4 style='float:left;margin:0px;padding:0px;'>Subject: " . $rows['subject'] . "</h4>";
                    if ($rows['status'] == "pending")
                        echo "<h4 style='float:right;background-color:#e8cc8c;border-radius:10px;padding:5px;'>Pending</h4><br>";
                    else if ($rows['status'] == "invalid")
                        echo "<h4 style='float:right;background-color:#F88279;border-radius:10px;padding:5px;'>Invalid</h4><br>";
                    else if ($rows['status'] == "resolved")
                        echo "<h4 style='float:right;background-color:#64e3a1;border-radius:10px;padding:5px;'>Resolved</h4><br>";

                    echo "<br><h4 style='float:left;color:rgba(160, 157, 157, 0.959);margin:0px;padding:0px;'>Category: " . $rows['category'] . "</h4>";
                    echo "<br><h5 style='float:left;color:rgba(160, 157, 157, 0.959);margin:0px;padding:0px;'>Date: " . $rows['date'] . "<br>Time: " . $rows['time'] . "</h5><br><br><hr><br>";
                    echo "</button></form>";
                }
            } else {
                echo "<br><h3 style='float:left;margin:0px;padding:0px;'>No Complaints or suggesstion found.</h3>";
            }
            ?>
        </div>
    </div>


    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileSidebar = document.getElementById('mobileSidebar');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuBtn.classList.toggle('active');
            mobileSidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', (event) => {
            if (!mobileSidebar.contains(event.target) && !mobileMenuBtn.contains(event.target)) {
                mobileMenuBtn.classList.remove('active');
                mobileSidebar.classList.remove('active');
            }
        });

        // Close menu when clicking links
        document.querySelectorAll('.mobile-sidebar .sidebarbtn').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                mobileSidebar.classList.remove('active');
            });
        });
    </script>
    </body>

</html>
<!-- 
<?php
// print_r($_SESSION['user']); 
?> -->