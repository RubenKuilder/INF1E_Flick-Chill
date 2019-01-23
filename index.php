<?php
session_start();

if ($_SESSION['id'] != "") {
    header('location:dashboard.php');
    exit();
}

require('system/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title> Flick N Chill</title>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
        <script type='text/javascript' src='assets/scripts/jquery.js'></script>
        <script type='text/javascript' src='assets/scripts/main.js'></script>
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#46435b">
		<meta name="theme-color" content="#ffffff">
		<link rel='shortcut icon' href='favicon.ico' type='image/x-icon' />
    </head>
    <body id="loginPage">
        <?php
        $postEmail = $_POST['email'];
        $postPass = $_POST['password'];
        $sql = "SELECT * FROM user WHERE email = ?";
        //$sql = "SELECT * FROM account WHERE email = ?";

        if(isset($_POST['submit'])) {
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

            mysqli_stmt_bind_result($stmt, $id, $vnaam, $anaam, $email, $ww, $rol);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                while (mysqli_stmt_fetch($stmt)) {
                    if(password_verify($postPass, $ww)) {
                        ?>
                        <script type="text/javascript">
                        window.location.href = "dashboard.php";
                        </script>
                        <?php
                        $_SESSION['id'] = $id;
                        $_SESSION['email'] = $email;
                        $_SESSION['name'] = $vnaam . " " . $anaam;
                        $_SESSION['rol'] = $rol;
                        echo "<div class='loginMessage'>
                                Welcome " . $_SESSION['name'] . ", it looks like you're having trouble getting onto the dashboard. Try clicking <a href='dashboard.php'>here</a> to visit it.
                            </div>";
                    } else {
                        echo "<div class='loginMessage'>
                                Something went wrong. Are you sure you used the right password?
                                <span class='closeLoginMessage'>Close</span>
                            </div>";
                    }
                }
            } else {
                echo "<div class='loginMessage'>
                    Something went wrong. Please try again.
                    <span class='closeLoginMessage'>Close</span>
                </div>";
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
        <div id="loginWrapper">
            <div id="loginLogo">
                <img src="assets/images/logo.png" alt="logo">
            </div>
            <div id="loginForm">
                <p>
                    Log here in with your school data:
                </p>
                <form action="index.php" method="post">
                    <input type="email" name="email" placeholder="Email..."><br/>
                    <input type="password" name="password" placeholder="Password..."><br/>
                    <input type="submit" name="submit" value="LOG IN">
                </form>
            </div>
        </div>
    </body>
</html>
