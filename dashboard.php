<!DOCTYPE html>
<?php
//require('system/confiq.php');
//require('system/header.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>FlickAndChill</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/dashboard.css">
        <script>
        function loadResults() {
            var result = "";
            for (var i = 0; i < 10; i++) {
                result += "<div class="flex-container" data-infinite-scroll='{ "path": ".pagination__next", "append": ".post", "history": false }'>
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
        </div>";
            }
            $.ajax({
                url: "/echo/html/",
                type: "post",
                data: {
                    html: result,
                    delay: 3
                },
                beforeSend: function(xhr) {
                    $("#results").after($("<li class='loading'>Loading...</li>").fadeIn('slow')).data("loading", true);
                },
                success: function(data) {
                    var $results = $("#results");
                    $(".loading").fadeOut('fast', function() {
                        $(this).remove();
                    });
                    var $data = $(data);
                    $data.hide();
                    $results.append($data);
                    $data.fadeIn();
                    $results.removeData("loading");
                }
            });
        };
        $(function() {
            loadResults();

            $(".scrollpane").scroll(function() {
                var $this = $(this);
                var $results = $("#results");

                if (!$results.data("loading")) {

                    if ($this.scrollTop() + $this.height() == $results.height()) {
                        loadResults();
                    }
                }
            });
        });
        </script>
    </head>
    <body>
        <div class="flex-container" data-infinite-scroll='{ "path": ".pagination__next", "append": ".post", "history": false }'>
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
        </div>
    </body>
</html>