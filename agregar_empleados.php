<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/usuarios.css");
	echo cargaJS("js/usuarios.js");

	$mysqli = new db(false);

	if($_POST['guardar']){
		$_POST['d_nacimiento'] = $_POST['nac_anho']."-".$_POST['nac_mes']."-".$_POST['nac_dia'];
		unset($_POST['guardar']);
		unset($_POST['nac_anho']);
		unset($_POST['nac_mes']);
		unset($_POST['nac_dia']);
		$_POST['d_fecha_creacion'] = date("Y-m-d H:i:s");
		$_POST['d_fecha_modificacion'] = date("Y-m-d H:i:s");

		if($mysqli->insert("empleado",$_POST))
			$msg ='<div id="correcto">El empleadoo fue guardado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al insertar el empleado.</div>';
	}

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-usuario">

		<fieldset>
			<legend>Datos del Empleado</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Apellido</div>
				<div><input type="text" name="n_apellido" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Fecha de Nacimiento</div>
				<div>
					D&iacute;a: <select name="nac_dia"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					Mes: <select name="nac_mes"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					A&ntilde;o: <select name="nac_anho"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div><input type="text" name="a_direccion" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Puesto</div>
				<div><input type="text" name="t_puesto" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Password</div>
				<div><input type="password" name="pw_password" class="formulario-input" id="password" /></div>
			</div>

			<div>
				<div class="input-leyenda">Tel&eacute;fono</div>
				<div><input type="text" name="a_telefono" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">E-Mail</div>
				<div><input type="text" name="a_email" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Nivel</div>
				<div>
					<select name="t_nivel"><?php for($n=1;$n<11;$n++) echo ($niveles[$n]!="")?'<option value="'.$n.'">'.$niveles[$n].'</option>':""; ?></select>
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Activo</div>
				<div>
					<input type="checkbox" checked="checked" name="b_activo" value="1" />
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
