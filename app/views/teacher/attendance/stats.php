<?php $pageTitle = "Attendance Statistics"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Attendance Statistics</h2>
            <p class="text-muted mb-0">Class: <strong><?= htmlspecialchars($class->name) ?></strong></p>
        </div>
        <a href="/teacher/attendance" class="btn btn-secondary">Back</a>
    </div>

    <?php if (empty($students)): ?>
        <div class="alert alert-warning">
            No students in this class.
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Total Records</th>
                            <th>Present</th>
                            <th>Absent</th>
                            <th>Attendance Rate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <?php 
                            $studentStats = $statsMap[$student->id] ?? null;
                            $totalRecords = $studentStats['total_records'] ?? 0;
                            $presentCount = $studentStats['present_count'] ?? 0;
                            $absentCount = $studentStats['absent_count'] ?? 0;
                            $attendanceRate = $totalRecords > 0 ? round(($presentCount / $totalRecords) * 100, 1) : 0;
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($student->getFullName()) ?></td>
                                <td><?= $totalRecords ?></td>
                                <td><span class="badge bg-success"><?= $presentCount ?></span></td>
                                <td><span class="badge bg-danger"><?= $absentCount ?></span></td>
                                <td>
                                    <div class="progress" style="height: 25px;">
                                        <div class="progress-bar <?= $attendanceRate >= 75 ? 'bg-success' : ($attendanceRate >= 50 ? 'bg-warning' : 'bg-danger') ?>" 
                                             role="progressbar" 
                                             style="width: <?= $attendanceRate ?>%">
                                            <?= $attendanceRate ?>%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
