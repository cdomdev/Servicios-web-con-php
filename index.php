<?php
// Inicio de la sesion
session_start();
// Conexion a la base de datos
require 'database.php';
// Variable para guardar datos del usuario

$usuario = null;

// Validar datos
if (isset($_SESSION['usuario_id'])) {
    $dataUser = $conn->prepare('SELECT email FROM usuarios WHERE id = :id');
    $dataUser->bindParam(':id', $_SESSION['usuario_id']);
    $dataUser->execute();

    $usuario = $dataUser->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login php</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="contenedor">
        <?php if (!empty($usuario)) : ?>
            <h1>Hola </h1>
            <span>Bienvenido: <?= $usuario['email'] ?>
                <br>Tu sesión fue iniciada con éxito
                <br>
                <a href="logout.php" id="logout">Cerrar sesión</a>
            <?php else : ?>
                <h1>App con PHP</h1>
                <h2>Inicia sesión en tu cuenta</h2>
                <a href="login.php">Login en la app</a> or <a href="registro.php">Registrarme</a>
            <?php endif; ?>
    </div>
</body>

</html>