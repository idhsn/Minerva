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
    <title><?= $pageTitle ?? 'Minerva' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Teacher</span>
            <div>
                <a href="/teacher/dashboard" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <a href="/teacher/classes" class="btn btn-outline-light btn-sm me-2">Classes</a>
                <a href="/teacher/students" class="btn btn-outline-light btn-sm me-2">Students</a>
                <a href="/teacher/works" class="btn btn-outline-light btn-sm me-2">Works</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
