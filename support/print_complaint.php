
<?php

function PrintDummy()
{

?>
    <hr style="width:300px; height:10px;background-color: #e8eaec;margin:40px 0px 0px 0px;border:none;border-radius:10px">
    <hr style="width:200px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px;float:right">
    <hr style="width:300px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <h4 style="display:inline-block;">Date:</h4><hr style="width:90px;display:inline-block;  height:10px;background-color: #e8eaec;margin:15px 5px 0px 10px;border:none;border-radius:10px">
    <h4 style="display:inline-block;">Time:</h4><hr style="width:100px;display:inline-block; height:10px;background-color: #e8eaec;margin:15px 0px 0px 10px;border:none;border-radius:10px">
    <hr style="width:300px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style=" float:right;width:90%;height:10px;background-color: #e8eaec;margin:40px 0px 0px 0px;border:none;border-radius:10px">
    <br>
    <br>
    <br>

    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style="width:300px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 40px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style="width:500px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <br><br>
    
    <h3>Attachments:</h3>
    <img src="../Img/dummy.webp" alt="" style="height:300px;width:350px;border-radius:10px;margin-top:10px;">
    
    <h3>Remarks:</h3>
    <hr style="width:100px;display:inline-block;height:10px;background-color: #e8eaec;margin:15px 5px 0px 0px;border:none;border-radius:10px">
    <hr style="width:100px;display:inline-block;height:10px;background-color: #e8eaec;margin:15px 5px 0px 0px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style=" height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">
    <hr style="width:500px; height:10px;background-color: #e8eaec;margin:15px 0px 0px 0px;border:none;border-radius:10px">




<?php
}


function PrintComplaint($result1,$result2)
{
    $rows1 = mysqli_fetch_assoc($result1);
    if(substr($rows1['complaint_id'],0,3) == "CMP")
        echo "<h2 class='inlineBlock' style='margin-top:40px'>Complaint ID: </h2><h2 class='inlineBlock' style='margin:40px 0px 0px 20px;color:#2463eb'>".$rows1['complaint_id']."</h2>";
    else
        echo "<h2 class='inlineBlock' style='margin-top:40px'>Suggestion ID: </h2><h2 class='inlineBlock' style='margin:40px 0px 0px 20px;color:#2463eb'>".$rows1['complaint_id']."</h2>";
        
    echo "<br><p class='inlineBlock' style='margin-top:5px'>Category:</p><p class='inlineBlock' style='margin:5px 0px 0px 30px'> ".$rows1['category']."</p>";
    
    if($rows1['status'] == 'pending')
        echo "<h3 style='float:right;margin-right:50px;background-color:#e8cc8c;border-radius:10px;height:20px;width:80px;padding:10px;text-align:center'>".ucfirst($rows1['status'])."</h3>";
    else if($rows1['status'] == 'invalid')
        echo "<h3 style='float:right;margin-right:50px;background-color:#F88279;border-radius:10px;height:20px;width:80px;padding:10px;text-align:center'>".ucfirst($rows1['status'])."</h3>";
    else
        echo "<h3 style='float:right;margin-right:50px;background-color:#64e3a1;border-radius:10px;height:20px;width:80px;padding:10px;text-align:center'>".ucfirst($rows1['status'])."</h3>";

    echo "<br><p class='inlineBlock' style='margin:5px 0px 0px 0px'>Date: ".date("d:m:Y", strtotime($rows1['date']))."</p>";
    echo "<p class='inlineBlock' style='margin:5px 0px 0px 30px;'>Time: ".date("H:i", strtotime($rows1['time']))."</p>";
    echo "<br><h2 class='inlineBlock' style='margin:40px 30px 0px 50px'>Subject: </h2><h2 class='inlineBlock' style='font-family: Lato;'>".$rows1['subject']."</h2>";

    // echo "<br><p class='p' style='font-size: 18px;margin:20px 50px 0px 0px;text-align:justify;'>".$rows1['description']."</p>";

    echo "<br><div style='width:100%;'><pre>".$rows1['description']."</pre></div>";

    print_attachments($result2);
}
?>
    <!-- <div style="height:auto;width:100%;background-color:#e8eaec"> -->
