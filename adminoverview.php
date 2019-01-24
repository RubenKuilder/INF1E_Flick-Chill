<?php
session_start();
if ($_SESSION['id'] == "" || $_SESSION['rol'] == "1") {
    header('location:index.php');
    exit();
}
include("system/config.php");
include('header.php')
?>
  
<?php
       
        if ($_SESSION['rol'] == "2" || $_SESSION['rol'] == "3"){


            if (!mysqli_select_db($conn, $databasename)) {
                echo "<p>Uplink error, unable to connect to the database</p>";
            } else {
               
                $SQLstring = "SELECT * FROM video WHERE isLive = 0;";
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $vId, $uId, $iApp, $iLive, $desc, $url, $tumb, $title);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<center><p><br><br><br><br>There are no videos suggested</p></center>";
                    } else {
                        echo "<br><br><br><br><p><a href='dashboard.php'>Click here to go back to the dashboard</a></p><br>";
                        echo "<p>The following videos are suggested:</p>";
                        echo "<table width='100%' border='1'>";
                        echo    "<tr><th>User id</th>
                                 <th> approved </th>
                                 <th>Live </th>
                                 <th>description </th>
                                 <th>URL </th>
                                 <th>Thumbnail </th>
                                 <th>Title </th>
                                 <th>Update</th></tr>";
                        while (mysqli_stmt_fetch($stmt)) {
                            echo "<tr><td>" . $uId . "</td>";
                            echo "<td>" . $iApp . "</td>";
                            echo "<td>" . $iLive . "</td>";
                            echo "<td>" . $desc . "</td>";
                            echo "<td>" . $url . "</td>";
                            echo "<td>" . $tumb . "</td>";
                            echo "<td>" . $title . "</td>";
                            echo "<td><a href='admin.php?id=".$vId."'>Click to update.</a></td></tr>";
                        }
                        
                        
                    }
                    mysqli_stmt_close($stmt);
                    
                }else{
                    echo 'prep failed';
                }
               
            }
            mysqli_close($conn);
        } else {
            echo "you must be an admin or moderator to visit this page";
        }
        ?>
    </body>
</html>