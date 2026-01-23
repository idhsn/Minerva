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
$router->get('/teacher/works/submissions', ['WorkController', 'submissions']);
$router->get('/teacher/works/grade', ['WorkController', 'grade']);
$router->post('/teacher/works/grade', ['WorkController', 'grade']);

// Attendance routes
$router->get('/teacher/attendance', ['AttendanceController', 'index']);
$router->get('/teacher/attendance/take', ['AttendanceController', 'take']);
$router->post('/teacher/attendance/take', ['AttendanceController', 'take']);
$router->get('/teacher/attendance/stats', ['AttendanceController', 'stats']);

// Statistics routes
$router->get('/teacher/statistics', ['StatisticsController', 'index']);

// Student routes
$router->get('/student/dashboard', ['StudentController', 'dashboard']);
$router->get('/student/works', ['StudentController', 'works']);
$router->get('/student/works/submit', ['StudentController', 'submitWork']);
$router->post('/student/works/submit', ['StudentController', 'submitWork']);
$router->get('/student/grades', ['StudentController', 'grades']);
$router->get('/student/classmates', ['StudentController', 'classmates']);

// Chat routes (both teacher and student)
$router->get('/chat', ['ChatController', 'index']);
$router->post('/chat', ['ChatController', 'index']);

// Dispatch
$uri = $_SERVER['REQUEST_URI'];
$router->dispatch($uri);
