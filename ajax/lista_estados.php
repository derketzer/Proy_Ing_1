<?php

	@require_once("../inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$id_pais = intval($_POST['id_pais']);

	if($id_pais != ""){
		$mysqli = new db(false);

		$consulta = $mysqli->query("SELECT id_estado, estado FROM estados WHERE id_pais='$id_pais' ORDER BY estado ASC");

		echo '<select name="id_estado">';

		while($fila = $consulta->fetch_assoc()){
			echo '<option value="'.$fila['id_estado'].'">'.(utf8_encode($fila['estado'])).'</option>';
		}

		echo '</selected>';

		$consulta->close();

		$mysqli->close();
	}

?>
