var nombre_busqueda;

$(document).ready(function(){
	$("#busca-boton").click(function(){
		nombre_busqueda = $("#campana_nombre").val();
		
		$.ajax({
			url: "ajax/buscar.php",
			type: "POST",
			data: "nombre_busqueda="+nombre_busqueda+"&tipo_busqueda=1",
			dataType: "html",
			success: function(msg){
				if(msg != ""){
					$("#caja-resultados").html(msg);
				}else{
					alert(msg);
				}
			}
		});
		
		$("#caja-resultados").show();
	});
});

var id_camp;
var nom_camp;
var campanas = 0;

function aResultado(obj){
	id_camp = $(obj).attr("val-id");
	nom_camp = $(obj).attr("val-nombre");
	
	$("#caja-resultados-agregados").append('<div class="busqueda-resultado" id="agregado-'+id_camp+'" val-id="'+id_camp+'" onclick="javascript:qResultado(this);">'+nom_camp+'</div>');
	$("#forma-producto").append('<input type="hidden" id="input_camp_'+id_camp+'" name="campana['+campanas+']" value="'+id_camp+'" />');
	campanas++;
}

function qResultado(obj){
	id_camp = $(obj).attr("val-id");
	$("#agregado-"+id_camp).remove();
	$("#input_camp_"+id_camp).remove();
}
