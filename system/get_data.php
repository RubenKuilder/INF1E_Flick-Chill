<?php
    $limit = $_GET['limit'];
    $offset = $_GET['offset'];

    $tableName = 'video';
    $selectQuery = "SELECT * FROM " . $tableName;
    if($stmt = mysqli_prepare($conn, $selectQuery))
    {
        if(!mysqli_execute($stmt))
        {
            echo "Error executing query";
            die(mysqli_error($conn));
        }
        else
        {
            die(mysqli_error($conn));
        }
    }
    
    mysqli_stmt_num_rows($stmt, $VideoID, $UserID, $isApp, $isLive, $Description, $URL, $Thumbnail $Title)
    mysqli_stmt_store_result($stmt);
    
    if(mysqli_stmt_num_rows($stmt) > 0)
    {
        while(mysqli_stmt_fetch($stmt))
        {
            echo "
            <div class='card' style='background-image: url(../assets/images/uploads/". $Thumbnail .");'>
                <div class='overlay'>
                    <div class='overlayTextContainer'>
                        <h2>". $Title ."</h2>
                        <p>". $Description ."</p>
                    </div>
                    <div class='ratingContainer'>
                        <span class='rateLike'></span>
                        <span class='rateNeutral'></span>
                        <span class='rateDislike'></span>
                    </div>
                </div>
            </div>";
        }
    }
?>