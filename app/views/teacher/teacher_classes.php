<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Mes Classes</title>
    <link rel="stylesheet" href="/php_briefs/Minerva_binomes/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reusing sidebar/layout styles from dashboard (should be in main.css ideally) */
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

        .btn_primary {
            background-color: #5ABDF1;
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

        .classes_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .class_card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .class_card:hover {
            transform: translateY(-5px);
        }

        .class_header {
            height: 100px;
            background: linear-gradient(135deg, #5ABDF1, #2980b9);
            padding: 20px;
            color: white;
            position: relative;
        }

        .class_header h3 {
            margin: 0;
            font-size: 1.4rem;
        }

        .class_header p {
            margin: 5px 0 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .class_options {
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
        }

        .class_body {
            padding: 20px;
        }

        .class_stats {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
            color: #666;
            font-size: 0.9rem;
        }

        .class_stats span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .class_footer {
            border-top: 1px solid #eee;
            padding: 15px 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn_sm {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #555;
        }

        .btn_sm:hover {
            background: #f9f9f9;
        }
    </style>
</head>

<body>

    <?php include '../partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Mes Classes</h1>
                <p style="color: #666;">Gérez vos classes et vos étudiants</p>
            </div>
            <button class="btn_primary" onclick="alert('Open Modal Create Class')"><i class="fa-solid fa-plus"></i>
                Créer une classe</button>
        </div>

        <div class="classes_grid">
            <!-- PHP Loop for Classes -->
            <div class="class_card">
                <div class="class_header">
                    <h3>Développement Web Fullstack</h3>
                    <p>Section A - 2023/2024</p>
                    <div class="class_options"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                </div>
                <div class="class_body">
                    <p style="color: #555; margin-bottom: 15px; font-size: 0.95rem;">Cours complet sur HTML, CSS, JS et
                        PHP pour débutants.</p>
                    <div class="class_stats">
                        <span><i class="fa-solid fa-users"></i> {{ 24 }} Étudiants</span>
                        <span><i class="fa-solid fa-book"></i> {{ 12 }} Modules</span>
                    </div>
                </div>
                <div class="class_footer">
                    <a href="teacher_students.php?class_id=1" class="btn_sm">Étudiants</a>
                    <a href="teacher_works.php?class_id=1" class="btn_sm">Travaux</a>
                </div>
            </div>

            <div class="class_card">
                <div class="class_header" style="background: linear-gradient(135deg, #2ecc71, #27ae60);">
                    <h3>Base de Données SQL</h3>
                    <p>Section B - 2023/2024</p>
                    <div class="class_options"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                </div>
                <div class="class_body">
                    <p style="color: #555; margin-bottom: 15px; font-size: 0.95rem;">Conception et manipulation de bases
                        de données relationnelles.</p>
                    <div class="class_stats">
                        <span><i class="fa-solid fa-users"></i> {{ 18 }} Étudiants</span>
                        <span><i class="fa-solid fa-book"></i> {{ 8 }} Modules</span>
                    </div>
                </div>
                <div class="class_footer">
                    <a href="teacher_students.php?class_id=2" class="btn_sm">Étudiants</a>
                    <a href="teacher_works.php?class_id=2" class="btn_sm">Travaux</a>
                </div>
            </div>
            <!-- End PHP Loop -->
        </div>
    </div>

</body>

</html>