<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	$mysqli = new db(false);
	
	$id_campana = $_REQUEST['id_campana'];

	if($_POST['guardar']){
		if($mysqli->update("campana", $_POST, array("id_campana"=>"$id_campana")))
			$msg ='<div id="correcto">La campana fue actualizada correctamente.</div>';
		else
			$msg = '<div id="error">Error al actualizar la campana.</div>';
	}

	$consulta = $mysqli->select("campana", "", "id_campana=$id_campana");
	$fila = $consulta->fetch_assoc();
	$consulta->close();
	
	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-campana">

		<fieldset>
			<legend>Datos de la Campaña</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" value="<?php echo $fila['n_nombre']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Direccion</div>
				<div><input type="text" name="a_direccion" class="formulario-input" value="<?php echo $fila['a_direccion']; ?>" /></div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="hidden" name="id_campana" value="<?php echo $id_campana; ?>" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
