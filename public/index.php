<?php

require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

// Auth routes
$router->get('/', ['AuthController', 'login']);
$router->get('/login', ['AuthController', 'login']);
$router->post('/login', ['AuthController', 'login']);
$router->get('/logout', ['AuthController', 'logout']);

// Teacher routes
$router->get('/teacher/dashboard', ['TeacherController', 'dashboard']);
$router->get('/teacher/classes', ['ClassController', 'index']);
$router->get('/teacher/classes/create', ['ClassController', 'create']);
$router->post('/teacher/classes/create', ['ClassController', 'create']);

// Student routes
$router->get('/student/dashboard', ['StudentController', 'dashboard']);

// Dispatch
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);a
