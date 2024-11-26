$(document).ready(function() {
  $('#icono-Ojo').attr('src', $('#icono-Ojo').data('src'));

  $('#toggle-clave').on('click', function() {
    var passwordField = $('#txtpassword');
    var eyeIcon = $('#icono-Ojo');

    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      eyeIcon.attr('src', 'img/icono-ojo-cerrado.svg'); 
    } else {
      passwordField.attr('type', 'password');
      eyeIcon.attr('src', 'img/icono-ojo-abierto.svg');  
    }
  });
});
