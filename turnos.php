<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

// Traer la lista de turnos
$stmt = $conexion->query("SELECT * FROM turnos ORDER BY fecha ASC, hora ASC");
$turnos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Turnos - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br>
    <div id="caja" style="width: 800px; padding: 25px;">
        <h2>Lucy Skin & Care</h2>
        <h3>Sistema de Turnos</h3>
        

        <div style="margin-bottom: 20px;">
            <a href="guardar_turno.php"><button style="display:inline-block; font-size:14px; padding:8px 16px;">+ Pedir / Agregar Turno</button></a>
            
            <?php if ($_SESSION["rol"] == 'admin'): ?>
                <a href="admin_usuarios.php"><button style="display:inline-block; font-size:14px; padding:8px 16px; background-color: #555;">Administrar Usuarios</button></a>
            <?php endif; ?>

            <a href="logout.php"><button style="display:inline-block; font-size:14px; padding:8px 16px; background-color: #a94442;">Cerrar Sesión</button></a>
        </div>

        <h3>Listado de Turnos Reservados</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:10px; background:white; color:black; font-size:14px; text-align: left;">
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Acciones</th>
            </tr>
            <?php if (count($turnos) > 0): ?>
                <?php foreach ($turnos as $t): ?>
                <tr>
                    <td><?= $t["id"] ?></td>
                    <td><?= htmlspecialchars($t["nombre"]) ?></td>
                    <td><?= htmlspecialchars($t["servicio"]) ?></td>
                    <td><?= htmlspecialchars($t["fecha"]) ?></td>
                    <td><?= htmlspecialchars($t["hora"]) ?></td>
                    <td>
                        <a href="guardar_turno.php?id=<?= $t["id"] ?>" style="color: blue; font-weight: bold;">Editar</a> | 
                        <form action="eliminar_turno.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este turno?');">
                            <input type="hidden" name="id" value="<?= $t["id"] ?>">
                            <button type="submit" style="background:none; border:none; color:red; padding:0; font:inherit; cursor:pointer; text-decoration:underline;">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">No hay turnos registrados actualmente.</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>