<?php $pageTitle = "Attendance"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Attendance Management</h2>

    <?php if (empty($classes)): ?>
        <div class="alert alert-info mt-3">
            No classes available. Please create a class first.
        </div>
    <?php else: ?>
        <div class="row mt-3">
            <?php foreach ($classes as $class): ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($class->name) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    👥 <?= $class->student_count ?> students
                                </small>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="/teacher/attendance/take?class_id=<?= $class->id ?>&date=<?= date('Y-m-d') ?>" 
                                   class="btn btn-sm btn-primary">Take Attendance Today</a>
                                <a href="/teacher/attendance/stats?class_id=<?= $class->id ?>" 
                                   class="btn btn-sm btn-info">View Statistics</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
