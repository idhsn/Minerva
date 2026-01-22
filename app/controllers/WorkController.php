<?php

require_once __DIR__ . '/../services/WorkService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/StudentService.php';
require_once __DIR__ . '/../services/AuthService.php';

class WorkController
{
    private $workService;
    private $classService;
    private $studentService;
    private $authService;

    public function __construct()
    {
        $this->workService = new WorkService();
        $this->classService = new ClassService();
        $this->studentService = new StudentService();
        $this->authService = new AuthService();

        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $user = $this->authService->getCurrentUser();
        $works = $this->workService->getTeacherWorks($user->id);

        require_once __DIR__ . '/../views/teacher/works/index.php';
    }

    public function create()
    {
        $error = null;
        $success = null;
        $createdWorkId = null;

        $user = $this->authService->getCurrentUser();
        $classes = $this->classService->getTeacherClasses($user->id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $classId = $_POST['class_id'] ?? '';

            $result = $this->workService->createWork($title, $description, $classId, $user->id);

            if ($result['success']) {
                $success = $result['message'];
                $createdWorkId = $result['work_id'];
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/works/create.php';
    }

    public function assign()
    {
        $workId = $_GET['id'] ?? null;

        if (!$workId) {
            header('Location: /teacher/works');
            exit;
        }

        $work = $this->workService->getWorkById($workId);
        if (!$work) {
            header('Location: /teacher/works');
            exit;
        }

        $students = $this->studentService->getStudentsByClassId($work->class_id);
        $assignedStudents = $this->workService->getAssignedStudents($workId);
        
        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedStudents = $_POST['students'] ?? [];

            $result = $this->workService->assignWorkToStudents($workId, $selectedStudents);

            if ($result['success']) {
                $success = $result['message'];
                $assignedStudents = $this->workService->getAssignedStudents($workId);
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/works/assign.php';
    }
}
