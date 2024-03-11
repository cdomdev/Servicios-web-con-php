<?php
$dbhost = "localhost:3308";
$dbuser = "root"; 
$dbpass = ""; 
$database = "php_database"; 

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$database", $dbuser, $dbpass);
    // Configuración de la conexión con PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // En caso de error en la conexión, muestra el mensaje de error
    die('Fallo la conexión a la base de datos: ' . $e->getMessage());
}
?>
