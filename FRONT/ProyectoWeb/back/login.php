<?php
session_start();
include("../db/conexion.php"); // Archivo donde realizo la configuración de la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conexion, $_POST['username']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    $query = "SELECT id, password FROM usuarios WHERE username = '$username'";
    $result = mysqli_query($conexion, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("location: dashboard.php"); //Inicio de sesión exitoso
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    mysqli_close($conexion);
}
?>

