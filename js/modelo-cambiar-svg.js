$(document).ready(function () {
    let activeLink = null; 
    $('.menu a').on('click', function (e) {
        e.preventDefault();
        const clickedLink = $(this); 
        const icon = clickedLink.find('.menu-icon'); 

        $('.menu-icon').each(function () {
            const resetIcon = $(this);
            resetIcon.attr('src', resetIcon.data('default-src'));
        });

        icon.attr('src', icon.data('alt-src'));

        activeLink = clickedLink;

        window.location.href = clickedLink.attr('href');
    });
});
