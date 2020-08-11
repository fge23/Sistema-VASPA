jQuery(document).on('submit','#form', function(event){
	event.preventDefault();
	jQuery.ajax({
		url: '../vista/plan.asignaturas.procesar.php',
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
	})
	.done(function(respuesta){
		console.log(respuesta);
		if (!respuesta.error) {

			alert("Las asignaturas se insertaron correctamente.");
			window.location.reload();

		}else{
			alert("Las asignaturas no se insertaron.");
		}
	})
	.fail(function(resp){
		console.log(resp.responseText);
	})
	.always(function(){
		console.log("complete");
	})
});