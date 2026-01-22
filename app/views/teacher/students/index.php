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
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Teacher</span>
            <div>
                <a href="/teacher/dashboard" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <a href="/teacher/classes" class="btn btn-outline-light btn-sm me-2">Classes</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Students</h2>
            <a href="/teacher/students/create" class="btn btn-primary">+ Create New Student</a>
        </div>

        <?php if (empty($students)): ?>
            <div class="alert alert-info">
                No students yet. Click "Create New Student" to get started!
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Class</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student->getFullName()) ?></td>
                                <td><?= htmlspecialchars($student->email) ?></td>
                                <td>
                                    <?php if ($student->class_id): ?>
                                        <span class="badge bg-primary">Class #<?= $student->class_id ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No Class</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('M d, Y', strtotime($student->created_at)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
