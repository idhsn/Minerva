<?php

namespace App\Models;

use App\Core\Model;

class Submission extends Model
{
    public function submit($assignmentId, $studentId, $content, $filePath)
    {
        $stmt = $this->db->prepare("INSERT INTO submissions (assignment_id, student_id, content, file_path) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$assignmentId, $studentId, $content, $filePath]);
    }

    public function getByAssignment($assignmentId)
    {
        $stmt = $this->db->prepare("SELECT s.*, u.name as student_name FROM submissions s JOIN users u ON s.student_id = u.id WHERE assignment_id = ?");
        $stmt->execute([$assignmentId]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM submissions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
