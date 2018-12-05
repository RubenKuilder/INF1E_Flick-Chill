<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/head.css">
        <script>
            function myFunction(x) {
                x.classList.toggle("change");
            }
        </script>
    </head>
    <body>
    <div class="head">
        <ul>
            <li>
                <div class="menu" onclick="myFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
            <li>
                <div class="logo">
                    <img class="size" src="assets/images/logo.png" alt='Logo'>
                </div>
            </li>
            <li>
                    <input class="searchbar" type="text" name="searchbar" placeholder="&#9773; Search...">
            </li>
            <li>
                <div class="border">
                </div>
            </li>
            <li>
                <div class="user">
                    <p>username<p>
                </div>
            </li>
        </ul>
    </div>
   