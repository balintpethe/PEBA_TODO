<?php

require_once '../db/db.php';
require_once '../controllers/UserController.php';
require_once '../controllers/TaskController.php';
require_once 'Router.php';

session_start();

$pdo = require '../db/db.php';

$basePath = '/vizsgafeladat/public';

$router = new Router($basePath);


// Route: Login
$router->addRoute('GET', '/login', function () {
    require_once '../views/login.php';
});

// Route: Register
$router->addRoute('GET', '/register', function () {
    require_once '../views/register.php';
});

// Route: Admin
$router->addRoute('GET', '/admin', function () use ($pdo) {
    if (isset($_GET['action']) && $_GET['action'] === 'deleteUser') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    else {
        $controller = new UserController($pdo);
        $controller->showAdminPanel();
    }
});

$router->addRoute('POST', '/index.php', function() use ($pdo) {
    if (isset($_GET['action']) && $_GET['action'] === 'login') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'checkAdmin') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'logout') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'register') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'updateUser') {
        $controller = new UserController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'createtask') {
        $controller = new TaskController($pdo);
        $controller->handleRequest();
    }
    elseif (isset($_GET['action']) && $_GET['action'] === 'updatetask') {
        $controller = new TaskController($pdo);
        $controller->handleRequest();
    }
});



// Route: Tasks
$router->addRoute('GET', '/tasks', function () use ($pdo) {
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $controller = new TaskController($pdo);
        $controller->handleRequest();
    }
    else {
        $controller = new TaskController($pdo);
        $controller->handleRequest();
    }
});

$router->dispatch();
