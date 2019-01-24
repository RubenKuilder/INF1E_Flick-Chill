<!DOCTYPE html>
<html lang="en">
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
    <body>
    <!--begin body-->
        <div class="header desktop">
            <!--begin header-->
            <ul>
                <div class="navLeft">
                    <li class="menu desktop">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </li>
                    <div class="navBtns">
                    <li><a href="dashboard.php">Home</a></li>
                        <li><a href="?search=vlog" class="vlog">Vlog</a></li>
                        <li><a href="?search=review" class="review">Review</a></li>
                        <li><a href="?search=tech" class="tech">Tech</a></li>
                        <li><a href="?search=unboxing" class="unboxing">Unboxing</a></li>
                        <li><a href="?search=tutorial" class="tutorial">Tutorial</a></li>
                        <li><a href="?search=news" class="news">News</a></li>
                    </div>
                    <img class="logo" src="assets/images/logo_header.png" alt='Logo'>
                </div>
                <div class="navRight">
                    <form action="dashboard.php" method="get" >
                        <input class="searchbar" type="text" name="search" placeholder="Search...">
                        <input type="submit" name="submit" value="search" class="search">
                    </form>
                    <div class="border"></div>
                    <li class="user dropdown">
                        <?php
                            echo $_SESSION['name'];
                        ?>
                        <?php 
                        if($_SESSION['rol'] > 1){
                            echo ' <div class="dropcontent">
                                        <div class="droptop">
                                        </div>
                                        <p class="dropalign">
                                            <a class="dropbutton" href="suggestiesv3.php">Suggestions</a>
                                        </p>
                                        <div class="droplist">
                                        </div>
                                        <p class="dropalign">
                                            <a class="dropbutton" href="adminoverview.php">Admin</a>
                                        </p>
                                        <div class="droplist">
                                        </div>
                                        <p class="dropalign">
                                            <a class="dropbutton" href="system/logout.php">Log Out</a>
                                        </p>
                                        <div class="dropbottom">
                                        </div>
                                    </div>';
                        } else {
                            echo ' <div class="dropcontent">
                                        <div class="droptop">
                                        </div>
                                        <p class="dropalign">
                                            <a class="dropbutton" href="suggestiesv3.php">Suggestions</a>
                                        </p>
                                        <div class="droplist">
                                        </div>
                                        <p class="dropalign">
                                            <a class="dropbutton" href="system/logout.php">Log Out</a>
                                        </p>
                                        <div class="dropbottom">
                                        </div>
                                    </div>';
                        }
                        ?>
            </ul>

                </div>
            </ul>
        </div>
        <!--eind header-->


        <div class="header mobile">
            <nav>
                <div class="menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <div class="navBtnsMobile">
                    <ul>
                        <li><a href="dashboard.php">Home</a></li>
                        <li><a href="?search=vlog" class="vlog">Vlog</a></li>
                        <li><a href="?search=review" class="review">Review</a></li>
                        <li><a href="?search=tech" class="tech">Tech</a></li>
                        <li><a href="?search=unboxing" class="unboxing">Unboxing</a></li>
                        <li><a href="?search=tutorial" class="tutorial">Tutorial</a></li>
                        <li><a href="?search=news" class="news">News</a></li>
                        <li><a href="suggestiesv3.php" class="sugesstions">Sugesstions</a></li>
                        <?php
                        if($_SESSION['rol'] > 1){
                            echo '<li><a class="admin" href="adminoverview.php">Admin Page</a></li>';
                        }
                        ?>
                        <li><a class="logout" href="system/logout.php">Log Out</a></li>
                    </ul>
                    <form action="dashboard.php" method="get">
                        <input class="searchbar" type="text" name="search" placeholder="Search...">
                        <input type="submit" name="submit" value="search">
                    </form>
                </div>
            </nav>
        </div>