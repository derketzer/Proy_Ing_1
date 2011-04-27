<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css");

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

			<div>
				<div class="input-leyenda">Fecha de Inicio</div>
				<div>
					D&iacute;a: <select id="dia" onchange="arregla_fecha();"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					Mes: <select id="mes" onchange="arregla_fecha();"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="anho" onchange="arregla_fecha();"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input" name="d_fecha_inicio" />
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Fecha de Fin</div>
				<div>
					D&iacute;a: <select id="dia2" onchange="arregla_fecha(2);"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					Mes: <select id="mes2" onchange="arregla_fecha(2);"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="anho2" onchange="arregla_fecha(2);"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input2" name="d_fecha_fin" />
				</div>
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