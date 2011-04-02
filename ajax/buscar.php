<?php

	@require_once("../inc/config.inc.php");
	@require_once($_SERVER['DOCUMENT_ROOT']."inc/mysqli.class.php");

	$tipo_busqueda = intval($_POST['tipo_busqueda']);
	$nombre_busqueda = $_POST['nombre_busqueda'];
	$donde_busco = $_POST['donde_busco'];
	$res = "";
	
	if($donde_busco != "")
		$donde_busco = explode("-", $donde_busco); //0 es tabla, 1 es campo
	
	if($tipo_busqueda != ""){
		$mysqli = new db(false);
		
		switch($tipo_busqueda){
			case 1:
				$consulta = $mysqli->select(
					"campana",
					"id_campana,n_nombre,a_direccion",
					"n_nombre LIKE '%".$nombre_busqueda."%'",
					array("n_nombre" => "ASC")
				);
			
				if($consulta->num_rows != 0){
					while($fila = $consulta->fetch_assoc()){
						$res .= '
							<div class="busqueda-resultado" onclick="javascript:aResultado(this);" val-nombre="'.$fila['n_nombre'].'" val-id="'.$fila['id_campana'].'" val-direccion="'.$fila['a_direccion'].'" val-tipo="'.$donde_busco[0].'">
								'.$fila['n_nombre'].'
							</div>
						';
					}
			
					$max = ceil($fila['cuantos']/5);
					$max = ($max==0)?"1":$max;
				
					if($max>1){
						$res .= '
							<div id="busqueda-links">
								<div id="busqueda-paginado"><a id="busqueda-anterior">&lt;</a> | <a id="busqueda-siguiente">></a></div>
								<div id="busqueda-paginas">1/'.$max.'</div>
							</div>
						';
					}
				}
			
				$consulta->close();
			break;
			
			case 2:
				if($donde_busco != "" && $nombre_busqueda != ""){
					$consulta = $mysqli->select(
						$donde_busco[0],
						"id_".$donde_busco[0].",n_nombre,n_apellido,a_direccion",
						$donde_busco[1]." LIKE '%".$nombre_busqueda."%'",
						array("n_nombre" => "ASC")
					);
				
					if($consulta->num_rows != 0){
						while($fila = $consulta->fetch_assoc()){
							$res .= '
								<div class="busqueda-resultado" onclick="javascript:aResultado(this);" val-nombre="'.$fila['n_nombre'].' '.$fila['n_apellido'].'" val-id="'.$fila['id_'.$donde_busco[0]].'" val-tipo="'.$donde_busco[0].'" val-direccion="'.addslashes($fila['a_direccion']).'">
									'.$fila['n_nombre'].' '.$fila['n_apellido'].'
								</div>
							';
						}
				
						$max = ceil($fila['cuantos']/5);
						$max = ($max==0)?"1":$max;
					
						if($max>1){
							$res .= '
								<div id="busqueda-links">
									<div id="busqueda-paginado"><a id="busqueda-anterior">&lt;</a> | <a id="busqueda-siguiente">></a></div>
									<div id="busqueda-paginas">1/'.$max.'</div>
								</div>
							';
						}
					}
				
					$consulta->close();
				}
			break;
			
			case 3:
				if($donde_busco != "" && $nombre_busqueda != ""){
					$consulta = $mysqli->select(
						$donde_busco[0],
						"id_".$donde_busco[0].",n_nombre,a_direccion",
						$donde_busco[1]." LIKE '%".$nombre_busqueda."%'",
						array("n_nombre" => "ASC")
					);
				
					if($consulta->num_rows != 0){
						while($fila = $consulta->fetch_assoc()){
							$res .= '
								<div class="busqueda-resultado" onclick="javascript:aResultado(this);" val-nombre="'.$fila['n_nombre'].' '.$fila['n_apellido'].'" val-id="'.$fila['id_'.$donde_busco[0]].'" val-tipo="'.$donde_busco[0].'" val-direccion="'.addslashes($fila['a_direccion']).'">
									'.$fila['n_nombre'].' '.$fila['n_apellido'].'
								</div>
							';
						}
				
						$max = ceil($fila['cuantos']/5);
						$max = ($max==0)?"1":$max;
					
						if($max>1){
							$res .= '
								<div id="busqueda-links">
									<div id="busqueda-paginado"><a id="busqueda-anterior">&lt;</a> | <a id="busqueda-siguiente">></a></div>
									<div id="busqueda-paginas">1/'.$max.'</div>
								</div>
							';
						}
					}
				
					$consulta->close();
				}
			break;
		}
		
		echo utf8_encode($res);
		
		$mysqli->close();
	}

?>
