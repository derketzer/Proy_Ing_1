<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css");

	$mysqli = new db(false);

	if($_POST['guardar']){
		$_POST['d_fecha_creacion'] = date("Y-m-d H:i:s");
		$_POST['d_fecha_modificacion'] = date("Y-m-d H:i:s");

		if($mysqli->insert("paciente",$_POST))
			$msg ='<div id="correcto">El paciente fue guardado exitosamente.</div>';
		else
			$msg = '<div id="error">Error al insertar el paciente.</div>';
	}

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-paciente">

		<fieldset>
			<legend>Datos del Paciente</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Apellido</div>
				<div><input type="text" name="n_apellido" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Sexo</div>
				<div>
					<select name="b_sexo"><?php for($n=1;$n<3;$n++) echo ($sexo[$n]!="")?'<option value="'.$n.'">'.$sexo[$n].'</option>':""; ?></select>
				</div>
			</div>
			
			<br />
			
			<div>
				<div class="input-leyenda">Fecha de Nacimiento</div>
				<div>
					D&iacute;a: <select id="nac_dia" name=""><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					Mes: <select id="nac_mes" name=""><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="nac_anho" name=""><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'">'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input" name="d_nacimiento" />
				</div>
			</div>
			
			<br />
			
			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div><input type="text" name="a_direccion" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">E-Mail</div>
				<div><input type="text" name="a_email" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Tel&eacute;fono</div>
				<div><input type="text" name="a_telefono" class="formulario-input" /></div>
			</div>

			<div>
				<div class="input-leyenda">Nota</div>
				<div>
					<textarea name="e_nota" id="input-tiny"></textarea>
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
