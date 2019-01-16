// Main Javascript here
$(document).ready(function() {
    var desktopNavBtnsWidth = $('.navBtns').css('width', 'auto').width();
    var mobileNavBtnsHeight = $('.navBtnsMobile').css('height', 'auto').height();

    $('.navBtns').css('width', '0');
    $('.navBtnsMobile').css('height', '0');

    function updateDesktopNav(){
        var desktopNavFullWidth = desktopNavBtnsWidth + 600;

        if($(window).width() < desktopNavFullWidth) {
            $('.header.desktop').css('display','none');
            $('.header.mobile').css('display','block');
        } else {
            $('.header.desktop').css('display','block');
            $('.header.mobile').css('display','none');
        }
    };

    $(window).on('resize', updateDesktopNav);
    updateDesktopNav();

    $(".header.desktop .menu").click(function() {
        var curWidth = $('.navBtns').width();
        $(this).toggleClass("active");

        if($(this).closest(".header").hasClass("desktop")) {
            if(curWidth > 0) {
                $('.navBtns').width(curWidth).animate({width: 0}, 1000);
            } else {
                $('.navBtns').width(curWidth).animate({width: desktopNavBtnsWidth}, 1000);
            }
        }
    });

    $(".header.mobile .menu").click(function() {
        var curHeight = $('.navBtnsMobile').height();
        $(this).toggleClass("active");

        if($(this).closest(".header").hasClass("mobile")) {
            if(curHeight > 0) {
                $('.navBtnsMobile').height(curHeight).animate({height: 0}, 1000);
            } else {
                $('.navBtnsMobile').height(curHeight).animate({height: mobileNavBtnsHeight}, 1000);
            }
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
		$(".header li:first-child a").addClass("active");

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
    	if($(".header li:first-child a." + search) == false) {
			alert("dafuckk");
		} else {
			$(".header li a."+search).addClass("active");
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

    $(".closeLoginMessage").click(function() {
        $(".loginMessage").remove();
    });
});