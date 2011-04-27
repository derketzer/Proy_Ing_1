<?php

	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/secciones.inc.php");

	session_start();

	$user = $_POST['usuario'];
	$pass = $_POST['md5_pass'];
	$challenge = $_SESSION['challenge'];

	if($user!="" && $pass!="" && $challenge!=""){

		$mysqli = new db(false);

		$consulta = $mysqli->select(
			"empleado",
			array("id_empleado","t_nivel","n_nombre","n_apellido"),
			array(
				"a_email" => $user,
				"MD5(CONCAT('".$challenge."', pw_password))" => $pass,
				"b_activo" => "1"
			)
		);

		if($consulta->num_rows==1){
			$nivel = $consulta->fetch_assoc();
			$consulta->close();
			$mysqli->close();
			
			$_SESSION['UsuarioEmp'] = $_POST['usuario'];
			$_SESSION['IdEmp'] = $nivel['id_empleado'];
			$_SESSION['PasswordEmp'] = $_POST['md5_pass'];
			$_SESSION['LogueadoEmp'] = true;
			$_SESSION['FechaEmp'] = time();
			$_SESSION['NivelEmp'] = $nivel['t_nivel'];
			$_SESSION['CampanaEmp'] = $_POST['id_campana'];
			$_SESSION['NombreEmp'] = $nivel['n_nombre']. " ".$nivel['n_apellido'];

			if($_POST['url'] != ""){
				header("location: ".$_POST['url']);
			}else{
				if($homeLanding[$nivel['t_nivel']] == ""){
					header("location: index.php");
				}else{
					header("location: ".$homeLanding[$nivel['t_nivel']]);
				}
			}

			exit();
		}else{
			$mysqli->query("INSERT INTO logins VALUES(".$nivel['id_empleado'].", '".$user."', 1, NOW(), '".$_SERVER['REMOTE_ADDR']."')");
			$consulta->close();
			$mysqli->close();
			header("location: index.php");
			exit();
		}
	}else{
		$mysqli->close();
		header("location: index.php");
		exit();
	}

?>
