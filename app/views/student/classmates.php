<?php
require_once __DIR__ . '/../../services/AuthService.php';
$authService = new AuthService();
$user = $authService->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classmates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Student</span>
            <div>
                <a href="/student/dashboard" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <a href="/student/works" class="btn btn-outline-light btn-sm me-2">My Works</a>
                <a href="/student/grades" class="btn btn-outline-light btn-sm me-2">Grades</a>
                <a href="/student/classmates" class="btn btn-outline-light btn-sm me-2">Classmates</a>
                <a href="/chat" class="btn btn-outline-light btn-sm me-2">Chat</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>My Classmates</h2>
        <?php if ($className): ?>
            <p class="text-muted">Class: <strong><?= htmlspecialchars($className) ?></strong></p>
        <?php endif; ?>

        <?php if (empty($classmates)): ?>
            <div class="alert alert-info mt-3">
                <?= $user->class_id ? 'No other students in your class yet.' : 'You are not assigned to any class yet.' ?>
            </div>
        <?php else: ?>
            <div class="row mt-3">
                <?php foreach ($classmates as $classmate): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($classmate->getFullName()) ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">📧 <?= htmlspecialchars($classmate->email) ?></small>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
