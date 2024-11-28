$(document).ready(function() {
    const mensajeEmergente = $('#mensaje-emergente');
    if (mensajeEmergente.length) { 
        setTimeout(function() {
            mensajeEmergente.fadeOut(1000, function() { 
                $(this).remove(); 
            });
        }, 2500); 
    }
});