<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	$mysqli = new db(false);

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"paciente",
		"id_paciente,n_nombre,n_apellido,a_email,a_telefono,a_direccion,e_nota",
		"",
		array("n_nombre" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left" style="width:240px;">Nombre</div>
			<div class="col-left" style="width:240px;">Apellido</div>
			<div class="col-left">E-Mail</div>
			<div class="col-left">Telefono</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		$extra = $n%2==0?"row-par":"row-impar";
		echo '
			<div class="row '.$extra.'">
				<div class="col-left" style="width:240px;"><a href="editar_pacientes.php?id_paciente='.$fila['id_paciente'].'"><b>'.$fila['n_nombre'].'</b></a></div>
				<div class="col-left" style="width:240px;">'.$fila['n_apellido'].'</div>
				<div class="col-left">'.($fila['a_email']==""?"&nbsp;":$fila['a_email']).'</div>
				<div class="col-left">'.($fila['a_telefono']==0?"&nbsp;":$fila['a_telefono']).'</div>
				<div class="col-left"><a href="borrar_pacientes.php?id_paciente='.$fila['id_paciente'].'"><img src="img/tache.png" class="tache" /></a></div>
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