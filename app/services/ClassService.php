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

    public function createStudent($data)
    {
        $studentModel = new \App\Models\User\Etudiant();
        $studentModel->setNom($data['name']);
        $studentModel->setEmail($data['email']);
        $studentModel->setPassword($data['password']);
        $studentModel->setRole('student');
        return $studentModel->register(); // Returns ID or false
    }
}
