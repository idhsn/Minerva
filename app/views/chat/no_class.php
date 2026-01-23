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
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Student</span>
            <div>
                <a href="/student/dashboard" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="alert alert-warning">
            <?= htmlspecialchars($error) ?>
        </div>
        <a href="/student/dashboard" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</body>
</html>
