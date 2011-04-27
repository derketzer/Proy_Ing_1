<?php

	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/grafica.class.php");

	$mysqli = new db(false);

	$consulta = $mysqli->query("
		SELECT
			a.n_nombre,
			a.id_producto
		FROM
			producto_campana AS b
		INNER JOIN
			producto AS a
		ON
			b.id_producto = a.id_producto
		WHERE
			b.id_campana=".$_SESSION['CampanaEmp']."
		ORDER BY
			a.n_nombre DESC
	");

	$productos = array();
	$ventas = array();

	while($fila = $consulta->fetch_assoc()){
		$productos[] = "'".$fila['n_nombre']."'";

		$consulta_temp = $mysqli->query("SELECT count(id_producto) AS cuantas FROM ventas WHERE id_producto='".$fila['id_producto']."'");
		$fila_temp = $consulta_temp->fetch_assoc();
		$consulta_temp->close();
		$ventas[] = $fila_temp['cuantas'];
	}

	$consulta->close();


	$grafica = new grafica;
	$grafica->setTipo(1);
	$grafica->setTitulo("Ventas Totales");
	$grafica->setLeyenda(true);
	$grafica->setY($productos);
	$grafica->setX(array("productos"=>$ventas));
	$grafica->dibuja();


	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>