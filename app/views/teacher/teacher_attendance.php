<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Présence</title>
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

        .attendance_controls {
            display: flex;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            align-items: center;
        }

        .control_group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .control_group select,
        .control_group input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .attendance_sheet {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f9f9f9;
            color: #555;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .radio_group {
            display: flex;
            gap: 15px;
        }

        .radio_option {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .radio_option input[type="radio"] {
            accent-color: #5ABDF1;
            transform: scale(1.2);
        }

        .present {
            color: #27ae60;
        }

        .absent {
            color: #e74c3c;
        }

        .late {
            color: #f39c12;
        }

        .save_btn {
            background: #5ABDF1;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 20px;
            float: right;
        }

        .save_btn:hover {
            background: #46a4d9;
        }
    </style>
</head>

<body>

    <?php include '../partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Feuille de Présence</h1>
                <p style="color: #666;">Marquer les présences pour vos classes</p>
            </div>
        </div>

        <div class="attendance_controls">
            <div class="control_group">
                <label>Classe</label>
                <select>
                    <option>Dev Web Fullstack - Section A</option>
                    <option>Base de Données - Section B</option>
                </select>
            </div>
            <div class="control_group">
                <label>Date</label>
                <input type="date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="control_group">
                <label>Horaire</label>
                <select>
                    <option>08:30 - 10:30</option>
                    <option>10:45 - 12:45</option>
                </select>
            </div>
        </div>

        <form action="#">
            <div class="attendance_sheet">
                <table>
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Status</th>
                            <th>Commentaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP Loop -->
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png"
                                        style="width: 30px; height: 30px; border-radius: 50%;" alt="">
                                    <strong>{{ Nom Étudiant 1 }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="radio_group">
                                    <label class="radio_option present"><input type="radio" name="status_1" checked>
                                        Présent</label>
                                    <label class="radio_option absent"><input type="radio" name="status_1">
                                        Absent</label>
                                    <label class="radio_option late"><input type="radio" name="status_1"> Retard</label>
                                </div>
                            </td>
                            <td><input type="text" placeholder="Note (optionnel)"
                                    style="padding: 5px; border: 1px solid #ddd; border-radius: 3px; width: 100%;"></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="/php_briefs/Minerva_binomes/public/imgs/profile-placeholder.png"
                                        style="width: 30px; height: 30px; border-radius: 50%;" alt="">
                                    <strong>{{ Nom Étudiant 2 }}</strong>
                                </div>
                            </td>
                            <td>
                                <div class="radio_group">
                                    <label class="radio_option present"><input type="radio" name="status_2" checked>
                                        Présent</label>
                                    <label class="radio_option absent"><input type="radio" name="status_2">
                                        Absent</label>
                                    <label class="radio_option late"><input type="radio" name="status_2"> Retard</label>
                                </div>
                            </td>
                            <td><input type="text" placeholder="Note (optionnel)"
                                    style="padding: 5px; border: 1px solid #ddd; border-radius: 3px; width: 100%;"></td>
                        </tr>
                        <!-- End PHP Loop -->
                    </tbody>
                </table>
            </div>

            <button type="submit" class="save_btn"><i class="fa-solid fa-save"></i> Enregistrer la Présence</button>
        </form>
    </div>

</body>

</html>