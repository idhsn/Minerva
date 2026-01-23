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

    <?php include APPROOT . '/app/views/partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Mes Classes</h1>
                <p style="color: #666;">Gérez vos classes et vos étudiants</p>
                <?php $succes = \App\Core\Auth::getFlash('succes');
                if ($succes): ?>
                        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-top: 10px; border: 1px solid #c3e6cb;">
                            <i class="fa-solid fa-circle-check"></i> <?= $succes ?>
                        </div>
                <?php endif; ?>
            </div>
            <button class="btn_primary" onclick="toggleModal('createClassModal')"><i class="fa-solid fa-plus"></i>
                Créer une classe</button>
        </div>

        <div class="classes_grid">
            <?php if (isset($classes) && !empty($classes)): ?>
                <?php foreach ($classes as $class): ?>
                    <div class="class_card">
                        <div class="class_header">
                            <h3><?= htmlspecialchars($class['name']) ?></h3>
                            <p>Section - 2023/2024</p>
                            <div class="class_options"><i class="fa-solid fa-ellipsis-vertical"></i></div>
                        </div>
                        <div class="class_body">
                            <p style="color: #555; margin-bottom: 15px; font-size: 0.95rem;">Cliquez pour gérer les
                                étudiants ou assigner des travaux.</p>
                            <div class="class_stats">
                                <span><i class="fa-solid fa-users"></i> {{ ? }} Étudiants</span>
                                <span><i class="fa-solid fa-book"></i> {{ ? }} Modules</span>
                            </div>
                        </div>
                        <div class="class_footer">
                            <a href="teacher_students.php?class_id=<?= $class['id'] ?>" class="btn_sm">Étudiants</a>
                            <a href="teacher_works.php?class_id=<?= $class['id'] ?>" class="btn_sm">Travaux</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; background: white; border-radius: 10px;">
                    <i class="fa-solid fa-chalkboard"
                        style="font-size: 3rem; color: #eee; margin-bottom: 15px; display: block;"></i>
                    <p style="color: #888;">Vous n'avez pas encore créé de classe.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Create Class Modal -->
    <div id="createClassModal"
        style="display:none; position:fixed; z-index:1001; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
        <div
            style="background:white; margin:10% auto; padding:25px; width:400px; border-radius:12px; box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
                <h3 style="margin:0; color:#003049;">Créer une nouvelle classe</h3>
                <i class="fa-solid fa-xmark" style="cursor:pointer;" onclick="toggleModal('createClassModal')"></i>
            </div>
            <form action="/php_briefs/Minerva_binomes/teacher/classes" method="POST">
                <div style="margin-bottom:20px;">
                    <label style="display:block; margin-bottom:8px; font-weight:500;">Nom de la classe</label>
                    <input type="text" name="name" placeholder="Ex: Développement Web Fullstack"
                        style="width:100%; padding:10px; border-radius:6px; border:1px solid #ddd; outline:none;"
                        required>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:12px;">
                    <button type="button" onclick="toggleModal('createClassModal')"
                        style="background:#f1f1f1; color:#555; border:none; padding:10px 20px; border-radius:6px; cursor:pointer;">Annuler</button>
                    <button type="submit"
                        style="background:#5ABDF1; color:white; border:none; padding:10px 20px; border-radius:6px; cursor:pointer; font-weight:500;">Créer
                        la classe</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.style.display === 'none') {
                modal.style.display = 'block';
            } else {
                modal.style.display = 'none';
            }
        }

        // Close modal if clicking outside
        window.onclick = function (event) {
            const modal = document.getElementById('createClassModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>