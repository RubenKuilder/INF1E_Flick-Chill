<?php
include ("header.php");
include ("system/config.php");
//if (isset($_SESSION['rol'] = "3")){

if (isset($_POST['update'])){
   
    if (empty($_POST['title']) || empty($_POST['live'])) {
        echo "<p>You must fill in all fields before you hit the submit button.</p>";
    } else  {
            $DBName = "flicknchill";
            if(!mysqli_select_db($conn, $DBName)){
                echo "connection error.";
            } else {
            $vgst = htmlentities($_POST['voorgesteld']);
            $live = htmlentities($_POST['livestat']);
           $iApp = $live;
            $getid = ($_GET['id']);
            if (isset($_POST['stat'])) {
                $SQLstring = "DELETE video WHERE videoID =?;";
                print $SQLstring;
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    mysqli_stmt_bind_param($stmt, 'i', $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
            }
           
        
            else 
            { 
                $SQLstring2 = "UPDATE video SET Title=?, isApp=?, isLive=? WHERE videoID =?;";
                print $SQLstring2;
                if ($stmt = mysqli_prepare($conn, $SQLstring2)) {
                    mysqli_stmt_bind_param($stmt, 'sssi', $vgst, $iApp, $live, $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
                }  
        }
                if ($QueryResult2 === FALSE) {
                    echo "<p>Unable to execute the query.</p>1"
                    . "<p>Error code "
                    . mysqli_errno($conn)
                    . ": "
                    . mysqli_error($conn)
                    . "</p>";
                } 
//Clean up the $stmt after use

            }

        }
    }
}

    
    
 // }
 
if (isset($_GET['id'])){
                $DBName = "flicknchill";
               if (!mysqli_select_db($conn, $DBName)) {
                   echo "<p>There are no video's to view</p>";
               } else {
                   
                   $id = $_GET['id'];
                   $SQLstring = "SELECT * FROM video WHERE VideoID=?;";
                       //Bind param
                       //run param inside database
                       if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                           mysqli_stmt_bind_param($stmt, "i", $id);
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt, $vId, $uId, $iApp, $iLive, $desc, $url, $tumb, $title);
                           mysqli_stmt_store_result($stmt);
                   }
   
           mysqli_stmt_fetch($stmt);
        echo " <h2>Change the video status</h2>";
        echo "The video description is: " . $desc;

           echo "</form>
            <form method='post' action='admin.php?id='$vId'>
           <p>Title: <input type='text' name='title' value='$title'></p>
           
           <p>Live status :<input type='number' name='live' value='$iLive'> 0 = offline and 1 = online</p>
           <p><input type='checkbox' name='drop'> Delete video</p>
           <p><input type='submit' name='update' value='update'></p>
       </form><br>
       <p><a href='adminoverview.php'> click here to show submitted video's</a></p>"; 
           
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
           }
       }
           
   
   
