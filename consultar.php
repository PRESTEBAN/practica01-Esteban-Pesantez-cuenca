<?php
require_once "conexion.php";

$mensajes = [];
$error_bd = "";

try {
    $conexion = conectar();
    $resultado = $conexion->query(
        "SELECT nombre, correo, asunto, mensaje, fecha_registro
         FROM mensajes ORDER BY fecha_registro DESC, id DESC"
    );
    while ($fila = $resultado->fetch_assoc()) {
        $mensajes[] = $fila;
    }
    $conexion->close();
} catch (mysqli_sql_exception $e) {
    $error_bd = "No se pudo consultar la base de datos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes recibidos - Cuenca</title>
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
                <li><a href="contacto.html">Contacto</a></li>
                <li><a href="consultar.php" class="actual">Mensajes</a></li>
            </ul>
        </nav>

        <main class="contenido">
            <h2>Mensajes recibidos</h2>

            <?php if ($error_bd !== ""): ?>
                <p class="error"><?php echo htmlspecialchars($error_bd); ?></p>
            <?php elseif (count($mensajes) === 0): ?>
                <p class="aviso">No existen mensajes registrados.</p>
            <?php else: ?>
                <div class="tabla-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mensajes as $m): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($m["nombre"]); ?></td>
                            <td><?php echo htmlspecialchars($m["correo"]); ?></td>
                            <td><?php echo htmlspecialchars($m["asunto"]); ?></td>
                            <td><?php echo htmlspecialchars($m["mensaje"]); ?></td>
                            <td><?php echo htmlspecialchars($m["fecha_registro"]); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            <?php endif; ?>
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