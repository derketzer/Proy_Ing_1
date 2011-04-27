$(document).ready(function(){
	tinyMCE.init({
		mode : "exact",
		elements : "input-tiny",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu",
		        
		// Theme options - button# indicated the row# only
		theme_advanced_buttons1 : "pasteword,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,|,cleanup,code",
		theme_advanced_buttons2 : "table,hr,removeformat,visualaid,|,sub,sup,|,charmap,fullscreen",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : true,
		apply_source_formatting : true,
		force_p_newlines : true,	
		relative_urls : true
	});

	$("#fecha-input").datepicker({
		showOn: "both",
		buttonImage: "/img/calendario.png",
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd",
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		changeMonth: true,
		changeYear: true,
		onSelect: function(dateText){
			var fecha = dateText.split("-");
			$("#dia option:eq("+parseInt(fecha[2]-1)+")").attr("selected", true);
			$("#mes option:eq("+parseInt(fecha[1]-1)+")").attr("selected", true);
			$("#anho option:contains("+fecha[0]+")").attr("selected", true);
		}
	});

	$("#fecha-input2").datepicker({
		showOn: "both",
		buttonImage: "/img/calendario.png",
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd",
		closeText: 'Cerrar',
		prevText: '&#x3c;Ant',
		nextText: 'Sig&#x3e;',
		currentText: 'Hoy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
		'Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
		dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
		weekHeader: 'Sm',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		changeMonth: true,
		changeYear: true,
		onSelect: function(dateText){
			var fecha = dateText.split("-");
			$("#dia2 option:eq("+parseInt(fecha[2]-1)+")").attr("selected", true);
			$("#mes2 option:eq("+parseInt(fecha[1]-1)+")").attr("selected", true);
			$("#anho2 option:contains("+fecha[0]+")").attr("selected", true);
		}
	});
	
	$().piroBox_ext({
		piro_speed : 900,
		bg_alpha : 0.8,
		piro_scroll : true
	});
});

function arregla_fecha(num){
	if(num==undefined)
		num = "";

	fecha = $("#anho"+num).val();
	fecha += "-" + $("#mes"+num).val();
	fecha += "-" + $("#dia"+num).val();

	$("#fecha-input"+num).val(fecha);
}