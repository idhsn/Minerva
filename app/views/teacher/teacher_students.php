<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Mes Étudiants</title>
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

        .table_container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        th {
            color: #888;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .user_cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user_img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #eee;
            overflow: hidden;
        }

        .user_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .status_badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }

        .status_active {
            background: #e6fffa;
            color: #00cc99;
        }

        .status_inactive {
            background: #fff0f0;
            color: #ff6b6b;
        }

        .action_btn {
            color: #666;
            cursor: pointer;
            margin-right: 10px;
            transition: color 0.2s;
        }

        .action_btn:hover {
            color: #5ABDF1;
        }

        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
        }

        .search_box {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 5px 15px;
            background: white;
            width: 300px;
        }

        .search_box input {
            border: none;
            outline: none;
            flex-grow: 1;
            margin-left: 10px;
            font-size: 0.9rem;
        }

        .filter_select {
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            outline: none;
            background: white;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Étudiants</h1>
                <p style="color: #666;">Liste de tous les étudiants inscrits à vos cours</p>
            </div>
            <button onclick="document.getElementById('createStudentModal').style.display='block'"
                style="background: #5ABDF1; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                <i class="fa-solid fa-plus"></i> Créer un étudiant
            </button>
        </div>

        <?php if (isset($success)): ?>
            <div style="background: #e6fffa; color: #00cc99; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <!-- Modal for creating student -->
        <div id="createStudentModal"
            style="display:none; position:fixed; z-index:1001; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
            <div style="background:white; margin:10% auto; padding:20px; width:400px; border-radius:10px;">
                <h3>Créer un nouvel étudiant</h3>
                <form action="/php_briefs/Minerva_binomes/teacher/students" method="POST">
                    <div style="margin-top:15px;">
                        <input type="text" name="name" placeholder="Nom complet"
                            style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" required>
                    </div>
                    <div style="margin-top:15px;">
                        <input type="email" name="email" placeholder="Email"
                            style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" required>
                    </div>
                    <div style="margin-top:15px;">
                        <select name="class_id"
                            style="width:100%; padding:10px; border-radius:5px; border:1px solid #ddd;" required>
                            <option value="">Sélectionner une classe</option>
                            <?php if (isset($classes)): ?>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class['id'] ?>"><?= $class['name'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div style="margin-top:20px; display:flex; justify-content:space-between;">
                        <button type="button"
                            onclick="document.getElementById('createStudentModal').style.display='none'"
                            style="background:#eee; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">Annuler</button>
                        <button type="submit"
                            style="background:#5ABDF1; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">Créer</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table_container">
            <div class="filters">
                <div class="search_box">
                    <i class="fa-solid fa-magnifying-glass" style="color: #888;"></i>
                    <input type="text" placeholder="Rechercher un étudiant...">
                </div>
                <select class="filter_select">
                    <option value="">Toutes les classes</option>
                    <option value="1">Dev Web Fullstack</option>
                    <option value="2">Base de Données</option>
                </select>
                <select class="filter_select">
                    <option value="">Status</option>
                    <option value="active">Actif</option>
                    <option value="inactive">Inactif</option>
                </select>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Email</th>
                        <th>Classe</th>
                        <th>Date Inscription</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($students) && !empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td>
                                    <div class="user_cell">
                                        <div class="user_img">
                                            <img src="/php_briefs/Minerva_binomes/public/imgs/logo.png" alt="">
                                        </div>
                                        <span><?= htmlspecialchars($student['name']) ?></span>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><?= htmlspecialchars($student['class_name'] ?? 'N/A') ?></td>
                                <td><?= date('d M Y', strtotime($student['created_at'])) ?></td>
                                <td><span class="status_badge status_active">Actif</span></td>
                                <td>
                                    <i class="fa-solid fa-envelope action_btn" title="Message"></i>
                                    <i class="fa-solid fa-chart-line action_btn" title="Performance"></i>
                                    <i class="fa-solid fa-trash action_btn" style="color:#ff6b6b;" title="Supprimer"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Aucun étudiant trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>