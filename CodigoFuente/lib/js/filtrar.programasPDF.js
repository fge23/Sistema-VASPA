$(buscar_datos());

function buscar_datos(consulta){
        var cod = $('#codCarrera').val()
        var anio = $('#anio').val()
	$.ajax({
		url: '../lib/consultaAjax/buscar.programasPDF.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {'consulta': consulta,
                'cod': cod,
                'anio': anio}
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}


$(document).on('keyup','#caja_busqueda', function(){
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
});