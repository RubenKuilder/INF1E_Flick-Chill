<?php
session_start();
if ($_SESSION['id'] == "" || $_SESSION['id'] == "1") {
    header('location:index.php');
    exit();
}

include ("header.php");
include ("system/config.php");

    if (isset($_GET['id'])){
        $DBName = "flicknchill";
       if (!mysqli_select_db($conn, $DBName)) {
           echo "<p>There are no video's to view</p>";
       } else {
           
           $vId = $_GET['id'];
           $SQLstring = "SELECT * FROM video WHERE VideoID=?;";
               //Bind param
               //run param inside database
               if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                   mysqli_stmt_bind_param($stmt, "i", $vId);
                   mysqli_stmt_execute($stmt);
                   mysqli_stmt_bind_result($stmt, $id, $uId, $iApp, $iLive, $desc, $url, $tumb, $title);
                   mysqli_stmt_store_result($stmt);
           }

   mysqli_stmt_fetch($stmt);
echo " <h2>Change the video status</h2>";


   echo "</form>
    <form method='post' action='admin.php?id=$id'>
   <p>Title: <input type='text' name='title' value='$title'><br><br></p>
   <p>The video description is: <br><textarea name='desc'> ". $desc ." </textarea><br></p>
   <p>PlaybackId: <input type='text' name='play' value='$url'><br><br></p>
   <p><input type='radio' name='drop' value='A' checked='check'> Check to approve and set live.</p>
   <p><input type='radio' name='drop' value='D'> Delete video</p>
   <p><input type='submit' name='update' value='update'></p>
</form><br>
<p><a href='adminoverview.php'> click here to show suggested video's</a></p>"; 
   
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
   }
}
   

if (isset($_POST['update'])){

    if (empty($_POST['title']) || empty($_POST['desc']) || empty($_POST['play'])) {
        echo "<p>You must fill in all fields before you hit the submit button.</p>";
    } else  {


                if ($_POST['drop'] == "D") {
                    $conn = mysqli_connect("localhost", "root", "");
                    $DBName = "flicknchill";
                    if(!mysqli_select_db($conn, $DBName)){
                        echo "connection error.";
                    }
            
            $getid = ($_GET['id']);
         
                $SQLstring = "DELETE video WHERE VideoID ='?';";
                print $SQLstring;
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    mysqli_stmt_bind_param($stmt, 'i', $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
                    if ($QueryResult2 === FALSE) {
                        echo "<p>Unable to execute the query.</p>1"
                        . "<p>Error code "
                        . mysqli_errno($conn)
                        . ": "
                        . mysqli_error($conn)
                        . "</p>";
                    } 
            }
        }
         else { 
            $conn = mysqli_connect("localhost", "root", "");
            $DBName = "flicknchill";
            if(!mysqli_select_db($conn, $DBName)){
                echo "connection error.";
            } 
            $getid = ($_GET['id']);
            $vgst = htmlentities($_POST['title']);
            $descript = htmlentities($_POST['desc']);
            $live = "1";
           $iApp = "1";
           $play = htmlentities($_POST['play']);
                $SQLstring2 = "UPDATE video SET isApp='?', isLive='?', Description='?', URL='?', Title='?' WHERE VideoID ='?';";
                print $SQLstring2;
                if ($stmt = mysqli_prepare($conn, $SQLstring2)) {
                    mysqli_stmt_bind_param($stmt, 'iisssi', $iApp, $live, $descript, $play, $vgst, $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);  
            
        
                if ($QueryResult2 === FALSE) {
                    echo "<p>Unable to execute the query.</p>1"
                    . "<p>Error code "
                    . mysqli_errno($conn)
                    . ": "
                    . mysqli_error($conn)
                    . "</p>";
                }
            } 
//Clean up the $stmt after use

            }

        }
    }


    
    

 

   
