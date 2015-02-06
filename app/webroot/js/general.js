// champs qui peuvent s'agrandir et se réduire
$(document).ready(function() {
    $('#normal').hide();

    $('#small').click(function() {
        $('#small').hide();
        $('#normal').show();
    });
    $('#reduire').click(function() {
        $('#normal').hide();
        $('#small').show();
    });

    $('#normal2').hide();

    $('#small2').click(function() {
        $('#small2').hide();
        $('#normal2').show();
    });
    $('#reduire2').click(function() {
        $('#normal2').hide();
        $('#small2').show();
    });

    var pathname = window.location.pathname;

    if (pathname == "/") {
        // idees
        $("#voyage_main").removeClass("active");
        $("#idee_main").removeClass("active");
        $("#user_main").removeClass("active");
    }
    else if (pathname.substring(0, 13) == "/pages/idees") {
        // idees
        $("#voyage_main").removeClass("active");
        $("#idee_main").addClass("active");
        $("#user_main").removeClass("active");
    } 
    else if (pathname.substring(0, 6) == "/users") {
        // compte
        $("#voyage_main").removeClass("active");
        $("#idee_main").removeClass("active");
        $("#user_main").addClass("active");
    } 
    else {
        // voyage
        $("#voyage_main").addClass("active");
        $("#idee_main").removeClass("active");
        $("#user_main").removeClass("active");
    }
});