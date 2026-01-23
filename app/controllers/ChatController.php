<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Services\ChatService;

class ChatController extends Controller
{
    private $chatService;

    public function __construct()
    {
        Auth::requireLogin();
        $this->chatService = new ChatService();
    }

    public function index()
    {
        $classId = $_GET['class_id'] ?? 0;
        $user = Auth::user();
        if (!$classId) {
            // If no class specified, maybe redirect to dashboard or show a select
            $this->redirect($user['role'] === 'teacher' ? '/php_briefs/Minerva_binomes/teacher/dashboard' : '/php_briefs/Minerva_binomes/student/dashboard');
        }

        $messages = $this->chatService->getMessages($classId);
        $view = ($user['role'] === 'teacher') ? 'teacher/teacher_chat' : 'student/student_chat';

        $this->view($view, [
            'messages' => $messages,
            'classId' => $classId,
            'user' => $user
        ]);
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classId = $_POST['class_id'] ?? 0;
            $message = $_POST['message'] ?? '';
            $user = Auth::user();

            if ($classId && !empty(trim($message))) {
                $this->chatService->sendMessage($classId, $user['id'], $message);
            }
            $this->redirect("/php_briefs/Minerva_binomes/chat?class_id=$classId");
        }
    }
}
