<!DOCTYPE html>
<?php
require('system/config.php');
require('header.php');

?>
    <h1 id="dashboardTitle">Dashboard</h1>
    <section id="dashboardContainer">
    </section>
    
    <div class="overlayPopup">
        <div class="overlayBackground"></div>
        <div class="popupContent">
            <div class="videoIframe">
                <img src="assets/images/emma-watson.jpg" alt="bae">
            </div>
            <div class="rating">
                <?php               require 'Rating.php';?>
            </div>
            <div class="discription">
                <h2>Sam Jackson</h2>
                <p>
                    Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it? No? Well, that's what you see at a toy store. And you must think you're in a toy store, because you're here shopping for an infant named Jeb.
                </p>
            </div>
            <div class="popupFooter">
                <a href="https://youtu.be/z-zxaKQfW6s">https://youtu.be/z-zxaKQfW6s</a>
            </div>
                
        </div>
    </div>
    
    </body>
    <script type='text/javascript'>
        $(document).ready(function() {

            // $(".card").click(function() {
            //  $(".overlayPopup").css('display', 'block');
            // });

            var flag = 0;
            var limit = 10;

            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    } else {
                        return false;
                    }
                }
            };

            var search = getUrlParameter('search');

            if(search == false) {
                $.ajax(
                {
                    url: 'system/get_data.php',
                    type: 'GET',
                    dataType: 'text',
                    data:
                    {
                        'offset': 0,
                        'limit': limit
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
                                'limit': limit,
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
            } else {
                $.ajax(
                {
                    url: 'system/get_data.php',
                    type: 'GET',
                    dataType: 'text',
                    data:
                    {
                        'offset': 0,
                        'limit': limit,
                        'search': search
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
                                'limit': limit,
                                'search': search,
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
                console.log("Load tagged cards.");
                console.log(search);
            }
        });

        // $(document).on('change','.card', function(){
        //    alert('OK!');
        // });
    </script>
</html>
