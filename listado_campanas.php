<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	$mysqli = new db(false);

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"campana",
		"id_campana,n_nombre,a_direccion",
		"",
		array("n_nombre" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left" style="width:530px;">Nombre</div>
			<div class="col-left" style="width:260px;">Direccion</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		$extra = $n%2==0?"row-par":"row-impar";
		echo '
			<div class="row '.$extra.'">
				<div class="col-left" style="width:530px;"><a href="editar_campanas.php?id_campana='.$fila['id_campana'].'"><b>'.$fila['n_nombre'].'</b></a></div>
				<div class="col-left" style="width:260px;">'.$fila['a_direccion'].'</div>
				<div class="col-left"><a href="borrar_campanas.php?id_campana='.$fila['id_campana'].'"><img src="img/tache.png" class="tache" /></a></div>
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
