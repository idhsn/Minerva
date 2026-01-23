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
            <a href="teacher_assign_work.php" class="btn_primary"><i class="fa-solid fa-plus"></i> Nouveau Devoir</a>
        </div>

        <div class="works_container">
            <!-- PHP Loop -->
            <div class="work_item">
                <div class="work_info">
                    <div class="work_icon"><i class="fa-solid fa-file-code"></i></div>
                    <div class="work_details">
                        <h4>Création Landing Page</h4>
                        <p>Dev Web Fullstack - Section A</p>
                    </div>
                </div>
                <div class="work_meta">
                    <span><i class="fa-regular fa-calendar"></i> Due: 25 Jan 2024</span>
                    <span><i class="fa-solid fa-upload"></i> 18/24 Soumis</span>
                </div>
                <div class="work_actions">
                    <a href="teacher_grade_work.php?id=1" class="btn_icon" title="Noter"><i
                            class="fa-solid fa-check-to-slot"></i></a>
                    <a href="#" class="btn_icon" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                    <a href="#" class="btn_icon" title="Supprimer" style="color: #ff6b6b;"><i
                            class="fa-solid fa-trash"></i></a>
                </div>
            </div>

            <div class="work_item">
                <div class="work_info">
                    <div class="work_icon"><i class="fa-solid fa-database"></i></div>
                    <div class="work_details">
                        <h4>Schéma Relationnel - Projet E-com</h4>
                        <p>Base de Données - Section B</p>
                    </div>
                </div>
                <div class="work_meta">
                    <span><i class="fa-regular fa-calendar"></i> Due: 30 Jan 2024</span>
                    <span><i class="fa-solid fa-upload"></i> 5/18 Soumis</span>
                </div>
                <div class="work_actions">
                    <a href="teacher_grade_work.php?id=2" class="btn_icon" title="Noter"><i
                            class="fa-solid fa-check-to-slot"></i></a>
                    <a href="#" class="btn_icon" title="Modifier"><i class="fa-solid fa-pen"></i></a>
                    <a href="#" class="btn_icon" title="Supprimer" style="color: #ff6b6b;"><i
                            class="fa-solid fa-trash"></i></a>
                </div>
            </div>
            <!-- End PHP Loop -->
        </div>
    </div>

</body>

</html>