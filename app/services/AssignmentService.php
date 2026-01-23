<?php

namespace App\Services;

use App\Models\Assignment;
use App\Models\Submission;

class AssignmentService
{
    private $assignmentModel;
    private $submissionModel;

    public function __construct()
    {
        $this->assignmentModel = new Assignment();
        $this->submissionModel = new Submission();
    }

    public function createAssignment($title, $description, $filePath, $teacherId, $classId)
    {
        return $this->assignmentModel->create($title, $description, $filePath, $teacherId, $classId);
    }

    public function getAssignmentsForClass($classId)
    {
        return $this->assignmentModel->getByClass($classId);
    }

    public function getAssignmentsForTeacher($teacherId)
    {
        return $this->assignmentModel->getByTeacher($teacherId);
    }

    public function getAssignment($id)
    {
        return $this->assignmentModel->find($id);
    }

    public function updateAssignment($id, $title, $description, $filePath, $classId)
    {
        return $this->assignmentModel->update($id, $title, $description, $filePath, $classId);
    }

    public function deleteAssignment($id)
    {
        return $this->assignmentModel->delete($id);
    }

    public function submitWork($assignmentId, $studentId, $content, $filePath)
    {
        return $this->submissionModel->submit($assignmentId, $studentId, $content, $filePath);
    }

    public function getSubmissions($assignmentId)
    {
        return $this->submissionModel->getByAssignment($assignmentId);
    }
}
