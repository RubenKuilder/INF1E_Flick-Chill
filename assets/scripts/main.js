// Main Javascript here
$(document).ready(function() {
    var navBtnsWidth = $('.navBtns').css('width', 'auto').width();

    $('.navBtns').css('width', '0');

    function updateNav(){
        var navFullWidth = navBtnsWidth + 20 + 600;

        if($(window).width() < navFullWidth) {
            $('.header.desktop').css('display','none');
            $('.header.mobile').css('display','block');
        } else {
            $('.header.desktop').css('display','block');
            $('.header.mobile').css('display','none');
        }

        console.log(navFullWidth);
    };

    $(window).on('resize', updateNav);
    updateNav();

    $(".menu").click(function() {
        var curWidth = $('.navBtns').width();
        $(this).toggleClass("active");

        if($(this).closest(".header").hasClass("desktop")) {
            if(curWidth > 0) {
                $('.navBtns').width(curWidth).animate({width: 0}, 1000);
            } else {
                $('.navBtns').width(curWidth).animate({width: navBtnsWidth}, 1000);
            }
        } else {
            console.log("test");
        }
    });

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
		$(".navBtns li:first-child a").addClass("active");

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
    	if($(".navBtns li:first-child a." + search) == false) {
			alert("dafuckk");
		} else {
			$(".navBtns li a."+search).addClass("active");
		}

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
    }

    $("#dashboardContainer").on("click", ".card", function(){
        $(".overlayPopup").css('display','block');
    });

    $(".overlayBackground").click(function() {
        $(".overlayPopup").css('display','none');
    });
});