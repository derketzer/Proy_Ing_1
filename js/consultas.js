var sels = 0;
var empleado = 0;
var paciente = 0;

$(document).ready(function(){
	$("#busca-boton").click(function(){
		$("#caja-resultados").show();
	});
});

function nuevo_producto(){
	$("#listado-productos").append('<select id="producto-select-'+sels+'" onchange="checaProducto(this);" class="formulario-select select-corto" name="producto['+sels+']">'+productos+'</select><input id="producto-costo-'+sels+'" type="text" name="producto_costo['+sels+']" class="formulario-input costo-corto" />');
	sels++;
}

function buscar(){
	var donde_busco = $("#donde-busco option:selected").val();
	var nombre_busqueda = $("#nombre-busqueda").val();
	
	$("#caja-resultados").html();
	$("#caja-resultados").hide();

	$.ajax({
		url: "ajax/buscar.php",
		type: "POST",
		data: "nombre_busqueda="+nombre_busqueda+"&donde_busco="+donde_busco+"&tipo_busqueda=2",
		dataType: "html",
		success: function(msg){
			if(msg != ""){
				$("#caja-resultados").html(msg);
				$("#caja-resultados").show();
			}else{
				alert("No se encontraron resultados!");
			}
		}
	});
}

function aResultado(obj){
	if($(obj).attr("val-tipo") == "empleado"){
		if(empleado != 0){
			alert("Ya tienes un empleado agregado!");
			return 0;
		}else{
			empleado++;
		}
	}else if($(obj).attr("val-tipo") == "paciente"){
		if(paciente != 0){
			alert("Ya tienes un paciente agregado!");
			return 0;
		}else{
			paciente++;
		}
	}
	
	res_id = $(obj).attr("val-id");
	tipo = $(obj).attr("val-tipo");
	nombre = $(obj).attr("val-nombre");
	direccion = $(obj).attr("val-direccion");

	$("#"+tipo+"-nombre").html(nombre);
	$("#"+tipo+"-direccion").html(direccion);
	$("#forma-consulta").append('<input type="hidden" id="input-id-'+tipo+'" name="id_'+tipo+'" value="'+res_id+'" />');	
}

function qResultado(tipo){
	if(tipo == "empleado"){
		if(empleado == 0){
			alert("No hay empleado que quitar!");
			return 0;
		}else{
			empleado--;
		}
	}else if(tipo == "paciente"){
		if(paciente == 0){
			alert("No hay empleado que quitar!");
			return 0;
		}else{
			paciente--;
		}
	}
	
	$("#"+tipo+"-nombre").html("");
	$("#"+tipo+"-direccion").html("");
	$("#input-id-"+tipo).remove();
}

function checaProducto(obj){
	if($(obj).val() == "-1"){
		prod_id = $(obj).attr("id");
		costo_id = prod_id.replace("select", "costo");
		$("#"+costo_id).remove();
		$(obj).remove();
	}else{
		prod_id = $(obj).attr("id");
		costo_id = prod_id.replace("select", "costo");
		prod_costo = $("#"+prod_id+" option:selected").attr("val-costo");
		$("#"+costo_id).val(prod_costo);
	}
}
