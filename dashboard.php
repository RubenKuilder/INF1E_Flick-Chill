<!DOCTYPE html>
<?php
require('system/config.php');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>FlickAndChill</title>
        <link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css">
        <script type='text/javascript' src='assets/scripts/jquery.js'></script>
        <script type='text/javascript'>
            $(document).ready(function() {


                var flag = 0;
                var limit = 10;

                $.ajax(
                {
                    url: 'system/get_data.php',
                    type: 'GET',
                    dataType: 'text',
                    data:
                    {
                        'offset': 0,
                        'limit': 10
                    },
                    success: function (response)
                    {
                        $('#dashboardContainer').append(response);
                        flag += 10;
                    }
                });
                
                $(window).scroll(function() {
                    if($(window).scrollTop() >= $(document).height() - $(window).height()) {


                        $.ajax(
                        {
                            url: 'system/get_data.php',
                            type: 'GET',
                            dataType: 'text',
                            data:
                            {
                                'offset': 0,
                                'limit': 10,
                                'lastID': $('#dashboardContainer .card').last().data('id')
                            },
                            success: function (response)
                            {
                                $('#dashboardContainer').append(response);
                                flag += 10;
                            }
                        });
                    }
                });

            });
        </script>
    </head>
    <body>
    <h1 id="dashboardTitle">Dashboard</h1>
    <section id="dashboardContainer">
    </section>
    </body>
</html>
