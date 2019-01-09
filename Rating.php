<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Flick N Chill</title>
        <link rel="stylesheet" type="text/css" href="Rating.css">
    </head>
    <body> <form action="Rating.php" method="post">

            <div class="container">
                <ul>
                    <li>
                        <input type="radio" id="f-option" name="selector" value="1">
                        <label for="f-option">Slecht</label>

                        <div class="slecht"><div></div></div>
                    </li>

                    <li>
                        <input type="radio" id="s-option" name="selector" value="2" checked="checked">
                        <label for="s-option">Neutraal</label>

                        <div class="check"><div></div></div>
                    </li>

                    <li>
                        <input type="radio" id="t-option" name="selector" value="3" >
                        <label for="t-option" >Goed</label>

                        <div class="goed"><div></div></div>
                    </li>
                </ul>
                <div>
                    <input type="submit" name="submit" value="Submit" class="distance"/>
                </div> 
            </div>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            $rating = $_POST['selector'];
// video en user id moeten nog veranderd worden..........................
            $userid = 3;
            $videoid = 1;


            $db_name = "flicknchill";
            $DBConnect = mysqli_connect('localhost', 'root', '');
            if ($DBConnect === FALSE) {
                echo "<p>Unable to connect to the database server.</p>"
                . "<p>Error code " . mysqli_errno() . ": "
                . mysqli_error() . "</p>";
            } else {
                $db = mysqli_select_db($DBConnect, $db_name);
                if ($db === FALSE) {
                    echo "<p>Unable to connect to the database server.</p>"
                    . "<p>Error code " . mysqli_errno() . ": "
                    . mysqli_error() . "</p>";
                    mysqli_close($DBConnect);
                    $DBConnect = FALSE;
                }
            }

            if ($stmt = mysqli_prepare($DBConnect, "SELECT Count(Rating) FROM user_likes WHERE UserID = " . $userid . " AND VideoID = " . $videoid)) {
                if (!mysqli_stmt_execute($stmt)) {
                    echo "Error executing query";
                    die(mysqli_error($DBConnect));
                }
            } else {
                echo "Error with prepare: <br />";
                die(mysqli_error($DBConnect));
            }

            mysqli_stmt_bind_result($stmt, $countR);
            mysqli_stmt_store_result($stmt);
            while (mysqli_stmt_fetch($stmt)) {
                
            }if ($countR > 0) {
                echo 'Je hebt al een rating gegeven op deze video.';
            } else {
                $query = "INSERT INTO user_likes (UserID, VideoID, Rating) VALUES (" . $userid . ", " . $videoid . ", " . $rating . ")";
                if ($stmt = mysqli_prepare($DBConnect, $query)) {
                    if (mysqli_stmt_execute($stmt)) {
                        echo "Query executed";
                    } else {
                        echo "Error executing query";
                        die(mysqli_error($DBConnect));
                    }
                    echo "<br /><br />--------------------<br /><br />";
                } else {
                    echo "Error with prepare: <br />";
                    die(mysqli_error($DBConnect));
                }
            }
        }
        ?>

    </body>
