<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

require_once "conexion.php";

$id = $_GET["id"] ?? "";
$nombre = "";
$servicio = "";
$fecha = "";
$hora = "";

if ($id != "") {
    $stmt = $conexion->prepare("SELECT * FROM turnos WHERE id = ?");
    $stmt->execute([$id]);
    $turno = $stmt->fetch();

    if ($turno) {
        $nombre = $turno["nombre"];
        $servicio = $turno["servicio"];
        $fecha = $turno["fecha"];
        $hora = $turno["hora"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = trim($_POST["nombre"]);
    $servicio = trim($_POST["servicio"]);
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];

    if ($id == "") {
       
        $stmt = $conexion->prepare("INSERT INTO turnos (nombre, servicio, fecha, hora) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre, $servicio, $fecha, $hora]);
    } else {
       
        $stmt = $conexion->prepare("UPDATE turnos SET nombre = ?, servicio = ?, fecha = ?, hora = ? WHERE id = ?");
        $stmt->execute([$nombre, $servicio, $fecha, $hora, $id]);
    }

    header("Location: turnos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos del Turno - Lucy Skin & Care</title>
    <link rel="stylesheet" href="estiloss.css">
</head>
<body>
    <br><br>
    <div id="caja" style="width: 380px; padding: 20px;">
        <h2>Lucy Skin & Care</h2>
        <h3><?= ($id == "") ? "Nuevo Turno" : "Editar Turno" ?></h3>

        <form method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

            <p style="text-align: left; margin-bottom: 3px;">Nombre del cliente:</p>
            <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Servicio:</p>
            <select name="servicio" required style="width: 92%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;">
                <option value="">Elegir servicio</option>
                <option value="Limpieza facial" <?= ($servicio == "Limpieza facial") ? "selected" : "" ?>>Limpieza facial</option>
                <option value="Manicura" <?= ($servicio == "Manicura") ? "selected" : "" ?>>Manicura</option>
                <option value="Perfilado de cejas" <?= ($servicio == "Perfilado de cejas") ? "selected" : "" ?>>Perfilado de cejas</option>
            </select><br>

            <p style="text-align: left; margin-bottom: 3px;">Fecha:</p>
            <input type="date" name="fecha" value="<?= htmlspecialchars($fecha) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br>

            <p style="text-align: left; margin-bottom: 3px;">Hora:</p>
            <input type="time" name="hora" value="<?= htmlspecialchars($hora) ?>" required style="width: 90%; padding: 6px; border-radius: 8px; border: 1px solid #ccc;"><br><br>

            <button type="submit">Guardar Turno</button>
        </form>

        <p><a href="turnos.php" style="color: #8f5951; text-decoration: none;">Volver a la lista de turnos</a></p>
    </div>
    <footer>Creadora: Angelina Piñeiro 4B</footer>
</body>
</html>