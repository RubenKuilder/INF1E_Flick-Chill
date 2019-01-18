<!DOCTYPE html>
<html lang="en">
    <head> <meta charset="UTF-8">
        <title> Flick N Chill</title>
        <link rel="stylesheet" type="text/css" href="Rating.css"> 

    </head>
    <body>

        <?php
// video en user id moeten nog veranderd worden..........................
session_start();
        $userid = $_SESSION['id'];


        require('system/config.php');
       

        if (isset($_SESSION["videoIdRate"])) {
            $videoid = $_SESSION["videoIdRate"];
        }
        if ($stmt = mysqli_prepare($conn, "SELECT Count(Rating) FROM user_likes WHERE UserID = " . $userid . " AND VideoID = " . $videoid)) {
            if (!mysqli_stmt_execute($stmt)) {
                echo "Error executing query";
                die(mysqli_error($conn));
            }
        } else {
            echo "Error with prepare: <br />";
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_result($stmt, $countR);
        mysqli_stmt_store_result($stmt);
        while (mysqli_stmt_fetch($stmt)) {
            
        }
        //   if ($countR > 0) {
        ?> <div>
            <form action="Rating.php" method="post"> 
                <input type="submit" name="goed" class="goed" value="">
                <input type="submit" name="neutraal" class="neutraal" value="">
                <input type="submit" name="slecht" class="slecht" value="">


            </form> 





            <?php
            $rating = 0;

            if (isset($_POST['goed'])) {
                $rating = 3;
            } else if (isset($_POST['neutraal'])) {
                $rating = 2;
            } else if (isset($_POST['slecht'])) {
                $rating = 1;
            }
            ?>
        </div>   
        <?php
        // } else {
        if ($rating != 0) {

            $query = "INSERT INTO user_likes (UserID, VideoID, Rating) VALUES (" . $userid . ", " . $videoid . ", " . $rating . ")";
            if ($stmt = mysqli_prepare($conn, $query)) {
                if (mysqli_stmt_execute($stmt)) {
                    header('Location: Dashboard.php');
                } else {
                    echo "Error executing query";
                    die(mysqli_error($conn));
                }
            } else {
                echo "Error with prepare: <br />";
                die(mysqli_error($conn));
            }
        }
        // }
        ?>

    </body>
</html>
