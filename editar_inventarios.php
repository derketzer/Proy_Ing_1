<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listado.css");
	echo cargaJS("js/inventario.js");

	$mysqli = new db(false);
	
	$id_producto = $_GET['id_producto'];

	if($_POST['guardar']){
		$id_producto = $_POST['id_producto'];

		if($mysqli->query("UPDATE producto_campana SET q_cantidad=q_cantidad+".$_POST['q_cantidad']." WHERE id_campana='".$_POST['id_campana']."' AND id_producto='".$id_producto."'")){
			$_POST['d_fecha'] = date("Y-m-d H:i:s");

			if($mysqli->insert("entradas_salidas", $_POST))
				$msg ='<div id="correcto">El producto fue guardado exitosamente.</div>';
			else
				$msg ='<div id="correcto">El inventario no se pudo guardar.</div>';
		}else{
			$msg = '<div id="error">Error al insertar el producto.</div>';
		}
	}

	echo $msg;
	
	if($id_producto){
		$consulta = $mysqli->select(
			"producto",
			"n_nombre",
			"id_producto=".$id_producto
		);
		$fila = $consulta->fetch_assoc();
		$consulta->close();
		$nombre = $fila['n_nombre'];
		
		$consulta = $mysqli->select(
			"producto_campana",
			"q_cantidad",
			"id_producto=".$id_producto." AND id_campana=".$_SESSION['CampanaEmp']
		);
		$fila = $consulta->fetch_assoc();
		$consulta->close();
		$cantidad = $fila['q_cantidad'];
		
		$consulta = $mysqli->select(
			"campana",
			"n_nombre",
			"id_campana=".$_SESSION['CampanaEmp']
		);
		$fila = $consulta->fetch_assoc();
		$consulta->close();
		$campana = $fila['n_nombre'];
	}
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-producto">

		<fieldset>
			<legend>Datos del Producto</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><?php echo $nombre; ?></div>
			</div>
			
			<br />

			<div>
				<div class="input-leyenda">Cantidad</div>
				<div><input type="text" name="q_cantidad" class="formulario-input" value="" style="width:500px;" /> (Actual <?php echo $cantidad; ?>) </div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<?php if($id_producto){ ?><input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>" /><?php } ?>
		<input type="hidden" name="id_campana" value="<?php echo $_SESSION['CampanaEmp']; ?>" />
		<input type="submit" value="Guardar" class="boton" />

	</form>
</div>

<div id="marco-right">
	<fieldset>
		<legend>Campa&ntilde;a</legend>
		
		<div>
			<div class="busca-leyenda">Campa&ntilde;a</div>
		</div>

		<div id="caja-resultados-agregados">
			<div class="busqueda-resultado"><?php echo $campana; ?></div>
		</div>
	</fieldset>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
