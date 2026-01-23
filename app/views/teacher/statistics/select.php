<?php $pageTitle = "Statistics"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Class Statistics</h2>
    <p class="text-muted">Select a class to view statistics</p>

    <?php if (empty($classes)): ?>
        <div class="alert alert-info mt-3">
            No classes available.
        </div>
    <?php else: ?>
        <div class="row mt-3">
            <?php foreach ($classes as $class): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($class->name) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">👥 <?= $class->student_count ?> students</small>
                            </p>
                            <a href="/teacher/statistics?class_id=<?= $class->id ?>" class="btn btn-primary">View Statistics</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
