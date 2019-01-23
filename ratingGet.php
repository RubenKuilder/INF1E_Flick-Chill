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
        } else if (isset($_GET['dataID'])){
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
                echo' <div class="iframe"><iframe src="https://www.youtube.com/embed/' . $Url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
                //WEL DE JUISTE URL IN DATABASE HEBBEN!
// video en user id moeten nog veranderd worden..........................

                $userid = $_SESSION['id'];


                if (isset($_SESSION["videoIdRate"])) {
                    $videoid = $_SESSION["videoIdRate"];
                }
                if ($stmt = mysqli_prepare($conn, "SELECT Count(Rating) FROM user_likes WHERE UserID = " . $userid . " AND VideoID = " . $_SESSION['vidId']) . ";") {
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
                if ($countR == 0) {
                    ?> <div>
                        <form action="ratingGet.php" method="post"> 
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
                    if ($rating != 0) {

                        $query = "INSERT INTO user_likes (UserID, VideoID, Rating) VALUES (" . $userid . ", " . $_SESSION['vidId'] . ", " . $rating . ");";
                        if ($stmt = mysqli_prepare($conn, $query)) {
                            if (mysqli_stmt_execute($stmt)) {
                                unset($_SESSION['vidId']);
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
                } else {
                    unset($_SESSION['vidId']);

                    echo '<i>You already rated this video.</i>';
                }
               
                echo'<h2>' . $titel . '</h2><p>' . $descr . '</p>';
            }
        }
        ?>

    </body>
</html>
