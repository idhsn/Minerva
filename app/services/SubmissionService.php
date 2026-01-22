<?php

require_once __DIR__ . '/../repositories/SubmissionRepository.php';

class SubmissionService
{
    private $submissionRepository;

    public function __construct()
    {
        $this->submissionRepository = new SubmissionRepository();
    }

    public function submitWork($workId, $studentId, $content)
    {
        if (empty($content)) {
            return ['success' => false, 'message' => 'Content cannot be empty'];
        }

        // Check if already submitted
        $existing = $this->submissionRepository->findByWorkAndStudent($workId, $studentId);
        if ($existing) {
            return ['success' => false, 'message' => 'You have already submitted this work'];
        }

        $submissionId = $this->submissionRepository->create($workId, $studentId, $content);

        return ['success' => true, 'submission_id' => $submissionId, 'message' => 'Work submitted successfully'];
    }

    public function gradeSubmission($submissionId, $grade, $comment)
    {
        if ($grade === null || $grade === '') {
            return ['success' => false, 'message' => 'Grade is required'];
        }

        if ($grade < 0 || $grade > 20) {
            return ['success' => false, 'message' => 'Grade must be between 0 and 20'];
        }

        $this->submissionRepository->grade($submissionId, $grade, $comment);

        return ['success' => true, 'message' => 'Work graded successfully'];
    }

    public function getSubmissionByWorkAndStudent($workId, $studentId)
    {
        return $this->submissionRepository->findByWorkAndStudent($workId, $studentId);
    }

    public function getSubmissionsByWork($workId)
    {
        return $this->submissionRepository->findByWorkId($workId);
    }

    public function getSubmissionById($submissionId)
    {
        return $this->submissionRepository->findById($submissionId);
    }
}
