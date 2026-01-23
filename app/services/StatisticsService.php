<?php

require_once __DIR__ . '/../repositories/WorkRepository.php';
require_once __DIR__ . '/../repositories/SubmissionRepository.php';
require_once __DIR__ . '/../repositories/AttendanceRepository.php';

class StatisticsService
{
    private $workRepository;
    private $submissionRepository;
    private $attendanceRepository;

    public function __construct()
    {
        $this->workRepository = new WorkRepository();
        $this->submissionRepository = new SubmissionRepository();
        $this->attendanceRepository = new AttendanceRepository();
    }

    public function getClassStatistics($classId)
    {
        $stats = [];

        // Total works for this class
        $works = $this->workRepository->findByClassId($classId);
        $stats['total_works'] = count($works);

        // Total submissions
        $allSubmissions = [];
        foreach ($works as $work) {
            $submissions = $this->submissionRepository->findByWorkId($work->id);
            $allSubmissions = array_merge($allSubmissions, $submissions);
        }
        $stats['total_submissions'] = count($allSubmissions);

        // Average grade
        $gradedSubmissions = array_filter($allSubmissions, function($sub) {
            return $sub->grade !== null;
        });
        
        if (count($gradedSubmissions) > 0) {
            $totalGrades = array_sum(array_map(function($sub) {
                return $sub->grade;
            }, $gradedSubmissions));
            $stats['average_grade'] = round($totalGrades / count($gradedSubmissions), 2);
        } else {
            $stats['average_grade'] = 0;
        }

        // Attendance stats
        $attendanceStats = $this->attendanceRepository->getAttendanceStats($classId);
        $totalPresent = 0;
        $totalRecords = 0;

        foreach ($attendanceStats as $stat) {
            $totalPresent += $stat['present_count'];
            $totalRecords += $stat['total_records'];
        }

        if ($totalRecords > 0) {
            $stats['attendance_rate'] = round(($totalPresent / $totalRecords) * 100, 1);
        } else {
            $stats['attendance_rate'] = 0;
        }

        return $stats;
    }
}
