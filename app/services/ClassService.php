<?php

require_once __DIR__ . '/../repositories/ClassRepository.php';

class ClassService
{
    private $classRepository;

    public function __construct()
    {
        $this->classRepository = new ClassRepository();
    }

    public function createClass($name, $teacherId)
    {
        // Validate
        if (empty($name)) {
            return ['success' => false, 'message' => 'Class name is required'];
        }

        // Create class
        $classId = $this->classRepository->create($name, $teacherId);

        return ['success' => true, 'class_id' => $classId, 'message' => 'Class created successfully'];
    }

    public function getTeacherClasses($teacherId)
    {
        return $this->classRepository->findByTeacherId($teacherId);
    }

    public function getClassWithStudentCount($classId)
    {
        $class = $this->classRepository->findById($classId);
        if ($class) {
            $class->student_count = $this->classRepository->getStudentCount($classId);
        }
        return $class;
    }
}
