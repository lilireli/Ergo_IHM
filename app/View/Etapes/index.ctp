<div class="general_voyage">
<?php 
	$etape_id = $etape; 
    $voyage_id = $_GET['voyage_id'];
    $days = $_GET['days'];
    $date_debut = $_GET['date_debut'];

    $base_url = $this->here;

    if (isset($_GET['tab']))
    {  // si tab existe
        $tab = $_GET['tab'];
    } else { // sinon tab 1
        $tab = 0;
    }
    
    
    function affiche_menu($tab, $base_url)
    {
        $tab_menu_texte = array( "Hébergements", "Activités" );
        $i = 0;
        
        $menu = "\n<div id=\"menu\">\n    <ul id=\"onglets\">\n";

        foreach($tab_menu_texte as $value)
        {
            $menu .= "    <li";                        
            if( $tab == $i )    $menu .= " class=\"active\"";                        
            $menu .= "><a href=\"".$base_url."&tab=" . $i . "\">" . $value . "</a></li>\n";
            
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
            echo $etape->element('hebergement',  array('etape_id' => $etape_id));
        } elseif ($tab == 1) {
            echo $etape->element('activite',  array('etape_id' => $etape_id));
        }
        
        echo '</div>';
    }


    $menu = affiche_menu($tab, $base_url);
    echo $menu;
    
    $main = affiche_tab($tab, $this, $etape_id);
?>
</div>

<?php
    echo $this->element('frise', array(
        'voyage_id' => $voyage_id,
        'days' => $days,
        'date_debut' => $date_debut
    ));
?>