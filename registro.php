<?php
require_once "conexion.php";
$error = "";
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dni = trim($_POST["dni"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Verificar duplicados de DNI o email
        $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE dni = ? OR email = ?");
        $stmt->execute([$dni, $email]);
        if ($stmt->fetch()) {
            $error = "El DNI o el correo electrónico ya se encuentran registrados.";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, dni, email, password_hash, rol) VALUES (?, ?, ?, ?, ?, 'cliente')");
            if ($stmt->execute([$nombre, $apellido, $dni, $email, $password_hash])) {
                $exito = "¡Cuenta creada con éxito! Ya podés iniciar sesión.";
            } else {
                $error = "Ocurrió un error al registrar el usuario.";
            }
        }
    }
}
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
        <h3>Registro de Cuenta</h3>

        <?php if (!empty($error)): ?>
            <p style="color: red; font-size: 14px;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (!empty($exito)): ?>
            <p style="color: green; font-size: 14px;"><?= htmlspecialchars($exito) ?></p>
        <?php endif; ?>

        <form method="POST">
            <p style="text-align: left; margin-bottom: 3px;">Nombre:</p>
            <input type="text" name="nombre" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Apellido:</p>
            <input type="text" name="apellido" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">DNI:</p>
            <input type="text" name="dni" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Correo Electrónico:</p>
            <input type="email" name="email" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Contraseña:</p>
            <input type="password" name="password" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br><br>

            <button type="submit">Registrarse</button>
        </form>

        <p><a href="login.php" style="color: #8f5951; text-decoration: none;">¿Ya tenés cuenta? Iniciá sesión</a></p>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>