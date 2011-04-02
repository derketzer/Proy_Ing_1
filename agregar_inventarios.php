<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/listado.css");
	echo cargaJS("js/inventario.js");

	$mysqli = new db(false);
	
	$id_producto = $_REQUEST['id_producto'];

	if($_POST['guardar']){
		if($_POST['id_producto'] != "" && $_POST['id_campana'] != "" && $_POST['q_cantidad'] != ""){
			if($mysqli->insert("producto_campana",$_POST))
				$msg ='<div id="correcto">El producto fue guardado exitosamente.</div>';
			else
				$msg = '<div id="error">Error al insertar el producto.</div>';
		}else{
			$msg = '<div id="error">Error al insertar el producto, faltan datos.</div>';
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
	}else{
		$consulta = $mysqli->select(
			"producto",
			"id_producto,n_nombre",
			"",
			array("n_nombre"=>"ASC")
		);
		
		$nombre = '<select name="id_producto" class="formulario-select">';
		
		while($fila = $consulta->fetch_assoc()){
			$nombre .= '
				<option value="'.$fila['id_producto'].'">'.$fila['n_nombre'].'</option>
			';
		}
		
		$nombre .= '</select>';
		
		$consulta->close();
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
				<div><input type="text" name="q_cantidad" class="formulario-input" /></div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<?php if($id_producto){ ?><input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>" /><?php } ?>
		<input type="submit" value="Guardar" class="boton" />

	</form>
</div>

<div id="marco-right">
	<fieldset>
		<legend>Buscar Campa&ntilde;a</legend>
		
		<div>
			<div class="busca-leyenda">Campa&ntilde;a</div>
			<div><input type="text" name="campana_nombre" id="campana_nombre" class="busca-input" /></div>
		</div>

		<div id="caja-resultados">
		</div>
	</fieldset>
	
	<div class="limpia" style="height:15px;">&nbsp;</div>
	<div class="limpia">
		<input type="button" value="Buscar" id="busca-boton" class="boton" />
	</div>
	
	<br />
	<br />
	
	<fieldset>
		<legend>Campa&ntilde;as agregada</legend>
		
		<div>
			<div class="busca-leyenda">Campa&ntilde;a</div>
		</div>

		<div id="caja-resultados-agregados">
		</div>
	</fieldset>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
