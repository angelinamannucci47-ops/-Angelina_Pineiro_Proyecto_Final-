<?php
session_start();
require_once "conexion.php";
if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: login.php");
    exit;
}
$id = $_GET["id"] ?? "";
$error = "";
if (empty($id)) {
    header("Location: admin_usuarios.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dni = trim($_POST["dni"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $rol = $_POST["rol"] ?? "cliente";

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($email)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, dni = ?, email = ?, rol = ? WHERE id = ?");
        if ($stmt->execute([$nombre, $apellido, $dni, $email, $rol, $id])) {
            header("Location: admin_usuarios.php");
            exit;
        } else {
            $error = "No se pudo actualizar el usuario.";
        }
    }
}
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();
if (!$usuario) {
    header("Location: admin_usuarios.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br>
    <div id="caja" style="width: 400px; padding: 20px;">
        <h2>Editar Usuario</h2>
        <?php if (!empty($error)): ?>
            <p style="color: red; font-size: 14px;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <p style="text-align: left; margin-bottom: 3px;">Nombre:</p>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario["nombre"]) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>
            <p style="text-align: left; margin-bottom: 3px;">Apellido:</p>
            <input type="text" name="apellido" value="<?= htmlspecialchars($usuario["apellido"]) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>
            <p style="text-align: left; margin-bottom: 3px;">DNI:</p>
            <input type="text" name="dni" value="<?= htmlspecialchars($usuario["dni"]) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>
            <p style="text-align: left; margin-bottom: 3px;">Email:</p>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario["email"]) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>
            <p style="text-align: left; margin-bottom: 3px;">Rol:</p>
            <select name="rol" style="width: 92%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;">
                <option value="cliente" <?= ($usuario["rol"] == 'cliente') ? 'selected' : '' ?>>Cliente</option>
                <option value="admin" <?= ($usuario["rol"] == 'admin') ? 'selected' : '' ?>>Administrador</option>
            </select><br><br>
            <button type="submit">Guardar Cambios</button>
        </form>
        <p><a href="admin_usuarios.php" style="color: #8f5951; text-decoration: none;">Cancelar y volver</a></p>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>