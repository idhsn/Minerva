<?php $pageTitle = "Submissions"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <h2>Submissions for: <?= htmlspecialchars($work->title) ?></h2>
    <a href="/teacher/works" class="btn btn-sm btn-secondary mb-3">Back to Works</a>

    <?php if (empty($submissionsWithStudents)): ?>
        <div class="alert alert-info">
            No submissions yet.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Submitted</th>
                        <th>Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissionsWithStudents as $data): ?>
                        <tr>
                            <td><?= htmlspecialchars($data['student']->getFullName()) ?></td>
                            <td><?= date('M d, Y H:i', strtotime($data['submission']->submitted_at)) ?></td>
                            <td>
                                <?php if ($data['submission']->isGraded()): ?>
                                    <span class="badge bg-success"><?= $data['submission']->grade ?>/20</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Not Graded</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/teacher/works/grade?id=<?= $data['submission']->id ?>" class="btn btn-sm btn-primary">
                                    <?= $data['submission']->isGraded() ? 'Edit Grade' : 'Grade' ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
