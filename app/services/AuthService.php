<?php

require_once __DIR__ . '/../repositories/UserRepository.php';

class AuthService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($email, $password)
    {
        // Find user by email
        $user = $this->userRepository->findByEmail($email);

        // Check if user exists and password matches
        if ($user && password_verify($password, $user->password)) {
            // Store user info in session
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->role;
            $_SESSION['user_name'] = $user->getFullName();
            
            return $user;
        }

        return false;
    }

    public function logout()
    {
        session_destroy();
        session_start();
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser()
    {
        if ($this->isLoggedIn()) {
            return $this->userRepository->findById($_SESSION['user_id']);
        }
        return null;
    }

    public function isTeacher()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'teacher';
    }

    public function isStudent()
    {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'student';
    }
}
