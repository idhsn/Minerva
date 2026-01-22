<?php $pageTitle = "Create Work"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Create New Work</h3>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success">
                            <?= $success ?>
                            <br>
                            <a href="/teacher/works/assign?id=<?= $createdWorkId ?>" class="btn btn-sm btn-primary mt-2">
                                Assign to Students Now
                            </a>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/teacher/works/create">
                        <div class="mb-3">
                            <label for="title" class="form-label">Work Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                                   placeholder="e.g., PHP OOP Assignment" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" 
                                      rows="5" placeholder="Describe the work..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="class_id" class="form-label">Class</label>
                            <select class="form-select" id="class_id" name="class_id" required>
                                <option value="">Select a class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class->id ?>"><?= htmlspecialchars($class->name) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Create Work</button>
                            <a href="/teacher/works" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
