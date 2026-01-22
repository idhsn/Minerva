<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Services\ClassService;
use App\Services\AssignmentService;

class TeacherController extends Controller
{
    private $classService;
    private $assignmentService;

    public function __construct()
    {
        Auth::requireLogin();
        // Check role
        $user = Auth::user();
        if ($user['role'] !== 'teacher') {
            $this->redirect('/php_briefs/Minerva_binomes/login');
        }
        $this->classService = new ClassService();
        $this->assignmentService = new AssignmentService();
    }

    public function dashboard()
    {
        $user = Auth::user();
        $classes = $this->classService->getTeacherClasses($user['id']);
        $this->view('teacher/teacher_dashboard', [
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function createClass()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $user = Auth::user();
            if ($this->classService->createClass($name, $user['id'])) {
                $this->redirect('/php_briefs/Minerva_binomes/teacher/dashboard');
            }
        }
        $this->view('teacher/teacher_classes');
    }

    public function createStudent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $classId = $_POST['class_id'] ?? 0;
            $password = \App\Services\AuthService::generateRandomPassword();

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            $studentId = $this->classService->createStudent($data);
            if ($studentId) {
                // Link to class
                if ($classId) {
                    $this->classService->assignStudentToClass($classId, $studentId);
                }

                // Send Welcome Email
                \App\Services\EmailService::sendWelcomeEmail($email, $name, $password);

                $success = "Étudiant créé avec succès. Un email de bienvenue a été envoyé à $email avec le mot de passe : <strong>$password</strong>";

                $user = Auth::user();
                $classes = $this->classService->getTeacherClasses($user['id']);
                $this->view('teacher/teacher_students', [
                    'success' => $success,
                    'classes' => $classes
                ]);
                return;
            }
        }
        $user = Auth::user();
        $classes = $this->classService->getTeacherClasses($user['id']);
        $this->view('teacher/teacher_students', ['classes' => $classes]);
    }
    public function createAssignment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $classId = $_POST['class_id'] ?? 0;
            $user = Auth::user();

            $filePath = '';
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploader = new \App\Utils\FileUploader('uploads/assignments/');
                $filePath = $uploader->upload($_FILES['file']);
            }

            if ($this->assignmentService->createAssignment($title, $description, $filePath, $user['id'], $classId)) {
                $this->redirect('/php_briefs/Minerva_binomes/teacher/dashboard');
            }
        }
        $user = Auth::user();
        $classes = $this->classService->getTeacherClasses($user['id']);
        $this->view('teacher/teacher_assign_work', ['classes' => $classes]);
    }
}
