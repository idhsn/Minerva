<?php
require_once __DIR__ . '/../../services/AuthService.php';
$authService = new AuthService();
$user = $authService->getCurrentUser();
$isTeacher = $authService->isTeacher();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - <?= htmlspecialchars($class->name) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-container {
            height: 500px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            background-color: #f8f9fa;
        }
        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            background-color: white;
        }
        .message-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .message-time {
            font-size: 0.85em;
            color: #6c757d;
        }
        .teacher-message {
            border-left: 4px solid #0d6efd;
        }
        .student-message {
            border-left: 4px solid #198754;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark <?= $isTeacher ? 'bg-dark' : 'bg-primary' ?>">
        <div class="container-fluid">
            <span class="navbar-brand">Minerva - Chat</span>
            <div>
                <a href="<?= $isTeacher ? '/teacher/dashboard' : '/student/dashboard' ?>" class="btn btn-outline-light btn-sm me-2">Dashboard</a>
                <span class="text-white me-3"><?= $user->getFullName() ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>💬 Chat: <?= htmlspecialchars($class->name) ?></h2>
            <?php if ($isTeacher): ?>
                <a href="/chat" class="btn btn-secondary">Back</a>
            <?php endif; ?>
        </div>

        <div class="chat-container mb-3" id="chatContainer">
            <?php if (empty($messages)): ?>
                <p class="text-muted">No messages yet. Start the conversation!</p>
            <?php else: ?>
                <?php foreach ($messages as $msg): ?>
                    <div class="message <?= $msg['role'] === 'teacher' ? 'teacher-message' : 'student-message' ?>">
                        <div class="message-header">
                            <?= htmlspecialchars($msg['first_name'] . ' ' . $msg['last_name']) ?>
                            <span class="badge <?= $msg['role'] === 'teacher' ? 'bg-primary' : 'bg-success' ?>">
                                <?= ucfirst($msg['role']) ?>
                            </span>
                        </div>
                        <div><?= nl2br(htmlspecialchars($msg['message'])) ?></div>
                        <div class="message-time"><?= date('M d, Y H:i', strtotime($msg['created_at'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <form method="POST" action="/chat?class_id=<?= $class->id ?>">
            <div class="input-group">
                <input type="text" class="form-control" name="message" 
                       placeholder="Type your message..." required autofocus>
                <button class="btn btn-primary" type="submit">Send</button>
            </div>
        </form>
    </div>

    <script>
        // Auto-scroll to bottom of chat
        const chatContainer = document.getElementById('chatContainer');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</body>
</html>
