<?php

use App\Core\Auth;

return function ($router) {
    // Landing page
    $router->get('/', ['HomeController', 'index']);

    // Auth routes
    $router->get('/login', ['AuthController', 'login']);
    $router->post('/login', ['AuthController', 'loginPost']);
    $router->get('/register', ['AuthController', 'register']);
    $router->post('/register', ['AuthController', 'registerPost']);
    $router->get('/logout', ['AuthController', 'logout']);

    // Teacher routes
    $router->get('/teacher/dashboard', ['TeacherController', 'dashboard']);
    $router->get('/teacher/classes', ['TeacherController', 'createClass']);
    $router->post('/teacher/classes', ['TeacherController', 'createClass']);
    $router->get('/teacher/classes/create', ['TeacherController', 'createClass']);
    $router->post('/teacher/classes/create', ['TeacherController', 'createClass']);
    $router->get('/teacher/students', ['TeacherController', 'manageStudents']);
    $router->post('/teacher/students', ['TeacherController', 'manageStudents']);
    $router->get('/teacher/assignments', ['TeacherController', 'listAssignments']);
    $router->get('/teacher/assignments/create', ['TeacherController', 'createAssignment']);
    $router->post('/teacher/assignments/create', ['TeacherController', 'createAssignment']);
    $router->get('/teacher/assignments/edit', ['TeacherController', 'editAssignment']);
    $router->post('/teacher/assignments/update', ['TeacherController', 'updateAssignment']);
    $router->get('/teacher/assignments/delete', ['TeacherController', 'deleteAssignment']);

    // Student routes
    $router->get('/student/dashboard', ['StudentController', 'dashboard']);
    $router->get('/student/assignments', ['StudentController', 'assignments']);
    $router->get('/student/submit', ['StudentController', 'submit']);
    $router->post('/student/submit', ['StudentController', 'submit']);

    // Chat routes
    $router->get('/chat', ['ChatController', 'index']);
    $router->post('/chat/send', ['ChatController', 'send']);
};
