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
});