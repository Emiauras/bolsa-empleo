<?php
// app/Config/config.php

session_start();

// Configuración con el nombre CORRECTO del proyecto
define('BASE_URL', 'http://localhost/bolsa-empleo/public');
$_ENV['BASE_URL'] = BASE_URL;

// Base de datos
$_ENV['DB_HOST'] = 'localhost';
$_ENV['DB_NAME'] = 'bolsa_empleo';
$_ENV['DB_USER'] = 'root';
$_ENV['DB_PASS'] = '';

// Para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!-- Config loaded: " . BASE_URL . " -->";