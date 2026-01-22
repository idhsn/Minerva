<?php

namespace App\Models;

use App\Core\Model;

class Assignment extends Model
{
    public function create($title, $description, $filePath, $teacherId, $classId)
    {
        $stmt = $this->db->prepare("INSERT INTO assignments (title, description, file_path, teacher_id, class_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $filePath, $teacherId, $classId]);
    }

    public function getByClass($classId)
    {
        $stmt = $this->db->prepare("SELECT * FROM assignments WHERE class_id = ?");
        $stmt->execute([$classId]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM assignments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
