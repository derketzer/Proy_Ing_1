<?php
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaJS("js/asignar_campana.js");
	
	$mysqli = new db(false);

	if($_POST['guardar']){

		if($mysqli->insert("empleado_campana",$_POST)){
			$msg ='<div id="correcto">El empleado fue asignado exitosamente a la campa&ntilde;a.</div>';
		}else{
			$msg = '<div id="error">Error, el empleado ya est&aacute; asignado a la campa&ntilde;a.</div>';
		}
	}

	echo $msg;
?>
<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-asigna-campana">

		<fieldset>
			<legend>Datos del Empleado</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div id="empleado-nombre"></div>
			</div>
			
			<br />
			
			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div id="empleado-direccion"></div>
			</div>

			<div class="qa-resultado"><a href="javascript:void(0);" onclick="qResultado('empleado');">[-]</a></div>
		</fieldset>

		<fieldset>
			<legend>Datos de la Campa&ntilde;a</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div id="campana-nombre"></div>
			</div>
			
			<br />
			
			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div id="campana-direccion"></div>
			</div>

			<div class="qa-resultado"><a href="javascript:void(0);" onclick="qResultado('campana');">[-]</a></div>
		</fieldset>

		<input type="hidden" name="guardar" value="1" />

		<input type="submit" value="Guardar" id="busca-boton" />
	</form>
</div>

<div id="marco-right">
	<fieldset>
		<legend>B&uacute;squeda</legend>

		<div>
			<div class="busca-leyenda">Buscar</div>
			<div>
				<select name="donde-busco" id="donde-busco" class="busca-select">
					<option value="campana-n_nombre">Campa&ntilde;a Nombre</option>
					<option value="campana-a_direccion">Campa&ntilde;a Direcci&oacute;n</option>
					<option value="empleado-n_nombre">Empleado Nombre</option>
					<option value="empleado-n_apellido">Empleado Apellido</option>
				</select>
			</div>
			<div><input type="text" name="nombre" class="busca-input" id="nombre-busqueda" /></div>
		</div>

		<div id="caja-resultados">
		</div>

		<div class="limpia"></div>
		<div class="limpia">
			<input type="button" value="Buscar" id="busca-boton" class="boton" onclick="javascript:buscar();" />
		</div>
	
	</fieldset>
</div>
