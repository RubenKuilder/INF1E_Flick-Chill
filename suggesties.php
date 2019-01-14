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
        ?>
    </body>
</html>