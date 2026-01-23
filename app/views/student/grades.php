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
    <title>My Grades</title>
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
        <h2>My Grades</h2>

        <?php if (empty($gradesData)): ?>
            <div class="alert alert-info mt-3">
                No submissions yet.
            </div>
        <?php else: ?>
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Work Title</th>
                            <th>Submitted</th>
                            <th>Grade</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gradesData as $data): ?>
                            <tr>
                                <td><?= htmlspecialchars($data['work']->title) ?></td>
                                <td><?= date('M d, Y', strtotime($data['submission']->submitted_at)) ?></td>
                                <td>
                                    <?php if ($data['submission']->isGraded()): ?>
                                        <span class="badge bg-success"><?= $data['submission']->grade ?>/20</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $data['submission']->comment ? htmlspecialchars($data['submission']->comment) : '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
