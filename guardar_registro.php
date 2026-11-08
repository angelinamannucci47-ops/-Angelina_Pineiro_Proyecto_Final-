<?php
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dni = trim($_POST["dni"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($nombre) || empty($apellido) || empty($dni) || empty($email) || empty($password)) {
        header("Location: registro.php?error=vacios");
        exit;
    }

    try {
        // Verificar si ya existe el DNI o el Email en la base de datos
        $sqlCheck = "SELECT id FROM usuarios WHERE dni = ? OR email = ?";
        $stmtCheck = $conexion->prepare($sqlCheck);
        $stmtCheck->execute([$dni, $email]);

        if ($stmtCheck->fetch()) {
            header("Location: registro.php?error=duplicado");
            exit;
        }

        // Cifrar la contraseña de forma segura
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $rol = "cliente"; // Rol por defecto

        // Guardar el usuario nuevo
        $sqlInsert = "INSERT INTO usuarios (nombre, apellido, dni, email, password_hash, rol) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conexion->prepare($sqlInsert);
        $stmtInsert->execute([$nombre, $apellido, $dni, $email, $password_hash, $rol]);

        header("Location: login.php");
        exit;

    } catch (PDOException $e) {
        header("Location: registro.php?error=error");
        exit;
    }
} else {
    header("Location: registro.php");
    exit;
}
?>