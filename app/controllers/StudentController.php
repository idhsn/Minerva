<?php

require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/StudentService.php';
require_once __DIR__ . '/../services/ClassService.php';

class StudentController
{
    private $authService;
    private $studentService;
    private $classService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->studentService = new StudentService();
        $this->classService = new ClassService();
    }

    public function dashboard()
    {
        // Check if user is student
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }

        require_once __DIR__ . '/../views/student/dashboard.php';
    }

    public function index()
    {
        // Check if user is teacher
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }

        $students = $this->studentService->getAllStudents();
        require_once __DIR__ . '/../views/teacher/students/index.php';
    }

    public function create()
    {
        // Check if user is teacher
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }

        $error = null;
        $success = null;
        $generatedPassword = null;

        // Get all classes for dropdown
        $user = $this->authService->getCurrentUser();
        $classes = $this->classService->getTeacherClasses($user->id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $lastName = $_POST['last_name'] ?? '';
            $classId = $_POST['class_id'] ?? null;

            $result = $this->studentService->createStudent($email, $firstName, $lastName, $classId);

            if ($result['success']) {
                $success = $result['message'];
                $generatedPassword = $result['password'];
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/students/create.php';
    }
}
