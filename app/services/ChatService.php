<?php

namespace App\Services;

use App\Models\ChatMessage;

class ChatService
{
    private $chatModel;

    public function __construct()
    {
        $this->chatModel = new ChatMessage();
    }

    public function sendMessage($classId, $senderId, $message)
    {
        return $this->chatModel->sendMessage($classId, $senderId, $message);
    }

    public function getMessages($classId)
    {
        return $this->chatModel->getByClass($classId);
    }
}
