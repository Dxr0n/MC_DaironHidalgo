window.onload = function() {
    var cargaElement = document.getElementById('carga');
    
    if (cargaElement) {
        cargaElement.style.transition = 'opacity 2s';
        cargaElement.style.opacity = 0;

        setTimeout(function() {
            cargaElement.style.display = 'none';
        }, 2200);  
    }
}
