<?php

require_once __DIR__ . '/../repositories/AttendanceRepository.php';

class AttendanceService
{
    private $attendanceRepository;

    public function __construct()
    {
        $this->attendanceRepository = new AttendanceRepository();
    }

    public function markAttendance($studentId, $classId, $date, $status)
    {
        if (!in_array($status, ['present', 'absent'])) {
            return ['success' => false, 'message' => 'Invalid status'];
        }

        $this->attendanceRepository->markAttendance($studentId, $classId, $date, $status);

        return ['success' => true, 'message' => 'Attendance marked successfully'];
    }

    public function markMultipleAttendance($classId, $date, $attendanceData)
    {
        foreach ($attendanceData as $studentId => $status) {
            $this->attendanceRepository->markAttendance($studentId, $classId, $date, $status);
        }

        return ['success' => true, 'message' => 'Attendance saved for all students'];
    }

    public function getAttendanceByClassAndDate($classId, $date)
    {
        return $this->attendanceRepository->getAttendanceByClassAndDate($classId, $date);
    }

    public function getStudentAttendance($studentId)
    {
        return $this->attendanceRepository->getStudentAttendance($studentId);
    }

    public function getAttendanceStats($classId)
    {
        return $this->attendanceRepository->getAttendanceStats($classId);
    }
}
