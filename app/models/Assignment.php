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
        $stmt = $this->db->prepare("SELECT a.*, c.name as class_name FROM assignments a JOIN classes c ON a.class_id = c.id WHERE a.class_id = ?");
        $stmt->execute([$classId]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT a.*, c.name as class_name FROM assignments a JOIN classes c ON a.class_id = c.id WHERE a.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $title, $description, $filePath, $classId)
    {
        $sql = "UPDATE assignments SET title = ?, description = ?, class_id = ?";
        $params = [$title, $description, $classId];

        if ($filePath) {
            $sql .= ", file_path = ?";
            $params[] = $filePath;
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM assignments WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getByTeacher($teacherId)
    {
        $stmt = $this->db->prepare("SELECT a.*, c.name as class_name FROM assignments a JOIN classes c ON a.class_id = c.id WHERE a.teacher_id = ? ORDER BY a.created_at DESC");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll();
    }
}
