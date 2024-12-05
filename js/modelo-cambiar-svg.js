document.addEventListener('DOMContentLoaded', function () {
    let activeLink = null;

    const menuLinks = document.querySelectorAll('.menu a');

    menuLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const clickedLink = this; 
            const icon = clickedLink.querySelector('.menu-icon');  

            const allIcons = document.querySelectorAll('.menu-icon');
            allIcons.forEach(function (resetIcon) {
                resetIcon.setAttribute('src', resetIcon.getAttribute('data-default-src'));
            });

            if (icon) {
                icon.setAttribute('src', icon.getAttribute('data-alt-src'));
            }

            activeLink = clickedLink;

            window.location.href = clickedLink.getAttribute('href');
        });
    });
});
