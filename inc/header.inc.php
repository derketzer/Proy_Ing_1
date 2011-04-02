<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xml:lang="es" lang="es"> 

	<head>
	
		<title>Campa&ntilde;a Internacional de Medicina Celular</title>
		
		<meta name="description" content="" /> 
		<meta name="keywords" content="" />
		
		<link rel="shortcut icon" href="" type="image/x-icon">
		
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		
		<!-- Scripts necesarios para el funcionamiento -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script> 
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/jquery-ui.min.js" type="text/javascript"></script>
		<script src="inc/tiny_mce/tiny_mce.js" type="text/javascript"></script>
		<script src="js/pirobox_extended_min.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		
		<!-- Estilos necesarios para que se vea bonito -->
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/pirobox.css" />
		<link rel="stylesheet" type="text/css" href="/css/style_1/style.css"/>
	</head>
	
	<body>
	
<?php

	include_once("secciones.inc.php");
	include_once("migajas.inc.php");
	
	echo '
		<div id="top">
			<div>
				<div id="migajas">
					'.$migajas.'
				</div>

				<div id="links-top">
					<u>'.$_SESSION['NombreEmp'].'</u> | <a href="logout.php">Salir</a>
				</div>
			</div>
			
			<div id="secciones">
				<div class="espacio-left">&nbsp;</div>
	';
	
	foreach($secciones as $nSeccion=>$subseccion){
		$mju = explode("/", $_SERVER['REQUEST_URI']);
		$mju = array_pop($mju);
		$mju = explode("?", $mju);
		$mju = array_shift($mju);
		$ando = explode("_", $mju);
		$extra = "";
		
		if($ando[1] == "")
			$ando[1] = $ando[0];

		if(strtolower(str_replace(".php", "", $ando[1])) == strtolower($nSeccion)){
			$voy = $subseccion;
			$extra = " seccionA";
		}
		
		if(strpos($subseccion, ".php") == false){
			$url = array_values(array_slice($subseccion, 0));
			$url = $url[0];
		}else{
			$url = $subseccion;
		}
		
		echo '<a href="'.$url.'"><div class="seccion'.$extra.'">'.$nSeccion.'</div></a>';
	}
	
	echo "</div>";
	
	echo '
		<div id="subsecciones" class="limpia">
			<div class="espacio-left">&nbsp;</div>
	';

	if($voy){
	foreach($voy as $nSubseccion=>$subsubseccion){
		$mju = explode("/", $_SERVER['REQUEST_URI']);
		$mju = array_pop($mju);
		$extra = "";

		if($mju == $subsubseccion)
			$extra = " subSeccionA";

		if(strpos($subsubseccion, ".php") == false){
			$url = array_values(array_slice($subsubseccion, 0));
			$url = $url[0];
		}else{
			$url = $subsubseccion;
		}
		
		echo '<a href="'.$url.'"><div class="subseccion'.$extra.'">'.$nSubseccion.'</div></a>';
	}
	}else{
		$url = explode("_", $_SERVER['SCRIPT_NAME']);
		$url = "listado_".$url[1];
		echo '<a href="'.$url.'"><div class="subseccion subSeccionA">Atr&aacute;s</div></a>';
	}
	
	echo '
			<div class="limpia"></div>
			</div>
		</div>

		<div id="main">
	';
?>
