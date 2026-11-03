<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];
    $stmt = $conexion->prepare("DELETE FROM turnos WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: turnos.php");
exit;
?>