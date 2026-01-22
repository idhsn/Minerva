<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch();

        if ($data) {
            return new User($data);
        }
        return null;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new User($data);
        }
        return null;
    }

    public function create($email, $hashedPassword, $role, $firstName, $lastName, $classId = null)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (email, password, role, first_name, last_name, class_id) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$email, $hashedPassword, $role, $firstName, $lastName, $classId]);
        
        return $this->pdo->lastInsertId();
    }

    public function findByClassId($classId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE class_id = ? AND role = 'student'");
        $stmt->execute([$classId]);
        
        $students = [];
        while ($data = $stmt->fetch()) {
            $students[] = new User($data);
        }
        
        return $students;
    }

    public function findAllStudents()
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE role = 'student' ORDER BY created_at DESC");
        
        $students = [];
        while ($data = $stmt->fetch()) {
            $students[] = new User($data);
        }
        
        return $students;
    }
}
