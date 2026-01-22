<?php

require_once __DIR__ . '/../services/AttendanceService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/StudentService.php';
require_once __DIR__ . '/../services/AuthService.php';

class AttendanceController
{
    private $attendanceService;
    private $classService;
    private $studentService;
    private $authService;

    public function __construct()
    {
        $this->attendanceService = new AttendanceService();
        $this->classService = new ClassService();
        $this->studentService = new StudentService();
        $this->authService = new AuthService();

        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $user = $this->authService->getCurrentUser();
        $classes = $this->classService->getTeacherClasses($user->id);

        require_once __DIR__ . '/../views/teacher/attendance/index.php';
    }

    public function take()
    {
        $classId = $_GET['class_id'] ?? null;
        $date = $_GET['date'] ?? date('Y-m-d');

        if (!$classId) {
            header('Location: /teacher/attendance');
            exit;
        }

        $class = $this->classService->getClassWithStudentCount($classId);
        if (!$class) {
            header('Location: /teacher/attendance');
            exit;
        }

        $students = $this->studentService->getStudentsByClassId($classId);
        $existingAttendance = $this->attendanceService->getAttendanceByClassAndDate($classId, $date);

        // Create a map of existing attendance
        $attendanceMap = [];
        foreach ($existingAttendance as $record) {
            $attendanceMap[$record['student_id']] = $record['status'];
        }

        $error = null;
        $success = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $attendanceData = [];
            
            foreach ($students as $student) {
                $status = $_POST['attendance_' . $student->id] ?? 'absent';
                $attendanceData[$student->id] = $status;
            }

            $result = $this->attendanceService->markMultipleAttendance($classId, $date, $attendanceData);

            if ($result['success']) {
                $success = $result['message'];
                // Refresh attendance data
                $existingAttendance = $this->attendanceService->getAttendanceByClassAndDate($classId, $date);
                $attendanceMap = [];
                foreach ($existingAttendance as $record) {
                    $attendanceMap[$record['student_id']] = $record['status'];
                }
            } else {
                $error = $result['message'];
            }
        }

        require_once __DIR__ . '/../views/teacher/attendance/take.php';
    }

    public function stats()
    {
        $classId = $_GET['class_id'] ?? null;

        if (!$classId) {
            header('Location: /teacher/attendance');
            exit;
        }

        $class = $this->classService->getClassWithStudentCount($classId);
        if (!$class) {
            header('Location: /teacher/attendance');
            exit;
        }

        $students = $this->studentService->getStudentsByClassId($classId);
        $stats = $this->attendanceService->getAttendanceStats($classId);

        // Create stats map
        $statsMap = [];
        foreach ($stats as $stat) {
            $statsMap[$stat['student_id']] = $stat;
        }

        require_once __DIR__ . '/../views/teacher/attendance/stats.php';
    }
}
