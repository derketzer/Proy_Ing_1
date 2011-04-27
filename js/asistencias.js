function aResultado(obj){
	res_id = $(obj).attr("val-id");
	nombre = $(obj).attr("val-nombre");
	id_campana = $(obj).attr("val-campana");
	
	$.ajax({
		url: "ajax/registrar_asistencia.php",
		type: "POST",
		data: "id_empleado="+res_id+"&id_campana="+id_campana+"&asistencia=1",
		dataType: "html",
		success: function(msg){
			if(msg == ""){
				$("#lista-asistencias").append('\
					<div class="busqueda-resultado" onclick="javascript:qResultado(this);" val-nombre="'+nombre+'" val-campana="'+id_campana+'" val-id="'+res_id+'" style="width:600px;">\
						'+nombre+'\
					</div>\
				');
				$(obj).remove();
			}else{
				alert("No se pudo registrar la asistencia!");
			}
		}
	});
}

function qResultado(obj){
	res_id = $(obj).attr("val-id");
	nombre = $(obj).attr("val-nombre");
	campana = $(obj).attr("val-campana");
	
	$.ajax({
		url: "ajax/registrar_asistencia.php",
		type: "POST",
		data: "id_empleado="+res_id+"&id_campana="+campana+"&inasistencia=1",
		dataType: "html",
		success: function(msg){
			if(msg == ""){
				$("#lista-activos").append('\
					<div class="busqueda-resultado" onclick="javascript:aResultado(this);" val-nombre="'+nombre+'" val-id="'+res_id+'">\
						'+nombre+'\
					</div>\
				');
				$(obj).remove();
			}else{
				alert("No se pudo registrar la inasistencia!");
			}
		}
	});
}
