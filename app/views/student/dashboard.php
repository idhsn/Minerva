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
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Student Dashboard</span>
            <div>
                <a href="/student/works" class="btn btn-outline-light btn-sm me-2">My Works</a>
                <a href="/student/grades" class="btn btn-outline-light btn-sm me-2">Grades</a>
                <a href="/student/classmates" class="btn btn-outline-light btn-sm me-2">Classmates</a>
                <a href="/chat" class="btn btn-outline-light btn-sm me-2">Chat</a>
                <span class="text-white me-3">Welcome, <?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome Student! 🎓</h1>
        
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">My Works</h5>
                        <p class="card-text">View and submit assigned works</p>
                        <a href="/student/works" class="btn btn-primary">Go to Works</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">My Grades</h5>
                        <p class="card-text">View your grades and feedback</p>
                        <a href="/student/grades" class="btn btn-primary">View Grades</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">My Classmates</h5>
                        <p class="card-text">See who's in your class</p>
                        <a href="/student/classmates" class="btn btn-primary">View Classmates</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Chat</h5>
                        <p class="card-text">Chat with your class</p>
                        <a href="/chat" class="btn btn-primary">Open Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
