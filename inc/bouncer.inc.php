<?php

	session_start();

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/secciones.inc.php");

	$url = addslashes(str_replace("/", "", $_SERVER['SCRIPT_NAME']));

	if(!array_key_exists($url, $permisos)){
		header("location: index.php");
		die();
	}else{
		if($_SESSION['LogueadoEmp'] == ""){
			header("location: index.php?url=".$_SERVER['REQUEST_URI']);
			die();
		}elseif($_SESSION['NivelEmp']>=$permisos[$url] && $_SESSION['NivelEmp']!=""){
			header("location: index.php");
			die();
		}
	}
?>
