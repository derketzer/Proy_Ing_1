<?php
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaCSS("css/consultas.css");
	echo cargaJS("js/consultas.js");
	echo cargaJS("inc/tiny_mce/tiny_mce.js");

	$mysqli = new db(false);

	if($_POST['guardar']){
		$producto = $_POST['producto'];
		$producto_costo = $_POST['producto_costo'];
		$q_costo = $_POST['q_costo'];
		$e_nota = $_POST['e_nota'];
		$_POST['d_fecha'] = "NOW()";
		
		unset($_POST['producto']);
		unset($_POST['producto_costo']);
		unset($_POST['q_costo']);
		unset($_POST['e_nota']);
		
		if($mysqli->insert("consulta",$_POST)){
			$id_insertado = $mysqli->insert_id;
			
			$mysqli->insert("orden", array(
				"id_consulta" => $id_insertado,
				"id_producto" => "0",
				"q_costo" => $q_costo,
				"d_fecha_creacion" => date("Y-m-d H:i:s"),
				"d_fecha_modificacion" => date("Y-m-d H:i:s"),
				"b_pagado"=>"0",
				"e_nota"=>$e_nota
			));
			
			foreach($producto as $key=>$prod){
				$val = array();
				$dat = array();
				$dat['id_consulta'] = $val['id_consulta'] = $id_insertado;
				$dat['id_producto'] = $val['id_producto'] = $prod;
				$dat['q_costo'] = $val['q_costo'] = $producto_costo[$key];
				$val['d_fecha_creacion'] = date("Y-m-d H:i:s");
				$val['d_fecha_modificacion'] = date("Y-m-d H:i:s");
				$dat['d_fecha'] = date("Y-m-d H:i:s");
				$val['b_pagado'] = "0";
				$dat['id_campana'] = $_SESSION['CampanaEmp'];
				$dat['id_empleado'] = $_SESSION['IdEmp'];

				$mysqli->insert("orden",$val);
				$mysqli->insert("ventas",$dat);
			}
			
			$msg ='<div id="correcto">La consulta fue guardada exitosamente.</div>';
		}else{
			$msg = '<div id="error">Error al insertar la consulta.</div>';
		}
	}

	$consulta = $mysqli->select(
		"producto_campana",
		"id_producto,q_cantidad",
		array("id_campana" => $_SESSION['CampanaEmp']),
		array("id_producto" => "ASC")
	);

	$productos = '<option value="0">Seleccionar un producto</option><option value="-1">Cancelar</option>';

	while($fila = $consulta->fetch_assoc()){
		if($fila['q_cantidad'] >= 1){
			$consulta_temp = $mysqli->select(
				"producto",
				"id_producto,n_nombre,q_costo,b_activo",
				array("id_producto" => $fila['id_producto']
				),
				array("id_producto" => "ASC")
			);
			$fila_temp = $consulta_temp->fetch_assoc();
			$consulta_temp->close();

			if($fila_temp['b_activo'] != 0)
				$productos .= '<option value="'.$fila['id_producto'].'" val-costo="'.$fila_temp['q_costo'].'" val-cantidad="'.$fila['q_cantidad'].'">'.$fila_temp['n_nombre'].'</option>';
		}
	}

	$consulta->close();

	echo '<script>var productos=\''.$productos.'\';</script>';
	
	echo $msg;
?>

<div id="marco-left">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="forma-consulta">

		<fieldset>
			<legend>Datos del Paciente</legend>

			<div>
				<div class="input-leyenda">Nombre</div>
				<div id="paciente-nombre"></div>
			</div>
			
			<br />

			<div>
				<div class="input-leyenda">Direcci&oacute;n</div>
				<div id="paciente-direccion"></div>
			</div>

			<div class="qa-resultado"><a href="javascript:void(0);" onclick="qResultado('paciente');">[-]</a></div>
		</fieldset>

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
			<legend>Datos de la Consulta</legend>

			<div>
				<div class="input-leyenda">Costo</div>
				<div>
					<input type="text" name="q_costo" class="formulario-input" value="200" />
				</div>
			</div>

			<div>
				<div class="input-leyenda">Nota</div>
				<div>
					<textarea name="e_nota" id="input-tiny"></textarea>
				</div>
			</div>

			<br />

			<div>
				<div class="input-leyenda">Pagada</div>
				<div>
					<input type="checkbox" name="b_pagado">
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend>Datos de la Orden</legend>

			<div>
				<div class="input-leyenda">Productos</div>
			</div>

			<div id="listado-productos"></div>
			<div class="qa-resultado"><a href="javascript:nuevo_producto();">[+]</a></div>
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
					<option value="paciente-n_nombre">Paciente Nombre</option>
					<option value="paciente-n_apellido">Paciente Apellido</option>
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

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
