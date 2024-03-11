<?php 
// Inciar sesion 
session_start();
// Quitar la sesion
session_unset();
// Destruir la sesion
session_destroy();

// Redirigir al home
header('Location: /php-login')
?>