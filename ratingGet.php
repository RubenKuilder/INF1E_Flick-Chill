<?php

require('system/config.php');
$dataID = $_GET['dataID'];
$tableName = "video";
$selectQuery = "SELECT Description, URL, Title FROM " . $tableName . " WHERE VideoID = " . $dataID;

if ($stmt = mysqli_prepare($conn, $selectQuery)) {
    session_start();
    $_SESSION["videoIdRate"] = $dataID;
    
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
        echo' <iframe width="100%" height="400px" src="' . $Url . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        //WEL DE JUISTE URL IN DATABASE HEBBEN!
        include 'Rating.php';
        echo'<h2>' . $titel . '</h2><p>' . $descr . '</p>';
    }
}
?>
