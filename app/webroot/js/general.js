/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Gestion générale du site
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */

$(document).ready(function() {
    // champs qui peuvent s'agrandir et se réduire
    $('#normal').hide();

    $('#small').click(function() {
        $('#small').hide();
        $('#normal').show();
    });
    $('#reduire').click(function() {
        $('#normal').hide();
        $('#small').show();
    });

    $('#normal2').hide(); // 2e champ au cas où on en ai deux sur une même page

    $('#small2').click(function() {
        $('#small2').hide();
        $('#normal2').show();
    });
    $('#reduire2').click(function() {
        $('#normal2').hide();
        $('#small2').show();
    });


    // gérer l'onglet actif, pour le mettre dans la bonne couleur dans le bandeau
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