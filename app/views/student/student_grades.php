<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Mes Notes</title>
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

        .grades_table_container {
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
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f9f9f9;
            color: #555;
            font-weight: 600;
        }

        .grade_pill {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 15px;
            font-weight: bold;
        }

        .grade_good {
            background: #e6fffa;
            color: #2ecc71;
        }

        .grade_avg {
            background: #fff8e1;
            color: #f39c12;
        }

        .grade_bad {
            background: #fff0f0;
            color: #ff6b6b;
        }

        .feedback_cell {
            max-width: 300px;
            color: #666;
            font-size: 0.9rem;
            font-style: italic;
        }
    </style>
</head>

<body>

    <?php include APPROOT . '/app/views/partiels/sidebar_student.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Mes Notes</h1>
                <p style="color: #666;">Suivi de vos résultats académiques</p>
            </div>
            <div
                style="background: white; padding: 10px 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <span style="color: #888; margin-right: 10px;">Moyenne Générale:</span>
                <span style="font-size: 1.5rem; font-weight: bold; color: #5ABDF1;">15.5/20</span>
            </div>
        </div>

        <div class="grades_table_container">
            <table>
                <thead>
                    <tr>
                        <th>Matière</th>
                        <th>Devoir / Examen</th>
                        <th>Date</th>
                        <th>Note</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Dev Web</strong></td>
                        <td>Création Landing Page</td>
                        <td>15 Jan 2024</td>
                        <td><span class="grade_pill grade_good">18/20</span></td>
                        <td class="feedback_cell">"Excellent design et code propre. Attention à l'indentation."</td>
                    </tr>
                    <tr>
                        <td><strong>Base de Données</strong></td>
                        <td>Interrogation SQL</td>
                        <td>10 Jan 2024</td>
                        <td><span class="grade_pill grade_avg">13/20</span></td>
                        <td class="feedback_cell">"Des erreurs dans les jointures externes. À revoir."</td>
                    </tr>
                    <tr>
                        <td><strong>Anglais</strong></td>
                        <td>Oral Présentation</td>
                        <td>05 Jan 2024</td>
                        <td><span class="grade_pill grade_good">16/20</span></td>
                        <td class="feedback_cell">"Good pronunciation. Work on vocabulary."</td>
                    </tr>
                    <tr>
                        <td><strong>Algorithmique</strong></td>
                        <td>Partiel Semestre 1</td>
                        <td>20 Dec 2023</td>
                        <td><span class="grade_pill grade_bad">09/20</span></td>
                        <td class="feedback_cell">"Notions de complexité non acquises."</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>