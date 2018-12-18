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

$hashed = password_hash($postPass, PASSWORD_DEFAULT);

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

echo $hashed;

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
    $sql = "INSERT INTO account (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";

	if ($stmt = mysqli_prepare($conn, $sql)) {
		mysqli_stmt_bind_param($stmt, 'ssss', $postFname, $postLname, $postEmail, $hashed);

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