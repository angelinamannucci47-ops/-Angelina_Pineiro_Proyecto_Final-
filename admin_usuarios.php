<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: login.php");
    exit;
}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br>
    <div id="caja" style="width: 850px; padding: 20px;">
        <h2>Panel de Administración</h2>
        <p>Administrador/a: <strong><?= htmlspecialchars($_SESSION["nombre"]) ?></strong></p>
        
        <div>
            <a href="panel.php"><button style="display:inline-block; font-size:14px; padding:6px 12px;">Mi Panel</button></a>
            <a href="usuarios_archivados.php"><button style="display:inline-block; font-size:14px; padding:6px 12px; background-color: #555;">Ver Archivados</button></a>
            <a href="logout.php"><button style="display:inline-block; font-size:14px; padding:6px 12px; background-color: #a94442;">Cerrar Sesión</button></a>
        </div>

        <hr style="margin: 20px 0;">

        <h3>Buscador de Usuarios Activos</h3>
        <form method="GET">
            <input type="text" name="busqueda" value="<?= htmlspecialchars($busqueda) ?>" placeholder="Nombre, apellido, DNI o email" style="padding: 6px; width: 250px; border-radius: 8px; border: 1px solid #ccc;">
            <button type="submit" style="display:inline-block; font-size:14px; padding:6px 14px;">Buscar</button>
            <?php if($busqueda !== ""): ?>
                <a href="admin_usuarios.php"><button type="button" style="display:inline-block; font-size:14px; padding:6px 14px; background-color: #666;">Ver todos</button></a>
            <?php endif; ?>
        </form>

        <h3>Listado de Usuarios</h3>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:10px; background:white; color:black; font-size: 14px; text-align: left;">
            <tr style="background-color: #f2f2f2;">
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>DNI</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </table>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>