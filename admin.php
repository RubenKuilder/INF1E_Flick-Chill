<?php
include ("header.php");
include ("config.php");
if (isset($_SESSION['rol'] = "3")){
    echo "<form method='post' action='admin.php'>
        <p><input type='text' name='voorgesteld'></p>
        <p><input type='text' name='goedgekeurd'></p>
        <p><input type='text' name='livestat'></p>
        <p><input type='checkbox' name='drop'></p>
    </form>";
if (isset($_POST['update'])){
    $conn = mysqli_connect("localhost", "root", "");
    if (empty($_POST['name']) || empty($_POST['vers'])|| empty($_POST['os'])|| empty($_POST['freq'])|| empty($_POST['sol'])) {
        echo "<p>You must fill in all fields before you hit the submit button.</p>";
    } else  {
            $DBName = "bugrep";
            if(!mysqli_select_db($conn, $DBName)){
                echo "There are no bug reports.";
            } else {
            $TableName = "bug";
           // $id = $_GET['id'];
            $Name = htmlentities($_POST['name']);
            $vers = htmlentities($_POST['vers']);
            $os = htmlentities($_POST['os']);
            $freq = htmlentities($_POST['freq']);
            $sol = ($_POST['sol']);
            $getid = ($_GET['id']);
            $SQLstring2 = "UPDATE $TableName SET name=?, vers=?, os=?, freq=?, sol=?  WHERE countID =?";
            //print $SQLstring2;
            if ($stmt = mysqli_prepare($conn, $SQLstring2)) {
                mysqli_stmt_bind_param($stmt, 'sssssi', $Name, $vers, $os, $freq, $sol, $getid);
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
                    header ("location:ShowBugRep.php?up=suc");
                }
//Clean up the $stmt after use
                mysqli_stmt_close($stmt);
            }
            mysqli_close($conn);
        }
    }
    }
  }
} 
if (isset($_GET['id'])){
               if (!mysqli_select_db($conn, $DBName)) {
                   echo "<p>There are no bugs reported</p>";
               } else {
                   
                   $id = $_GET['id'];
                   $SQLstring = "SELECT * FROM bug WHERE countID=?;";
                   //$stmt = mysqli_stmt_init($conn);
                       //Bind param
                       //run param inside database
                       if ($stmt = mysqli_prepare($conn, $SQLstring)) {
                           mysqli_stmt_bind_param($stmt, "i", $id);
                           mysqli_stmt_execute($stmt);
                           mysqli_stmt_bind_result($stmt, $id, $name, $vers, $os, $freq, $sold);
                           mysqli_stmt_store_result($stmt);
                   }
   
           mysqli_stmt_fetch($stmt);
           
        echo " <h2>Change your report</h2>";
         echo '  <form method="POST" action="update.php?id='.$id.'">' ;
           echo " <p>Product Name <input type='text' name='name' value='$name'></p>
               <p>Product Version <input type='text' name='vers' value='$vers'></p>
               <p>Operating System <input type='text' name='os' value='$os'></p>
               <p>Frequency Of Occurrence <input type='text' name='freq' value='$freq'></p>
               <p>Proposed solution <input type='text' name='sol' value='$sold'></p>
               <p><input type='submit' name='update' value='update'></p>
           </form>
           <p><a href='ShowBugRep.php'>Show bug reports</a></p> ";
           
           mysqli_stmt_close($stmt);
           mysqli_close($conn);
           }
       }
           }
   
   
