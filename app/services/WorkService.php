<?php

require_once __DIR__ . '/../repositories/WorkRepository.php';

class WorkService
{
    private $workRepository;

    public function __construct()
    {
        $this->workRepository = new WorkRepository();
    }

    public function createWork($title, $description, $classId, $teacherId)
    {
        if (empty($title) || empty($classId)) {
            return ['success' => false, 'message' => 'Title and class are required'];
        }

        $workId = $this->workRepository->create($title, $description, $classId, $teacherId);

        return ['success' => true, 'work_id' => $workId, 'message' => 'Work created successfully'];
    }

    public function assignWorkToStudents($workId, $studentIds)
    {
        if (empty($studentIds)) {
            return ['success' => false, 'message' => 'Please select at least one student'];
        }

        foreach ($studentIds as $studentId) {
            $this->workRepository->assignToStudent($workId, $studentId);
        }

        return ['success' => true, 'message' => 'Work assigned to ' . count($studentIds) . ' student(s)'];
    }

    public function getTeacherWorks($teacherId)
    {
        return $this->workRepository->findByTeacherId($teacherId);
    }

    public function getStudentWorks($studentId)
    {
        return $this->workRepository->getAssignedWorks($studentId);
    }

    public function getWorkById($workId)
    {
        return $this->workRepository->findById($workId);
    }

    public function getAssignedStudents($workId)
    {
        return $this->workRepository->getAssignedStudents($workId);
    }
}
