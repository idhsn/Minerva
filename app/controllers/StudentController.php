<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Services\ClassService;
use App\Services\AssignmentService;
use App\Services\ChatService;

class StudentController extends Controller
{
    private $classService;
    private $assignmentService;
    private $chatService;

    public function __construct()
    {
        Auth::requireLogin();
        $user = Auth::user();
        if ($user['role'] !== 'student') {
            $this->redirect('/php_briefs/Minerva_binomes/login');
        }
        $this->classService = new ClassService();
        $this->assignmentService = new AssignmentService();
        $this->chatService = new ChatService();
    }

    public function dashboard()
    {
        $user = Auth::user();
        $studentClasses = $this->classService->getStudentClasses($user['id']);

        $assignments = [];
        foreach ($studentClasses as $class) {
            $classAssignments = $this->assignmentService->getAssignmentsForClass($class['id']);
            $assignments = array_merge($assignments, $classAssignments);
        }

        $this->view('student/student_dashboard', [
            'user' => $user,
            'assignments' => $assignments,
            'classes' => $studentClasses
        ]);
    }

    public function assignments()
    {
        $user = Auth::user();
        $studentClasses = $this->classService->getStudentClasses($user['id']);
        $assignments = [];
        foreach ($studentClasses as $class) {
            $classAssignments = $this->assignmentService->getAssignmentsForClass($class['id']);
            $assignments = array_merge($assignments, $classAssignments);
        }
        $this->view('student/student_works', ['assignments' => $assignments]);
    }

    public function submit()
    {
        $assignmentId = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $assignmentId = $_POST['assignment_id'] ?? 0;
            $content = $_POST['content'] ?? '';
            $user = Auth::user();

            $filePath = '';
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploader = new \App\Utils\FileUploader('uploads/submissions/');
                $filePath = $uploader->upload($_FILES['file']);
            }

            if ($this->assignmentService->submitWork($assignmentId, $user['id'], $content, $filePath)) {
                $this->redirect('/php_briefs/Minerva_binomes/student/dashboard');
            }
        }

        $assignment = $this->assignmentService->getAssignment($assignmentId);
        $this->view('student/student_submit_work', ['assignment' => $assignment]);
    }

    public function chat()
    {
        $this->view('student/student_chat');
    }
}
