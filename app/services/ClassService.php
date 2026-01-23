<?php

namespace App\Services;

use App\Models\ClassModel;

class ClassService
{
    private $classModel;
    private $mailService;

    public function __construct()
    {
        $this->classModel = new ClassModel();
        $this->mailService = new MailService();
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

                // Send welcome email using MailService
                $this->mailService->sendWelcomeEmail($data['email'], $data['name'], $data['password']);
                return true;
            }
        }
        return false;
    }



    public function getStudentsByTeacher($teacherId)
    {
        return $this->classModel->getStudentsByTeacher($teacherId);
    }

    public function getStudentsByClass($classId)
    {
        return $this->classModel->getStudents($classId);
    }
}
