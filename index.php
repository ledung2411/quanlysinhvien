<?php
// Khởi động session
session_start();

// Autoload controllers
function loadController($controller) {
    $controllerFile = 'app/controllers/' . $controller . 'Controller.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controllerClass = $controller . 'Controller';
        return new $controllerClass();
    }
    return null;
}

// Get controller and action from the URL
$controller = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Default';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Load the controller
$controllerInstance = loadController($controller);

if ($controllerInstance && method_exists($controllerInstance, $action)) {
    // Call the action
    $controllerInstance->$action();
} else {
    // Default action
    $defaultController = loadController('Default');
    $defaultController->index();
}
?>