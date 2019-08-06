$(buscar_datos());
/**
 * Este codigo filtra los años de un programa pdf
 * @param {type} consulta
 * @returns {undefined}
 */
function buscar_datos(consulta){
	var cod = $('#codCarrera').val()
        //alert(cod)
        $.ajax({
		url: '../lib/consultaAjax/buscar.anios.pdf.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {'consulta': consulta,
                    'cod': cod}
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