<?php
/**
 * GroupTrotteur: Heureux qui comme Ulysse a fait un beau voyage
 *
 * Menu des différentes étapes 
 *
 * @author        A. Chardon, A. El Bachiri, J. Pieyre, A. Suzanne
 */
?>

<?php
    $tab_menu_texte = array( 
        array("Général", "etapes", "index"),
        array("Hébergements", "hebergements", "view"), 
        array("Activités", "activites", "view" ));
    $i = 0;
    
    $menu = "\n<div id=\"menu\">\n    <ul class=\"onglets \">\n";

    foreach($tab_menu_texte as $value) // pour chaque possibilité créer l'onglet
    {
        $menu .= "    <li";                        
        if( $tab == $i ){
            $menu .= " class=\"active\"";  
        }  

        $menu .= ">";

        $menu .= $this->Html->link(__($value[0]), 
            array(
                'controller' => $value[1], 
                'action' => $value[2], 
                $base_url
            )); 

        $menu .= '</li>';
        
        $i += 1;
    }
    
    $menu .= "</ul>\n</div>";
   
    echo $menu;
?>