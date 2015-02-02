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
});