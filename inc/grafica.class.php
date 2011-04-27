<?php

	class grafica{
		private $id;
		private $titulo;
		private $datosX;
		private $datosY;
		private $tipo;
		private $height;
		private $width;
		private $renderer;
		private $leyenda = false;

		private static $includes = '
			<link rel="stylesheet" type="text/css" href="/css/jqplot.css" />
			<script src="/js/jqplot.min.js" type="text/javascript"></script>
		';

		function __construct($titulo="", $datosX=array(), $datosY=array(), $tipo=0, $width="800", $height="600"){
			$this->titulo = $titulo;
			$this->datosX = $datosX;
			$this->datosY = $datosY;
			$this->setTipo($tipo);
			$this->width = $width;
			$this->height = $height;
			$this->id = rand();
		}

		function setTitulo($titulo=""){
			$this->titulo = $titulo;
		}

		function setX($datos=array(), $delim=""){
			if($datos != array()){
				if(is_array($datos))
					$this->datosX = $datos;
				else
					$this->datosX = explode($delim, $datos);
			}
		}

		function addX($titulo="", $datos=array()){
			if($datos!=array())
				$this->datosX[$titulo] = $datos;
		}

		function setY($datos=array(), $delim=""){
			if($datos != array()){
				if(is_array($datos))
					$this->datosY = $datos;
				else
					$this->datosY = explode($delim, $datos);
			}
		}

		function setTipo($tipo=0){
			switch($tipo){
				case 0:
					$tipo = "";
					$renderer = '$.jqplot.LineRenderer';
				break;

				case 1:
					$tipo = '<script src="/js/jqplot/jqplot.pieRenderer.min.js" type="text/javascript"></script>';
					$renderer = '$.jqplot.PieRenderer';
				break;
			}

			$this->tipo = $tipo;
			$this->renderer = $renderer;
		}

		function setHeight($height="600"){
			$this->height = intval($height);
		}

		function setWidth(){
			$this->width = intval($width);
		}

		function setID($id=""){
			$this->id = $id;
		}

		function getID(){
			return $this->id;
		}

		function setLeyenda($leyenda=false){
			$this->leyenda = $leyenda;
		}

		function genera_arreglos(){
			$arreglos = array();

			foreach($this->datosX as $label=>$dataX){
				$arreglos[$label] = "[";

				foreach($dataX as $key=>$val){
					if($val != 0)
						$arreglos[$label] .= "[".$this->datosY[$key].",".$val."],";
				}

				$arreglos[$label] = substr($arreglos[$label], 0, -1);
				$arreglos[$label] .= "]";
			}

			return $arreglos;
		}

		function dibuja(){
			echo self::$includes;
			echo $this->tipo;
			echo '<div id="'.$this->id.'" style="height: '.$this->height.'px; width: '.$this->width.'px; margin: auto;"></div>';

			$arreglos = $this->genera_arreglos();

			echo "
				<script>
			";

			$labels = "";
			$lineas = "";
			$n = 1;

			foreach($arreglos as $label=>$valores){
				echo "line".$n." = ".$valores.";";
				$labels .= "{label:'".$label."'},";
				$lineas .= "line".$n.",";

				$n++;
			}

			$labels = substr($labels, 0, -1);
			$lineas = substr($lineas, 0, -1);

			echo "
					plot1 = $.jqplot('".$this->id."', [".$lineas."], {
						title: '".$this->titulo."',
						seriesDefaults:{renderer: ".$this->renderer."},
						series:[".$labels."]
			";

			if($this->leyenda) echo ",legend:{show:true}";

			echo "
					});
				</script>
			";
		}
	}

?>