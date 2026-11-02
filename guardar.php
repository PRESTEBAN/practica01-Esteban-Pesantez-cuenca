<?php
require_once "conexion.php";

$errores = [];
$guardado = false;
$nombre = "";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $errores[] = "Acceso no válido. Use el formulario de contacto.";
} else {
    $nombre  = trim($_POST["nombre"] ?? "");
    $correo  = trim($_POST["correo"] ?? "");
    $asunto  = trim($_POST["asunto"] ?? "");
    $mensaje = trim($_POST["mensaje"] ?? "");

    if ($nombre === "") {
        $errores[] = "El nombre completo es obligatorio.";
    } elseif (mb_strlen($nombre) > 100) {
        $errores[] = "El nombre no puede superar los 100 caracteres.";
    }

    if ($correo === "") {
        $errores[] = "El correo electrónico es obligatorio.";
    } elseif (mb_strlen($correo) > 150) {
        $errores[] = "El correo no puede superar los 150 caracteres.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no tiene un formato válido.";
    }

    if ($asunto === "") {
        $errores[] = "El asunto es obligatorio.";
    } elseif (mb_strlen($asunto) > 150) {
        $errores[] = "El asunto no puede superar los 150 caracteres.";
    }

    if ($mensaje === "") {
        $errores[] = "El mensaje es obligatorio.";
    } elseif (mb_strlen($mensaje) > 2000) {
        $errores[] = "El mensaje no puede superar los 2000 caracteres.";
    }

    if (empty($errores)) {
        try {
            $conexion = conectar();
            $sql = "INSERT INTO mensajes (nombre, correo, asunto, mensaje) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $correo, $asunto, $mensaje);
            $stmt->execute();
            $guardado = ($stmt->affected_rows === 1);
            $stmt->close();
            $conexion->close();
        } catch (mysqli_sql_exception $e) {
            $errores[] = "No se pudo guardar el mensaje. Intente nuevamente más tarde.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del envío - Cuenca</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
<div class="sitio">
    <header id="encabezado">
        <h1>Descubre Cuenca</h1>
        <p>Patrimonio Cultural de la Humanidad</p>
    </header>

    <div class="contenedor">
        <nav class="menu">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="historia.html">Historia</a></li>
                <li><a href="lugares.html">Lugares</a></li>
                <li><a href="gastronomia.html">Gastronomía</a></li>
                <li><a href="contacto.html" class="actual">Contacto</a></li>
                <li><a href="consultar.php">Mensajes</a></li>
            </ul>
        </nav>

        <main class="contenido">
            <h2>Resultado del envío</h2>

            <?php if ($guardado): ?>
                <p class="exito">
                    ¡Gracias, <strong><?php echo htmlspecialchars($nombre); ?></strong>!
                    Tu mensaje fue guardado correctamente.
                </p>
            <?php else: ?>
                <p class="error"><strong>No se pudo registrar el mensaje:</strong></p>
                <ul class="lista-errores">
                    <?php foreach ($errores as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <p><a href="contacto.html">Volver al formulario</a></p>
        </main>
    </div>

    <footer id="pie">
        <p>Autor: Esteban Vicente Pesantez Rea</p>
       <p><a href="mailto:epesantezr1@est.ups.edu.ec">epesantezr1@est.ups.edu.ec</a></p>
        <p>&copy; 2026 Esteban Pesantez. Todos los derechos reservados.</p>
    </footer>
</div>
</body>
</html>