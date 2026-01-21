<?php

require_once __DIR__ . '/../services/AuthService.php';

class StudentController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
        
        // Check if user is student
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }
    }

    public function dashboard()
    {
        require_once __DIR__ . '/../views/student/dashboard.php';
    }
}
