$(document).ready(function(){
	document.getElementById('participants').value= "";

	var myselect = document.getElementById("participants"); //select the name already entered 
	var name = myselect.value;

	var voyage = document.getElementById("voyage_id");
	var voyage_id = voyage.value;
	
	$("#participants").autocomplete({
	    source: "/users/autoComplete/?voyage="+voyage_id + name, // appeler le fichier php qui nous renverra les noms possibles
	    minLength: 2, //This is the min ammount of chars before autocomplete kicks in
	    
	    // when field is selected keep the user, create the id
        select: function(event, ui) {            
	        //create formatted friend
	        var trotteur = ui.item.value;
	        var trotteur_id = ui.item.id;

	        var text = 
	        	"<div class='field_participants' id='participant"+trotteur_id+"'>" +  
					"<div class='float'>"+ trotteur +
						"<input type='hidden' value='"+trotteur_id+"' name='data[User]["+trotteur+"]' checked>" +
					"</div>" +
					"<div class='float right' id='x_participant"+trotteur_id+"'>x</div>" +
				"</div>";
	                      
            $('#trotteurs').prepend(text);

            $('#x_participant'+trotteur_id).click(function(){
				$('#participant'+trotteur_id).remove();
			})
        },
                     
    	html: true,  // optional (jquery.ui.autocomplete.html.js required)

    	// optional (if other layers overlap autocomplete list)
    	open: function(event, ui) {
            $(".ui-autocomplete").css("z-index", 1000);
        }
	});	
});