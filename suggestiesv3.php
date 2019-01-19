<?php
session_start();

if ($_SESSION['id'] == "") {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<?php
require('system/config.php');
require('header.php');

        if(isset($_POST['upload'])) {
            $sug_d = htmlentities(trim($_POST['Description']));
            $sug_ti = htmlentities(trim($_POST['Title']));
            $sug_u = htmlentities(trim($_POST['URL']));
            $sug_ta = htmlentities(trim($_POST['Tags']));
            $thumbnail = filter_var($_FILES["Thumbnail"]["name"], FILTER_SANITIZE_STRING);
            $userID = $_SESSION["id"];

            $explodedTags = explode(" ", $sug_ta);

            $target_dir = "assets/images/uploads/";
            $target_file = $target_dir . basename($_FILES["Thumbnail"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["Thumbnail"]["tmp_name"]);
                if($check !== false) {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    //echo "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                echo "File already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["Thumbnail"]["size"] > 500000) {
                echo "Your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            $tableName = "video";
            $insertQuery = "INSERT INTO " . $tableName . " (UserID, Description, URL, Thumbnail, Title) VALUES (?, ?, ?, ?, ?)";
            if($stmt = mysqli_prepare($conn, $insertQuery)) {
                mysqli_stmt_bind_param($stmt, 'issss', $userID, $sug_d, $sug_u, $thumbnail, $sug_ti);

                if($uploadOk != 0) {
                    if (mysqli_stmt_execute($stmt) && move_uploaded_file($_FILES["Thumbnail"]["tmp_name"], $target_file)) {
                        echo "Video suggestion added to database.";

                        $selectTags = "SELECT * FROM tag WHERE Genre = ?";
                            
                        $i = 0;
                        foreach ($explodedTags as $tag) {
                            if($selectTagsStmt = mysqli_prepare($conn, $selectTags)) {
                                mysqli_stmt_bind_param($selectTagsStmt, 's', $explodedTags[$i]);

                                if(!mysqli_stmt_execute($selectTagsStmt)) {
                                    echo "An error occured executing the select query.";
                                    echo "<br /><br />-----------------<br /><br />";
                                    die(mysqli_error($conn));
                                }
                            } else {
                                die(mysqli_error($conn));
                            }
                            mysqli_stmt_store_result($selectTagsStmt);

                            if(mysqli_stmt_num_rows($selectTagsStmt) > 0) {
                                echo "Tag already exists in database";
                            } else {
                                $insertTag = "INSERT INTO tag (Genre) VALUES (?)";
                                if($insertTagsStmt = mysqli_prepare($conn, $insertTag)) {
                                    mysqli_stmt_bind_param($insertTagsStmt, 's', $explodedTags[$i]);

                                    if(mysqli_stmt_execute($insertTagsStmt)) {
                                        echo "Doet het.";
                                    } else {
                                        echo "Pestklerekankerding werkt nog niet.";
                                    }
                                }
                            }

                            $i++;
                        }
                    } else {
                        echo "Video couldn't be added.";
                    }
                } else {
                    echo "Your file was not uploaded.";
                }
            } else {
                die(mysqli_error($conn));
            }
        }

        ?>
        <div id="suggestieswrapper">
            <h2>Fill in your video details</h2>
            <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <input type="hidden" name="size" value="1000000">
                <input type="file" name="Thumbnail">
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
                <input type="submit" name="upload" value="Submit" id="submit"/>
                <p class="error_msg"><?php if(isset($file_err)){ echo "<br/>" . $file_err; }?></p>
                <p class="error_msg"><?php if(isset($submit_err)){ echo "<br/>". $submit_err; } if(isset($msg)){ echo "<br/>". $msg; }?></p>
            </form>
        </div>
    </body>
</html>