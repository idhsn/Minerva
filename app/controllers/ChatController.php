<?php

require_once __DIR__ . '/../services/ChatService.php';
require_once __DIR__ . '/../services/ClassService.php';
require_once __DIR__ . '/../services/AuthService.php';

class ChatController
{
    private $chatService;
    private $classService;
    private $authService;

    public function __construct()
    {
        $this->chatService = new ChatService();
        $this->classService = new ClassService();
        $this->authService = new AuthService();

        if (!$this->authService->isLoggedIn()) {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $user = $this->authService->getCurrentUser();
        $classId = null;
        
        // Get class ID based on role
        if ($this->authService->isTeacher()) {
            $classId = $_GET['class_id'] ?? null;
            
            if (!$classId) {
                $classes = $this->classService->getTeacherClasses($user->id);
                require_once __DIR__ . '/../views/chat/select_class.php';
                return;
            }
        } else {
            // Student
            $classId = $user->class_id;
            
            if (!$classId) {
                $error = "You are not assigned to any class yet.";
                require_once __DIR__ . '/../views/chat/no_class.php';
                return;
            }
        }

        $class = $this->classService->getClassWithStudentCount($classId);
        if (!$class) {
            header('Location: /chat');
            exit;
        }

        // Handle message sending
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'] ?? '';
            $this->chatService->sendMessage($classId, $user->id, $message);
            header('Location: /chat?class_id=' . $classId);
            exit;
        }

        // Get messages
        $messages = $this->chatService->getMessages($classId);

        require_once __DIR__ . '/../views/chat/index.php';
    }
}
