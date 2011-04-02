<?php

	/* Esta funcion sirver para convertir los meses en numero a letra
	   Pude haber utilizado simplemente:
	   	date("F", mktime(0, 0, 0, $mes))
	   Pero el problema es que depende del server, y para no meterme con
	   Variables extrañas de PHP y eso, opté por hacerlo a pie.
	*/
	function mestostr($mes){
		switch($mes){
			case 1: return "Enero"; break;
			case 2: return "Febrero"; break;
			case 3: return "Marzo"; break;
			case 4: return "Abril"; break;
			case 5: return "Mayo"; break;
			case 6: return "Junio"; break;
			case 7: return "Julio"; break;
			case 8: return "Agosto"; break;
			case 9: return "Septiembre"; break;
			case 10: return "Octubre"; break;
			case 11: return "Noviembre"; break;
			case 12: return "Diciembre"; break;
		}
	}
	
	
	
	function friendly($nombre){
		$invalidos = array(
			ñ,
			á,
			é,
			í,
			ó,
			ú,
			à,
			è,
			ì,
			ò,
			ù,
			" "
		);
		
		$validos = array(
			n,
			a,
			e,
			i,
			o,
			u,
			a,
			e,
			i,
			o,
			u,
			"-"
		);
		
		return strtolower(str_replace($invalidos, $validos, $nombre));
	}
	
	function generaCache($archivo, $id, $url, $mysqli){
		$target_path = $_SERVER['DOCUMENT_ROOT'].$url;

		ob_start();
			include($_SERVER['DOCUMENT_ROOT']."/caches/".$archivo);
			$source = ob_get_contents();
		ob_end_clean();

		$fp = fopen($target_path, 'w');
		fwrite($fp, $source);
		fclose($fp);
		chmod($target_path, 0755);
	}

	function cargaCSS($url){
		return '<link rel="stylesheet" type="text/css" href="'.$url.'" />';
	}

	function cargaJS($url){
		return '<script src="'.$url.'" type="text/javascript"></script>';

	}

?>
