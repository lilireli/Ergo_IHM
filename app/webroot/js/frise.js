// champs qui peuvent s'agrandir et se réduire
$(document).ready(function() {
    var days = document.getElementById("nombre_days").innerHTML; 
    var date_start = new Date(document.getElementById("date_debut").innerHTML*1000); 
    var text = '';
    var months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", 
        "Août", "Septembre", "Octobre", "Novembre", "Décembre"]

    var width_day = 110;

    var current_date = date_start;

    for (var i = 0; i <= days; i++) {
        var jour=current_date.getDate();
        var mois=months[current_date.getMonth()];

        text = text + 
            '<div class="days" style="left:'+width_day*i+'px; width:'+width_day+'px;">' +
                jour + '<br>' + mois +
            '</div>'

        tomorrow = new Date();
        tomorrow.setDate(current_date.getDate()+1);
        current_date = tomorrow;
    };

    $('#frise_voyage').append(text);
});