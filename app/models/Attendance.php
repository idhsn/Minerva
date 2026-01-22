<?php

namespace App\Models;

use App\Core\Model;

class Attendance extends Model
{
    public function takeAttendance($classId, $studentId, $date, $status)
    {
        $stmt = $this->db->prepare("INSERT INTO attendance (class_id, student_id, date, status) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE status = VALUES(status)");
        return $stmt->execute([$classId, $studentId, $date, $status]);
    }

    public function getByClassAndDate($classId, $date)
    {
        $stmt = $this->db->prepare("SELECT * FROM attendance WHERE class_id = ? AND date = ?");
        $stmt->execute([$classId, $date]);
        return $stmt->fetchAll();
    }

    public function getStatsForTeacher($teacherId)
    {
        $stmt = $this->db->prepare("
            SELECT c.name as class_name, 
                   COUNT(CASE WHEN a.status = 'present' THEN 1 END) as present_count,
                   COUNT(CASE WHEN a.status = 'absent' THEN 1 END) as absent_count
            FROM classes c
            LEFT JOIN attendance a ON c.id = a.class_id
            WHERE c.teacher_id = ?
            GROUP BY c.id
        ");
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll();
    }
}
