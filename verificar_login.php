<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"] ?? ""); 
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=vacios");
        exit;
    }

  
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND fecha_archivado IS NULL");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($password, $usuario["password_hash"])) {
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["apellido"] = $usuario["apellido"];
        $_SESSION["dni"] = $usuario["dni"];
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["rol"] = $usuario["rol"];

      
        header("Location: turnos.php");
        exit;
    } else {
        header("Location: login.php?error=credenciales");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>