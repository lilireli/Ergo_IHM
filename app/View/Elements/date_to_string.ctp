<?php
	function aff_date($date)
	{
		$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

		$tmp = strtotime($date);
		$datefr = date("d", $tmp)." ".$mois[date("n", $tmp)]." ".date("Y", $tmp);

	    return $datefr;

	}
?>