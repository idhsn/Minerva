<?php $pageTitle = "My Works"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Works</h2>
        <a href="/teacher/works/create" class="btn btn-primary">+ Create New Work</a>
    </div>

    <?php if (empty($works)): ?>
        <div class="alert alert-info">
            No works yet. Click "Create New Work" to get started!
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($works as $work): ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($work->title) ?></h5>
                            <p class="card-text"><?= htmlspecialchars(substr($work->description, 0, 100)) ?>...</p>
                            <p class="card-text">
                                <small class="text-muted">
                                    Created: <?= date('M d, Y', strtotime($work->created_at)) ?>
                                </small>
                            </p>
                            <a href="/teacher/works/assign?id=<?= $work->id ?>" class="btn btn-sm btn-primary">Assign to Students</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
