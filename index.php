<?php
	@require_once("inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/form.class.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	session_start();

	$_SESSION['challenge'] = mt_rand();
	
	$mysqli = new db(false);

	$consulta = $mysqli->select(
		"campana",
		array("id_campana","n_nombre")
	);
?>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link href='http://fonts.googleapis.com/css?family=Radley' rel='stylesheet' type='text/css'>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script> 
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js" type="text/javascript"></script>
		<script src="js/md5.js" type="text/javascript"></script>
		<script src="js/login.js" type="text/javascript"></script>
	</head>

	<body>

		<div id="caja-login">

			<div id="login-titulo">CIMC</div>

			<form method="POST" action="check.php" id="login-form">
				Usuario: &nbsp;&nbsp; <input type="text" name="usuario" id="usuario" />
				<br />
				Password: <input type="password" name="password" id="password" />
				<br /><br />
				
				Campa&ntilde;a: &nbsp;&nbsp;
				<select name="id_campana">
				
				<?php
					while($fila = $consulta->fetch_assoc()){
						echo '<option value="'.$fila['id_campana'].'">'.$fila['n_nombre'].'</option>';
					}
				?>
				</select>
				
				<br />

				<input type="button" name="enviar" value="Entrar" id="login-boton" onclick="loguear();" />

				<input type="hidden" name="challenge" value="<?php echo $_SESSION['challenge']; ?>" id="challenge" />

				<input type="hidden" name="md5_pass" value="" id="md5_pass" />

				<input type="hidden" name="url" value="<?php echo $_GET['url']; ?>" />

			</form>
		</div>

	</body>

</html>
