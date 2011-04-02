<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$mysqli = new db(false);

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listados.css");

	$consulta = $mysqli->select(
		"producto_campana",
		"id_producto AS id, q_cantidad",
		"id_campana=".$_SESSION['CampanaEmp'],
		array("id_producto" => "ASC")
	);

	echo '
		<div class="row tabla-header">
			<div class="col-left" style="width:530px;">Producto</div>
			<div class="col-left" style="width:260px;">Cantidad</div>
			<div class="col-left">Borrar</div>
		</div>
	';

	$n = 0;

	while($fila = $consulta->fetch_assoc()){
		$consulta_temp = $mysqli->select(
			"producto",
			"id_producto AS id,n_nombre",
			"id_producto=".$fila['id']
		);
		$fila_temp = $consulta_temp->fetch_assoc();
		$consulta_temp->close();
	
		$extra = $n%2==0?"row-par":"row-impar";
		echo '
			<div class="row '.$extra.'">
				<div class="col-left" style="width:530px;"><a href="editar_inventarios.php?id_producto='.$fila_temp['id'].'"><b>'.$fila_temp['n_nombre'].'</b></a></div>
				<div class="col-left" style="width:260px;">'.$fila['q_cantidad'].'</div>
				<div class="col-left"><a href="borrar_inventarios.php?id_producto='.$fila_temp['id'].'"><img src="img/tache.png" class="tache" /></a></div>
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
