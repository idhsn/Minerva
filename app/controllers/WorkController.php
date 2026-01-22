<?php

require_once __DIR__ . '/../services/WorkService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/StudentService.php';
require_once __DIR__ . '/../services/AuthService.php';
require_once __DIR__ . '/../services/SubmissionService.php';
require_once __DIR__ . '/../repositories/UserRepository.php';

class WorkController
{
    private $workService;
    private $classService;
    private $studentService;
    private $authService;
    private $submissionService;
    private $userRepository;

    public function __construct()
    {
        $this->workService = new WorkService();
        $this->classService = new ClassService();
        $this->studentService = new StudentService();
        $this->authService = new AuthService();
        $this->submissionService = new SubmissionService();
        $this->userRepository = new UserRepository();

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

    public function submissions()
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

        $submissions = $this->submissionService->getSubmissionsByWork($workId);
        
        // Get student info for each submission
        $submissionsWithStudents = [];
        foreach ($submissions as $submission) {
            $student = $this->userRepository->findById($submission->student_id);
            $submissionsWithStudents[] = [
                'submission' => $submission,
                'student' => $student
            ];
        }

        require_once __DIR__ . '/../views/teacher/works/submissions.php';
    }

    public function grade()
    {
        $submissionId = $_GET['id'] ?? null;

        if (!$submissionId) {
            header('Location: /teacher/works');
            exit;
        }

        $submission = $this->submissionService->getSubmissionById($submissionId);
        if (!$submission) {
            header('Location: /teacher/works');
            exit;
        }

        $student = $this->userRepository->findById($submission->student_id);
        $work = $this->workService->getWorkById($submission->work_id);

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $grade = $_POST['grade'] ?? '';
            $comment = $_POST['comment'] ?? '';

            $result = $this->submissionService->gradeSubmission($submissionId, $grade, $comment);

            if ($result['success']) {
                $success = $result['message'];
                header("refresh:1;url=/teacher/works/submissions?id=" . $submission->work_id);
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/works/grade.php';
    }
}
