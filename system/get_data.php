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
    
    mysqli_stmt_num_rows($stmt, $VideoID, $UserID, $isApp, $isLive, $Description, $URL)
    mysqli_stmt_store_result($stmt);
    
    if(mysqli_stmt_num_rows($stmt) > 0)
    {
        while(mysqli_stmt_fetch($stmt))
        {
            echo ""
        }
    }
?>