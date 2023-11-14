<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.html");
    exit();
}
include("../db/conexion.php");

// ID del usuario a editar
if (isset($_GET['id'])) {
    $usuario_id = mysqli_real_escape_string($conexion, $_GET['id']);
    $query = "SELECT * FROM usuarios WHERE id = $usuario_id";
    $result = mysqli_query($conexion, $query);
    $usuario = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nuevo_username = mysqli_real_escape_string($conexion, $_POST['username']);
        $nueva_password = password_hash(mysqli_real_escape_string($conexion, $_POST['password']), PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET username = '$nuevo_username', password = '$nueva_password' WHERE id = $usuario_id";
        mysqli_query($conexion, $query);

        header("location: dashboard.php");
        exit();
    }
} else {
    header("location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        <form action="editar_usuario.php?id=<?php echo $usuario['id']; ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nuevo Usuario:</label>
                <input type="text" name="username" class="form-control" value="<?php echo $usuario['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
