$(document).ready(function() {
  var eyeIconSrc = $('#icono-Ojo').data('src');
  $('#icono-Ojo').attr('src', eyeIconSrc);

  $('#toggle-clave').on('click', function() {
    var passwordField = $('#txtpassword');
    var eyeIcon = $('#icono-Ojo');

    if (passwordField.attr('type') === 'password') {
      passwordField.attr('type', 'text');
      eyeIcon.attr('src', eyeIcon.data('closed'));
    } else {
      passwordField.attr('type', 'password');
      eyeIcon.attr('src', eyeIcon.data('src'));
    }
  });
});
