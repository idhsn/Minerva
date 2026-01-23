<?php $pageTitle = "Statistics - " . htmlspecialchars($class->name); ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Statistics</h2>
            <p class="text-muted mb-0">Class: <strong><?= htmlspecialchars($class->name) ?></strong></p>
        </div>
        <a href="/teacher/statistics" class="btn btn-secondary">Back</a>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Total Works</h6>
                    <h2 class="card-title"><?= $stats['total_works'] ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Total Submissions</h6>
                    <h2 class="card-title"><?= $stats['total_submissions'] ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Average Grade</h6>
                    <h2 class="card-title"><?= $stats['average_grade'] ?>/20</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">Attendance Rate</h6>
                    <h2 class="card-title"><?= $stats['attendance_rate'] ?>%</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Summary</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Number of students:</span>
                        <strong><?= $class->student_count ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Works created:</span>
                        <strong><?= $stats['total_works'] ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Student submissions:</span>
                        <strong><?= $stats['total_submissions'] ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Class average:</span>
                        <strong><?= $stats['average_grade'] ?>/20</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Overall attendance:</span>
                        <strong><?= $stats['attendance_rate'] ?>%</strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
