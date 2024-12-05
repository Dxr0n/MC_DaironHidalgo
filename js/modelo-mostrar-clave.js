document.addEventListener('DOMContentLoaded', function() {
  var eyeIcon = document.getElementById('icono-Ojo');
  var eyeIconSrc = eyeIcon.getAttribute('data-src');
  eyeIcon.setAttribute('src', eyeIconSrc);

  var toggleClave = document.getElementById('toggle-clave');
  
  toggleClave.addEventListener('click', function() {
    var passwordField = document.getElementById('txtpassword');

    if (passwordField.type === 'password') {
      passwordField.type = 'text'; 
      eyeIcon.setAttribute('src', eyeIcon.getAttribute('data-closed'));
    } else {
      passwordField.type = 'password'; 
      eyeIcon.setAttribute('src', eyeIcon.getAttribute('data-src')); 
    }
  });
});
