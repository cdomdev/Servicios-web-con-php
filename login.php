<?php
// Incluir el archivo que contiene la conexión a la base de datos
require 'database.php'; 

// Redirecciona al usuario a la página principal si ya tiene una sesión activa
if(isset($_SESSION['usuario_id'])){
    header('Location: /php-login'); 
}

// Inicio de la sesión
session_start();

// Validación de los campos del formulario de inicio de sesión
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    // Consulta a la base de datos para obtener el usuario por su correo electrónico
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email=:email');

    
    // Vincula el parámetro :email con el valor proporcionado en el formulario
    $records->bindParam(':email', $_POST['email']);
    
    // Ejecuta la consulta
    $records->execute();

    // Obtiene la información del usuario desde la base de datos
    $passwordDb = $records->fetch(PDO::FETCH_ASSOC);

    // Variable para mensaje de error o éxito
    $message = '';

    // Verifica si se encontró un usuario con el correo electrónico proporcionado y si la contraseña es correcta
    if (count($passwordDb) > 0 && password_verify($_POST['password'], $passwordDb['password'])) {
        // Si el usuario y la contraseña son válidos, establece la sesión del usuario
        $_SESSION['usuario_id'] = $passwordDb['id'];
        // Redirecciona al usuario a la página principal
        header("Location: /php-login");
    } else {
        // Si las credenciales no son válidas, muestra un mensaje de error
        $message = "Correo o contraseña no son correctos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div>
        <h1>Login</h1>
        <?php
        // Muestra el mensaje de error si existe alguno
        if (!empty($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <!-- Formulario para inicio de sesión -->
        <form action="login.php" method='post'>
            <input type="email" placeholder="Ingrese tu email" name="email">
            <input type="password" placeholder='Ingrese tu contraseña' name="password"> 
            <button type="submit" value="send">Iniciar sesión</button>
        </form>
        <!-- Enlace para redirigir a la página de registro -->
        <a href="registro.php" class="link-form">Quiero registrarme</a>
    </div>
</body>

</html>
