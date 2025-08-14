<?php
date_default_timezone_set('America/Costa_Rica');
session_start();

require_once 'app/config/autoload.php';
require_once 'app/config/database.php';

// Obtener la URL y dividirla en partes
$url = isset($_GET['url']) ? $_GET['url'] : 'auth/login';
$url = explode('/', rtrim($url, '/'));

// Controlador y método predeterminados
$controllerName = ucfirst($url[0]) . 'Controller';
$methodName = isset($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Verificar si el controlador existe
if (file_exists('app/controllers/' . $controllerName . '.php')) {
    $controller = new $controllerName();

    // Verificar si el método existe en el controlador
    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        echo "Método no encontrado.";
    }
} else {
    // Si no hay controlador y no hay sesión, redirigir a login
    if (!isset($_SESSION['user_id'])) {
        header("Location: /encuestas/auth/login");
        exit();
    }
    echo "Controlador no encontrado.";
}