<?php
require('config.php');

//echo "test";

if(isset($_GET['offset']) && isset($_GET['limit'])) {
    $limit = filter_var($_GET['limit'], FILTER_SANITIZE_SPECIAL_CHARS);
    $offset = filter_var($_GET['offset'], FILTER_SANITIZE_SPECIAL_CHARS);
    $search = filter_var($_GET['search'], FILTER_SANITIZE_SPECIAL_CHARS);
    $lastID = filter_var($_GET['lastID'], FILTER_SANITIZE_SPECIAL_CHARS);

    $search = str_replace("+", "%", $search);

    $tableName = "video";
    //$selectQuery = "SELECT * FROM " . $tableName . " LIMIT {$limit} OFFSET {$offset}";
    if(isset($_GET['lastID'])) {
        if(isset($_GET['search'])) {
            $selectQuery = "SELECT * FROM " . $tableName . " WHERE VideoID > " . $lastID . " AND Description like '%$search%' ORDER BY VideoID DESC";   
        } else {
            $selectQuery = "SELECT * FROM " . $tableName . " WHERE VideoID > " . $lastID . " ORDER BY VideoID DESC";
        }
    } else {
        if(isset($_GET['search'])) {
            $selectQuery = "SELECT * FROM " . $tableName . " WHERE Description like '%$search%' ORDER BY VideoID DESC";
        } else {
            $selectQuery = "SELECT * FROM " . $tableName . " ORDER BY VideoID DESC";
        }
    }

    if($stmt = mysqli_prepare($conn, $selectQuery)) {

        if(!mysqli_stmt_execute($stmt)) {
            echo "Error executing query";
            echo "<br /><br />--------------<br /><br />";
            die(mysqli_error($conn));
        }
    } else {
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_result($stmt, $id, $userID, $isApp, $isLive, $description, $URL, $thumbnail, $title);
    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0) {
        while(mysqli_stmt_fetch($stmt)) {
            echo "
            <div class='card' style='background-image: url(assets/images/uploads/". $thumbnail .");' data-id='" . $id . "'>
                <div class='overlay'>
                    <div class='overlayTextContainer'>
                        <h2>". $title ."</h2>
                        <p>". $description ."</p>
                    </div>
                    <div class='ratingContainer'>
                        <span class='rateLike'></span>
                        <span class='rateNeutral'></span>
                        <span class='rateDislike'></span>
                    </div>
                </div>
            </div>";
        }
    } else {
        echo "<p>
        Geen video's gevonden.
        </p>";
    }
}
?>