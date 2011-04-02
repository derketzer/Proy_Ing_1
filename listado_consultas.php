<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	$mysqli = new db(false);

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"consulta",
		"id_consulta,id_paciente,id_empleado,d_fecha",
		"",
		array("d_fecha" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left" style="width:240px;">Paciente</div>
			<div class="col-left" style="width:240px;">Empleado</div>
			<div class="col-left">Debe</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		$extra = $n%2==0?"row-par":"row-impar";
		
		$consulta2 = $mysqli->select(
			"paciente",
			"id_paciente,n_nombre,n_apellido",
			"id_paciente=".$fila['id_paciente']
		);
		$fila2 = $consulta2->fetch_assoc();
		$consulta2->close();
	
		$consulta3 = $mysqli->select(
			"empleado",
			"id_empleado,n_nombre,n_apellido",
			"id_empleado=".$fila['id_empleado']
		);
		$fila3 = $consulta3->fetch_assoc();
		$consulta3->close();
		
		$consulta4 = $mysqli->select(
			"orden",
			"SUM(q_costo) AS costo_total",
			"b_pagado=0 AND id_consulta=".$fila['id_consulta']
		);
		$fila4 = $consulta4->fetch_assoc();
		$consulta4->close();
	
		echo '
			<div class="row '.$extra.'">
				<div class="col-left" style="width:240px;"><a rel="content-600-400" class="pirobox_gall" href="detalles_consultas.php?id_consulta='.$fila['id_consulta'].'"><b>'.$fila2['n_nombre'].' '.$fila2['n_apellido'].'</b></a></div>
				<div class="col-left" style="width:240px;">'.$fila3['n_nombre'].' '.$fila3['n_apellido'].'</div>
				<div class="col-left">'.$fila4['costo_total'].'</div>
				<div class="col-left"><a href="borrar_consultas.php?id_consulta='.$fila['id_consulta'].'"><img src="img/tache.png" class="tache" /></a></div>
			</div>
		';

		$n++;

	}

	$consulta->close();
?>

<?php
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

	$mysqli->close();

?>
