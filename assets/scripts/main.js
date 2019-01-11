// Main Javascript here
$(document).ready(function() {
    $("#dashboardContainer").on("click", ".card", function(){
        $(".overlayPopup").css('display','block');
    });

    $(".overlayBackground").click(function() {
        $(".overlayPopup").css('display','none');
    });
});