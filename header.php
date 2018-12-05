<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="assets/stylesheets/head.css">
    <head>
    <body>
    <div class="head">
        <ul>
            <li>
                <div class="menu" onclick="myFunction(this)">
                    <script>
                        function myFunction(x) {
                            x.classList.toggle("change");
                        }
                    </script>
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                </div>
            </li>
            <li>
                <img class="logo" src="assets/images/logo.png" alt='Logo'>
            </li>
            <li>
                <form  value="search" action="post">
                    <input class="searchbar" type="text" name="searchbar" placeholder="Search">
                </form>
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
   