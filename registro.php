<?php
// Archivo de conexión a la base de datos
require 'database.php';

$message = '';
// Validacion de campos del formulario
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";


    // Preparar la consulta SQL
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bindParam(':email', $_POST['email']);
    // Cifrar la contraseña
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $message = "Usuario creado con éxito";
    } else {
        $message = "Ocurrió un error al crear el usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div>
        <?php if (!empty($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <h1>Registro</h1>
        <form action="registro.php" method='post'>
            <input type="email" name="email" placeholder="Ingrese tu email">
            <input type="password" name='password' placeholder='Ingrese tu contraseña'>
            <button type="submit" value="send">Registrarme</button>
        </form>
        <a href="login.php">Ya tengo una cuenta</a>
    </div>
</body>

</html>