<?php

require('config.php');

//echo "test";

if (isset($_GET['offset']) && isset($_GET['limit'])) {
    $limit = filter_var($_GET['limit'], FILTER_SANITIZE_SPECIAL_CHARS);
    $offset = filter_var($_GET['offset'], FILTER_SANITIZE_SPECIAL_CHARS);
    $search = filter_var($_GET['search'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastID = filter_var($_GET['lastID'], FILTER_SANITIZE_SPECIAL_CHARS);

    $search = str_replace("+", "%", $search);

    $tableName = "video";
    //$selectQuery = "SELECT * FROM " . $tableName . " LIMIT {$limit} OFFSET {$offset}";
    if (isset($_GET['lastID'])) {
        if (isset($_GET['search'])) {
            $searching = explode('%', $search);
            if (count($searching) > 0) {
                $end = '';
                foreach ($searching as $a => $z) {
                    $end = $end . " OR v.Description LIKE '%$z%' OR t.Genre LIKE '$z'";
                }
            }
            $selectQuery = "SELECT v.VideoID, UserID, isApp, isLive, Description, URL, Thumbnail, Title FROM video as v JOIN video_tag as vt on vt.VideoID = v.VideoID join tag as t on t.TagID = vt.TagID WHERE  v.Description LIKE '%$search%' " . $end . " GROUP BY v.VideoID";
        } else {
            $selectQuery = "SELECT * FROM " . $tableName . " WHERE VideoID > " . $lastID . " ORDER BY VideoID DESC";
        }
    } else {
        if (isset($_GET['search'])) {
            //database moet correct gevuld zijn om te laten werken(tabel video_tag moet de juiste dingen bevatten)
            $searching = explode('%', $search);
            if (count($searching) > 0) {
                $end = '';
                foreach ($searching as $a => $z) {
                    $end = $end . " OR v.Description LIKE '%$z%' OR t.Genre LIKE '$z'";
                }
            }
            $selectQuery = "SELECT v.VideoID, UserID, isApp, isLive, Description, URL, Thumbnail, Title FROM video as v JOIN video_tag as vt on vt.VideoID = v.VideoID join tag as t on t.TagID = vt.TagID WHERE  v.Description LIKE '%$search%' " . $end . " GROUP BY v.VideoID";
        } else {
            $selectQuery = "SELECT * FROM " . $tableName . " ORDER BY VideoID DESC";
        }
    }

    if ($stmt = mysqli_prepare($conn, $selectQuery)) {

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error executing query";
            echo "<br /><br />--------------<br /><br />";
            die(mysqli_error($conn));
        }
    } else {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_result($stmt, $id, $userID, $isApp, $isLive, $description, $URL, $thumbnail, $title);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        while (mysqli_stmt_fetch($stmt)) {

            $selectLikes = "SELECT COUNT(UserID) FROM user_likes WHERE VideoID = " . $id;
            $selectNeutraal = "SELECT COUNT(UserID) FROM user_likes WHERE VideoID = " . $id . " AND Rating = 2";
            $selectDislikes = "SELECT COUNT(UserID) FROM user_likes WHERE VideoID = " . $id . " AND Rating = 3";

            // SELECT LIKES START
            if ($selectLikesStmt = mysqli_prepare($conn, $selectLikes)) {
                if (!mysqli_stmt_execute($selectLikesStmt)) {
                    echo "Error executing query";
                    echo "<br />";
                }
            } else {
                die(mysqli_error($conn));
            }

            mysqli_stmt_bind_result($selectLikesStmt, $likesAmount);
            mysqli_stmt_store_result($selectLikesStmt);
            mysqli_stmt_fetch($selectLikesStmt);
            // SELECT LIKES END
            // SELECT NEUTRAAL START
            if ($selectNeutraalStmt = mysqli_prepare($conn, $selectNeutraal)) {
                if (!mysqli_stmt_execute($selectNeutraalStmt)) {
                    echo "Error executing query";
                    echo "<br />";
                }
            } else {
                die(mysqli_error($conn));
            }

            mysqli_stmt_bind_result($selectNeutraalStmt, $neutraalAmount);
            mysqli_stmt_store_result($selectNeutraalStmt);
            mysqli_stmt_fetch($selectNeutraalStmt);
            // SELECT NEUTRAAL END
            // SELECT DISLIKE START
            if ($selectDislikeStmt = mysqli_prepare($conn, $selectDislikes)) {
                if (!mysqli_stmt_execute($selectDislikeStmt)) {
                    echo "Error executing query";
                    echo "<br />";
                }
            } else {
                die(mysqli_error($conn));
            }

            mysqli_stmt_bind_result($selectDislikeStmt, $dislikeAmount);
            mysqli_stmt_store_result($selectDislikeStmt);
            mysqli_stmt_fetch($selectDislikeStmt);
            // SELECT DISLIKE END

            if (mysqli_stmt_num_rows($selectLikesStmt) > 0 && mysqli_stmt_num_rows($selectNeutraalStmt) > 0 && mysqli_stmt_num_rows($selectDislikeStmt) > 0) {

                $totalRating = $likesAmount + $neutraalAmount + $dislikeAmount;
                $likes = ($likesAmount / $totalRating) * 100;
                $neutraal = ($neutraalAmount / $totalRating) * 100;
                $dislikes = ($dislikeAmount / $totalRating) * 100;
            } else {
                echo "No rows found.";
            }

            echo "
            <div class='card' style='background-image: url(assets/images/uploads/" . $thumbnail . ");' data-id='" . $id . "'>
                <div class='overlay'>";

            echo "<div class='overlayTextContainer'>
                        <h2>" . $title . "</h2>
                        <p>" . $description . "</p>
                    </div>
                    <div class='ratingContainer'>
                        ";
            if ($likes != 0 || $neutraal != 0 || $dislikes != 0) {
                echo "
                            <span class='rateLike' style='width:" . $likes . "%;'></span>
                            <span class='rateNeutral' style='width:" . $neutraal . "%;'></span>
                            <span class='rateDislike' style='width:" . $dislikes . "%;'></span>";
            }
            echo "
                        <span class='rateLike'></span>
                        <span class='rateNeutral'></span>
                        <span class='rateDislike'></span>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo 'geen resultaten.';
    }
}
?>