<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Travaux</title>
    <link rel="stylesheet" href="/php_briefs/Minerva_binomes/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f7f6;
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
            margin-left: 300px;
            flex-grow: 1;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .section_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn_primary {
            background: #5ABDF1;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn_primary:hover {
            background-color: #46a4d9;
        }

        .works_container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .work_item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: box-shadow 0.2s;
        }

        .work_item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .work_info {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .work_icon {
            width: 50px;
            height: 50px;
            background: #eef2f5;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #F07167;
        }

        .work_details h4 {
            margin: 0 0 5px 0;
            color: #333;
        }

        .work_details p {
            margin: 0;
            font-size: 0.9rem;
            color: #888;
        }

        .work_meta {
            display: flex;
            gap: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        .work_meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .work_actions {
            display: flex;
            gap: 10px;
        }

        .btn_icon {
            width: 35px;
            height: 35px;
            border-radius: 5px;
            border: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #555;
            transition: all 0.2s;
        }

        .btn_icon:hover {
            background: #5ABDF1;
            color: white;
            border-color: #5ABDF1;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Travaux & Devoirs</h1>
                <p style="color: #666;">Gérez les devoirs assignés à vos classes</p>
            </div>
            <a href="/php_briefs/Minerva_binomes/teacher/assignments/create" class="btn_primary"><i
                    class="fa-solid fa-plus"></i> Nouveau Devoir</a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div style="background: #e6fffa; color: #00cc99; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <div class="works_container">
            <?php if (isset($assignments) && !empty($assignments)): ?>
                <?php foreach ($assignments as $assignment): ?>
                    <div class="work_item">
                        <div class="work_info">
                            <div class="work_icon">
                                <?php
                                $icon = 'fa-file-lines';
                                if (strpos(strtolower($assignment['title']), 'landing') !== false)
                                    $icon = 'fa-file-code';
                                if (strpos(strtolower($assignment['title']), 'base') !== false)
                                    $icon = 'fa-database';
                                ?>
                                <i class="fa-solid <?= $icon ?>"></i>
                            </div>
                            <div class="work_details">
                                <h4><?= htmlspecialchars($assignment['title']) ?></h4>
                                <p><?= htmlspecialchars($assignment['class_name']) ?></p>
                            </div>
                        </div>
                        <div class="work_meta">
                            <span><i class="fa-regular fa-calendar"></i> Assigné le:
                                <?= date('d M Y', strtotime($assignment['created_at'])) ?></span>
                            <span><i class="fa-solid fa-paperclip"></i>
                                <?= $assignment['file_path'] ? 'Fichier joint' : 'Pas de fichier' ?></span>
                        </div>
                        <div class="work_actions">
                            <a href="/php_briefs/Minerva_binomes/teacher/grade?id=<?= $assignment['id'] ?>" class="btn_icon"
                                title="Noter"><i class="fa-solid fa-check-to-slot"></i></a>
                            <a href="/php_briefs/Minerva_binomes/teacher/assignments/edit?id=<?= $assignment['id'] ?>"
                                class="btn_icon" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                            <a href="/php_briefs/Minerva_binomes/teacher/assignments/delete?id=<?= $assignment['id'] ?>"
                                class="btn_icon" title="Supprimer" style="color: #ff6b6b;"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devoir ?')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 50px; background: white; border-radius: 10px; color: #888;">
                    <i class="fa-solid fa-folder-open" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
                    <p>Aucun devoir n'a été créé pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>