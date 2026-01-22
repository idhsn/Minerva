<?php

namespace App\Models;

use App\Core\Model;

class ClassModel extends Model
{
    public function create($name, $teacherId)
    {
        $stmt = $this->db->prepare("INSERT INTO classes (name, teacher_id) VALUES (?, ?)");
        return $stmt->execute([$name, $teacherId]);
    }

    public function getAllByTeacher($teacherId)
    {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE teacher_id = ?");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function addStudent($classId, $studentId)
    {
        $stmt = $this->db->prepare("INSERT INTO class_students (class_id, student_id) VALUES (?, ?)");
        return $stmt->execute([$classId, $studentId]);
    }

    public function getStudents($classId)
    {
        $stmt = $this->db->prepare("
            SELECT u.* FROM users u 
            JOIN class_students cs ON u.id = cs.student_id 
            WHERE cs.class_id = ?
        ");
        $stmt->execute([$classId]);
        return $stmt->fetchAll();
    }

    public function getStudentClasses($studentId)
    {
        $stmt = $this->db->prepare("
            SELECT c.* FROM classes c
            JOIN class_students cs ON c.id = cs.class_id
            WHERE cs.student_id = ?
        ");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll();
    }
}
