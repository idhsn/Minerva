<?php 
$pageTitle = "Assign Work"; 
$assignedIds = array_map(function($student) {
    return $student->id;
}, $assignedStudents);
?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-1">Aessign Work to Students</h3>
                    <p class="text-muted mb-4">Work: <strong><?= htmlspecialchars($work->title) ?></strong></p>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <?php if (empty($students)): ?>
                        <div class="alert alert-warning">
                            No students found in this class. Please create students first.
                        </div>
                        <a href="/teacher/students/create" class="btn btn-primary">Create Student</a>
                    <?php else: ?>
                        <form method="POST" action="/teacher/works/assign?id=<?= $work->id  ?>">
                            <div class="mb-3">
                                <label class="form-label">Select Students (multiple)</label>
                                <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                    <?php foreach ($students as $student): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="students[]" value="<?= $student->id ?>" 
                                                   id="student<?= $student->id ?>"
                                                   <?= in_array($student->id, $assignedIds) ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="student<?= $student->id ?>">
                                                <?= htmlspecialchars($student->getFullName()) ?> 
                                                <small class="text-muted">(<?= htmlspecialchars($student->email) ?>)</small>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Assign Work</button>
                                <a href="/teacher/works" class="btn btn-secondary">Back to Works</a>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
