<?php

namespace App\Services;

use App\Models\ClassModel;

class ClassService
{
    private $classModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
    }

    public function createClass($name, $teacherId)
    {
        return $this->classModel->create($name, $teacherId);
    }

    public function assignStudentToClass($classId, $studentId)
    {
        return $this->classModel->addStudent($classId, $studentId);
    }

    public function getTeacherClasses($teacherId)
    {
        return $this->classModel->getAllByTeacher($teacherId);
    }

    public function getStudentClasses($studentId)
    {
        return $this->classModel->getStudentClasses($studentId);
    }

    public function createStudent($data, $classId)
    {
        $studentModel = new \App\Models\User\Etudiant();
        $studentModel->setNom($data['name']);
        $studentModel->setEmail($data['email']);
        $studentModel->setPassword($data['password']);
        $studentModel->setRole('student');

        if ($studentModel->register()) {
            // Get the new student ID
            $student = $studentModel->findByEmail($data['email']);
            if ($student) {
                // Link student to class
                $this->classModel->addStudent($classId, $student['id']);

                // Send welcome email
                $this->sendWelcomeEmail($data['email'], $data['name'], $data['password']);
                return true;
            }
        }
        return false;
    }

    private function sendWelcomeEmail($email, $name, $password)
    {
        $subject = "Bienvenue chez Minerva - Vos identifiants";
        $message = "Bonjour $name,\n\n";
        $message .= "Votre compte étudiant a été créé par votre enseignant.\n";
        $message .= "Voici vos identifiants de connexion :\n";
        $message .= "Email : $email\n";
        $message .= "Mot de passe : $password\n\n";
        $message .= "Vous pouvez vous connecter ici : http://localhost/php_briefs/Minerva_binomes/login\n\n";
        $message .= "Cordialement,\nL'équipe Minerva";

        $headers = "From: no-reply@minerva.edu";

        // In a real environment, mail() would be used.
        // For development/testing, we can log it or assume success.
        return mail($email, $subject, $message, $headers);
    }

    public function getStudentsByTeacher($teacherId)
    {
        return $this->classModel->getStudentsByTeacher($teacherId);
    }
}
