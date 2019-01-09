<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title> Flick N Chill</title>
        <link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
        <script type='text/javascript' src='assets/scripts/jquery.js'></script>
        <script> //hamburger menu script
            function ourFunction(x) {
                x.classList.toggle("change");
            }
        </script>
    </head>
    <body>
    <!--begin body-->
        <div class="header">
            <!--begin header-->
            <ul>
                <div class="navLeft">
                    <li class="menu" onclick="ourFunction(this)">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </li>
                    <div class="navBtns">
                        <li><a href="dashboard.php" class="active">Home</a></li>
                        <li><a href="?search=test">Test</a></li>
                        <li><a href="?search=free">Free</a></li>
                        <li><a href="?search=tech">Tech</a></li>
                    </div>
                    <img class="logo" src="assets/images/logo_header.png" alt='Logo'>
                </div>
                <div class="navRight">
                    <form action="dashboard.php" method="get">
                        <input class="searchbar" type="text" name="search" placeholder="Search...">
                        <input type="submit" name="submit" value="search">
                    </form>
                    <div class="border"></div>
                    <li class="user">
                        <?php
                            echo $_SESSION['name'];
                        ?>
                    </li>
                </div>
            </ul>
        </div>
        <!--eind header-->