<?php $pageTitle = "Create Student"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Create New Student</h3>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <?= $success ?>
                            <hr>
                            <strong>Generated Password:</strong> 
                            <code class="fs-5"><?= $generatedPassword ?></code>
                            <br><small class="text-muted">⚠️ Save this password! It won't be shown again.</small>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/teacher/students/create">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Assign to Class</label>
                            <select class="form-select" id="class_id" name="class_id">
                                <option value="">No Class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class->id ?>"><?= htmlspecialchars($class->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Optional: Assign student to a class</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Create Student</button>
                            <a href="/teacher/students" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
