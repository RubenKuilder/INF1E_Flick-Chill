<?php
//session_start();

/*if ($_SESSION['id'] != "") {
    header('location:test.php');
    exit();
}

require('system/config.php');*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
    </head>
    <body id="loginPage">
        <?php
        echo "<div style='background-color:white; padding:10px; position:absolute; top: 0; left: 0; z-index:999999;'>";
          echo "ID-: " . $_SESSION['id'];
        echo "</div>";
        ?>
        <div id="loginWrapper">
            <div id="loginLogo">
                <img src="assets/images/logo.png" alt="logo">
            </div>
            <div id="loginForm">
                <p>
                    Log hier in met je schoolgegevens:
                </p>
                <form action="system/login.php" method="post">
                    <input type="email" name="email" placeholder="Email..."><br/>
                    <input type="password" name="password" placeholder="Password..."><br/>
                    <input type="submit" name="submit" value="LOG IN">
                </form>
            </div>
        </div>
    </body>
</html>
