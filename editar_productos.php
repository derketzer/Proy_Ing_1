<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/usuarios.css");

	$mysqli = new db(false);
	
	$id_producto = $_GET['id_producto'];

	if($_POST['guardar']){
		$id_producto = $_POST['id_producto'];

		unset($_POST['guardar']);
		$_POST['b_activo'] = ($_POST['b_activo'])?$_POST['b_activo']:"0";

		if($mysqli->update("producto", $_POST, array("id_producto"=>"$id_producto")))
			$msg ='<div id="correcto">El producto fue actualizado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al actualizar el producto.</div>';
	}

	$consulta = $mysqli->select("producto", "", "id_producto=$id_producto");
	$fila = $consulta->fetch_assoc();
	$consulta->close();

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-producto">

		<fieldset>
			<legend>Datos del producto</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" value="<?php echo $fila['n_nombre']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Costo</div>
				<div><input type="text" name="q_costo" class="formulario-input" value="<?php echo $fila['q_costo']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Activo</div>
				<div>
					<input type="checkbox" <?php if($fila['b_activo']==1){ ?>checked="checked"<?}?> name="b_activo" value="1" />
				</div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
