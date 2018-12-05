<!DOCTYPE html>
<?php 
//$configs = include('system/config.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/login.css">
    </head>
    <body>
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