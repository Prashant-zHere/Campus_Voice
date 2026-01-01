<?php

include "../connection/conn.php";
include "../connection/admin_session.php";

    $query = "select complaint_id from complaint_suggestion where complaint_id like 'CMP%' ";
    $result = mysqli_query($conn,$query);
    $total_com = mysqli_num_rows($result);
    
    $query = "select complaint_id from complaint_suggestion where complaint_id like 'SUG%' ";
    $result = mysqli_query($conn,$query);
    $total_sug = mysqli_num_rows($result);
    // echo $total_sug;

    $query = "select complaint_id from complaint_suggestion where status='pending'";
    $result = mysqli_query($conn,$query);
    $pending = mysqli_num_rows($result);

    $query = "select complaint_id from complaint_suggestion where status='invalid'";
    $result = mysqli_query($conn,$query);
    $invalid = mysqli_num_rows($result);

    $query = "select complaint_id from complaint_suggestion where status='resolved'";
    $result = mysqli_query($conn,$query);
    $resolved = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
    <script src="../support/javascript.js"></script>
</head>
<body>
    <div class="header">
        <div class="logo_area">
            <img src="../Img/logo.jpg" alt="" class="logo"><h2 class="" style="padding-top:15px;padding-left:10px;font:bold">Campus Voice</h2>
            <p class="">Your Voice matter's to us</p>
        </div>

        <div class="header_area">
            <h2>Welcome <?php echo $_SESSION['user'][2]?></h2>
            <h5 style="color:rgb(165, 162, 162);">ID: <?php echo $_SESSION['user'][3]?></h5>
            <h5 style="color:rgb(165, 162, 162);">Manage and review students complaints</h5>
            <form action="" method="post">
                <input type="submit" name="logout" value="Log out" class="logout">
            </form>
        </div>
    </div>

    <div class="status">
        <div class="status0" style="margin:0px">
            <h4 class="statusHead">Total Complaints</h4>
            <img src="../Img/statistic.png" alt="" class="statusImg">
            <h2 class="totalcnt"><?php echo $total_com; ?></h2>
            <p class="sentence">Overall complaints logged</p>
        </div>

        <div class="status0 status1">
            <h4 class="statusHead">Total Suggestion</h4>
            <img src="../Img/statistic.png" alt="" class="statusImg">
            <h2 class="totalcnt"><?php echo $total_sug; ?></h2>
            <p class="sentence">Overall complaints logged</p>

        </div>

        <div class="status0 status2">
            <h4 class="statusHead"> Pending</h4>
            <img src="../Img/clock.png" alt="" class="statusImg" style="margin-left:135px">
            <h2 class="totalcnt"><?php echo $pending; ?></h2>
            <p class="sentence">Complaints/Suggestion awaiting resolution</p>

        </div>
        <div class="status0 status3">
            <h4 class="statusHead">Resolved</h4>
            <img src="../Img/tick.png" alt="" class="statusImg" style="margin-left:125px">
            <h2 class="totalcnt"><?php echo $resolved; ?></h2>
            <p class="sentence">Resolved issues</p>
        </div>
        <div class="status0 status4">
            <h4 class="statusHead">Invalid</h4>
            <img src="../Img/alert.png" alt="" class="statusImg" style="margin-left:125px">
            <h2 class="totalcnt"><?php echo $invalid; ?></h2>
            <p class="sentence">Complaints/Suggestion found to be invalid or not applicable.</p>
        </div>
    </div>

    <div class="search">
        <form action="../User/view.php" method="get" class="serchform">
            <input type="text" placeholder="Enter Complaint/Suggestion ID to search EX: CMP-XXXXXXXX" id="id" class="inputsearch" name='cmp_id'>
            <button style="border:none;background-color:#FFFF"><img src="../Img/search.png" alt="search"  class="searchbtn"></button>
        </form>
        <select name="status" id="status" onchange="sort()" class="sort">
            <option value="all">All Status</option>
            <option value="pending">Pending</option>
            <option value="resolved">Resolved</option>
            <option value="invalid">Invalid</option>
        </select>

        <select name="" id="category" class="sort category" onchange="category()">
                <option value="" selected disabled>Select Category</option>
                <option value="Academic">Academic</option>
                <option value="Teaching">Teaching</option>
                <option value="Cleaniness">Cleaniness</option>
                <option value="Administrative">Administrative</option>
                <option value="Library">Library</option>
                <option value="Hostel">Hostel</option>
                <option value="Hostel Mess">Hostel Mess</option>
                <option value="Canteen">Canteen</option>
                <option value="Other">Other</option>
        </select>

        <div class="searchByDate">
            <label for="start_date">From </label>
            <input type="date" id="start_date" class="date" onchange="sortbydate()">
            <label for="end_date">To </label>
            <input type="date" id="end_date" class=date value="<?php echo date("Y-m-d")?>" onchange="sortbydate()">
        </div>

    </div>

    <div id="complaint" class="complaintList"></div>
</body>
</html>