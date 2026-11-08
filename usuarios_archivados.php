<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM usuarios WHERE fecha_archivado IS NOT NULL";
$stmt = $conexion->query($sql);
$usuarios = $stmt->fetchAll();
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
    <div id="caja" style="width: 850px; padding: 20px;">
        <h2>Usuarios Archivados</h2>
        <p>Administrador/a: <strong><?= htmlspecialchars($_SESSION["nombre"]) ?></strong></p>
        
        <div>
            <a href="admin_usuarios.php"><button style="display:inline-block; font-size:14px; padding:6px 12px;">Volver al Panel Admin</button></a>
            <a href="logout.php"><button style="display:inline-block; font-size:14px; padding:6px 12px; background-color: #a94442;">Cerrar Sesión</button></a>
        </div>

        <hr style="margin: 20px 0;">

        <h3>Listado de Cuentas Archivadas</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:10px; background:white; color:black; font-size: 14px; text-align: left;">
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Fecha de Archivado</th>
                <th>Acciones</th>
            </tr>
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u["id"] ?></td>
                    <td><?= htmlspecialchars($u["nombre"] . " " . $u["apellido"]) ?></td>
                    <td><?= htmlspecialchars($u["dni"]) ?></td>
                    <td><?= htmlspecialchars($u["email"]) ?></td>
                    <td><?= htmlspecialchars($u["fecha_archivado"]) ?></td>
                    <td>
                        <a href="reactivar_usuario.php?id=<?= $u["id"] ?>" onclick="return confirm('¿Deseas reactivar este usuario?');" style="color: green; font-weight: bold;">Reactivar</a>
                    </td>
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
</html>