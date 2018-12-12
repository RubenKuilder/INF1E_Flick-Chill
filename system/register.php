<?php
session_start();

if ($_SESSION['id'] != "") {
    header('location:test.php');
    exit();
}

require('config.php');

$postFname = $_POST['fname'];
$postLname = $_POST['lname'];
$postEmail = $_POST['email'];
$postPass = $_POST['pass'];

if (CRYPT_BLOWFISH == 1){
    $items = array('A','b','1','24','3','Y','j');
    $salt = '';
    for($i = 0; $i < 30; $i++){
        $random = rand(0, sizeof($items));
        $salt = $salt.$items[$random];
    }
    //                echo "salt:".$salt;
    $hash = crypt($_POST['pass'],'$2a$09$'.$salt.'$');
    //                echo "Blowfish: ".$hash."\n<br>";
} else{
    //echo "Blowfish DES not supported.\n<br>";
    echo 'blowfishError';
}

//-----------------------------
// Step #3: Create the query
$emailCheck = "SELECT * FROM account WHERE email = ?";

// Step #4.1: Prepare query as a statement
if($statement = mysqli_prepare($conn, $emailCheck))
{
    // Step #4.2: Fill in the ? parameters!
    mysqli_stmt_bind_param($statement, 's', $postEmail);

    //Step #5: Execute statement and check success
    if(mysqli_stmt_execute($statement)) {
        echo "Query executed";
    }
    else {
        echo "Error executing query";
        die(mysqli_error($conn));
    }
    echo"<br><br>--------------<br><br>";
}
else{
    die(mysqli_error($conn));
}

// Step #6.1: Bind result to variables when fetching...
mysqli_stmt_bind_result($statement, $postEmail);
// Step #6.2: And buffer the result if you want to display the data
mysqli_stmt_store_result($statement);

// Step #7: Check if there are results in the statement
if(mysqli_stmt_num_rows($statement) > 0)
{
    echo 'A user with the same email already exists.';
}
else {
    $sql = "INSERT INTO account (firstname, lastname, email, password, pass_crypt) VALUES (?, ?, ?, ?, ?)";

	if ($stmt = mysqli_prepare($conn, $sql)) {
		mysqli_stmt_bind_param($stmt, 'sssss', $postFname, $postLname, $postEmail, $hash, $salt);

		if (mysqli_stmt_execute($stmt)) {
			echo "Query executed";
		} else {
			echo "Error executing query";
			echo "<br /><br />--------------<br /><br />";
			die(mysqli_error($conn));
		}
	} else {
		die(mysqli_error($conn));
	}
}

//----------------------------
?>