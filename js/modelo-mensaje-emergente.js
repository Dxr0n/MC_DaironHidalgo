document.addEventListener('DOMContentLoaded', function() {
    const mensajeEmergente = document.getElementById('mensaje-emergente');
    
    if (mensajeEmergente) { 
        setTimeout(function() {
            mensajeEmergente.style.transition = 'opacity 1s';
            mensajeEmergente.style.opacity = 0;

            setTimeout(function() {
                mensajeEmergente.remove();
            }, 1000);  
        }, 2500);  
    }
});
