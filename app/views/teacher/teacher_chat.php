<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Chat</title>
    <link rel="stylesheet" href="/php_briefs/Minerva_binomes/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f7f6;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background: #003049;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            top: 0;
            left: 0;
        }

        .sidebar .logo_details {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #333;
        }

        .sidebar .nav_links {
            list-style: none;
            padding: 0;
            flex-grow: 1;
        }

        .sidebar .nav_links li {
            margin-bottom: 10px;
        }

        .sidebar .nav_links a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            text-decoration: none;
            color: #fff;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar .nav_links a:hover,
        .sidebar .nav_links a.active {
            background-color: #eef2f5;
            color: #5ABDF1;
        }

        .main_content {
            margin-left: 350px;
            flex-grow: 1;
            padding: 0;
            width: calc(100% - 250px);
            display: flex;
            height: 100vh;
        }

        .chat_window {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background: #fff;
        }

        .chat_header {
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat_messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f4f7f6;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 15px;
            font-size: 0.95rem;
            line-height: 1.4;
            position: relative;
        }

        .message.received {
            background: white;
            align-self: flex-start;
            border-bottom-left-radius: 2px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .message.sent {
            background: #5ABDF1;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 2px;
            box-shadow: 0 1px 2px rgba(50, 169, 220, 0.2);
        }

        .message_time {
            font-size: 0.7rem;
            margin-top: 5px;
            opacity: 0.7;
            text-align: right;
        }

        .chat_input_area {
            padding: 20px;
            border-top: 1px solid #eee;
            background: white;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .chat_input_area input {
            flex-grow: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
        }

        .send_btn {
            width: 40px;
            height: 40px;
            background: #5ABDF1;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            transition: transform 0.2s;
        }

        .user_name {
            font-size: 0.75rem;
            color: #888;
            margin-bottom: 2px;
            display: block;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="chat_window">
            <div class="chat_header">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <h3 style="margin: 0;">Discussion de Classe</h3>
                </div>
            </div>

            <div class="chat_messages">
                <?php if (empty($messages)): ?>
                    <p style="text-align: center; color: #888; padding: 20px;">Aucun message pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <div class="message <?= $msg['sender_id'] == $user['id'] ? 'sent' : 'received' ?>">
                            <?php if ($msg['sender_id'] != $user['id']): ?>
                                <span class="user_name"><?= htmlspecialchars($msg['sender_name'] ?? 'Utilisateur') ?></span>
                            <?php endif; ?>
                            <?= htmlspecialchars($msg['message']) ?>
                            <div class="message_time"><?= $msg['created_at'] ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <form class="chat_input_area" action="/php_briefs/Minerva_binomes/chat/send" method="POST">
                <input type="hidden" name="class_id" value="<?= $classId ?>">
                <input type="text" name="message" placeholder="Écrivez votre message..." required>
                <button type="submit" class="send_btn"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>

</body>

</html>