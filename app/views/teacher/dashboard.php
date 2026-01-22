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
    <title>Teacher Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Teacher Dashboard</span>
            <div>
                <span class="text-white me-3">Welcome, <?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome Teacher! 👨‍🏫</h1>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">My Classes</h5>
                        <p class="card-text">View and manage your classes</p>
                        <a href="/teacher/classes" class="btn btn-primary">Go to Classes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Students</h5>
                        <p class="card-text">Manage student accounts</p>
                        <a href="/teacher/students" class="btn btn-primary">Manage Students</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Works</h5>
                        <p class="card-text">Create and assign works</p>
                        <a href="#" class="btn btn-secondary disabled">Coming Soon</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
