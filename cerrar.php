<?php
session_start();
// si no es un usuario logeado --> NO PUEDE CERRAR SESION
// --> redirigimos a index con error = 1 en el GET
if (!isset($_SESSION['logeado']) or (!$_SESSION['logeado'])) {
    header('Location: index.php?error=1');
} else {
    // si es un usuario logeado destruimos las variables de sesión y redirigimos a index
    unset($_SESSION['token_usuario']);
    unset($_SESSION['secreto_usuario']);
    unset($_SESSION['nombre']);
    unset($_SESSION['user_id']);
    unset($_SESSION['logeado']);
    header('Location: index.php');
} // del else
?>