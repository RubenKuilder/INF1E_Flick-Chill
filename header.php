<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="height=device-height, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
        <script> //hamburger menu script
            function ourFunction(x) {
                x.classList.toggle("change");
            }
        </script>
        <title> Flick N Chill</title>
    </head>
    <body>
    <!--begin body-->
        <div class="header">
            <!--begin header-->
            <ul>
                <li>
                    <div class="menu" onclick="ourFunction(this)">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                </li>
                <li>
                    <div class="logo">
                        <img class="size" src="assets/images/logo_header.png" alt='Logo'>
                    </div>
                </li>
                <li>
                    <div class="user">
                        <p>Naam gebruiker<p>
                    </div>
                </li>
                <li>
                    <div class="border">
                    </div>
                </li>
                <li>
                    <div class="bar">
                    <form action="system/search.php" method="post">
                        <input class="searchbar" type="text" name="searchbar" placeholder="&#x1F50E; &nbsp;Zoeken...">
                        <input type="submit" name="submit" value="search">
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!--eind header-->