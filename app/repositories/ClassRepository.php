<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Class.php';

class ClassRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create($name, $teacherId)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO classes (name, teacher_id) VALUES (?, ?)"
        );
        $stmt->execute([$name, $teacherId]);
        
        return $this->pdo->lastInsertId();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new ClassModel($data);
        }
        return null;
    }

    public function findByTeacherId($teacherId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM classes WHERE teacher_id = ?");
        $stmt->execute([$teacherId]);
        
        $classes = [];
        while ($data = $stmt->fetch()) {
            $classes[] = new ClassModel($data);
        }
        
        return $classes;
    }

    public function getStudentCount($classId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) as count FROM users WHERE class_id = ? AND role = 'student'"
        );
        $stmt->execute([$classId]);
        $result = $stmt->fetch();
        
        return $result['count'];
    }
}
