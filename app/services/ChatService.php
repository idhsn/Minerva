<?php

require_once __DIR__ . '/../repositories/ChatRepository.php';

class ChatService
{
    private $chatRepository;

    public function __construct()
    {
        $this->chatRepository = new ChatRepository();
    }

    public function sendMessage($classId, $userId, $message)
    {
        if (empty(trim($message))) {
            return ['success' => false, 'message' => 'Message cannot be empty'];
        }

        $messageId = $this->chatRepository->create($classId, $userId, $message);

        return ['success' => true, 'message_id' => $messageId];
    }

    public function getMessages($classId, $limit = 50)
    {
        return $this->chatRepository->getMessagesByClass($classId, $limit);
    }
}
