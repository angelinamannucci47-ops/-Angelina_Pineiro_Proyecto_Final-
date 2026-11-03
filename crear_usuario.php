<?php
require_once "conexion.php";

try {
    $nombre = "Angelina";
    $apellido = "Piñeiro";
    $dni = "12345678";
    $email = "admin@lucyskin.com";
    $password = password_hash("Estetica123!", PASSWORD_DEFAULT);
    $rol = "admin";

    // Verificar si ya existe
    $sql = "SELECT id FROM usuarios WHERE dni = ?";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$dni]);

    if ($consulta->fetch()) {
        exit("El usuario administrador ya existe. Ya podés ir a login.php.");
    }

    $sql = "INSERT INTO usuarios (nombre, apellido, dni, email, password_hash, rol) VALUES (?, ?, ?, ?, ?, ?)";
    $consulta = $conexion->prepare($sql);
    $consulta->execute([$nombre, $apellido, $dni, $email, $password, $rol]);

    echo "¡Administrador creado con éxito!<br>";
    echo "<b>DNI:</b> 12345678<br>";
    echo "<b>Contraseña:</b> Estetica123!<br><br>";
    echo "<a href='login.php'>Ir a Iniciar Sesión</a>";

} catch (PDOException $e) {
    error_log($e->getMessage());
    exit("No se pudo crear el usuario.");
}
?>