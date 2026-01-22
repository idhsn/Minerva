<?php

namespace App\Models;

use App\Core\Model;

class ChatMessage extends Model
{
    public function sendMessage($classId, $senderId, $message)
    {
        $stmt = $this->db->prepare("INSERT INTO chat_messages (class_id, sender_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$classId, $senderId, $message]);
    }

    public function getByClass($classId, $limit = 50)
    {
        $stmt = $this->db->prepare("
            SELECT cm.*, u.name as sender_name 
            FROM chat_messages cm 
            JOIN users u ON cm.sender_id = u.id 
            WHERE cm.class_id = ? 
            ORDER BY cm.created_at DESC 
            LIMIT ?
        ");
        $stmt->execute([$classId, $limit]);
        return array_reverse($stmt->fetchAll());
    }
}
