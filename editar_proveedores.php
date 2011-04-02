<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/usuarios.css");

	$mysqli = new db(false);
	
	$id_proveedor = $_GET['id_proveedor'];

	if($_POST['guardar']){
		$id_proveedor = $_POST['id_proveedor'];

		unset($_POST['guardar']);

		if($mysqli->update("proveedor", $_POST, array("id_proveedor"=>"$id_proveedor")))
			$msg ='<div id="correcto">El proveedor fue actualizado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al actualizar el proveedor.</div>';
	}

	$consulta = $mysqli->select("proveedor", "", "id_proveedor=$id_proveedor");
	$fila = $consulta->fetch_assoc();
	$consulta->close();

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-proveedor">

		<fieldset>
			<legend>Datos del proveedor</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" value="<?php echo $fila['n_nombre']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Tipo</div>
				<div><input type="text" name="t_tipo" class="formulario-input" value="<?php echo $fila['t_tipo']; ?>" /></div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor; ?>" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
