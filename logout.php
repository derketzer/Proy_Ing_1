<?php
	session_start();

	$_SESSION['UsuarioEmp'] = "";
	$_SESSION['IdEmp'] = "";
	$_SESSION['PasswordEmp'] = "";
	$_SESSION['LogueadoEmp'] = "";
	$_SESSION['FechaEmp'] = "";
	$_SESSION['NivelEmp'] = "";

	session_destroy();

	header("location: index.php");
?>