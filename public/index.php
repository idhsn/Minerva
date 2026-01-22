<?php

require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

// Root route
$router->get('/', ['AuthController', 'login']);

// Auth routes
$router->get('/login', ['AuthController', 'login']);
$router->post('/login', ['AuthController', 'login']);
$router->get('/logout', ['AuthController', 'logout']);

// Teacher routes
$router->get('/teacher/dashboard', ['TeacherController', 'dashboard']);
$router->get('/teacher/classes', ['ClassController', 'index']);
$router->get('/teacher/classes/create', ['ClassController', 'create']);
$router->post('/teacher/classes/create', ['ClassController', 'create']);

// Student management routes
$router->get('/teacher/students', ['StudentController', 'index']);
$router->get('/teacher/students/create', ['StudentController', 'create']);
$router->post('/teacher/students/create', ['StudentController', 'create']);

// Work routes
$router->get('/teacher/works', ['WorkController', 'index']);
$router->get('/teacher/works/create', ['WorkController', 'create']);
$router->post('/teacher/works/create', ['WorkController', 'create']);
$router->get('/teacher/works/assign', ['WorkController', 'assign']);
$router->post('/teacher/works/assign', ['WorkController', 'assign']);

// Student routes
$router->get('/student/dashboard', ['StudentController', 'dashboard']);

// Dispatch
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);
