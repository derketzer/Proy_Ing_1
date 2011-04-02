$(document).ready(function(){
	var wa = $("#caja-login").width();
	var ha = $("#caja-login").height();
	var wb = $(window).width();
	var hb = $(window).height();

	$("#caja-login").css("top", (hb-ha)/2);
	$("#caja-login").css("left", (wb-wa)/2);
});

function loguear(){
	$("#md5_pass").val(MD5($("#challenge").val()+MD5($("#password").val())));
	$("#password").val("");
	$("#challenge").val("");

	$("#login-form").submit();
}