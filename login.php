<?php
session_start();
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br><br>
    <div id="caja" style="width: 350px; padding: 20px;">
        <h2>Lucy Skin & Care</h2>
        <h3>Iniciar Sesión</h3>

        <?php if ($error == 'credenciales'): ?>
            <p style="color: red; font-size: 14px;">Correo o contraseña incorrectos.</p>
        <?php elseif ($error == 'vacios'): ?>
            <p style="color: red; font-size: 14px;">Completá todos los campos.</p>
        <?php endif; ?>

        <form action="verificar_login.php" method="POST">
            <p style="text-align: left; margin-bottom: 5px;">Correo electrónico:</p>
            <input type="email" name="email" required style="width: 90%; padding: 8px; border-radius: 10px; border: 1px solid #ccc;"><br><br>

            <p style="text-align: left; margin-bottom: 5px;">Contraseña:</p>
            <input type="password" name="password" required style="width: 90%; padding: 8px; border-radius: 10px; border: 1px solid #ccc;"><br><br>

            <button type="submit">Ingresar</button>
        </form>

        <p><a href="registro.php" style="color: #8f5951; text-decoration: none;">¿No tenés cuenta? Registrate acá</a></p>
        <p><a href="index.php" style="color: #666; font-size: 14px; text-decoration: none;">Volver al inicio</a></p>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>