<?php $pageTitle = "Grade Submission"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-1">Grade Submission</h3>
                    <p class="text-muted mb-1">Student: <strong><?= htmlspecialchars($student->getFullName()) ?></strong></p>
                    <p class="text-muted mb-4">Work: <strong><?= htmlspecialchars($work->title) ?></strong></p>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Student's Answer:</label>
                        <div class="border p-3 bg-light">
                            <?= nl2br(htmlspecialchars($submission->content)) ?>
                        </div>
                        <small class="text-muted">Submitted: <?= date('M d, Y H:i', strtotime($submission->submitted_at)) ?></small>
                    </div>

                    <form method="POST" action="/teacher/works/grade?id=<?= $submission->id ?>">
                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade (0-20)</label>
                            <input type="number" class="form-control" id="grade" name="grade" 
                                   min="0" max="20" step="0.5" 
                                   value="<?= $submission->grade ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment (optional)</label>
                            <textarea class="form-control" id="comment" name="comment" rows="4" 
                                      placeholder="Add feedback for the student..."><?= htmlspecialchars($submission->comment ?? '') ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Save Grade</button>
                            <a href="/teacher/works/submissions?id=<?= $work->id ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
