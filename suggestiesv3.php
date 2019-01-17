<?php
session_start();
if ($_SESSION['id'] = "") {
    header('location:index.php');
    exit();
}

require 'system/config.php';

if(isset($_POST['upload'])){
    if(empty($_POST['Description']) || empty($_POST['Title']) || empty($_POST['URL']) || empty($_POST['Tags'])){
        $submit_err = "Please fill in all fields.";
    }
    if(empty($_FILES['Thumbnail']['tmp_name'])){
        $file_err = "Upload a file.";
    }
    else {
        $sug_d = htmlentities(trim($_POST['Description']));
        $sug_ti = htmlentities(trim($_POST['Title']));
        $sug_u = htmlentities(trim($_POST['URL']));
        $userID = $_SESSION["id"];
        $text = $_POST["Tags"];
        
        $upload_dir = "assets/images/uploads/";
        $target_file = $upload_dir.basename($_FILES['Thumbnail']['name']);
        $upload_ok = 1;
        if(!empty($_POST['file'])){
            $check = getimagesize($_FILES['Thumbnail']['tmp_name']);
            if($check !== FALSE){
                $upload_ok = 1;
            }
            else {
                $upload_ok = 0;
            }
        }
        if($upload_ok == 0){
            $file_err = "Upload a file.";
        }
        else{
            if(move_uploaded_file($_FILES['Thumbnail']['tmp_name'], $target_file)){
                $sug_tu = basename($_FILES['Thumbnail']['name']);
            }
            else{
                $file_err = "Upload a file.";
            }
        }
        $query = "INSERT INTO video (userID, Description, URL, Thumbnail, Title) VALUES (?, ?, ?, ?, ?);";
        
        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt, 'sssss', $userID, $sug_d, $sug_u, $sug_tu, $sug_ti);
            if (mysqli_stmt_execute($stmt)) 
            {
                $query2 = "INSERT INTO tag (Genre) VALUES (?)";
                if ($stmt2 = mysqli_prepare($conn, $query2)){
                    mysqli_stmt_bind_param($stmt2, 's', $text);
                    if (mysqli_stmt_execute($stmt2)){
                    $msg = "Suggestion added! Thank you!";
                    }
                    else 
                    {
                        $msg = "Error with sending your suggestion: ";
                        die(mysqli_error($conn));
                    }
                    mysqli_stmt_close($stmt2);
                } 
                else 
                {
                    $msg = "Error connecting to: <br />";
                    die(mysqli_error($conn));
                    
                }
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                } 
            } 
            else 
            {
                $msg = "Error with sending your suggestion: ";
                die(mysqli_error($conn));
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Image Upload</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="suggesties.css">
    </head>
    <body>
        <div id="suggestieswrapper">
            <h2>Fill in your video details</h2>
            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="Thumbnail"><p><?php if(isset($file_err)){ echo "<br/>" . $file_err; }?></p>
                <textarea 
                    name="Description" 
                    placeholder="Description"
                    id="description"
                    class="inputs"></textarea>
                <textarea 
                    name="Title" 
                    placeholder="Title"
                    class="inputs"></textarea>
                <textarea 
                    name="URL" 
                    placeholder="Playback-ID"
                    class="inputs"></textarea>
                <textarea 
                    name="Tags" 
                    placeholder="Tags"
                    class="inputs"></textarea>
                <input type="submit" name="upload" id="submit"/>
                <p><?php if(isset($submit_err)){ echo "<br/>". $submit_err; } if(isset($msg)){ echo "<br/>". $msg; }?></p>
            </form>
        </div>
    </body>
</html>