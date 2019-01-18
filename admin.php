<?php
session_start();
if ($_SESSION['id'] == "") {
    header('location:index.php');
    exit();
}
?>
<?php
include ("header.php");
include ("system/config.php");

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
   <p>Live status :<input type='checkbox' name='live'> Check to approve.</p>
   <p><input type='checkbox' name='drop'> Delete video</p>
   <p><input type='submit' name='update' value='update'></p>
</form><br>
<p><a href='adminoverview.php'> click here to show suggested video's</a></p>"; 
   
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
   }
}
   

if (isset($_POST['update'])){
   include ("system/config.php");
    if (empty($_POST['title']) || empty($_POST['live'])) {
        echo "<p>You must fill in all fields before you hit the submit button.</p>";
    } else  {
            $DBName = "flicknchill";
            if(!mysqli_select_db($conn, $DBName)){
                echo "connection error.";
            } else {
                if (isset($_POST['drop'])) {
            
            $getid = ($_GET['id']);
                $SQLstring = "DELETE video WHERE VideoID =?;";
                print $SQLstring;
                if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                    mysqli_stmt_bind_param($stmt, 'i', $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
            }
        }
        
           if (isset($_POST['live'])) { 
            $getid = ($_GET['id']);
            $vgst = htmlentities($_POST['title']);
            $live = "1";
           $iApp = "1";
                $SQLstring2 = "UPDATE video SET Title=?, isApp=?, isLive=? WHERE VideoID =?;";
                print $SQLstring2;
                if ($stmt = mysqli_prepare($conn, $SQLstring2)) {
                    mysqli_stmt_bind_param($stmt, 'siii', $vgst, $iApp, $live, $getid);
                    $QueryResult2 = mysqli_stmt_execute($stmt);
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

    
    

 

   
