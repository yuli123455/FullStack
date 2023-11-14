<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: login.html");
    exit();
}

include("../db/conexion.php");
function obtenerUsuarios($conexion) {
    $query = "SELECT id, username FROM usuarios";
    $result = mysqli_query($conexion, $query);
    return $result;
}

// Lista de usuarios
$usuarios = obtenerUsuarios($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Panel de Control</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Cerrar sesión</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($usuarios)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td>
                            <!-- Botones para editar y eliminar usuarios -->
                            <a href="editar_usuario.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Editar</a>
                            <a href="eliminar_usuario.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Botón para agregar un nuevo usuario -->
        <a href="nuevo_usuario.php" class="btn btn-success">Agregar Nuevo Usuario</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
