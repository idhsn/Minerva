<?php

namespace App\Services;

use App\Models\Grade;

class GradeService
{
    private $gradeModel;

    public function __construct()
    {
        $this->gradeModel = new Grade();
    }

    public function gradeSubmission($submissionId, $score, $comment, $teacherId)
    {
        return $this->gradeModel->grade($submissionId, $score, $comment, $teacherId);
    }

    public function getGradeForSubmission($submissionId)
    {
        return $this->gradeModel->getBySubmission($submissionId);
    }
}
