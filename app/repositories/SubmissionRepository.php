<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Submission.php';

class SubmissionRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create($workId, $studentId, $content)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO submissions (work_id, student_id, content) VALUES (?, ?, ?)"
        );
        $stmt->execute([$workId, $studentId, $content]);
        
        return $this->pdo->lastInsertId();
    }

    public function findByWorkAndStudent($workId, $studentId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM submissions WHERE work_id = ? AND student_id = ?"
        );
        $stmt->execute([$workId, $studentId]);
        $data = $stmt->fetch();

        if ($data) {
            return new Submission($data);
        }
        return null;
    }

    public function findByWorkId($workId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM submissions WHERE work_id = ?");
        $stmt->execute([$workId]);
        
        $submissions = [];
        while ($data = $stmt->fetch()) {
            $submissions[] = new Submission($data);
        }
        
        return $submissions;
    }

    public function findByStudentId($studentId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM submissions WHERE student_id = ?");
        $stmt->execute([$studentId]);
        
        $submissions = [];
        while ($data = $stmt->fetch()) {
            $submissions[] = new Submission($data);
        }
        
        return $submissions;
    }

    public function grade($submissionId, $grade, $comment)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE submissions SET grade = ?, comment = ? WHERE id = ?"
        );
        $stmt->execute([$grade, $comment, $submissionId]);
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM submissions WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new Submission($data);
        }
        return null;
    }
}
