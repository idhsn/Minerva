<?php

require_once __DIR__ . '/../services/AuthService.php';

class TeacherController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
        
        // Check if user is teacher
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }
    }

    public function dashboard()
    {
        require_once __DIR__ . '/../views/teacher/dashboard.php';
    }
}
