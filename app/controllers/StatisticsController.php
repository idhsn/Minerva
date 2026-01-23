<?php

require_once __DIR__ . '/../services/StatisticsService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/AuthService.php';

class StatisticsController
{
    private $statisticsService;
    private $classService;
    private $authService;

    public function __construct()
    {
        $this->statisticsService = new StatisticsService();
        $this->classService = new ClassService();
        $this->authService = new AuthService();

        if (!$this->authService->isTeacher()) {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $classId = $_GET['class_id'] ?? null;

        if (!$classId) {
            $user = $this->authService->getCurrentUser();
            $classes = $this->classService->getTeacherClasses($user->id);
            require_once __DIR__ . '/../views/teacher/statistics/select.php';
            return;
        }

        $class = $this->classService->getClassWithStudentCount($classId);
        if (!$class) {
            header('Location: /teacher/statistics');
            exit;
        }

        $stats = $this->statisticsService->getClassStatistics($classId);

        require_once __DIR__ . '/../views/teacher/statistics/index.php';
    }
}
