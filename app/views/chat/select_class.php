<?php $pageTitle = "Chat"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Class Chat</h2>
    <p class="text-muted">Select a class to join chat</p>

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
                            <a href="/chat?class_id=<?= $class->id ?>" class="btn btn-primary">Join Chat</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
