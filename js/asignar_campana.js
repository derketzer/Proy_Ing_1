var empleado = 0;
var campana = 0;

function buscar(){
	var donde_busco = $("#donde-busco option:selected").val();
	var nombre_busqueda = $("#nombre-busqueda").val();
	var temp = donde_busco.split("-");
	
	if(temp[0] == "empleado")
		tipo_busqueda = 2;
	else
		tipo_busqueda = 1;
	
	$("#caja-resultados").html();
	$("#caja-resultados").hide();

	$.ajax({
		url: "ajax/buscar.php",
		type: "POST",
		data: "nombre_busqueda="+nombre_busqueda+"&donde_busco="+donde_busco+"&tipo_busqueda="+tipo_busqueda,
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
	}else if($(obj).attr("val-tipo") == "campana"){
		if(campana != 0){
			alert("Ya tienes una campaña agregada!");
			return 0;
		}else{
			campana++;
		}
	}
	
	res_id = $(obj).attr("val-id");
	tipo = $(obj).attr("val-tipo");
	nombre = $(obj).attr("val-nombre");
	direccion = $(obj).attr("val-direccion");

	$("#"+tipo+"-nombre").html(nombre);
	$("#"+tipo+"-direccion").html(direccion);
	$("#forma-asigna-campana").append('<input type="hidden" id="input-id-'+tipo+'" name="id_'+tipo+'" value="'+res_id+'" />');	
}

function qResultado(tipo){
	if(tipo == "empleado"){
		if(empleado == 0){
			alert("No hay empleado que quitar!");
			return 0;
		}else{
			empleado--;
		}
	}else if(tipo == "campana"){
		if(campana == 0){
			alert("No hay empleado que quitar!");
			return 0;
		}else{
			campana--;
		}
	}
	
	$("#"+tipo+"-nombre").html("");
	$("#"+tipo+"-direccion").html("");
	$("#input-id-"+tipo).remove();
}
