<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function conectar() {
    $conexion = new mysqli("localhost", "root", "", "contacto_db");
    $conexion->set_charset("utf8mb4");
    return $conexion;
}