# Práctica 01: Descubre Cuenca

Sitio web de temática libre sobre Cuenca, Ecuador, desarrollado con HTML, CSS y PHP, con un formulario de contacto que guarda mensajes en una base de datos MySQL.

**Autor:** Esteban Vicente Pesantez Rea
**Asignatura:** Programación y Plataformas Web
**Carrera:** Computación, Universidad Politécnica Salesiana

## Descripción

- 5 páginas HTML: Inicio, Historia, Lugares, Gastronomía y Contacto.
- Hoja de estilos externa en `css/estilos.css`, sin frameworks ni estilos en línea.
- Formulario de contacto (`contacto.html`) que envía por POST a `guardar.php`.
- `guardar.php` valida en el servidor y guarda con consultas preparadas (MySQLi).
- `consultar.php` muestra los mensajes guardados en una tabla.

## Requisitos

- XAMPP (Apache, MySQL y PHP 8 o superior)
- Un navegador web

## Estructura

    practica01/
    ├── css/estilos.css
    ├── images/
    ├── media/video.mp4
    ├── sql/contacto_db.sql
    ├── conexion.php
    ├── guardar.php
    ├── consultar.php
    ├── index.html
    ├── historia.html
    ├── lugares.html
    ├── gastronomia.html
    └── contacto.html

## Configuración y ejecución en XAMPP

1. Copiar la carpeta del proyecto en `C:\xampp\htdocs\practica01`.
2. Abrir el panel de XAMPP e iniciar **Apache** y **MySQL**.
3. Abrir `http://localhost/phpmyadmin`, entrar a la pestaña **Importar** y seleccionar `sql/contacto_db.sql`. Esto crea la base `contacto_db` y la tabla `mensajes`.
4. Verificar las credenciales en `conexion.php` (por defecto: servidor `localhost`, usuario `root`, sin contraseña, base `contacto_db`).
5. Abrir `http://localhost/practica01/index.html`.
6. Envíar un mensaje desde **Contacto** y revísarlo en **Mensajes** (`consultar.php`).

## Base de datos

Tabla `mensajes`: `id` (clave primaria autoincremental), `nombre` (100), `correo` (150), `asunto` (150), `mensaje` (2000) y `fecha_registro` (se llena sola).

## Enlaces

- GitHub Pages (solo HTML, sin PHP): https://presteban.github.io/practica01-Esteban-Pesantez-cuenca/
- Video en YouTube: (pendiente)