<?php

include "../connection/conn.php";
include "../connection/admin_session.php";

if (isset($_GET['cmp_id']))
    $cmp_id = $_GET['cmp_id'];
else if (isset($_SESSION['cmp_id']))
    $cmp_id = $_SESSION['cmp_id'];
else
    $cmp_id = "";


include "../support/print_complaint.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="../css/view.css">
    <style>
        table{
            /* margin-top: 40px; */
            border: 1px solid;
            border-collapse: collapse;
            /* border-spacing: 20px; */
        }
        /* td,th{
            border: none;
        } */

        th,td{
            border:2px solid;
            padding-right: 8px;
            /* display: flex;  */
            /* justify-content: center;  */
            /* align-items: center; */
            vertical-align: middle;
        }

        th{
            padding: 5px;
            border-bottom: 3.5px solid;
        }

        .inlineBlock{
            display:inline-block;
        }

        .p::first-line{
            padding-left: 15px;
        }

        .file{
            /* margin:10px 10px 0px 0px; */
            border-radius: 3px;
            width:500px; 
            height:400px;
        }

        .fileDetails{
            text-decoration: none;
            font-size: 18px;
            color :rgb(65, 66, 67);
            padding-left: 20px;
        }
        pre{
            white-space: pre-wrap;
            word-wrap: break-word;
            /* font-family: ' Georgia', serif; */
        font-family: 'Roboto' , sans-serif;
        font-size:18px;
        margin:25px 50px 0px 0px;
        text-align:justify;
        }

        .re{
        display:flex;
        align-items: center;
        justify-content: flex-start;
        /* align-items: flex-end; */
        /* width: 100%; */
        /* height: 10px; */
        flex-direction: row;
        }



        @media (max-width: 767px){
        .file{
        /* margin:10px 10px 0px 0px; */
        border-radius: 3px;
        width:100%;
        height:100%;
        }

        table{
        /* margin-top: 40px; */
        border: 1px solid;
        border-collapse: collapse;
        margin-right: 13px;

        /* border-spacing: 20px; */

        }

        element.style{
        display: flex;
        /* align-items: center; */
        justify-content: flex-end;
        /* align-items: flex-end; */
        width: 100%;
        height: 1px;
        }


        }

        /* Mobile Remarks Section */
        @media (max-width: 767px) {
        .remarks {
        width: 80%;
        padding: 1rem;
        margin-top: 1.5rem;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        #s {
        max-height: 300px;
        padding: 0.5rem;
        background: #f8fafc;
        border-radius: 8px;
        margin: 0.5rem 0;
        }

        .re {
        flex-direction: column;
        gap: 0.5rem;
        width: 100%;
        }


        .addfile {
        background-color: #ffffff;
        height: 38px;
        padding: 5px;
        /* width: 70px; */
        margin-left: -295px;
        border: solid 2px #a8acbd;
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        }

        .msg {
        height: 38px;
        padding: 5px;
        width: 69%;
        font-size: 18px;
        padding-left: 10px;
        border: solid 2px #a8acbd;
        display: inline-block;
        resize: none;
        overflow-y: scroll;
        margin-top: -59px;
        }

        .sendbtn {
        height: 51px;
        padding: 5px;
        width: 60px;
        font-size: 18px;
        border: solid 2px #a8acbd;
        border-top-right-radius: 20px;
        border-bottom-right-radius: 20px;
        margin-top: -59px;
        margin-right: -258px;
        }
        
        .addfile img {
        height: 20px;
        width: 20px;
        }

        /* Remark Messages */
        .sender, .receiver {
        max-width: 85%;
        margin: 0.5rem 0;
        padding: 0.8rem 1rem;
        font-size: 0.9rem;
        line-height: 1.4;
        }

        .sender {
        background: #a3d5ff;
        margin-left: auto;
        border-radius: 15px 15px 0 15px;
        }

        .receiver {
        background: #75bcec;
        margin-right: auto;
        border-radius: 15px 15px 15px 0;
        }

        .date {
        width: 100%;
        margin: 0.5rem 0;
        font-size: 0.8rem;
        background: transparent;
        }

        /* File Attachments */
        .senderFile, .receiverFile {
        padding: 0.8rem;
        height: auto;
        max-width: 200px;
        }

        .fileanchor {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e293b;
        }

        .fileanchor::before {
        content: '📎' ;
        font-size: 1.1rem;
        }

        /* Scrollbar */
        #s::-webkit-scrollbar {
        width: 4px;
        }

        #s::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
        }
        }

        /* Animation Enhancements */
        .sender, .receiver {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sender:hover, .receiver:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .fileanchor {
        transition: opacity 0.2s ease;
        }

        .fileanchor:hover {
        opacity: 0.8;
        }

        /* Image Previews */
        .file {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 0.5rem 0;
        }

        element.style{
        width: 100px;
        }

        </style>
</head>

<body>
    <div class="header">
        <img src="../Img/notepad.png" alt="notebook" style="height:40px;width:40px;">
        <h1 style="margin-top:5px;margin-left:10px;">Student Complaints and Suggestions</h1>
    </div>
    <div class="main">
        <div style="display: flex;align-items: center;">
            <img src="../Img/back.jpg" alt="back" onclick="goBack()" class="back">
            <form action="" method="post">
                <input type="text" class="id" name="id" placeholder="<?php if ($cmp_id == '') echo 'CMP-XXXXXXXXX or SUG-XXXXXXXXX'; ?>" value="<?php if ($cmp_id != '' && !isset($_POST['Search'])) echo $cmp_id;
                                                                                                                                                if (isset($_POST['Search'])) echo $_POST['id']; ?>" required>
                <input type="submit" name="Search" value="Search" class="searchbtn" style="display:inline">

                <!-- <h2 onclick="goBack()" style="display:inline;cursor:pointer;margin:0px 10px;color:#606a72">Go Back</h2> -->
            </form>
        </div>

        <?php
        if (isset($_POST['Search']) || $cmp_id != '') {
            if (isset($_POST['Search']))
                $cmp_id = $_POST['id'];

            // $_GET['cmp_id'] = $cmp_id;
            // echo $cmp_id;
            if ($_SESSION['user'][0] == "student") {
                $stud_id = $_SESSION['user'][3];
                $query1 = "select * from complaint_suggestion where complaint_id='$cmp_id' and stud_id = '$stud_id'";
                $query2 = "select file_name,size,type from attachments where '$cmp_id'= attachments.complaint_id";
            } else {
                $query1 = "select * from complaint_suggestion where complaint_id='$cmp_id'";
                $query2 = "select * from attachments where '$cmp_id'= complaint_id";
            }

            $result1 = mysqli_query($conn, $query1);
            $result2 = mysqli_query($conn, $query2);

            // echo $result1;
            // $row1 = mysqli_fetch_assoc($result1);
            // $row2 = mysqli_fetch_assoc($result2);

            if (mysqli_num_rows($result1) == 0) {
                echo "<h2 style='color:#ff6242;margin-top:25px'>No record FOUND!<h2>";
                // echo "<script>alert('No record found!')</script>";
                PrintDummy();
            } else {
                if ($_SESSION['user'][0] == "admin") {
                    if ($_SESSION['user'][5] == "admin" || $_SESSION['user'][5] == "Admin")
                        printControls($cmp_id);
                    else {
                        $query3 = "select admin.id from admin, admin_complaint,complaint_suggestion 
                                where admin.id=admin_complaint.admin_id and 
                                complaint_suggestion.complaint_id=admin_complaint.complaint_id and 
                                admin_complaint.complaint_id='$cmp_id'
                                ";

                        $result3 = mysqli_query($conn, $query3);
                        if (mysqli_num_rows($result3) == 1)
                            printControls($cmp_id);
                    }
                }

                PrintComplaint($result1, $result2);
            }
            // $row2 = mysqli_fetch_assoc($result2);
            // echo "asdhf";
            // echo "asdhf";

            // print_r($row2);
            // echo $row1[]


        ?>
            <h3 style='margin-top:20px'>Remarks:</h3>
            <div class="remarks">
                <div id="s" style='padding-top:5px;max-height:500px;overflow-y:auto'>
                    <?php
                    $user_id = $_SESSION['user'][3];
                    if ($_SESSION["user"][0] == "student") {
                        // $query = "select sender, file_name,message,remarks.time,remarks.date from remarks,complaint_suggestion where remarks.complaint_id='$cmp_id' and complaint_suggestion.stud_id='$user_id' order by remarks.date desc";
                        $query = "
                                SELECT sender, file_name, message, remarks.time, remarks.date
                                FROM remarks
                                JOIN complaint_suggestion ON remarks.complaint_id = complaint_suggestion.complaint_id
                                WHERE remarks.complaint_id = '$cmp_id' 
                                AND complaint_suggestion.stud_id = '$user_id'
                                ORDER BY remarks.date";
                    } else {
                        $query = "select * from remarks where complaint_id='$cmp_id'";
                    }


                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                        print_remark($result);
                    } else {
                        echo "<h3 class='date' style='width:200px;'>No remarks found</h3><br>";
                    }

                    ?>
                </div>
                <!-- <label for="file" class="file"><img src="../Img/add.png" style="height:50px;width:50px" alt=""></label>
                    <input type="file" style="display:none" name="file[]" id=file>
                    <textarea type="text" id="message" name='message' placeholder="Enter your remark or message" required></textarea>
                    <input type="button" class="sendbtn" onclick="insert(document.getElementById('message').value)" value=send> -->
                <form action="./view.php?cmp_id=<?php echo $cmp_id ?>" method="post" enctype="multipart/form-data">
                    <div class="re">
                        <label for='file' class="addfile" style="display:flex;align-items: center;"><img src="../Img/add.png" style="height:40px;width:40px" alt=""></label>
                        <input type="file" name='addfile[]' id='file' style='display:none' multiple>
                        <textarea name="message" cols="30" class="msg" id='message' rows="2" placeholder="Enter your message here"></textarea>
                        <input type="submit" class="sendbtn" name="send" value="Send" onclick="autoScroll()">
                    </div>
                </form>
            </div>
        <?php
        } else
            PrintDummy();

        ?>

    </div>

    <script>
        // function insert(cmp_id)
        // {
        //     var msg = document.getElementById('message').value;

        //     if(msg != "")
        //     {
        //         // console.log(msg);
        //         var xmlhttp = new XMLHttpRequest();
        //         xmlhttp.onreadystatechange = function () {
        //           if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        //             document.getElementById("remarks").innerHTML = xmlhttp.responseText;
        //           }
        //         }
        //         xmlhttp.open("POST", "../support/remarks.php?message="+msg+'&file='+file+'&comp_id='+cmp_id, true); 
        //         xmlhttp.send();

        //     }            
        // }

        // if (performance.navigation.type === 1) {
        //         window.location.href = "view.php?cmp_id=<?php echo $cmp_id ?>";
        // }
        // setInterval(function() {
        //             location.reload();  // Refresh the page
        //         }, 10000);

        var container = document.getElementById('remarks');

        function autoScroll() {
            // Scroll to the bottom of the container
            container.scrollTop = container.scrollHeight;
        }

        // Auto scroll every 100 milliseconds (this can be adjusted)
        // setInterval(autoScroll, 100);
    </script>

    <script src="../support/javascript.js"></script>
