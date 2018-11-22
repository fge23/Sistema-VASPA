$(document).ready(function(){
  $.ajax({
    type: 'POST',
    url: '../lib/consultaAjax/cargarCarreras.php',
    //data: {'peticion': 'cargar_listas'}
  })
  .done(function(carreras){
    $('#carrera').html(carreras)
  })
  .fail(function(){
    alert('Hubo un error al cargar las carreras')
  })

  $('#carrera').on('change', function(){
    var id = $('#carrera').val()
    var anio = $('#anio').val()
    //alert(anio)
    //alert(id)
    $.ajax({
      type: 'POST',
      url: '../lib/consultaAjax/cargarAsignaturas.php',
      data: {'id': id,
       'anio': anio}
    })
    .done(function(listas_rep){
      $('#asignatura').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un error al cargar las asignaturas')
    })
  })
/*
  $('#plan').on('change', function(){
    var id = $('#plan').val()
    //alert(id)
    $.ajax({
      type: 'POST',
      url: '../app/cargarAsignaturas.php',
      data: {'id': id}
    })
    .done(function(listas_rep){
      $('#asignatura').html(listas_rep)
    })
    .fail(function(){
      alert('Hubo un error al cargar las asignaturas')
    })
  })
*/
})