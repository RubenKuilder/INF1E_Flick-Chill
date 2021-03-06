<!DOCTYPE html>
<html lang="en">
    <head> <meta charset="UTF-8">
        <title> Flick N Chill</title>
        <link rel="stylesheet" type="text/css" href="Rating.css"> 

    </head>
    <body>

        <?php
        session_start();
        require('system/config.php');
        if (!isset($_SESSION['vidId'])) {
            $_SESSION['vidId'] = $_GET['dataID'];
        } else if (isset($_GET['dataID'])) {
            $_SESSION['vidId'] = $_GET['dataID'];
        }
        $tableName = "video";
        $selectQuery = "SELECT Description, URL, Title FROM " . $tableName . " WHERE VideoID = " . $_SESSION['vidId'];

        if ($stmt = mysqli_prepare($conn, $selectQuery)) {



            if (!mysqli_stmt_execute($stmt)) {
                echo "Error executing query";
                echo "<br /><br />--------------<br /><br />";
                die(mysqli_error($conn));
            }
        } else {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_result($stmt, $descr, $Url, $titel);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            while (mysqli_stmt_fetch($stmt)) {
                echo' <div class="iframe"><iframe src="https://www.youtube.com/embed/' . $Url . '?rel=0&showinfo=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
                //WEL DE JUISTE URL IN DATABASE HEBBEN!
// video en user id moeten nog veranderd worden..........................

                $userid = $_SESSION['id'];
                $tableName2 = "tag";
                $sqlTag = "SELECT genre
                            FROM tag
                            JOIN video_tag ON video_tag.TagID= tag.TagID
                            WHERE videoID='" . $_SESSION['vidId'] . "';" ;
                            if ($stmt2 = mysqli_prepare($conn, $sqlTag)) {
                                if (!mysqli_stmt_execute($stmt2)) {
                                    echo "Error executing query";
                                    echo "<br /><br />--------------<br /><br />";
                                    die(mysqli_error($conn));
                                }
                            } 
                        else {
                            die(mysqli_error($conn));
                        }
                   mysqli_stmt_bind_result($stmt2, $tags);
                   mysqli_stmt_store_result($stmt2);

                if (isset($_SESSION["videoIdRate"])) {
                    $videoid = $_SESSION["videoIdRate"];
                }
                if ($stmt = mysqli_prepare($conn, "SELECT Count(Rating), Rating FROM user_likes WHERE UserID = " . $userid . " AND VideoID = " . $_SESSION['vidId'] . ";")) {
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error executing query";
                        die(mysqli_error($conn));
                    }
                } else {
                    echo "Error with prepare: <br />";
                    die(mysqli_error($conn));
                }

                mysqli_stmt_bind_result($stmt, $countR, $rate);
                mysqli_stmt_store_result($stmt);
                while (mysqli_stmt_fetch($stmt)) {
                    
                }
                if ($countR == 0) {
                    ?> <div>
                        <form action="ratingGet.php" method="post"> 
                            <i>Rating: </i><input type="submit" name="goed" class="goed" value="">
                            <input type="submit" name="neutraal" class="neutraal" value="">
                            <input type="submit" name="slecht" class="slecht" value="">
                        </form> 
                        <?php
                        $rating = 0;

                        if (isset($_POST['goed'])) {
                            $rating = 1;
                        } else if (isset($_POST['neutraal'])) {
                            $rating = 2;
                        } else if (isset($_POST['slecht'])) {
                            $rating = 3;
                        }
                        ?>
                    </div>   
                    <?php
                    if ($rating != 0) {

                        $query = "INSERT INTO user_likes (UserID, VideoID, Rating) VALUES (" . $userid . ", " . $_SESSION['vidId'] . ", " . $rating . ");";
                        if ($stmt = mysqli_prepare($conn, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                unset($_SESSION['vidId']);
                                header('Location: dashboard.php');
                            } else {
                                echo "Error executing query";
                                die(mysqli_error($conn));
                            }
                        } else {
                            echo "Error with prepare: <br />";
                            die(mysqli_error($conn));
                        }
                    }
                } else {

                    if ($rate == 1) {
                        echo "<div class='ratingConfirm'><i>You rated this video 'good'</i> <input type='submit' name='goed' class='goedS' value=''></div>";
                    } else if ($rate == 2) {
                        echo "<div class='ratingConfirm'><i>You rated this video 'neutral'</i><input type='submit' name='goed' class='neutraalS' value=''></div>";
                    } else if ($rate == 3) {
                        echo "<div class='ratingConfirm'><i>You rated this video 'bad'</i><input type='submit' name='goed' class='slechtS' value=''></div>";
                    } else {
                        echo "<div class='ratingConfirm'><i>You already rated this video</i></div>";
                    }
                    unset($_SESSION['vidId']);
                }         
                echo'<h2>' . $titel . '</h2>';
                echo '<p>' . $descr . '</p>';
                if(mysqli_stmt_num_rows($stmt2) > 0){
                    echo "<i>Tags: ";
                    while(mysqli_stmt_fetch($stmt2)){
                        echo  "<a href='dashboard.php?search=" . $tags . "'>" . $tags . "</a> ";
                    }
                    echo "</i><p></p>";
                }
            }
        }
        ?>

    </body>
</html>
