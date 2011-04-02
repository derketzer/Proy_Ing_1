<?php

	class form{
		private $method = "";
		private $action = "";
		private $name = "";
		private $id = "";
		private $enctype = "";
		private $class = "";

		function __construct(){
		}

		function start($options=array()){
			$string = "";
			if($options != array()){
				$string = '<form';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= ">";
			}
			return $string;
		}

		function end(){
			return "</form>";
		}

		function input($options=array()){
			$string = "";
			if($options != array()){
				$string = '<input type="text"';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= " />";
			}
			return $string;
		}

		function secret($options=array()){
			$string = "";
			if($options != array()){
				$string = '<input type="password"';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= " />";
			}
			return $string;
		}

		function textarea($options=array()){
		}

		function hidden($options=array()){
			$string = "";
			if($options != array()){
				$string = '<input type="hidden"';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= " />";
			}
			return $string;
		}

		function select($ini, $fin, $nombre, $cond=false){
			$select = "";
			$extra = "";
		
			$select = '<select size="1" name="'.$nombre.'" id="'.$nombre.'">';
		
			foreach(range($ini, $fin) as $var){
				if($cond){
					$extra = "";
					if($var == $cond)
						$extra = "selected";
				}
			
				$select .= '<option value="'.$var.'"'.$extra.'>'.$var.'</option>';
			}
			
			$select .= '</select>';
		
			return $select;
		}

		function button($options=array()){
			$string = "";
			if($options != array()){
				$string = '<input type="button"';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= " />";
			}
			return $string;
		}

		function submit($options=array()){
			$string = "";
			if($options != array()){
				$string = '<input type="submit"';
				foreach($options as $key=>$value){
					$string .= ' '.$key.'="'.$value.'"';
				}
				$string .= " />";
			}
			return $string;
		}

		function startFieldset($texto="", $class=""){
			return '<fieldset class="'.$class.'"><legend class="'.$class.'">'.$texto.'</legend>';
		}

		function endFieldset(){
			return "</fieldset>";
		}
	}

?>