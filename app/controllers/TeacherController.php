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
        $user = Auth::user();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            if ($this->classService->createClass($name, $user['id'])) {
                Auth::setFlash('succes', 'La classe a été créée avec succès !');
                $this->redirect('/php_briefs/Minerva_binomes/teacher/classes');
            }
        }
        $classes = $this->classService->getTeacherClasses($user['id']);
        $this->view('teacher/teacher_classes', [
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function manageStudents()
    {
        $user = Auth::user();
        $classId = $_GET['class_id'] ?? 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $selectedClassId = $_POST['class_id'] ?? 0;
            $password = \App\Services\AuthService::generateRandomPassword();

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password
            ];

            if ($this->classService->createStudent($data, $selectedClassId)) {
                $classes = $this->classService->getTeacherClasses($user['id']);
                $students = $classId ? $this->classService->getStudentsByClass($classId) : $this->classService->getStudentsByTeacher($user['id']);

                $this->view('teacher/teacher_students', [
                    'success' => "Étudiant créé avec succès. Mot de passe: $password",
                    'classes' => $classes,
                    'students' => $students,
                    'user' => $user
                ]);
                return;
            }
        }

        $classes = $this->classService->getTeacherClasses($user['id']);
        if ($classId) {
            $students = $this->classService->getStudentsByClass($classId);
        } else {
            $students = $this->classService->getStudentsByTeacher($user['id']);
        }

        $this->view('teacher/teacher_students', [
            'classes' => $classes,
            'students' => $students,
            'user' => $user
        ]);
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

    public function listAssignments()
    {
        $user = Auth::user();
        $classId = $_GET['class_id'] ?? 0;
        $classes = $this->classService->getTeacherClasses($user['id']);

        if ($classId) {
            $assignments = $this->assignmentService->getAssignmentsForClass($classId);
        } else {
            $assignments = $this->assignmentService->getAssignmentsForTeacher($user['id']);
        }

        $this->view('teacher/teacher_works', [
            'classes' => $classes,
            'user' => $user,
            'classId' => $classId,
            'assignments' => $assignments
        ]);
    }

    public function editAssignment()
    {
        $user = Auth::user();
        $id = $_GET['id'] ?? 0;
        $assignment = $this->assignmentService->getAssignment($id);

        if (!$assignment || $assignment['teacher_id'] !== $user['id']) {
            $this->redirect('/php_briefs/Minerva_binomes/teacher/assignments');
        }

        $classes = $this->classService->getTeacherClasses($user['id']);
        $this->view('teacher/teacher_assign_work', [
            'assignment' => $assignment,
            'classes' => $classes,
            'user' => $user
        ]);
    }

    public function updateAssignment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $classId = $_POST['class_id'] ?? 0;
            $user = Auth::user();

            $filePath = null;
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $uploader = new \App\Utils\FileUploader('uploads/assignments/');
                $filePath = $uploader->upload($_FILES['file']);
            }

            if ($this->assignmentService->updateAssignment($id, $title, $description, $filePath, $classId)) {
                Auth::setFlash('success', 'Le devoir a été modifié avec succès !');
                $this->redirect('/php_briefs/Minerva_binomes/teacher/assignments');
            }
        }
    }

    public function deleteAssignment()
    {
        $user = Auth::user();
        $id = $_GET['id'] ?? 0;
        $assignment = $this->assignmentService->getAssignment($id);

        if ($assignment && $assignment['teacher_id'] === $user['id']) {
            if ($this->assignmentService->deleteAssignment($id)) {
                Auth::setFlash('success', 'Le devoir a été supprimé avec succès !');
            } else {
                Auth::setFlash('error', 'Erreur lors de la suppression.');
            }
        }
        $this->redirect('/php_briefs/Minerva_binomes/teacher/assignments');
    }
}
