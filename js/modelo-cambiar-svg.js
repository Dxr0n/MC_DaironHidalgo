$(document).ready(function () {
    let activeLink = null; // Almacena el enlace actualmente activo

    // Asocia el evento de clic a cada enlace
    $('.menu a').on('click', function (e) {
        e.preventDefault(); // Evita la navegación automática

        const clickedLink = $(this); // Enlace clickeado
        const icon = clickedLink.find('.menu-icon'); // Encuentra el ícono dentro del enlace

        // Restablece todos los íconos a su estado inicial
        $('.menu-icon').each(function () {
            const resetIcon = $(this);
            resetIcon.attr('src', resetIcon.data('default-src'));
        });

        // Cambia la imagen del ícono del enlace clickeado
        icon.attr('src', icon.data('alt-src'));

        // Actualiza el enlace activo
        activeLink = clickedLink;

        // Redirige manualmente a la URL del enlace clickeado
        window.location.href = clickedLink.attr('href');
    });
});
