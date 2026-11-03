<?php
session_start();
require_once "conexion.php";
if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: login.php");
    exit;
}
$stmt = $conexion->query("SELECT * FROM usuarios WHERE fecha_archivado IS NOT NULL");
$archivados = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Archivados - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br>
    <div id="caja" style="width: 800px; padding: 20px;">
        <h2>Usuarios Archivados</h2>
        <p><a href="admin_usuarios.php"><button style="font-size:14px; padding:6px 12px;">Volver al Panel Admin</button></a></p>

        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:10px; background:white; color:black; font-size:14px; text-align: left;">
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Fecha Archivado</th>
                <th>Acción</th>
            </tr>
            <?php if (count($archivados) > 0): ?>
                <?php foreach ($archivados as $u): ?>
                <tr>
                    <td><?= $u["id"] ?></td>
                    <td><?= htmlspecialchars($u["nombre"] . " " . $u["apellido"]) ?></td>
                    <td><?= htmlspecialchars($u["dni"]) ?></td>
                    <td><?= htmlspecialchars($u["email"]) ?></td>
                    <td><?= htmlspecialchars($u["fecha_archivado"]) ?></td>
                    <td><a href="reactivar_usuario.php?id=<?= $u["id"] ?>" style="color: green; font-weight: bold;">Reactivar</a></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">No hay usuarios archivados.</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>