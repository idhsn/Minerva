<?php

require_once __DIR__ . '/../core/Database.php';

class AttendanceRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function markAttendance($studentId, $classId, $date, $status)
    {
        // Check if already marked for this date
        $stmt = $this->pdo->prepare(
            "SELECT id FROM attendance WHERE student_id = ? AND class_id = ? AND date = ?"
        );
        $stmt->execute([$studentId, $classId, $date]);
        $existing = $stmt->fetch();

        if ($existing) {
            // Update existing
            $stmt = $this->pdo->prepare(
                "UPDATE attendance SET status = ? WHERE id = ?"
            );
            $stmt->execute([$status, $existing['id']]);
            return $existing['id'];
        } else {
            // Create new - REMOVED recorded_by column
            $stmt = $this->pdo->prepare(
                "INSERT INTO attendance (student_id, class_id, date, status) VALUES (?, ?, ?, ?)"
            );
            $stmt->execute([$studentId, $classId, $date, $status]);
            return $this->pdo->lastInsertId();
        }
    }

    public function getAttendanceByClassAndDate($classId, $date)
    {
        $stmt = $this->pdo->prepare(
            "SELECT a.*, u.first_name, u.last_name, u.email 
             FROM attendance a
             INNER JOIN users u ON a.student_id = u.id
             WHERE a.class_id = ? AND a.date = ?"
        );
        $stmt->execute([$classId, $date]);
        
        return $stmt->fetchAll();
    }

    public function getStudentAttendance($studentId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM attendance WHERE student_id = ? ORDER BY date DESC"
        );
        $stmt->execute([$studentId]);
        
        return $stmt->fetchAll();
    }

    public function getAttendanceStats($classId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                student_id,
                COUNT(*) as total_records,
                SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) as present_count,
                SUM(CASE WHEN status = 'absent' THEN 1 ELSE 0 END) as absent_count
             FROM attendance 
             WHERE class_id = ?
             GROUP BY student_id"
        );
        $stmt->execute([$classId]);
        
        return $stmt->fetchAll();
    }
}
