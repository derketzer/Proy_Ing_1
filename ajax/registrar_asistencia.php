<?php

	@require_once("../inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$id_empleado = intval($_POST['id_empleado']);
	$res = "Error";

	if($id_empleado != ""){
		$mysqli = new db(false);
		
		if($_POST['asistencia']){
			$variables = array(
				"id_asistencia" => "NULL",
				"id_empleado" => $id_empleado,
				"d_fecha" => date("Y-m-d H:i:s"),
				"b_asistio"=>"1"
			);
			
			if($mysqli->insert("asistencia", $variables))
				$res = "";
		}elseif($_POST['inasistencia']){
			$variables = array(
				"id_empleado" => $id_empleado,
				"DATE(d_fecha)" => date("Y-m-d"),
			);
			
			if($mysqli->delete("asistencia", $variables))
				$res = "";
		}else{
			$res = "Error, falta si es asistencia o no!";
		}
		
		$mysqli->close();
	}else{
		$res = "Error, falta el empleado!";
	}

	echo utf8_encode($res);
?>
