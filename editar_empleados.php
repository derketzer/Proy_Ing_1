<?php
	@require_once("inc/config.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");

	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.10/themes/base/jquery-ui.css");

	echo cargaCSS("css/usuarios.css");
	echo cargaJS("js/usuarios.js");

	$mysqli = new db(false);
	
	$id_empleado = $_GET['id_empleado'];

	if($_POST['guardar']){
		$id_empleado = $_POST['id_empleado'];

		unset($_POST['guardar']);
		
		$data['q_sueldo'] = $_POST['q_sueldo'];
		unset($_POST['q_sueldo']);

		$data['q_sueldo_old'] = $_POST['q_sueldo_old'];
		unset($_POST['q_sueldo_old']);

		$_POST['d_fecha_modificacion'] = date("Y-m-d H:i:s");
		$_POST['b_activo']=($_POST['b_activo'])?$_POST['b_activo']:"0";
		
		foreach($_POST as $key=>$value){
			$key = str_replace("-", "_", $key);
			$$key = addslashes((string)$value);
		}

		if($mysqli->update("empleado", $_POST, array("id_empleado"=>"$id_empleado"))){
			if($data['q_sueldo'] != $data['q_sueldo_old']){
				$data['id_empleado'] = $id_empleado;
				$data['d_fecha'] = $_POST['d_fecha_modificacion'];

				if($mysqli->insert("sueldo", $data))
					$msg ='<div id="correcto">El empleado fue actualizado exitosamente.</div>';
				else
					$msg = '<div id="error">Error al actualizar el sueldo del empleado.</div>';
			}else{
				$msg ='<div id="correcto">El empleado fue actualizado exitosamente.</div>';
			}
		}else{
			$msg = '<div id="error">Error al actualizar el empleado.</div>';
		}
	}

	$consulta = $mysqli->select("empleado", "", "id_empleado=$id_empleado");
	$fila = $consulta->fetch_assoc();
	$consulta->close();

	$fecha = explode(" ", $fila['d_nacimiento']);
	$fechota = $fecha[0];
	$fecha = explode("-", $fecha[0]);
	$fila['nac_dia'] = $fecha[2];
	$fila['nac_mes'] = $fecha[1];
	$fila['nac_anho'] = $fecha[0];

	$consulta = $mysqli->select("sueldo", "", "id_empleado=$id_empleado", array("d_fecha"=>"DESC"));
	$fila_temp = $consulta->fetch_assoc();
	$consulta->close();

	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-usuario">

		<fieldset>
			<legend>Datos del Empleado</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div><input type="text" name="n_nombre" class="formulario-input" value="<?php echo $fila['n_nombre']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Apellido</div>
				<div><input type="text" name="n_apellido" class="formulario-input" value="<?php echo $fila['n_apellido']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Fecha de Nacimiento</div>
				<div>
					D&iacute;a: <select id="dia" onchange="arregla_fecha();"><?php for($n=1;$n<32;$n++) echo '<option value="'.$n.'"'.(($fila['nac_dia']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					Mes: <select id="mes" onchange="arregla_fecha();"><?php for($n=1;$n<13;$n++) echo '<option value="'.$n.'"'.(($fila['nac_mes']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					A&ntilde;o: <select id="anho" onchange="arregla_fecha();"><?php for($n=2011;$n>1900;$n--) echo '<option value="'.$n.'"'.(($fila['nac_anho']==$n)?' selected="selected"':'').'>'.$n.'</option>'; ?></select>
					<input type="hidden" id="fecha-input" name="d_nacimiento" value="<?php echo $fechota; ?>" />
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div><input type="text" name="a_direccion" class="formulario-input" value="<?php echo $fila['a_direccion']; ?>" /></div>
			</div>
			
			<div>
				<div class="input-leyenda">Puesto</div>
				<div><input type="text" name="t_puesto" class="formulario-input" value="<?php echo $fila['t_puesto']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Password</div>
				<div><input type="password" name="pw_password" class="formulario-input" id="pw_password" /></div>
			</div>

			<div>
				<div class="input-leyenda">Tel&eacute;fono</div>
				<div><input type="text" name="a_telefono" class="formulario-input" value="<?php echo $fila['a_telefono']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">E-Mail</div>
				<div><input type="text" name="a_email" class="formulario-input" value="<?php echo $fila['a_email']; ?>" /></div>
			</div>

			<div>
				<div class="input-leyenda">Sueldo</div>
				<div><input type="text" name="q_sueldo" class="formulario-input" value="<?php echo $fila_temp['q_sueldo']; ?>" /></div>
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
					<input type="checkbox" <?php if($fila['b_activo']==1){ ?>checked="checked"<?}?> name="b_activo" value="1" />
				</div>
			</div>

			<br />

		</fieldset>

		<input type="hidden" name="guardar" value="1" />
		<input type="hidden" name="pw_password_old" value="<?php echo $fila['pw_password']; ?>" />
		<input type="hidden" name="id_empleado" value="<?php echo $id_empleado; ?>" />
		<input type="hidden" name="q_sueldo_old" value="<?php echo $fila_temp['q_sueldo']; ?>" />

		<input type="submit" value="Guardar" id="busca-boton" />

	</form>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
