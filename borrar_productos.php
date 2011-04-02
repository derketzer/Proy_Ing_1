<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$mysqli = new db(false);

	if($_GET != array())
		$mysqli->delete("producto", $_GET);

	header("location: listado_productos.php");

?>
