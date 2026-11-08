<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION["id"]) || $_SESSION["rol"] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $stmt = $conexion->prepare("UPDATE usuarios SET fecha_archivado = NULL WHERE id = ?");
    $stmt->execute([$_GET["id"]]);
}

header("Location: usuarios_archivados.php");
exit;
?>