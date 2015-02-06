<?php
/**
 * formater une date en français ou en anglais
 *
 * affichage date en francais ou en anglais
 * recois une date au format : 2008-12-01 11:16:53
 * et le renvoie au format : 1 décembre 2008 à 11:16:53
 *
 * Exemple %A %d %B %Y à %H:%M:%S  -> Monday 13 June 2011 à 16:13:26
 *
 * http://www.phpascal.com/programmation-web/PHP/date_formater_en_francais.html
 *
 * @param $date = date au format Y-m-d H:i:s
 * @author PHPascal.com
 * @since 2011-06-28 à 16:17:29
 * @return string
 */
	function aff_date($date,$lang = 'fr',$format_fr="%d %B %Y", $format_en ="%B %d, %Y")
	{
	    $date_formatee = "";
	   
	    $format = $format_fr;
	    if ($lang == 'en') $format = $format_en;
	               
	               
	    setlocale(LC_TIME, "fr_FR");
	           
	    $date_strtotime = strtotime($date);
	    $date_formatee = strftime ($format,$date_strtotime);
	    return $date_formatee;

	}
?>