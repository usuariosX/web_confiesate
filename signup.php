<?php
// Habilitar informes de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
session_start();

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "150921jacaA";
$dbname = "usuarios";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $opcion = $conn->real_escape_string($_POST['options']);

    // Comprobar que se ha seleccionado una opción
    if (empty($opcion)) {
        $_SESSION['message'] = "Por favor, selecciona una opción.";
        header("Location: signup.php"); // Redirigir a la misma página
        exit();
    }

    // Comprobar si el nombre de usuario ya existe
    $checkUsername = "SELECT * FROM usuarios WHERE username='$username'";
    $result = $conn->query($checkUsername);
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "El nombre de usuario ya está en uso.";
        header("Location: signup.php");
        exit();
    }

    // Comprobar si el email ya existe
    $checkEmail = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        $_SESSION['message'] = "El correo electrónico ya está en uso.";
        header("Location: signup.php");
        exit();
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (username, email, password, opcion) VALUES ('$username', '$email', '$password', '$opcion')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Cuenta creada con éxito.";
        header("Location: success.html"); // Redirigir a la página de éxito
        exit();
    } else {
        $_SESSION['message'] = "Error al crear la cuenta: " . $conn->error;
        header("Location: signup.php");
        exit();
    }
}

$conn->close();
?>