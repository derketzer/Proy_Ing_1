<?php
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css");

	$mysqli = new db(false);
	
	$id_paciente = $_REQUEST['id_paciente'];

	if($_POST['guardar']){
		$_POST['d_fecha_modificacion'] = date("Y-m-d H:i:s");

		foreach($_POST as $key=>$value){
			$key = str_replace("-", "_", $key);
			$$key = addslashes((string)$value);
		}

		if($mysqli->update("paciente", $_POST, array("id_paciente"=>"$id_paciente")))
			$msg ='<div id="correcto">El paciente fue actualizado exitosamente.</div>';
		else
			$msq = '<div id="error">Error al actualizar el paciente.</div>';
	}

	$consulta = $mysqli->select("paciente", "", "id_paciente=$id_paciente");
	$fila = $consulta->fetch_assoc();
	$consulta->close();

	$fecha = explode(" ", $fila['d_nacimiento']);
	$fecha = explode("-", $fecha[0]);
	$fila['nac_dia'] = $fecha[2];
	$fila['nac_mes'] = $fecha[1];
	$fila['nac_anho'] = $fecha[0];

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-paciente">

		<fieldset>
			<legend>Datos del Paciente</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" value="<?php echo $fila['n_nombre']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Apellido</div>
				<div><input type="text" name="n_apellido" class="formulario-input" value="<?php echo $fila['n_apellido']; ?>" /></div>
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
					D&iacute;a: <select id="nac_dia" name=""><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'"'.(($fila['nac_dia']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					Mes: <select id="nac_mes" name=""><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'"'.(($fila['nac_mes']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="nac_anho" name=""><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'"'.(($fila['nac_anho']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input" name="d_nacimiento" />
				</div>
			</div>
			
			<br />
			
			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div><input type="text" name="a_direccion" class="formulario-input" value="<?php echo $fila['a_direccion']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">E-Mail</div>
				<div><input type="text" name="a_email" class="formulario-input" value="<?php echo $fila['a_email']; ?>" /></div>
			</div>
			

			<div>
				<div class="input-leyenda">Tel&eacute;fono</div>
				<div><input type="text" name="a_telefono" class="formulario-input" value="<?php echo $fila['a_telefono']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Nota</div>
				<div>
					<textarea name="e_nota" id="input-tiny"><?php echo $fila['e_nota']; ?></textarea>
				</div>
			</div>
			
			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
