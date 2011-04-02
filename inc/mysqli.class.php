<?php

	class db extends MySQLi{
		private static $DBhost_local = "localhost";
		private static $DBhost_remote = ""; // Aqui debe ir un IP
		private static $DBuser = "ketzer_cimc";
		private static $DBpass = "gCV2srnRbHtP0X3eFua9";
		private static $DBname = "ketzer_cimc";
		private static $port = "3306";
		private static $socket = "";

		function __construct($online=true){
			try{
				if($online){
					parent::__construct(self::$DBhost_remoto, self::$DBuser, self::$DBpass, self::$DBname, self::$port, self::$socket);
				}else{
					parent::__construct(self::$DBhost_local, self::$DBuser, self::$DBpass, self::$DBname, self::$port, self::$socket);
				}

				if(mysqli_connect_errno()){
					parent::close();
					throw new Exception("No se pudo conectar a la Base de Datos");
				}
			}catch(Exception $e){
				echo "<br />Error: ".$e->getMessage()."<br />";
			}
		}

		function query($query_string){
			if(strpos(strtoupper($query_string), "SELECT") === false)
				$this->audita($query_string);

			return parent::query($query_string);
		}

		function query_array($query_string){
			if(strpos(strtoupper($query_string), "SELECT") === false)
				$this->audita($query_string);

			$resultado = array();
			$consulta = parent::query($query_string);
			while($fila = $consulta->fetch_assoc()){
				array_push($resultado, $fila);
			}
			$consulta->close();

			return $resultado;
		}

		function select($tabla="", $campos="", $where="", $order="", $debug=false){
			if($tabla == ""){
				return "Falta tabla!";
			}else{
				if($campos==array() || $campos==""){
					$campos = "*";
				}else{
					if(is_array($campos))
						$campos = implode(",", $campos);
				}

				$query_string = "SELECT ".$campos." FROM ".$tabla;

				if($where!="" || $where!=array()){
					if(is_array($where)){
						$query_string .= " WHERE ";

						foreach($where as $campo=>$valor){
							$query_string .= $campo."='".(addslashes($valor))."' AND ";
						}

						$query_string = substr($query_string, 0, -5);
					}else if($where!=""){
						$query_string .= " WHERE ".$where;
					}
				}

				if($order!="" || $order!=array()){
					if(is_array($order)){
						$query_string .= " ORDER BY ";

						foreach($order as $campo=>$valor){
							$query_string .= $campo." ".(addslashes($valor)).", ";
						}

						$query_string = substr($query_string, 0, -2);
					}else if($order!=""){
						$query_string .= " ORDER BY ".$order;
					}
				}
				
				if($debug)
					echo $query_string;

				return parent::query($query_string);
			}
		}

		function insert($tabla="", $campos="", $debug=false){
			if($campos['guardar']) unset($campos['guardar']);

			if($tabla == ""){
				return "Falta tabla!";
			}else{
				if($campos==array() || $campos==""){
					return "Faltan los campos a insertar";
				}else{
					$query_string = "INSERT INTO ".$tabla." (";
					$listado_campos = "";
					$listado_valores = "";

					foreach($campos as $key=>$valor){
						$listado_campos .= $key.",";

						if($key == "pw_password")
							$valor = MD5($valor);
						
						$listado_valores .= "'".(addslashes($valor))."',";
					}

					$listado_campos = substr($listado_campos, 0, -1);
					$listado_valores = substr($listado_valores, 0, -1);

					$query_string .= $listado_campos.")VALUES(".$listado_valores.")";
					
					if($debug)
						echo $query_string;

					$this->audita($query_string);

					return parent::query($query_string);
				}
			}
		}

		function delete($tabla="", $where="", $debug=false){
			if($tabla == ""){
				return "Falta tabla!";
			}else{
				if($where==""){
					return "Falta la condici&oacute;n!";
				}else{
					if(is_array($where) && $where!=array()){
						$query_string = "DELETE FROM ".$tabla." WHERE ";

						foreach($where as $campo=>$valor){
							$query_string .= $campo."='".(addslashes($valor))."' AND ";
						}
						$query_string = substr($query_string, 0, -5);
					}else{
						$query_string = "DELETE FROM ".$tabla." WHERE ".$where;
					}
					
					if($debug)
						echo $query_string;
					
					$this->audita($query_string);

					return parent::query($query_string);
				}
			}
		}

		function update($tabla="", $campos="", $where="", $debug=false){
			if($campos['guardar']) unset($campos['guardar']);
			if($tabla == ""){
				return "Falta tabla!";
			}else{
				if($campos==array() || $campos==""){
					return "Faltan los campos a insertar";
				}else{
					if($where==""){
						return "Falta la condici&oacute;n!";
					}else{
						$donde = "";

						if(is_array($where) && $where!=array()){	
							foreach($where as $campo=>$valor){
								$donde .= $campo."='".(addslashes($valor))."' AND ";
							}
							$donde = substr($donde, 0, -5);
						}else{
							$donde = $where;
						}

						$query_string = "UPDATE ".$tabla." SET ";
						$listado = "";

						foreach($campos as $key=>$valor){
							if($key == "pw_password"){
								if($value=="")
									$valor = $campos['pw_password_old'];
								else
									$valor = MD5($valor);
							}

							if(strpos($key, "_old") === false && !array_key_exists($key, $where))
								$listado .= $key."='".(addslashes($valor))."',";
						}
						$listado = substr($listado, 0, -1);
						$query_string .= $listado." WHERE ".$donde;
						
						if($debug)
							echo $query_string;

						$this->audita($query_string);

						return parent::query($query_string);
					}
				}
			}
		}

		function audita($query_string){
			parent::query("INSERT INTO auditoria (id_query,query,fecha,id_empleado)VALUES(NULL,'".(addslashes($query_string))."',NOW(),".$_SESSION['IdEmp'].")");
		}
	}

?>
