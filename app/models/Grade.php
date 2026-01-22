<?php

namespace App\Models;

use App\Core\Model;

class Grade extends Model
{
    public function grade($submissionId, $score, $comment, $teacherId)
    {
        $stmt = $this->db->prepare("INSERT INTO grades (submission_id, score, comment, teacher_id) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE score = VALUES(score), comment = VALUES(comment)");
        return $stmt->execute([$submissionId, $score, $comment, $teacherId]);
    }

    public function getBySubmission($submissionId)
    {
        $stmt = $this->db->prepare("SELECT * FROM grades WHERE submission_id = ?");
        $stmt->execute([$submissionId]);
        return $stmt->fetch();
    }
}
