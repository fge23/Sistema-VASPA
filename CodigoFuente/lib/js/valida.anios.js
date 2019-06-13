function valida_anios(e) {
    var anioInicio = document.getElementById('inputAnioInicio').value;
    var anioFin = document.getElementById('inputAnioFin').value;
    if (anioFin.length == 0)
        return true;        
    else {
        if (anioInicio <= anioFin)
            return true;
        else {
            alert("El año de finalización debe ser mayor o igual al de inicio");
            return false;
        }
    }
}