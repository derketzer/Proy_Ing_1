<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$mysqli = new db(false);

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"empleado",
		"id_empleado,n_nombre,n_apellido,a_email,a_telefono,t_puesto",
		"",
		array("n_nombre" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left">Nombre</div>
			<div class="col-left">Apellido</div>
			<div class="col-left">E-Mail</div>
			<div class="col-left">Telefono</div>
			<div class="col-left">Puesto</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		$extra = $n%2==0?"row-par":"row-impar";
		echo '
			<div class="row '.$extra.'">
				<div class="col-left"><a href="editar_empleados.php?id_empleado='.$fila['id_empleado'].'"><b>'.$fila['n_nombre'].'</b></a></div>
				<div class="col-left">'.$fila['n_apellido'].'&nbsp;</div>
				<div class="col-left">'.$fila['a_email'].'&nbsp;</div>
				<div class="col-left">'.($fila['a_telefono']==0?"&nbsp;":$fila['a_telefono']).'</div>
				<div class="col-left">'.$fila['t_puesto'].'&nbsp;</div>
				<div class="col-left"><a href="borrar_empleados.php?id_empleado='.$fila['id_empleado'].'"><img src="img/tache.png" class="tache" /></a></div>
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
