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
    <title>Submit Work</title>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-1">Submit Work</h3>
                        <p class="text-muted mb-4">Work: <strong><?= htmlspecialchars($work->title) ?></strong></p>

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php endif; ?>

                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?= $success ?></div>
                        <?php endif; ?>

                        <?php if ($existingSubmission): ?>
                            <div class="alert alert-warning">
                                You have already submitted this work.
                                <?php if ($existingSubmission->isGraded()): ?>
                                    <br><strong>Grade: <?= $existingSubmission->grade ?>/20</strong>
                                    <?php if ($existingSubmission->comment): ?>
                                        <br>Comment: <?= htmlspecialchars($existingSubmission->comment) ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <br>Awaiting teacher's grade.
                                <?php endif; ?>
                            </div>
                            <a href="/student/works" class="btn btn-secondary">Back to Works</a>
                        <?php else: ?>
                            <div class="mb-3">
                                <label class="form-label">Work Description:</label>
                                <p class="border p-3 bg-light"><?= htmlspecialchars($work->description) ?></p>
                            </div>

                            <form method="POST" action="/student/works/submit?id=<?= $work->id ?>">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Your Answer</label>
                                    <textarea class="form-control" id="content" name="content" rows="8" 
                                              placeholder="Type your answer here..." required></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Submit Work</button>
                                    <a href="/student/works" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
