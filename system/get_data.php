<?php
require('config.php');

//echo "test";

if(isset($_GET['offset']) && isset($_GET['limit'])) {
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];

    $tableName = "video";
    //$selectQuery = "SELECT * FROM " . $tableName . " LIMIT {$limit} OFFSET {$offset}";
    $selectQuery = "SELECT * FROM " . $tableName;

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
            <div class='card' style='background-image: url(assets/images/uploads/". $thumbnail .");'>
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
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "Nothing in the selected table.";
    }
}
?>