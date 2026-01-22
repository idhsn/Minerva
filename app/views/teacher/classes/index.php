<?php $pageTitle = "My Classes"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Classes</h2>
        <a href="/teacher/classes/create" class="btn btn-primary">+ Create New Class</a>
    </div>

    <?php if (empty($classes)): ?>
        <div class="alert alert-info">
            You haven't created any classes yet. Click "Create New Class" to get started!
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($classes as $class): ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($class->name) ?></h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    👥 <?= $class->student_count ?> students
                                </small>
                            </p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Created: <?= date('M d, Y', strtotime($class->created_at)) ?>
                                </small>
                            </p>
                            <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
