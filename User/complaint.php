<?php

include "../connection/conn.php";
include "../connection/session.php";
// print_r($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Img/logo.jpg" type="image/x-icon"'>
    <title>CampusVoice</title>
    <link rel="stylesheet" href="../css/complaint.css">
</head>
<body>
    <div class="form">
        <h1 class="heading"><button onclick="goBack()" style="border:none;background-color:white;"><img src="../Img/back.jpg" alt="" ></button> Submit New <?php if(isset($_GET['event']))echo $_GET['event'];else echo "Complaint";?></h1><br>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="category">Category: </label><br>
            <select name="category" id="category" required>
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
            </select><br><br>
            
            <label for="subject">Subject: </label><br>
            <input type="text" value="" placeholder="Brief description of the issue" class="subject" name="subject" required><br><br>

            <label for="description">Description:</label><br>
            <textarea name="description" class="description" placeholder="Please provide detailed information about the issue you are experiencing." required style="resize:vertical"></textarea><br><br>

            <!-- <form action="" method="post"  enctype="multipart/form-data"> -->

            <label for="attachment">Attachments:</label><br>
            <label for="file-upload" class="custom-file-upload">
                    <p style="color:blue">Upload a file </p>
                    <p>or drag and drop </p>
                    <p>PNG, JPG, PDF up to 10MB </p>
            </label>
            <input type="file" id="file-upload" name="file[]"  onchange="displayFileInfo()" style="display: none;" multiple><br>
            <div id="fileInfo"></div>
           
            <!-- <input type="submit" name=subfile value="Add File" class=addFile> -->
            <input type="reset" value="Reset" class="reset btn" name="reset">
            <input type="submit" class="submit btn" value="<?php echo 'Submit ';if(isset($_GET['event']))echo $_GET['event'];else echo "Complaint"?>" name="submit">
        </form>
    </div>
</body>
<script>
    // function displayFileInfo() 
    // {
    //     const file = document.getElementById("file-upload").files[0];
    //     const fileInfoDiv = document.getElementById("fileInfo");

    //     if (file) 
    //     {
    //         fileInfoDiv.innerHTML = `
    //             <p><strong>File Name:</strong> ${file.name}</p>
    //             <p><strong>File Size:</strong> ${file.size} bytes</p>
    //             <p><strong>File Type:</strong> ${file.type}</p>
    //             `;
    //     } else 
    //     {
    //         fileInfoDiv.textContent = "No file selected.";
    //     }
    // }
    function displayFileInfo() {
            const files = document.getElementById("file-upload").files;
            const fileInfoDiv = document.getElementById("fileInfo");

            fileInfoDiv.innerHTML = '';

            if (files.length > 0) 
            {

                Array.from(files).forEach(file => {
                    const fileInfo = document.createElement('div');
                    fileInfo.style.border = '1px solid #ccc';
                    fileInfo.style.padding = '10px';
                    fileInfo.style.marginBottom = '10px';
                    fileInfo.style.borderRadius = '5px';

                    fileInfo.innerHTML = `
                        <p><strong>File Name:</strong> ${file.name}</p>
                        <p><strong>File Size:</strong> ${file.size} bytes</p>
                        <p><strong>File Type:</strong> ${file.type || 'Unknown'}</p>
                    `;

                    fileInfoDiv.appendChild(fileInfo);
                });
            } else 
            {
                fileInfoDiv.textContent = "No files selected.";
            }
        }

    function goBack() 
    {
      window.history.back();
    }
  </script>
</html>

<?php

if(isset($_POST['submit']))
{
    
    $stud_id = $_SESSION['user'][3];
    $category = $_POST['category'];
    $subject = mysqli_real_escape_string($conn,$_POST['subject']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    // $attachments = $_POST['attachments'];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    // echo $date ."  ". $time; 

    if(!isset($_GET['event']) || $_GET['event'] == 'Complaint')
        $cmp_id = "CMP-".str_replace('-', '',$date).str_replace(':', '', $time);
    else
        $cmp_id = "SUG-".str_replace('-', '',$date).str_replace(':', '', $time);

    // echo $cmp_id;
    $query = "insert into complaint_suggestion values ('$stud_id' , '$cmp_id' ,'$category', '$subject', '$description' , '$date' ,'$time' ,'pending')";

    $result = mysqli_query($conn,$query);

    // $file_cnt = count($_FILES['file']['name']);

    $fileCount = count($_FILES['file']['name']); 
    // echo $fileCount;

        for($i = 0; $i < $fileCount; $i++)
        { 
            // $file_info = pathinfo($_FILES['file']['name'][$i]);
            // $extension = $file_info['extension'];
            if($_FILES['file']['error'][$i] == 0)
            {
                $file_name = $_FILES['file']['name'][$i];
                $extension = substr($file_name, strrpos($file_name, '.') + 1); 

                $fileName = $_FILES['file']['name'][$i] = "CampusVoice-".str_replace('-', '',$date).str_replace(':', '', $time).$i.'.'.$extension;
                $size = $_FILES['file']['size'][$i]; 
                $type = $_FILES['file']['type'][$i];
                $query = "insert into attachments values ('$cmp_id','$fileName','$size','$type')";
                $result = mysqli_query($conn,$query);
                move_uploaded_file($_FILES['file']['tmp_name'][$i], '../attachments/'.$fileName);
            }
        }

    // echo "<pre>";
    // print_r($_FILES['file']);
    // echo "</pre>";

    if($_GET['event'] == "Suggestion")
        echo "<script> alert('Suggestion submitted successfully')</script>";
    else if($_GET['event'] == "Complaint")
        echo "<script> alert('Complaint submitted successfully')</script>";
    
    echo "<script>
        window.location.href = './dashboard.php'
    </script>";
}

?>