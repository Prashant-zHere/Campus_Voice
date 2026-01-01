
<?php

    include "../connection/conn.php";
    include "../connection/admin_session.php";



function printComplaintTable($result)
{
    // echo mysqli_num_rows($result);
    if(mysqli_num_rows($result) == 0)
    {
        echo "<h3 style='margin-left:50px'>No Complaint/Suggestion Found<h3>";
    }
    else
    {
        // echo "jasd";
        // print_r($_SESSION['user']);
        echo "<table id='cmp_id'>
            <tr>
                <th style='width:220px;border-top-left-radius: 10px;'>Complaint ID</th>
                <th style='width:170px'>Category</th>
                <th style='width:150px'>Status</th>
                <th style='width:170px'>Submitted Date</th>
                <th style='border-top-right-radius: 10px;'>Subject</th>
            </tr>
        ";
        while($rows = mysqli_fetch_assoc($result))
        {
            if($rows['status'] == 'pending')
                $color = "#e8cc8c";
            else if($rows['status'] == 'resolved')
                $color = "#64e3a1";
            else if($rows['status'] == 'invalid')
                $color = "#f88279";
            

            echo "<tr>
                <td style='border-left: 2px solid rgb(226, 225, 225);'><form action='../User/view.php' method='get'><input type='submit' class='cmp_idtable' name='cmp_id' value=".$rows['complaint_id']."></form></td>
                <td>".$rows['category']."</td>
                <td class='tableStatus'><p class='tableStatusp' style='background-color:".$color.";'>".ucfirst($rows['status'])."</p></td>
                <td>".date("d:m:Y", strtotime($rows['date']))."</td>
                <td class='tableSub' style=''>".$rows['subject']."</td>
            </tr>";
        }
        echo "</table>";
    }
}



if(isset($_GET['status']) && $_GET['status'] != "")
{
    $status = $_GET['status'];
    $admin_id = $_SESSION['user'][3]; 
    // print_r($_SESSION['user']);

    if($_SESSION['user'][5] == 'admin' || $_SESSION['user'][5] == "Admin")
    {
        if($status != "all")
            $query = "select * from complaint_suggestion where status='$status' order by date desc";
        else
            $query = "select * from complaint_suggestion order by date desc";
    }
    else
    {
        if($status == "all")
        {
            $query = "select *
            from complaint_suggestion,admin,admin_complaint 
            where 
            admin.id=admin_complaint.admin_id and 
            complaint_suggestion.complaint_id=admin_complaint.complaint_id and
            admin_complaint.admin_id='$admin_id'";
        }
        else
        {
            $query = "select * from complaint_suggestion,admin,admin_complaint 
            where status='$status' and 
            admin.id=admin_complaint.admin_id and 
            complaint_suggestion.complaint_id=admin_complaint.complaint_id and
            admin_complaint.admin_id='$admin_id'";
        }
            
    }    
    
    $result = mysqli_query($conn,$query);
    printComplaintTable($result);
}


if(isset($_GET['category']) && $_GET['category'] != "")
{
    $category = $_GET['category'];
    $admin_id = $_SESSION['user'][3]; 
    if($_SESSION['user'][5] == 'admin' || $_SESSION['user'][5] == "Admin")
    {
            $query = "select * from complaint_suggestion where category='$category' order by date desc";
    }
    else
    {
        $query = "select * from complaint_suggestion,admin,admin_complaint 
                where category='$category' and 
                admin.id=admin_complaint.admin_id and 
                complaint_suggestion.complaint_id=admin_complaint.complaint_id and
                admin_complaint.admin_id='$admin_id'";
    }    
    
    $result = mysqli_query($conn,$query);
    printComplaintTable($result);
}

if(isset($_GET['start_date']) || isset($_GET['end_date']))
{
    if(isset($_GET['start_date']) && isset($_GET['end_date']))
    {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        
        if($_SESSION['user'][5] == 'admin' || $_SESSION['user'][5] == "Admin")
        {
            $query = "select * from complaint_suggestion where date>='$start_date' and date<='$end_date' order by date desc";
        }
        else
        {
            $query = "select * from complaint_suggestion,admin,admin_complaint 
                    where date>='$start_date' and date<='$end_date' and 
                    admin.id=admin_complaint.admin_id and 
                    complaint_suggestion.complaint_id=admin_complaint.complaint_id and
                    admin_complaint.admin_id='$admin_id'";
        }
    }else if(isset($_GET['start_date']))
    {
        $start_date = $_GET['start_date'];
        if($_SESSION['user'][5] == 'admin' || $_SESSION['user'][5] == "Admin")
        {
            $query = "select * from complaint_suggestion where date>='$start_date' order by date desc";
        }
        else
        {
            $query = "select * from complaint_suggestion,admin,admin_complaint 
                where date>='$start_date' and 
                admin.id=admin_complaint.admin_id and 
                complaint_suggestion.complaint_id=admin_complaint.complaint_id and
                admin_complaint.admin_id='$admin_id'";
        }
    }else if(isset($_GET['end_date']))
    {
        $end_date = $_GET['end_date'];
        if($_SESSION['user'][5] == 'admin' || $_SESSION['user'][5] == "Admin")
        {
            $query = "select * from complaint_suggestion where date<='$end_date' order by date desc";
        }
        else
        {
            $query = "select * from complaint_suggestion,admin,admin_complaint 
                where date<='$end_date' and 
                admin.id=admin_complaint.admin_id and 
                complaint_suggestion.complaint_id=admin_complaint.complaint_id and
                admin_complaint.admin_id='$admin_id'";
        }
    }

    $result = mysqli_query($conn,$query);
    printComplaintTable($result);
}

if(isset($_GET['statusChange']))
{
    $cmp_id = $_GET['cmp_id'];
    $status = $_GET['statusChange'];

    $query = "update complaint_suggestion set status='$status' where complaint_id='$cmp_id'";

    $result = mysqli_query($conn,$query);

}

if(isset($_GET['addAdmin']))
{
    $cmp_id = $_GET['cmp_id'];
    $addAdmin = $_GET['addAdmin'];

    $query = "insert into admin_complaint(complaint_id,admin_id) values('$cmp_id','$addAdmin')";

    $result = mysqli_query($conn,$query);
    
}
?>

