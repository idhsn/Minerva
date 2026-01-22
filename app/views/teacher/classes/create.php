<?php $pageTitle = "Create Class"; ?>
<?php include __DIR__ . '/../../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Create New Class</h3>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div>
                    <?php endif; ?>

                    <form method="POST" action="/teacher/classes/create">
                        <div class="mb-3">
                            <label for="name" class="form-label">Class Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   placeholder="e.g., Web Development 2026" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Create Class</button>
                            <a href="/teacher/classes" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../../layout/footer.php'; ?>
