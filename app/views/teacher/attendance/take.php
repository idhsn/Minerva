<?php $pageTitle = "Take Attendance"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Take Attendance</h2>
            <p class="text-muted mb-0">Class: <strong><?= htmlspecialchars($class->name) ?></strong></p>
        </div>
        <a href="/teacher/attendance" class="btn btn-secondary">Back</a>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="GET" action="/teacher/attendance/take" class="mb-4">
        <input type="hidden" name="class_id" value="<?= $classId ?>">
        <div class="row">
            <div class="col-md-4">
                <label for="date" class="form-label">Select Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?= $date ?>" 
                       onchange="this.form.submit()">
            </div>
        </div>
    </form>

    <?php if (empty($students)): ?>
        <div class="alert alert-warning">
            No students in this class. Please add students first.
        </div>
    <?php else: ?>
        <form method="POST" action="/teacher/attendance/take?class_id=<?= $classId ?>&date=<?= $date ?>">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $student): ?>
                                <?php $currentStatus = $attendanceMap[$student->id] ?? 'present'; ?>
                                <tr>
                                    <td><?= htmlspecialchars($student->getFullName()) ?></td>
                                    <td><?= htmlspecialchars($student->email) ?></td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" 
                                                   name="attendance_<?= $student->id ?>" 
                                                   id="present_<?= $student->id ?>" 
                                                   value="present" 
                                                   <?= $currentStatus === 'present' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="present_<?= $student->id ?>">
                                                ✅ Present
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" 
                                                   name="attendance_<?= $student->id ?>" 
                                                   id="absent_<?= $student->id ?>" 
                                                   value="absent"
                                                   <?= $currentStatus === 'absent' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="absent_<?= $student->id ?>">
                                                ❌ Absent
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary">Save Attendance</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
