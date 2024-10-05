document.getElementById('signupForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const option = document.getElementById('options').value;
    const terms = document.getElementById('terms').checked;

    if (terms) {
        alert(`Cuenta creada: ${username}, ${email}, Opción: ${option}`);
        // Redirigir al login después de crear cuenta
        window.location.href = "login.html";
    } else {
        alert('Debes aceptar los términos y condiciones.');
    }
});

document.getElementById('loginForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const loginEmail = document.getElementById('loginEmail').value;
    const loginPassword = document.getElementById('loginPassword').value;

    alert(`Iniciando sesión con: ${loginEmail}`);
    // Aquí puedes agregar lógica para iniciar sesión
});
