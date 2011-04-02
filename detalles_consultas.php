<?php

	if($id_consulta == ""){
		echo "No hay identificador de consulta!";
		die();
	}
	
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/bouncer.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/fun.inc.php");

	$mysqli = new db(false);

	$consulta = $mysqli->select(
		"consulta",
		"id_paciente,id_empleado,d_fecha",
		"id_consulta=".$id_consulta
	);
	$fila = $consulta->fetch_assoc();
	$consulta->close();
	
	$consulta = $mysqli->query("
		SELECT
			b.n_nombre AS emp_nom,
			b.n_apellido AS emp_ap,
			b.a_direccion AS emp_dir,
			b.t_puesto,
			c.n_nombre AS pac_nom,
			c.n_apellido AS pac_ap,
			c.a_direccion AS pac_dir,
			c.e_nota,
			DATE(a.d_fecha)
		FROM
			consulta AS a
		INNER JOIN
			empleado AS b
		ON
			a.id_empleado = a.id_empleado
		INNER JOIN
			paciente AS c
		ON
			a.id_paciente = c.id_paciente
		WHERE
			a.id_consulta = '$id_consulta'
	");
	$fila = $consulta->fetch_assoc();
	$consulta->close();
	
	$consulta = $mysqli->query("
		SELECT
			b.n_nombre,
			a.q_costo,
			a.b_pagado,
			a.e_nota
		FROM
			orden AS a
		INNER JOIN
			producto AS b
		ON
			a.id_producto = b.id_producto
		WHERE
			a.id_consulta = '$id_consulta'
	");
?>
<br />
<div style="color:#FFF;">
	<fieldset style="width: 540px; margin-left: 20px;">
		<legend>Datos del Empleado</legend>
		
		<b>Nombre:</b> <?php echo utf8_encode($fila['emp_nom'])." ".utf8_encode($fila['emp_ap']); ?><br />
		<b>Dirección:</b> <?php echo utf8_encode($fila['emp_dir']); ?><br />
		<b>Puesto:</b> <?php echo utf8_encode($fila['t_puesto']); ?>
	</fieldset>
	
	<br />
	
	<fieldset style="width: 540px; margin-left: 20px;">
		<legend>Datos del Paciente</legend>
		
		<b>Nombre:</b> <?php echo utf8_encode($fila['pac_nom'])." ".utf8_encode($fila['pac_ap']); ?><br />
		<b>Dirección:</b> <?php echo utf8_encode($fila['pac_dir']); ?>
		<?php if($fila['e_nota'] != ""){ ?>
			<br /><br />
			<b>Nota:</b><br /><?php echo utf8_encode($fila['e_nota']); ?>
		<?php } ?>
	</fieldset>
	
	<br />
	
	<fieldset style="width: 540px; margin-left: 20px;">
		<legend>Datos de la Consulta</legend>
		
		<?php
			while($fila2 = $consulta->fetch_assoc()){
				echo '
					<b>Producto:</b> '.utf8_encode($fila2['n_nombre']).'
					<b>Costo:</b> '.utf8_encode($fila2['q_costo']).'
				';
				if($fila2['e_nota'] != "")
					echo '<br /><b>Nota:</b> '.utf8_encode($fila2['e_nota']);
				echo '
					<br />
				';
			}
		?>
	</fieldset>
</div>

<?php $mysqli->close(); ?>
