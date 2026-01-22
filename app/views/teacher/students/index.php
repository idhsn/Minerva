<?php $pageTitle = "Students"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Students</h2>
        <a href="/teacher/students/create" class="btn btn-primary">+ Create New Student</a>
    </div>

    <?php if (empty($students)): ?>
        <div class="alert alert-info">
            No students yet. Click "Create New Student" to get started!
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student->getFullName()) ?></td>
                            <td><?= htmlspecialchars($student->email) ?></td>
                            <td>
                                <?php if ($student->class_id): ?>
                                    <span class="badge bg-primary">Class #<?= $student->class_id ?></span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No Class</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('M d, Y', strtotime($student->created_at)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
