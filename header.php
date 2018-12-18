<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/header.css">
        <script>
            function ourFunction(x) {
                x.classList.toggle("change");
            }
        </script>
        <title> Flick N Chill</title>
    </head>
    <body>
    <div class="head">
        <ul>
            <li class="left">
                <div class="menu" onclick="ourFunction(this)">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
            <li class="left">
                <div class="logo">
                    <img class="size" src="assets/images/logo.png" alt='Logo'>
                </div>
            </li>
            <li class="right">
                <div class="border">
                </div>
            </li>
            <li class="right">
                <div class="user">
                    <p>ourname<p>
                </div>
            </li>
            <li class="right">
                <div class="bar">
                    <input class="searchbar" type="text" name="searchbar" placeholder="&#9773; Zoeken...">
                </div>
            </li>

        </ul>
    </div>
