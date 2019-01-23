<?php
session_start();

if ($_SESSION['id'] == "") {
    header('location:index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Create account</title>
	</head>
	<body>
	    <form action="system/register.php" method="post">
	        <input type="text" name="fname" placeholder="First name" required>
	        <input type="text" name="lname" placeholder="Last name" required>
	        <input type="email" name="email" placeholder="Email" required>
	        <input class="pass" type="password" name="pass" placeholder="Password" required>
	        <input type="text" name="rol" placeholder="Rol" required>
	        <input type="submit" value="Create account">
	    </form>
    </body>
</html>