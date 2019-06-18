function valida_anios(e) {
    var anioInicio = document.getElementById('inputAnioInicio').value;
    var anioFin = document.getElementById('inputAnioFin').value;
    if (anioFin.length == 0)
        return true;
    else {
        if (anioInicio <= anioFin)
            return true;
        else {
            bootbox.setLocale('es');
            bootbox.alert("El Año de Fin del Plan debe ser mayor o igual al Año de Inicio");
            return false;
        }
    }
}