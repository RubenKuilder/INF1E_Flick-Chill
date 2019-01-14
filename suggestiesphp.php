<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Suggesties</title>
        <link rel="stylesheet" type="text/css" href="suggesties.css">
    </head>
    <body>
        <div id="suggestieswrapper">
            <h2>Fill in your video details</h2>
            <form method="post" action="suggestiesphp.php" enctype="multipart/form-data">
                <p><input type="text" name="title" placeholder="Title" class="inputs"/></p>
                <p><textarea type="text" name="description" placeholder="Description" id="description" class="inputs"></textarea></p>
                <p><input type="text" name="tags" placeholder="Tags" class="inputs"/></p>
                <p><input type="text" name="playback_id" placeholder="Playback ID" class="inputs"/></p>
                <p><input type="file" name="file"></p>
                <p><input type="submit" name="submit" value="Submit" id="submit"/></p>
            </form>
        </div>
        <?php
        $dbHost = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "flicknchill";

// Create database connection
        $DBConnect = mysqli_connect("localhost", "root", "");
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        $statusMsg = '';
        mysqli_select_db($DBConnect, $dbName);
        $TableName = "video";
        $SQLstring = "SHOW TABLES LIKE '" . $TableName . "' ";
        $title = htmlentities($_POST['title']);
        $description = htmlentities($_POST['description']);
        $tags = htmlentities($_POST['tags']);
        $playback_id = htmlentities($_POST['playback_id']);
// File upload path
        $targetDir = "upload/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database
                    $insert = "INSERT into $TableName (VideoID, UserID, isApp, isLive, Description, URL, Thumbnail, Title) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL";
                    {mysqli_stmt_bind_param($stmt, 'ssss', $description, $playback_id, $fileName, $title);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
                    if ($QueryResult2 === FALSE) {
                        echo "<p>Unable to execute the query.</p>"
                        . "<p>Error code "
                        . mysqli_errno($DBConnect)
                        . ": "
                        . mysqli_error($DBConnect)
                        . "</p>";
                    } else {
                        echo "<h1>Thank you for submitting your video!</h1>";
                    }}
                    if ($insert) {
                        $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                    } else {
                        $statusMsg = "File upload failed, please try again.";
                    }
                } else {
                    $statusMsg = "Sorry, there was an error uploading your file.";
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
            }
        } else {
            $statusMsg = 'Please select a file to upload.';
        }

// Display status message
        echo $statusMsg;
        ?>
    </body>
</html>