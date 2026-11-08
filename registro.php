<?php
session_start();
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br><br>
    <div id="caja" style="width: 380px; padding: 20px;">
        <h2>Lucy Skin & Care</h2>
        <h3>Crear Cuenta</h3>

        <?php if ($error == 'vacios'): ?>
            <p style="color: red; font-size: 14px;">Completá todos los campos obligatorios.</p>
        <?php elseif ($error == 'duplicado'): ?>
            <p style="color: red; font-size: 14px;">El DNI o el correo ya están registrados.</p>
        <?php elseif ($error == 'error'): ?>
            <p style="color: red; font-size: 14px;">Hubo un error al registrarte. Intentá de nuevo.</p>
        <?php endif; ?>

        <form action="guardar_registro.php" method="POST">
            <p style="text-align: left; margin-bottom: 3px;">Nombre:</p>
            <input type="text" name="nombre" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Apellido:</p>
            <input type="text" name="apellido" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">DNI:</p>
            <input type="text" name="dni" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Correo electrónico:</p>
            <input type="email" name="email" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Contraseña:</p>
            <input type="password" name="password" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br><br>

            <button type="submit">Registrarse</button>
        </form>

        <p><a href="login.php" style="color: #8f5951; text-decoration: none;">¿Ya tenés cuenta? Iniciá sesión</a></p>
        <p><a href="index.php" style="color: #666; font-size: 14px; text-decoration: none;">Volver al inicio</a></p>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>