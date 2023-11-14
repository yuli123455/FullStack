<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.html");
    exit();
}
include("../db/conexion.php");
if (isset($_GET['id'])) {
    $usuario_id = mysqli_real_escape_string($conexion, $_GET['id']);

    // Eliminar el usuario de la base de datos(para modo 
    //de ejemplo de eliminacion, en un caso de bd mas grande se utiliza el cambio de estdo
    // en lugar de eliminar)
    $query = "DELETE FROM usuarios WHERE id = $usuario_id";
    mysqli_query($conexion, $query);

    header("location: dashboard.php");
    exit();
} else {
    header("location: dashboard.php");
    exit();
}
?>
