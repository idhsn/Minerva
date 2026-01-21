<?php
require_once __DIR__ . '/../../../services/AuthService.php';
$authService = new AuthService();
$user = $authService->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Teacher</span>
            <div>
                <a href="/teacher/dashboard" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>My Classes</h2>
            <a href="/teacher/classes/create" class="btn btn-primary">+ Create New Class</a>
        </div>

        <?php if (empty($classes)): ?>
            <div class="alert alert-info">
                You haven't created any classes yet. Click "Create New Class" to get started!
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($classes as $class): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($class->name) ?></h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        👥 <?= $class->student_count ?> students
                                    </small>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Created: <?= date('M d, Y', strtotime($class->created_at)) ?>
                                    </small>
                                </p>
                                <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
