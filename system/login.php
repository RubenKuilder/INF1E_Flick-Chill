<?php
session_start();
header( "refresh:5;url=../test.php" );

require('config.php');

//SQL statement decleration

$postEmail = $_POST['email'];
$postPass = $_POST['password'];
$sql = "SELECT * FROM account WHERE email = ?";
//$sql = "SELECT * FROM account WHERE email = ?";

if ($stmt = mysqli_prepare($conn, $sql)) {
	mysqli_stmt_bind_param($stmt, 's', $postEmail);
	//mysqli_stmt_bind_param($stmt, 's', $postEmail);

	if (mysqli_stmt_execute($stmt)) {
		//echo "Query executed";
	} else {
		echo "Error executing query";
		echo "<br /><br />--------------<br /><br />";
		die(mysqli_error($conn));
	}
} else {
	die(mysqli_error($conn));
}

mysqli_stmt_bind_result($stmt, $id, $rol, $fname, $lname, $email, $ww);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
	while (mysqli_stmt_fetch($stmt)) {
		if(password_verify($postPass, $ww)) {
		    $_SESSION['id'] = $id;
		    $_SESSION['email'] = $email;
		    $_SESSION['name'] = $fname . " " . $lname;
		    echo "Welcome " . $_SESSION['name'] . ", you'll be redirected in 5 seconds.";
		} else {
			echo "Login error.";
			echo $hashed;
		}
	}
}

/*
if (mysqli_stmt_num_rows($stmt) > 0) {
	while (mysqli_stmt_fetch($stmt)) {
		if (CRYPT_BLOWFISH == 1) {
            if($ww == crypt($postPass,'$2a$09$'.$pc.'$')) {

			    $_SESSION['id'] = $id;
			    $_SESSION['email'] = $email;
			    $_SESSION['name'] = $fname . " " . $lname;
			    echo "Welcome " . $_SESSION['name'] . ", you'll be redirected in 5 seconds.";

            } else {
                echo 'error';
            }
        }
	}
} else {
	echo "<pre>";
		print_r($stmt);
	echo "</pre>";
	echo "<br />";
	echo $fname;
	echo "<br />";
	echo $ww;
	echo "<br />";
	echo $pc;
	echo "<br />";
	echo "No entries found.";
}
*/

mysqli_stmt_close($stmt);

mysqli_close($conn);
?>