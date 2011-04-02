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
		$_POST['d_fecha_creacion'] = date("Y-m-d H:i:s");

		if($mysqli->insert("producto",$_POST))
			$msg ='<div id="correcto">El producto fue guardado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al insertar el producto.</div>';
	}

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-producto">

		<fieldset>
			<legend>Datos del Producto</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Costo</div>
				<div><input type="text" name="q_costo" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Activo</div>
				<div>
					<input type="checkbox" checked="checked" name="b_activo" value="1" />
				</div>
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
