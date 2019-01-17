<html>
    <head>
        <meta charset="UTF-8">
        <title>Bug Report</title>
    </head>
    <body>

        <?php
       include ("header.php");
       include ("system/config.php");
       // if (isset($_SESSION['rol'] = "2" Or "3")){


            if (!mysqli_select_db($conn, "flicknchill")) {
                echo "<p>There are no bugs reported</p>";
            } else {
               
                $SQLstring = "SELECT * FROM video WHERE isLive = 0;";
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $vId, $uId, $iApp, $iLive, $desc, $url, $tumb, $title);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<p>There are no videos suggested</p>";
                    } else {
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
                    echo "<p><a href='dashboard.php'>Click here to go back to the home page</a></p>";
                }else{
                    echo 'prep failed';
                }
               
            }
            mysqli_close($conn);
      //  }
        ?>
    </body>
</html>