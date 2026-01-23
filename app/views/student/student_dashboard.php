<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Tableau de bord Étudiant</title>
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
            margin-left: 350px;
            flex-grow: 1;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .dashboard_cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card_info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
            color: #333;
        }

        .card_info p {
            color: #888;
            font-size: 0.9rem;
        }

        .card_icon {
            font-size: 2.5rem;
            color: #5ABDF1;
            opacity: 0.2;
        }

        .section_grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .content_card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .section_title {
            font-size: 1.1rem;
            margin-bottom: 15px;
            color: #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .todo_item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .todo_item:last-child {
            border-bottom: none;
        }

        .todo_icon {
            width: 40px;
            height: 40px;
            background: #e6f7ff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5ABDF1;
            flex-shrink: 0;
        }

        .todo_info h4 {
            margin: 0 0 5px 0;
            font-size: 0.95rem;
        }

        .todo_info p {
            margin: 0;
            font-size: 0.8rem;
            color: #888;
        }

        .grade_mini {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .grade_score {
            font-weight: bold;
            color: #27ae60;
            background: #e6fffa;
            padding: 2px 8px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_student.php'; ?>

    <div class="main_content">
        <!-- Header -->
        <header
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
            <div class="user_welcome">
                <h2>Bonjour, <span style="color: #5ABDF1;"><?= htmlspecialchars($user['name'] ?? 'Étudiant') ?></span>
                </h2>
                <p>Prêt pour apprendre de nouvelles choses aujourd'hui ?</p>
            </div>
            <div class="user_profile" style="display: flex; align-items: center; gap: 15px;">
                <div class="notif_icon" style="position: relative;">
                    <i class="fa-regular fa-bell" style="font-size: 1.2rem; color: #666; cursor: pointer;"></i>
                </div>
                <div class="profile_img"
                    style="width: 40px; height: 40px; background: #ddd; border-radius: 50%; overflow: hidden;">
                    <img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png" alt="Profile"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="dashboard_cards">
            <div class="card">
                <div class="card_info">
                    <h3><?= count($assignments ?? []) ?></h3>
                    <p>Travaux à faire</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <div class="card">
                <div class="card_info">
                    <h3><?= count($classes ?? []) ?></h3>
                    <p>Mes Classes</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-chalkboard"></i>
                </div>
            </div>
        </div>

        <div class="section_grid">
            <!-- To Do List -->
            <div class="content_card">
                <div class="section_title">
                    <span>Travaux à rendre prochainement</span>
                    <a href="/php_briefs/Minerva_binomes/student/assignments"
                        style="font-size: 0.8rem; color: #5ABDF1; text-decoration: none;">Voir tout</a>
                </div>

                <?php if (empty($assignments)): ?>
                    <p style="text-align: center; color: #888; padding: 20px;">Aucun travail à rendre.</p>
                <?php else: ?>
                    <?php foreach ($assignments as $assignment): ?>
                        <div class="todo_item">
                            <div class="todo_icon">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <div class="todo_info">
                                <h4><?= htmlspecialchars($assignment['title']) ?></h4>
                                <p><?= htmlspecialchars(substr($assignment['description'], 0, 60)) ?>...</p>
                            </div>
                            <a href="/php_briefs/Minerva_binomes/student/submit?id=<?= $assignment['id'] ?>"
                                style="margin-left: auto; padding: 5px 15px; background: #5ABDF1; color: white; border-radius: 5px; text-decoration: none; font-size: 0.8rem;">Soumettre</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Recent Grades Placeholder -->
            <div class="content_card">
                <div class="section_title">
                    <span>Mes Classes</span>
                </div>
                <?php foreach ($classes as $class): ?>
                    <div class="grade_mini">
                        <div>
                            <div style="font-weight: 500; font-size: 0.9rem;"><?= htmlspecialchars($class['name']) ?></div>
                        </div>
                        <div class="grade_score" style="color: #5ABDF1; background: #eef2f5;">Inscrit</div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>