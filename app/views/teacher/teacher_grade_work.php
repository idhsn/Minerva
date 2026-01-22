<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Évaluation</title>
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

        .grading_container {
            display: flex;
            gap: 20px;
            height: calc(100vh - 120px);
        }

        .submission_viewer {
            flex: 2;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
        }

        .grading_panel {
            flex: 1;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow-y: auto;
        }

        .student_info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .student_info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .file_preview {
            flex-grow: 1;
            background: #f9f9f9;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eee;
            position: relative;
        }

        .file_preview iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .form_group {
            margin-bottom: 20px;
        }

        .form_group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #444;
        }

        .form_control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }

        .form_control:focus {
            outline: none;
            border-color: #5ABDF1;
            background: white;
        }

        textarea.form_control {
            resize: vertical;
            min-height: 100px;
        }

        .grade_input {
            width: 80px;
            font-size: 1.2rem;
            text-align: center;
            font-weight: bold;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-weight: 500;
            width: 100%;
            margin-top: 10px;
        }

        .btn_primary {
            background: #5ABDF1;
            color: white;
        }

        .btn_primary:hover {
            background: #46a4d9;
        }
    </style>
</head>

<body>

    <?php include '../partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <a href="teacher_works.php" style="color: #666; text-decoration: none; font-size: 0.9rem;"><i
                        class="fa-solid fa-arrow-left"></i> Retour aux travaux</a>
                <h1 style="margin-top: 5px;">Noter: Création Landing Page</h1>
            </div>
            <div style="display: flex; gap: 10px;">
                <button class="btn" style="width: auto; background: #eee;"><i class="fa-solid fa-chevron-left"></i>
                    Précédent</button>
                <button class="btn" style="width: auto; background: #eee;">Suivant <i
                        class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="grading_container">
            <div class="submission_viewer">
                <div class="student_info">
                    <img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png" alt="">
                    <div>
                        <h3 style="margin: 0;">{{ Nom Étudiant }}</h3>
                        <p style="margin: 0; color: #888; font-size: 0.9rem;">Soumis le: 24 Jan 2024 à 14:30</p>
                    </div>
                </div>
                <div class="file_preview">
                    <!-- Placeholder for file content (PDF, Image, or Code) -->
                    <div style="text-align: center; color: #666;">
                        <i class="fa-solid fa-file-pdf" style="font-size: 4rem; color: #e74c3c;"></i>
                        <p style="margin-top: 15px;">rapport_projet_final.pdf</p>
                        <button
                            style="padding: 8px 15px; background: #5ABDF1; color: white; border: none; border-radius: 5px; cursor: pointer; margin-top: 10px;">Télécharger
                            / Ouvrir</button>
                    </div>
                </div>
                <div style="margin-top: 20px; padding: 15px; background: #f0f7ff; border-radius: 5px;">
                    <h4 style="margin: 0 0 10px 0; color: #5ABDF1;">Message de l'étudiant:</h4>
                    <p style="margin: 0; font-size: 0.9rem; color: #555;">Voici mon travail pour le projet final. J'ai
                        inclus tous les fichiers demandés ainsi qu'une documentation détaillée.</p>
                </div>
            </div>

            <div class="grading_panel">
                <h3 style="margin-top: 0;">Évaluation</h3>
                <form action="#">
                    <div class="form_group">
                        <label>Note (/20)</label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <input type="number" class="form_control grade_input" value="16" max="20" min="0">
                            <span style="font-size: 1.2rem; color: #888;"> / 20</span>
                        </div>
                    </div>

                    <div class="form_group">
                        <label>Commentaires / Feedback</label>
                        <textarea class="form_control"
                            placeholder="Ajoutez vos observations ici...">Excellent travail sur la structure HTML. Le CSS est bien organisé. Attention cependant à la réactivité sur mobile qui pourrait être améliorée.</textarea>
                    </div>

                    <div class="form_group">
                        <label>Date de correction</label>
                        <input type="text" class="form_control" value="<?php echo date('d/m/Y'); ?>" disabled>
                    </div>

                    <button type="submit" class="btn btn_primary">Enregistrer la Note</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>