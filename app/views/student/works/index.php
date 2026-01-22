<?php
require_once __DIR__ . '/../../../services/AuthService.php';
require_once __DIR__ . '/../../../services/SubmissionService.php';
$authService = new AuthService();
$submissionService = new SubmissionService();
$user = $authService->getCurrentUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Works</title>
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
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>My Assigned Works</h2>

        <?php if (empty($works)): ?>
            <div class="alert alert-info mt-3">
                No works assigned to you yet.
            </div>
        <?php else: ?>
            <div class="row mt-3">
                <?php foreach ($works as $work): ?>
                    <?php 
                    $submission = $submissionService->getSubmissionByWorkAndStudent($work->id, $user->id);
                    ?>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($work->title) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($work->description) ?></p>
                                
                                <?php if ($submission): ?>
                                    <?php if ($submission->isGraded()): ?>
                                        <span class="badge bg-success">Graded: <?= $submission->grade ?>/20</span>
                                    <?php else: ?>
                                        <span class="badge bg-info">Submitted - Awaiting Grade</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="badge bg-warning">Not Submitted</span>
                                    <br>
                                    <a href="/student/works/submit?id=<?= $work->id ?>" class="btn btn-sm btn-primary mt-2">Submit Work</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
