<?php

	$migajas = explode("/", str_replace(".php", "", $_SERVER['SCRIPT_NAME']));
	array_shift($migajas);
	$ultimo = array_pop($migajas);
	$ultimo = explode("_", $ultimo);
	$migajas = array_merge($migajas, $ultimo);
	$res = "";
	$blu = array();
	$blu[] = "CIMC";
	$migajas = array_merge($blu, $migajas);
	
	foreach($migajas as $migaja){
		$res .= ucfirst($migaja)." > ";
	}
	
	$migajas = substr($res, 0, -3);

?>
