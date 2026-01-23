<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Tableau de bord Enseignant</title>
    <link rel="stylesheet" href="/php_briefs/Minerva_binomes/public/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Temporary inline styles for dashboard layout until moved to main.css */
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
            left: 0;
            height: 100%;
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

        .recent_activity {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include APPROOT . '/app/views/partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <!-- Top bar/Header -->
        <header
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 15px 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
            <div class="user_welcome">
                <h2>Bonjour, <span style="color: #5ABDF1;"><?= htmlspecialchars($user['name'] ?? 'Professeur') ?></span>
                </h2>
                <p>Voici ce qui se passe dans vos classes aujourd'hui.</p>
            </div>
            <div class="user_profile" style="display: flex; align-items: center; gap: 15px;">
                <div class="notif_icon" style="position: relative;">
                    <i class="fa-regular fa-bell" style="font-size: 1.2rem; color: #666; cursor: pointer;"></i>
                    <span
                        style="position: absolute; top: -5px; right: -5px; background: red; color: white; border-radius: 50%; width: 15px; height: 15px; font-size: 10px; display: flex; align-items: center; justify-content: center;">3</span>
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
                    <h3><?= count($classes ?? []) ?></h3>
                    <p>Classes Actives</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-chalkboard" style="color: #F07167"></i>
                </div>
            </div>
            <div class="card">
                <div class="card_info">
                    <h3>0</h3>
                    <p>Total Étudiants</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-users" style="color: #F07167"></i>
                </div>
            </div>
            <div class="card">
                <div class="card_info">
                    <h3>0</h3>
                    <p>Travaux en Cours</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-file-contract" style="color: #F07167"></i>
                </div>
            </div>
            <div class="card">
                <div class="card_info">
                    <h3>0</h3>
                    <p>Devoirs à Corriger</p>
                </div>
                <div class="card_icon">
                    <i class="fa-solid fa-marker" style="color: #F07167"></i>
                </div>
            </div>
        </div>

        <!-- Recent Activity / Overview -->
        <div class="recent_activity">
            <div class="section_header">
                <h3>Activité Récente</h3>
                <a href="#" style="color: #5ABDF1; text-decoration: none;">Voir tout</a>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; color: #888; border-bottom: 1px solid #eee;">
                        <th style="padding: 15px 0;">Activité</th>
                        <th style="padding: 15px 0;">Classe</th>
                        <th style="padding: 15px 0;">Date</th>
                        <th style="padding: 15px 0;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- PHP Foreach Loop for Activities -->
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td style="padding: 15px 0;">Nouveau devoir soumis par <strong>{{ Student Name }}</strong></td>
                        <td style="padding: 15px 0;">Dev Web Niv 1</td>
                        <td style="padding: 15px 0;">Il y a 2h</td>
                        <td style="padding: 15px 0;"><span
                                style="background: #e6f7ff; color: #0099ff; padding: 5px 10px; border-radius: 15px; font-size: 0.8rem;">Nouveau</span>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td style="padding: 15px 0;">Cours "MVC Pattern" ajouté</td>
                        <td style="padding: 15px 0;">PHP Avancé</td>
                        <td style="padding: 15px 0;">Hier</td>
                        <td style="padding: 15px 0;"><span
                                style="background: #e6fffa; color: #00cc99; padding: 5px 10px; border-radius: 15px; font-size: 0.8rem;">Publié</span>
                        </td>
                    </tr>
                    <!-- End Foreach -->
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>