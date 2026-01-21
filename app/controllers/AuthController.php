<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        // If already logged in, redirect
        if ($this->authService->isLoggedIn()) {
            $this->redirectToDashboard();
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->authService->login($email, $password);

            if ($user) {
                $this->redirectToDashboard();
                return;
            } else {
                $error = "Invalid email or password";
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout()
    {
        $this->authService->logout();
        header('Location: /login');
        exit;
    }

    private function redirectToDashboard()
    {
        if ($this->authService->isTeacher()) {
            header('Location: /teacher/dashboard');
        } else {
            header('Location: /student/dashboard');
        }
        exit;
    }
}
