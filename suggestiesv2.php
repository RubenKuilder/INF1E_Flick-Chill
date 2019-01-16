<?php
// Create database connection
$db = mysqli_connect("localhost", "root", "", "flicknchill");

// Initialize message variable
$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
    // Get image name
    $Thumbnail = $_FILES['Thumbnail']['name'];
    $Title = htmlentities($_POST['Title']);
    $URL = htmlentities($_POST['URL']);
    // Get text
    $Description = mysqli_real_escape_string($db, $_POST['Description']);
    // image file directory
    $target = "thumbnails/" . basename($Thumbnail);

    $sql = "INSERT INTO video (Thumbnail, Title, Description, URL) VALUES ('$Thumbnail', '$Title', '$Description', '$URL')";
    // execute query
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['Thumbnail']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    } else {
        $msg = "Failed to upload image";
    }
}
$result = mysqli_query($db, "SELECT * FROM video");
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
            <form method="POST" action="suggestiesv2.php" enctype="multipart/form-data">
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
                <button type="submit" name="upload" id="submit">SUBMIT</button>
            </form>
        </div>
    </body>
</html>