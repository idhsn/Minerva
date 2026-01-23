<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Ma Classe</title>
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

        .class_info_card {
            background: linear-gradient(135deg, #5ABDF1, #2980b9);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(90, 189, 241, 0.3);
        }

        .class_info_card h2 {
            margin: 0 0 10px 0;
        }

        .class_stats {
            display: flex;
            gap: 30px;
            margin-top: 20px;
        }

        .stat_item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .students_grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .student_card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            text-align: center;
            transition: transform 0.2s;
        }

        .student_card:hover {
            transform: translateY(-5px);
        }

        .student_img {
            width: 80px;
            height: 80px;
            background: #eee;
            border-radius: 50%;
            margin: 0 auto 15px auto;
            overflow: hidden;
        }

        .student_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student_name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .student_role {
            font-size: 0.8rem;
            color: #888;
        }

        .message_icon {
            margin-top: 15px;
            color: #5ABDF1;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .message_icon:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_student.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Ma Classe</h1>
                <p style="color: #666;">Liste des camarades de classe</p>
            </div>
        </div>

        <div class="class_info_card">
            <h2>Dev Web Fullstack - Section A</h2>
            <p>Année 2023-2024 • Professeur Principal: M. Martin</p>
            <div class="class_stats">
                <div class="stat_item"><i class="fa-solid fa-users"></i> 24 Étudiants</div>
                <div class="stat_item"><i class="fa-solid fa-book"></i> 8 Matières</div>
            </div>
        </div>

        <h3 style="margin-bottom: 20px; color: #333;">Membres de la classe</h3>
        <div class="students_grid">
            <!-- PHP Loop -->
            <div class="student_card">
                <div class="student_img"><img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png"
                        alt=""></div>
                <div class="student_name">{{ Nom Camarade 1 }}</div>
                <div class="student_role">Délégué</div>
                <div class="message_icon"><i class="fa-regular fa-envelope"></i></div>
            </div>

            <div class="student_card">
                <div class="student_img"><img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png"
                        alt=""></div>
                <div class="student_name">{{ Nom Camarade 2 }}</div>
                <div class="student_role">Étudiant</div>
                <div class="message_icon"><i class="fa-regular fa-envelope"></i></div>
            </div>

            <div class="student_card">
                <div class="student_img"><img src="../../../imgs/profile-placeholder.png" alt=""></div>
                <div class="student_name">{{ Nom Camarade 3 }}</div>
                <div class="student_role">Étudiant</div>
                <div class="message_icon"><i class="fa-regular fa-envelope"></i></div>
            </div>

            <div class="student_card">
                <div class="student_img"><img src="../../../imgs/profile-placeholder.png" alt=""></div>
                <div class="student_name">{{ Nom Camarade 4 }}</div>
                <div class="student_role">Étudiant</div>
                <div class="message_icon"><i class="fa-regular fa-envelope"></i></div>
            </div>
            <!-- End PHP Loop -->
        </div>
    </div>

</body>

</html>