<?php
function print_attachments($result2)
{
    if(mysqli_num_rows($result2) != 0)
    {
        echo "<h3 style='margin-top:30px'>Attachments:</h3>";

        echo "<table>";
        while($rows2 = mysqli_fetch_assoc($result2))
        {
            $filename = "../attachments/".$rows2['file_name'];
            $type = $rows2['type'];
            $size = $rows2['size'];

            echo "<tr><th rowspan='5'>";
            if($rows2['type'] == "application/pdf" || preg_match('/\bpdf\b/i', $rows2['type']) == "pdf")
            {
                echo "<embed class=file src='$filename' type='application/pdf'>";
            }
            else if(substr($rows2['type'],0,5) == 'image' || preg_match('/\bimage\b/i', $rows2['type']) == "image")
            {
                echo "<a target='_blank' href='$filename'><img class='file' src='$filename' alt='Image Preview'></a>";
            }
            else if(substr($rows2['type'],0,4) == "text" || $rows2['type'] == 'text/plain' || preg_match('/\btext\b/i', $rows2['type']) == 'text')
            {
                // $content = file_get_contents($filename);
                // echo nl2br($content);      
                echo "<embed class=file src='$filename' type='text/plain'>";
            }
            else if($rows2['type'] == 'video/mp4' || substr($rows2['type'],0,5) == 'video' || preg_match('/\bvideo\b/i', $rows2['type']))
            {
                echo "<video class=file controls>
                <source src='$filename' type='$type'>
                Your browser does not support the video element.
                </video>";
            }
            else if($rows2['type'] == 'audio/mpeg' || substr($rows2['type'],0,5) == 'audio' || preg_match('/\baudio\b/i', $rows2['type']))
            {
                echo "<audio class=file controls style='height:100px'>
                    <source src='$filename' type='$type'>
                     Your browser does not support the audio element.
                    </audio>";
            }
            else
            {
                $type = $rows2['type'];
                echo "<a href='$filename' download><img class=file src='../Img/no-preview-available.png' alt='no-preview-avaiable' style='height:250px;width:400px'></a>";
                // echo "<embed class=file src='$filename' type='$type'>";

            }
            echo "</th>";

            echo "<td><h3 class='fileDetails'>File Name :".$rows2['file_name']." </td></tr>";
            echo "<tr><td class='fileDetails'>Type : $type</td></tr>";
            echo "<tr><td class='fileDetails'>Size: $size bytes</td></tr>";
            echo "<tr><td><a class='fileDetails' href='$filename' target='_blank'>Click to View</a></td></tr>";
            echo "<tr><td style='border-bottom:3.5px solid'><a class='fileDetails' download='$filename' href='$filename' >Click to Download</a></td></tr>";
        }
        echo "</table>";

    }else
        echo "<h3 style='margin-top:25px'>No Attachments FOUND!<h3>";
    
}


// echo "</div>";

function print_remark($result)
{
        $prev = "";
    while($rows = mysqli_fetch_assoc($result))
    {

        $date = $rows['date'];
    
        if($date != $prev)
        {
            echo "<h3 class='date'>".str_replace(":","/",date("d:m:Y", strtotime($rows['date'])))."</h3><br>";
            $prev = $date;
        }
            
        if($_SESSION['user']['3'] == $rows['sender'])
        {
            if($rows['message'] != NULL && $rows['file_name'] == NULL)
                echo "<p class='sender'>".$rows['message']."</p><br>";
            else if($rows['file_name'] != NULL && $rows['message'] == NULL)
            {
                echo "<p class='senderFile'><img src='../Img/file.png' height=30px width=30px><a download href='../attachments/$rows[file_name]' style='text-decoration:none'>".$rows['file_name']."</a></p><br>";
            }

        }
        else
        {
            if($rows['message'] != NULL && $rows['file_name'] == NULL)
                echo "<p class='receiver'>".$rows['message']."</p><br>";
            else if($rows['file_name'] != NULL && $rows['message'] == NULL)
            {
                echo "<p class='receiverFile'><img src='../Img/file.png' height=30px width=30px><a download href='../attachments/$rows[file_name]' style='text-decoration:none'>".$rows['file_name']."</a></p><br>";

            }
        }

    }
}

function printControls($cmp_id)
{
    include "../connection/conn.php";
    // echo "<br>aijrf<br>";
    echo " <div id='update'></div> <br><div class='adminControl'>
            <h3>Admin Control Panel:</h3>
            <input type='text' value='$cmp_id' id='cmp_id' style='display:none'>
        <label class='labelAdmin'>Mark as </label>
        <select id='statusChange' onchange='StatusChange()' class='adminSelect'>
            <option disabled selected>select Status</option>
            <option value='pending'>Pending</option>
            <option value='invalid'>Invalid</option>
            <option value='resolved'>Resolved</option>
        </select><br>
        
        <label class='labelAdmin'>Add Admin</label>";

    $query = "select admin.id, admin.name, admin.department
            from admin
            where not exists (
                select 1
                from admin_complaint
                where admin_complaint.admin_id = admin.id
                and admin_complaint.complaint_id = '$cmp_id'
                ) and (department <> 'admin');
    ";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0)
    {
        echo "<select id='addAdmin' class='adminSelect' style='width: 300px;' onchange='addAdmin()'>
            <option disabled selected>Select Admin</option>";
        while($rows = mysqli_fetch_assoc($result))
        {
            echo "<option value='".$rows['id']."'>".$rows['id'].": ".$rows['name']."<br> ".$rows['department']." department</option>";
        }
    }
    echo "</select></div>";
}

?>


