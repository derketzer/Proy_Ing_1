<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$mysqli = new db(false);

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"proveedor",
		"id_proveedor AS id,n_nombre,t_tipo",
		"",
		array("n_nombre" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left" style="width:530px;">Nombre</div>
			<div class="col-left" style="width:260px;">Tipo</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		
		$extra = $n%2==0?"row-par":"row-impar";
		echo '
			<div class="row '.$extra.'">
				<div class="col-left" style="width:530px;"><a href="editar_proveedores.php?id_proveedor='.$fila['id'].'"><b>'.$fila['n_nombre'].'</b></a></div>
				<div class="col-left" style="width:260px;">'.$fila['t_tipo'].'</div>
				<div class="col-left"><a href="borrar_proveedores.php?id_proveedor='.$fila['id'].'"><img src="img/tache.png" class="tache" /></a></div>
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
