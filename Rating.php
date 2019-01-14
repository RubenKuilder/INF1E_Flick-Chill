<!DOCTYPE html>
<html lang="en">
    <head> <meta charset="UTF-8">
        <title> Flick N Chill</title>
        <link rel="stylesheet" type="text/css" href="Rating.css"> 

    </head>
    <body><div>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post"> 
                <input type="submit" name="goed" class="goed" value="">
                <input type="submit" name="neutraal" class="neutraal" value="">
                <input type="submit" name="slecht" class="slecht" value="">


            </form>              






            <?php
            $rating = 'geenvote';

            if (isset($_POST['goed'])) {
                $rating = 'Goed';
            } 
            if (isset($_POST['neutraal'])) {
              $rating = 'Neutraal';
            }
            if (isset($_POST['slecht'])) {
                $rating = 'Slecht';
            } 
            echo $rating;
            {
                ?></div> <?php
               
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
</html>
