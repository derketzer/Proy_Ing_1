	<?php
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");
	@include_once($_SERVER['DOCUMENT_ROOT']."inc/header.inc.php");

	echo cargaJS("js/asistencias.js");

	$mysqli = new db(false);

	if($_POST['guardar']){
		$producto = $_POST['producto'];
		$producto_costo = $_POST['producto_costo'];
		$q_costo = $_POST['q_costo'];
		$e_nota = $_POST['e_nota'];
		$_POST['d_fecha'] = date("Y-m-d H:i:s");
		
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
				$val['id_consulta'] = $id_insertado;
				$val['id_producto'] = $prod;
				$val['q_costo'] = $producto_costo[$key];
				$val['d_fecha_creacion'] = date("Y-m-d H:i:s");
				$val['d_fecha_modificacion'] = date("Y-m-d H:i:s");
				$val['b_pagado'] = "0";
				$mysqli->insert("orden",$val);
			}
			
			$msg ='<div id="correcto">La consulta fue guardada exitosamente.</div>';
		}else{
			$msg = '<div id="error">Error al insertar la consulta.</div>';
		}
	}

	echo $msg;
?>

<div id="marco-left">
	<fieldset>
		<legend>Asistencias</legend>

		<div id="lista-asistencias">
			<?php
		
				$consulta = $mysqli->query("
					SELECT
						a.id_empleado,
						b.n_nombre,
						b.n_apellido,
						c.b_asistio IS NULL AS noAsistencia,
						a.id_campana
					FROM
						empleado_campana AS a
					INNER JOIN
						empleado AS b
					ON
						a.id_empleado = b.id_empleado
					LEFT JOIN
						asistencia AS c
					ON
						a.id_empleado = c.id_empleado AND
						c.id_campana = '".$_SESSION['CampanaEmp']."'
					WHERE
						a.id_campana = '".$_SESSION['CampanaEmp']."'
				");
			
				while($fila = $consulta->fetch_assoc()){
					if($fila['noAsistencia'] == 0){
						echo '
							<div class="busqueda-resultado" onclick="javascript:qResultado(this);" val-nombre="'.$fila['n_nombre'].' '.$fila['n_apellido'].'" val-id="'.$fila['id_empleado'].'" val-campana="'.$fila['id_campana'].'" style="width:600px;">
								'.$fila['n_nombre'].' '.$fila['n_apellido'].'
							</div>
						';
					}
				}
			
				$consulta->close();
			?>
		</div>
	</fieldset>
</div>

<div id="marco-right">
	<fieldset>
		<legend>Empleados de la Campa&ntilde;a</legend>
		
		<div class="busca-leyenda">Empleados</div>
		
		<div id="lista-activos" style="overflow:auto;height:500px;">
		
			<?php
		
				$consulta = $mysqli->query("
					SELECT
						a.id_empleado,
						b.n_nombre,
						b.n_apellido,
						c.b_asistio IS NULL AS noAsistencia,
						a.id_campana
					FROM
						empleado_campana AS a
					INNER JOIN
						empleado AS b
					ON
						a.id_empleado = b.id_empleado
					LEFT JOIN
						asistencia AS c
					ON
						a.id_empleado = c.id_empleado AND
						c.id_campana = ".$_SESSION['CampanaEmp']."
					WHERE
						a.id_campana = '".$_SESSION['CampanaEmp']."'
				");
			
				while($fila = $consulta->fetch_assoc()){
					if($fila['noAsistencia'] == 1){
						echo '
							<div class="busqueda-resultado" onclick="javascript:aResultado(this);" val-nombre="'.$fila['n_nombre'].' '.$fila['n_apellido'].'" val-id="'.$fila['id_empleado'].'" val-campana="'.$fila['id_campana'].'">
								'.$fila['n_nombre'].' '.$fila['n_apellido'].'
							</div>
						';
					}
				}
			
				$consulta->close();
			?>
		
		</div>
	
	</fieldset>
</div>

<?php

	$mysqli->close();

	@include_once($_SERVER['DOCUMENT_ROOT']."inc/footer.inc.php");

?>
