<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Assigner un Devoir</title>
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

        .form_card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
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
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 0.95rem;
            background: #f9f9f9;
        }

        .form_control:focus {
            outline: none;
            border-color: #5ABDF1;
            background: white;
        }

        textarea.form_control {
            resize: vertical;
            min-height: 120px;
        }

        .file_upload {
            border: 2px dashed #ddd;
            padding: 30px;
            text-align: center;
            border-radius: 5px;
            background: #fafafa;
            cursor: pointer;
            transition: border 0.3s;
        }

        .file_upload:hover {
            border-color: #5ABDF1;
            background: #f0f7ff;
        }

        .file_upload i {
            font-size: 2rem;
            color: #ccc;
            margin-bottom: 10px;
        }

        .form_actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn_secondary {
            background: #eee;
            color: #555;
        }

        .btn_secondary:hover {
            background: #e0e0e0;
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
                <h1>Assigner un Nouveau Devoir</h1>
                <p style="color: #666;">Créez et distribuez un devoir à vos classes</p>
            </div>
            <a href="teacher_works.php" class="btn btn_secondary"><i class="fa-solid fa-arrow-left"></i> Retour</a>
        </div>

        <div class="form_card">
            <form action="/minerva_binomes/teacher/assignments/create" method="POST" enctype="multipart/form-data">
                <div class="form_group">
                    <label for="title">Titre du Devoir</label>
                    <input type="text" id="title" name="title" class="form_control"
                        placeholder="Ex: Projet Final - PHP MVC" required>
                </div>

                <div class="form_group">
                    <label for="class">Assigner à la Classe</label>
                    <select id="class" name="class_id" class="form_control" required>
                        <option value="">Sélectionnez une classe...</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form_group">
                    <label for="description">Instructions / Description</label>
                    <textarea id="description" name="description" class="form_control"
                        placeholder="Détaillez les consignes du devoir ici..."></textarea>
                </div>

                <div class="form_group">
                    <label>Ressources / Fichiers Joints</label>
                    <div class="file_upload" onclick="document.getElementById('file').click()">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <p>Cliquez ou glissez des fichiers ici</p>
                        <input type="file" id="file" name="file" style="display: none;">
                    </div>
                </div>

                <div class="form_actions">
                    <a href="/minerva_binomes/teacher/dashboard" class="btn btn_secondary">Annuler</a>
                    <button type="submit" class="btn btn_primary">Assigner le Devoir</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>