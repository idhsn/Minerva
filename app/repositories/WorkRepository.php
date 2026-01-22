<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/Work.php';

class WorkRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create($title, $description, $classId, $teacherId)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO works (title, description, class_id, teacher_id) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$title, $description, $classId, $teacherId]);
        
        return $this->pdo->lastInsertId();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM works WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new Work($data);
        }
        return null;
    }

    public function findByTeacherId($teacherId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM works WHERE teacher_id = ? ORDER BY created_at DESC");
        $stmt->execute([$teacherId]);
        
        $works = [];
        while ($data = $stmt->fetch()) {
            $works[] = new Work($data);
        }
        
        return $works;
    }

    public function findByClassId($classId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM works WHERE class_id = ? ORDER BY created_at DESC");
        $stmt->execute([$classId]);
        
        $works = [];
        while ($data = $stmt->fetch()) {
            $works[] = new Work($data);
        }
        
        return $works;
    }

    public function assignToStudent($workId, $studentId)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO work_assignments (work_id, student_id) VALUES (?, ?)"
        );
        $stmt->execute([$workId, $studentId]);
    }

    public function getAssignedStudents($workId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT u.* FROM users u 
             INNER JOIN work_assignments wa ON u.id = wa.student_id 
             WHERE wa.work_id = ?"
        );
        $stmt->execute([$workId]);
        
        $students = [];
        while ($data = $stmt->fetch()) {
            $students[] = new User($data);
        }
        
        return $students;
    }

    public function getAssignedWorks($studentId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT w.* FROM works w 
             INNER JOIN work_assignments wa ON w.id = wa.work_id 
             WHERE wa.student_id = ?
             ORDER BY w.created_at DESC"
        );
        $stmt->execute([$studentId]);
        
        $works = [];
        while ($data = $stmt->fetch()) {
            $works[] = new Work($data);
        }
        
        return $works;
    }
}
