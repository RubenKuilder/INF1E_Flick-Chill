<!DOCTYPE html>
<?php
require('system/confiq.php');
//require('system/confiq.php');


?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>FlickAndChill</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/dashboard.css">
        <script type='text/javascript' src='system/get_data.php'></script>
        <script type='text/javascript'>
            $(document).ready(function()
            {
                $.ajax(
                {
                    url:'get_data.php',
                    data:
                    {
                        'offset': 0,
                        'limit': 10
                    },
                });              
            }):
        </script>
    </head>
    <body>
    <h1 id="dashboardTitle">Dashboard</h1>
    <section id="dashboardContainer">
        <div class="card" style="background-image: url(https://media.allure.com/photos/59dd28498ba03d6a578a1cd0/16:9/w_1280/emma%2520watson.jpg);">
            <div class="overlay">
                <div class="overlayTextContainer">
                    <h2>Overlay title</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="ratingContainer">
                    <span class="rateLike"></span>
                    <span class="rateNeutral"></span>
                    <span class="rateDislike"></span>
                </div>
            </div>
        </div>
    </section>


<!--         <div class="flex-container" data-infinite-scroll='{ "path": ".pagination__next", "append": ".post", "history": false }'>
            <div class="iframeID">
                <img src="assets/images/emma-watson.jpg">
                <div class="overlay">
                    <div class="text-content">
                        <h2>Titel</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut...</p>
                    </div>
                    <div class="rating">
                        <div class="green">
                        </div>
                        <div class="white">
                        </div>
                        <div class="red">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </body>
</html>
