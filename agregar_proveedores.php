<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listado.css");

	$mysqli = new db(false);

	if($_POST['guardar']){
		unset($_POST['guardar']);

		if($mysqli->insert("proveedor",$_POST))
			$msg ='<div id="correcto">El proveedor fue guardado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al insertar el proveedor.</div>';
	}

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-proveedor">

		<fieldset>
			<legend>Datos del proveedor</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Tipo</div>
				<div><input type="text" name="t_tipo" class="formulario-input" /></div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="submit" value="Guardar" class="boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
