<?php

	$secciones = array(
		"Consultas" => array(
			"Nueva" => "agregar_consultas.php",
			"Consultas" => "listado_consultas.php",
			//"Pendientes" => "",
			//"B&uacute;squeda" => ""
		),
		"Campanas" => array(
			"Campana" => "listado_campanas.php",
			"Nuevo" => "agregar_campanas.php"
		),
		"Pacientes" => array(
			"Pacientes" => "listado_pacientes.php",
			"Nuevo" => "agregar_pacientes.php"
		),
		//"Procesos Operativos" => "",
		"Productos" => array(
			"Productos" => "listado_productos.php",
			"Nuevo" => "agregar_productos.php"
		),
		"Empleados" => array(
			"Empleados" => "listado_empleados.php",
			"Nuevo" => "agregar_empleados.php",
			"Asignar Campa&ntilde;a" => "asignar_campanas.php",
			"Asistencias" => "asistencias.php",
		),
		"Reportes" => array(
			"Reporte Ventas" => "reporte_ventas.php"
		),
		"Inventarios" => array(
			"Inventarios" => "listado_inventarios.php",
			"Nuevo" => "agregar_inventarios.php"
		),
		"Proveedores" => array(
			"Proveedores" => "listado_proveedores.php",
			"Nuevo" => "agregar_proveedores.php"
		)
	);

	$permisos = array(
		"agregar_empleados.php" => "2",
		"agregar_productos.php" => "2",
		"agregar_proveedores.php" => "2",
		"agregar_inventarios.php" => "2",
		"agregar_pacientes.php" => "2",
		"agregar_campanas.php" => "2",
		"agregar_consultas.php" => "2",

		"editar_empleados.php" => "2",
		"editar_productos.php" => "2",
		"editar_proveedores.php" => "2",
		"editar_inventarios.php" => "2",
		"editar_pacientes.php" => "2",
        	"editar_campanas.php" =>"2",		

		"borrar_empleados.php" => "2",
		"borrar_productos.php" => "2",
		"borrar_proveedores.php" => "2",
		"borrar_inventarios.php" => "2",
		"borrar_pacientes.php" => "2",	
	       "borrar_campanas.php"  => "2",
		"borrar_consultas.php" => "2",	

		"listado_empleados.php" => "2",
		"listado_productos.php" => "2",
		"listado_proveedores.php" => "2",
		"listado_inventarios.php" => "2",
		"listado_pacientes.php" => "2",			
		"listado_campanas.php" => "2",
		"listado_consultas.php" => "2",
		
		"detalles_consultas.php" => "2",
		"asignar_campanas.php" => "2",
		"asistencias.php" => "2",
		"registrar_asistencia.php" => "2",

		"reporte_ventas.php" => "2"
	);

	$niveles = array(
		1=>"Administrador",
		2=>"",
		3=>"Secretaria",
		4=>"",
		5=>"",
		6=>"",
		7=>"",
		8=>"Doctor",
		9=>"",
		10=>""
	);
	
	$sexo = array(
		1=>"Hombre",
		2=>"Mujer"
	);
	
	$homeLanding = array(
		"1" => "asistencias.php"
	);

?>
