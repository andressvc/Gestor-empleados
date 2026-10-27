<?php
// Conexion a MySQL (valores por defecto de XAMPP/Laragon)
$conexion = new PDO('mysql:host=localhost;dbname=empleados_db;charset=utf8mb4', 'root', 'root');
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
