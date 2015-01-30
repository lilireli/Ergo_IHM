<?php 
	$etape_id = $etape; 

    if (isset($_GET['tab']))
    {  // si tab existe
        $tab = $_GET['tab'];
    } else { // sinon tab 1
        $tab = 0;
    }
    
    
    function affiche_menu($tab)
    {
        $tab_menu_texte = array( "Transports", "Hébergements", "Activités" );
        $i = 0;
        
        $menu = "\n<div id=\"menu\">\n    <ul id=\"onglets\">\n";

        foreach($tab_menu_texte as $value)
        {
            $menu .= "    <li";                        
            if( $tab == $i )    $menu .= " class=\"active\"";                        
            $menu .= "><a href=\"?tab=" . $i . "\">" . $value . "</a></li>\n";
            
            $i += 1;
        }
        
        $menu .= "</ul>\n</div>";
       
        return $menu;        
    }
    
    function affiche_tab($tab, $etape, $etape_id)
    {
        echo '<div class="main">';
            
        if ($tab == 0)
        {   
            echo $etape->element('transport',  array('etape_id' => $etape_id));
        } elseif ($tab == 1) {
            echo $etape->element('hebergement',  array('etape_id' => $etape_id));
        } elseif ($tab == 2) {
            echo $etape->element('activite',  array('etape_id' => $etape_id));
        }
        
        echo '</div>';
    }


    $menu = affiche_menu($tab);
    echo $menu;
    
    $main = affiche_tab($tab, $this, $etape_id);
?>