function Solo_Texto(e) {
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[\ba-zA-Z\s-'()áéíóúÁÉÍÓÚñÑ]$/;
    if (AllowRegex.test(character)) return true; 
    return false; 
}