<?php

require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/StudentService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/WorkService.php';
require_once __DIR__ . '/../services/SubmissionService.php';

class StudentController
{
    private $authService;
    private $studentService;
    private $classService;
    private $workService;
    private $submissionService;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->studentService = new StudentService();
        $this->classService = new ClassService();
        $this->workService = new WorkService();
        $this->submissionService = new SubmissionService();
    }

    public function dashboard()
    {
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }

        require_once __DIR__ . '/../views/student/dashboard.php';
    }

    public function index()
    {
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }

        $students = $this->studentService->getAllStudents();
        require_once __DIR__ . '/../views/teacher/students/index.php';
    }

    public function create()
    {
        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }

        $error = null;
        $success = null;
        $generatedPassword = null;

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

    public function works()
    {
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }

        $user = $this->authService->getCurrentUser();
        $works = $this->workService->getStudentWorks($user->id);

        require_once __DIR__ . '/../views/student/works/index.php';
    }

    public function submitWork()
    {
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }

        $workId = $_GET['id'] ?? null;

        if (!$workId) {
            header('Location: /student/works');
            exit;
        }

        $user = $this->authService->getCurrentUser();
        $work = $this->workService->getWorkById($workId);
        
        if (!$work) {
            header('Location: /student/works');
            exit;
        }

        // Check if already submitted
        $existingSubmission = $this->submissionService->getSubmissionByWorkAndStudent($workId, $user->id);

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = $_POST['content'] ?? '';

            $result = $this->submissionService->submitWork($workId, $user->id, $content);

            if ($result['success']) {
                $success = $result['message'];
                header("refresh:2;url=/student/works");
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/student/works/submit.php';
    }

    public function grades()
    {
        if (!$this->authService->isStudent()) {
            header('Location: /login');
            exit;
        }

        $user = $this->authService->getCurrentUser();
        $works = $this->workService->getStudentWorks($user->id);
        
        $gradesData = [];
        foreach ($works as $work) {
            $submission = $this->submissionService->getSubmissionByWorkAndStudent($work->id, $user->id);
            if ($submission) {
                $gradesData[] = [
                    'work' => $work,
                    'submission' => $submission
                ];
            }
        }

        require_once __DIR__ . '/../views/student/grades.php';
    }

    public function classmates()
{
    if (!$this->authService->isStudent()) {
        header('Location: /login');
        exit;
    }

    $user = $this->authService->getCurrentUser();
    
    if (!$user->class_id) {
        $classmates = [];
        $className = null;
    } else {
        $classmates = $this->studentService->getStudentsByClassId($user->class_id);
        $class = $this->classService->getClassWithStudentCount($user->class_id);
        $className = $class ? $class->name : 'Unknown';
        
        // Remove current user from list
        $classmates = array_filter($classmates, function($student) use ($user) {
            return $student->id !== $user->id;
        });
    }

    require_once __DIR__ . '/../views/student/classmates.php';
}

}
