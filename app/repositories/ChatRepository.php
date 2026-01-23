<?php

require_once __DIR__ . '/../core/Database.php';

class ChatRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function create($classId, $userId, $message)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO chat_messages (class_id, user_id, message) VALUES (?, ?, ?)"
        );
        $stmt->execute([$classId, $userId, $message]);
        
        return $this->pdo->lastInsertId();
    }

    public function getMessagesByClass($classId, $limit = 50)
    {
        $stmt = $this->pdo->prepare(
            "SELECT cm.*, u.first_name, u.last_name, u.role 
             FROM chat_messages cm
             INNER JOIN users u ON cm.user_id = u.id
             WHERE cm.class_id = ?
             ORDER BY cm.created_at DESC
             LIMIT " . (int)$limit
        );
        $stmt->execute([$classId]);
        
        return array_reverse($stmt->fetchAll());
    }
}
