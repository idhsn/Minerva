<?php

require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/AuthService.php';

class ClassController
{
    private $classService;
    private $authService;

    public function __construct()
    {
        $this->classService = new ClassService();
        $this->authService = new AuthService();
        
        // Check if user is teacher
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $user = $this->authService->getCurrentUser();
        $classes = $this->classService->getTeacherClasses($user->id);
        
        // Add student count to each class
        foreach ($classes as $class) {
            $class->student_count = $this->classService->getClassWithStudentCount($class->id)->student_count;
        }

        require_once __DIR__ . '/../views/teacher/classes/index.php';
    }

    public function create()
    {
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $user = $this->authService->getCurrentUser();

            $result = $this->classService->createClass($name, $user->id);

            if ($result['success']) {
                $success = $result['message'];
                header("refresh:1;url=/teacher/classes");
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/classes/create.php';
    }
}
