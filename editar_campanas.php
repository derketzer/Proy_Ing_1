<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css");

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

	$fecha = explode(" ", $fila['d_fecha_inicio']);
	$fechota_ini = $fecha[0];
	$fecha = explode("-", $fecha[0]);
	$fila['ini_dia'] = $fecha[2];
	$fila['ini_mes'] = $fecha[1];
	$fila['ini_anho'] = $fecha[0];

	$fecha = explode(" ", $fila['d_fecha_fin']);
	$fechota_fin = $fecha[0];
	$fecha = explode("-", $fecha[0]);
	$fila['fin_dia'] = $fecha[2];
	$fila['fin_mes'] = $fecha[1];
	$fila['fin_anho'] = $fecha[0];
	
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

			<div>
				<div class="input-leyenda">Fecha de Inicio</div>
				<div>
					D&iacute;a: <select id="dia" onchange="arregla_fecha();"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'"'.(($fila['ini_dia']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					Mes: <select id="mes" onchange="arregla_fecha();"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'"'.(($fila['ini_mes']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="anho" onchange="arregla_fecha();"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'"'.(($fila['ini_anho']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input" name="d_fecha_inicio" value="<?php echo $fechota_ini; ?>" />
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Fecha de Fin</div>
				<div>
					D&iacute;a: <select id="dia2" onchange="arregla_fecha(2);"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'"'.(($fila['fin_dia']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					Mes: <select id="mes2" onchange="arregla_fecha(2);"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'"'.(($fila['fin_mes']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="anho2" onchange="arregla_fecha(2);"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'"'.(($fila['fin_anho']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input2" name="d_fecha_fin" value="<?php echo $fechota_fin; ?>" />
				</div>
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
