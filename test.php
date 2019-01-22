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
		<title>test</title>
	</head>
	<body>
		<?php
		echo "<div style='background-color:white;padding:10px;'>";
		echo "ID-: " . $_SESSION['id'];
		echo "</div>";

		echo "<h2>Logged in as:</h2>";
		echo $_SESSION['name'];
		echo "<br />";
		echo "rol is: " . $_SESSION['rol'];
		?>
		<a href="system/logout.php">Log-out</a>
	</body>
</html>