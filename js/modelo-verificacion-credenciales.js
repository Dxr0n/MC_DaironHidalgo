const LOGIN_URL = 'http://MC_DaironHidalgo.test/controllers/controladorLogin.php';

document.getElementById('login-submit').addEventListener('click', async () => {
    const username = document.getElementById('txtusername').value.trim();
    const password = document.getElementById('txtpassword').value.trim();
    const output = document.getElementById('output');

    if (!username || !password) {
        output.textContent = 'Por favor, completa ambos campos.';
        return;
    }

    try {
        const response = await fetch(LOGIN_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: new URLSearchParams({
                txtusername: username,
                txtpassword: password,
            }),
        });

        const result = await response.json();

        if (result.success && result.redirect) {

            window.location.href = result.redirect;
        } else if (result.redirect) {

            window.location.href = result.redirect;
        } else {

            output.textContent = result.message || 'Error en las credenciales.';
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
        output.textContent = 'Ocurrió un error inesperado. Inténtalo de nuevo más tarde.';
    }
});
