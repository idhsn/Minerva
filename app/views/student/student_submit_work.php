<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Soumettre un Devoir</title>
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

        .submission_layout {
            display: flex;
            gap: 30px;
        }

        .work_details {
            flex: 1;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .submission_form {
            flex: 1;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .work_meta_list {
            margin: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }

        .meta_item {
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
            color: #555;
        }

        .meta_icon {
            width: 20px;
            color: #5ABDF1;
            text-align: center;
        }

        .file_drop_zone {
            border: 2px dashed #ddd;
            padding: 40px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s;
            background: #fafafa;
        }

        .file_drop_zone:hover {
            border-color: #5ABDF1;
            background: #f0f7ff;
        }

        .file_drop_zone i {
            font-size: 2.5rem;
            color: #ccc;
            margin-bottom: 15px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            margin-bottom: 20px;
            outline: none;
        }

        textarea:focus {
            border-color: #5ABDF1;
        }

        .btn_submit {
            width: 100%;
            padding: 15px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn_submit:hover {
            background: #27ae60;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_student.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <a href="/php_briefs/Minerva_binomes/student/dashboard"
                    style="color: #666; text-decoration: none; font-size: 0.9rem;"><i
                        class="fa-solid fa-arrow-left"></i> Retour au tableau de bord</a>
                <h1 style="margin-top: 5px;">Soumettre un Devoir</h1>
            </div>
        </div>

        <div class="submission_layout">
            <div class="work_details">
                <h2 style="color: #333; margin-top: 0;"><?= htmlspecialchars($assignment['title'] ?? 'Devoir') ?></h2>

                <div class="work_meta_list">
                    <div class="meta_item">
                        <div class="meta_icon"><i class="fa-regular fa-calendar"></i></div>
                        <div>Date de création: <strong><?= $assignment['created_at'] ?? 'Non spécifiée' ?></strong>
                        </div>
                    </div>
                    <?php if (!empty($assignment['file_path'])): ?>
                        <div class="meta_item">
                            <div class="meta_icon"><i class="fa-solid fa-file-arrow-down"></i></div>
                            <div>Ressources: <a
                                    href="/php_briefs/Minerva_binomes/public/uploads/assignments/<?= $assignment['file_path'] ?>"
                                    download style="color: #5ABDF1;">Télécharger le sujet</a></div>
                        </div>
                    <?php endif; ?>
                </div>

                <h3>Instructions:</h3>
                <p style="color: #666; line-height: 1.6;">
                    <?= nl2br(htmlspecialchars($assignment['description'] ?? 'Pas d\'instructions spécifiques.')) ?>
                </p>
            </div>

            <div class="submission_form">
                <h3 style="margin-top: 0;">Votre Travail</h3>
                <form action="/php_briefs/Minerva_binomes/student/submit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="assignment_id" value="<?= $assignment['id'] ?>">

                    <label style="display: block; margin-bottom: 10px; font-weight: 500; color: #444;">Fichiers
                        joints</label>
                    <div class="file_drop_zone" onclick="document.getElementById('file_upload').click()">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p style="margin: 0; color: #666;">Glissez vos fichiers ici ou cliquez pour parcourir</p>
                        <input type="file" id="file_upload" name="file" style="display: none;">
                    </div>

                    <label style="display: block; margin-bottom: 10px; font-weight: 500; color: #444;">Commentaire
                        (Optionnel)</label>
                    <textarea name="content" placeholder="Ajoutez un message pour votre professeur..."></textarea>

                    <button type="submit" class="btn_submit">Envoyer le Devoir</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>