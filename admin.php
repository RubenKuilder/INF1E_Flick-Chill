<?php
include ("header.php");
include ("system/config.php");
//if (isset($_SESSION['rol'] = "3")){

if (isset($_POST['update'])){
    $conn = mysqli_connect("localhost", "root", "");
    if (empty($_POST['voorgesteld']) || empty($_POST['livestat'])) {
        echo "<p>You must fill in all fields before you hit the submit button.</p>";
    } else  {
            $DBName = "flicknchill";
            if(!mysqli_select_db($conn, $DBName)){
                echo "There are no video's waiting.";
            } else {
            $TableName = "video";
           // $id = $_GET['id'];
            $vgst = htmlentities($_POST['voorgesteld']);
           
            $live = htmlentities($_POST['livestat']);
           
           
            $getid = ($_GET['id']);
            $SQLstring2 = "UPDATE $TableName SET voorgesteld=?, goedgekeurd=?, livestat=? WHERE videoID =?";
            //print $SQLstring2;
            if ($stmt = mysqli_prepare($conn, $SQLstring2)) {
                mysqli_stmt_bind_param($stmt, 'sssi', $vgst, $live, $live, $getid);
                $QueryResult2 = mysqli_stmt_execute($stmt);
                if ($QueryResult2 === FALSE) {
                    echo "<p>Unable to execute the query.</p>1"
                    . "<p>Error code "
                    . mysqli_errno($conn)
                    . ": "
                    . mysqli_error($conn)
                    . "</p>";
                } else {
                   // echo "<h1>Update is succesfull.</h1>";
                    header ("location:adminoverview.php?up=suc");
                }
//Clean up the $stmt after use
                mysqli_stmt_close($stmt);
            }
            mysqli_close($conn);
        }
    }
    }
 // }
 
if (isset($_GET['id'])){
               if (!mysqli_select_db($conn, "flicknchill")) {
                   echo "<p>There are no video's to view</p>";
               } else {
                   
                   $id = $_GET['id'];
                   $SQLstring = "SELECT * FROM video WHERE VideoID=?;";
                   //$stmt = mysqli_stmt_init($conn);
                       //Bind param
                       //run param inside database
                       if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                           mysqli_stmt_bind_param($stmt, "i", $id);
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt, $vId, $uId, $iApp, $iLive, $desc, $url, $tumb, $title);
                           mysqli_stmt_store_result($stmt);
                   }
   
           mysqli_stmt_fetch($stmt);
           
        echo " <h2>Change the video status</h2>

           </form>
            <form method='post' action='admin.php?id='.$vId.'>
           <p><input type='text' name='voorgesteld' value='$title'></p>
           
           <p><input type='number' name='livestat' value='$iLive'></p>
           <p><input type='radio' name='stat value='app' checked='check'> Approve video</p>
           <p><input type='radio' name='stat' value='drop'> Remove video</p>
           <p><input type='submit' name='update' value='update'></p>
       </form><br>
       <p><a href='adminoverview.php'> click here to show submitted video's</a></p>"; 
           
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
           }
       }
           
   
   
