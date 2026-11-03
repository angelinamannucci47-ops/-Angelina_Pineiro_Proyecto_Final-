<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Personal - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br><br>
    <div id="caja" style="width: 400px; padding: 25px;">
        <h2>Lucy Skin & Care</h2>
        <h3>Panel de Usuario</h3>
        
        <p><strong>Bienvenido/a:</strong> <?= htmlspecialchars($_SESSION["nombre"] . " " . $_SESSION["apellido"]) ?></p>
        <p><strong>DNI:</strong> <?= htmlspecialchars($_SESSION["dni"]) ?></p>
        <p><strong>Correo:</strong> <?= htmlspecialchars($_SESSION["usuario"] ?? $_SESSION["email"] ?? "") ?></p>
        <p><strong>Rol:</strong> <?= htmlspecialchars($_SESSION["rol"]) ?></p>

        <?php if ($_SESSION["rol"] == 'admin'): ?>
            <br>
            <a href="admin_usuarios.php"><button style="background-color: #555;">Ir al Panel de Administración</button></a>
        <?php endif; ?>

        <br>
        <a href="logout.php"><button style="background-color: #a94442;">Cerrar Sesión</button></a>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>