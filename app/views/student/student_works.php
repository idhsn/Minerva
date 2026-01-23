<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Mes Travaux</title>
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

        .section_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .works_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .work_card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            position: relative;
            border-left: 4px solid #5ABDF1;
        }

        .work_header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .course_badge {
            font-size: 0.7rem;
            background: #f0f7ff;
            color: #5ABDF1;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .work_title {
            font-size: 1.1rem;
            margin: 0 0 10px 0;
            color: #333;
        }

        .work_desc {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.4;
            flex-grow: 1;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .work_footer {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn_action {
            padding: 8px 15px;
            background: #5ABDF1;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }

        .btn_action:hover {
            background: #46a4d9;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_student.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Mes Travaux</h1>
                <p style="color: #666;">Consultez et soumettez vos devoirs</p>
            </div>
        </div>

        <?php if (empty($assignments)): ?>
            <p style="text-align: center; color: #888; padding: 40px; background: white; border-radius: 10px;">Vous n'avez
                aucun devoir pour le moment.</p>
        <?php else: ?>
            <div class="works_grid">
                <?php foreach ($assignments as $assignment): ?>
                    <div class="work_card">
                        <div class="work_header">
                            <span class="course_badge">Devoir</span>
                            <span style="font-size: 0.8rem; color: #888;"><i class="fa-regular fa-calendar"></i>
                                <?= $assignment['created_at'] ?></span>
                        </div>
                        <h3 class="work_title"><?= htmlspecialchars($assignment['title']) ?></h3>
                        <p class="work_desc"><?= htmlspecialchars($assignment['description']) ?></p>
                        <div class="work_footer">
                            <a href="/php_briefs/Minerva_binomes/student/submit?id=<?= $assignment['id'] ?>"
                                class="btn_action">Détails /
                                Soumettre</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>