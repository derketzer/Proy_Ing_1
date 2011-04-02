<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	$mysqli = new db(false);
	
	if($_POST['guardar']){
		if($mysqli->insert("campana",$_POST))
			$msg ='<div id="correcto">La campana fue guardada exitosamente.</div>';
		else
			$msg = '<div id="error">Error al insertar la campana.</div>';
	}

	echo $msg;
	
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-campana">

		<fieldset>
			<legend>Datos de la Campaña</legend>

			<div>
				<div class="input-leyenda">Nombre de la Campaña</div>
				<div><input type="text" name="n_nombre" class="formulario-input" /></div>
			</div>
			
			<br />

			<div>
				<div class="input-leyenda">Direccion</div>
				<div><input type="text" name="a_direccion" class="formulario-input" /></div>
			</div>
			
			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>