</body>

</html>

<?php

if (isset($_POST['send'])) {

    // print_r($_SESSION['user']);
    // unset($_POST['send']);
    // $_SESSION['cmp_id'] = $cmp_id;
    $user_id = $_SESSION['user'][3];
    $msg = $_POST['message'];
    $file = $_FILES["addfile"];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    // echo $fileCount;
    if ($msg != "") {
        $query = "insert into remarks (complaint_id,sender,message,date,time) values('$cmp_id','$user_id','$msg','$date','$time')";
        $result = mysqli_query($conn, $query);

        // echo $cmp_id;
        // echo "$msg";
    }

    $fileCount = count($_FILES['addfile']['name']);
    // print_r($_FILES['addfile']);

    for ($i = 0; $i < $fileCount; $i++) {
        if ($_FILES['addfile']['error'][$i] == 0) {
            $file_name = $_FILES['addfile']['name'][$i];
            $extension = substr($file_name, strrpos($file_name, '.') + 1);

            $fileName = $_FILES['addfile']['name'][$i] = "CampusVoice-" . str_replace('-', '', $date) . str_replace(':', '', $time) . $i . '.' . $extension;
            $size = $_FILES['addfile']['size'][$i];
            $type = $_FILES['addfile']['type'][$i];
            $query1 = "insert into attachments values ('$cmp_id','$fileName','$size','$type')";
            $query2 = "insert into remarks(complaint_id,sender,file_name,date,time) values ('$cmp_id','$user_id','$fileName','$date','$time')";
            move_uploaded_file($_FILES['addfile']['tmp_name'][$i], '../attachments/' . $fileName);
            $result1 = mysqli_query($conn, $query1);
            $result2 = mysqli_query($conn, $query2);
        }
    }

    echo "<script>window.location.href = 'view.php?cmp_id=" . urlencode($cmp_id) . "';</script>";
    exit();
    // echo "<script>  window.location.href = view.php?cmp_id=$cmp_id</script>";
    // echo "<script>  window.location.href = view.php?cmp_id=$cmp_id</script>";
    // echo "<script>  window.location.href = view.php?cmp_id=$cmp_id</script>";
    // header("Location: ./view.php?cmp_id=$cmp_id");
    // exit();

    echo "<script>autoScroll()</script>";
}
?>