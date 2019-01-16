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
    
    </div>
</div>

</body>
<script type='text/javascript'>
    $(document).ready(function () {

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

        if (search == false) {
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

            $(window).scroll(function () {
                if ($(window).scrollTop() >= $(document).height() - $(window).height()) {


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

            $(window).scroll(function () {
                if ($(window).scrollTop() >= $(document).height() - $(window).height()) {


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
        
        $("#dashboardContainer").on("click", ".card", function(){
            $(".popupContent").empty();
            $.ajax(
                            {
                                url: 'ratingGet.php',
                                type: 'GET',
                                dataType: 'text',
                                data:
                                        {
                                            'dataID': $(this).data('id')
                                        },
                                success: function (response)
                                {
                                    $('.popupContent').append(response);
                                }
                            });
        });
    });
    // $(document).on('change','.card', function(){
    //    alert('OK!');
    // });
</script>
</html>
