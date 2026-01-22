<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minerva - Statistiques</title>
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

        .grid_stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .chart_card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chart_header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: #555;
        }

        .chart_placeholder {
            height: 250px;
            background: #f9f9f9;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            position: relative;
            overflow: hidden;
        }

        /* Simulating Charts with CSS bars */
        .bar_chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 100%;
            width: 100%;
            padding: 20px;
        }

        .bar {
            width: 30px;
            background: #5ABDF1;
            border-radius: 5px 5px 0 0;
            position: relative;
            transition: height 1s;
        }

        .bar span {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.8rem;
            color: #666;
        }

        .pie_chart_container {
            display: flex;
            justify-content: center;
        }

        .pie_chart {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(#5ABDF1 0% 70%, #ff6b6b 70% 90%, #f39c12 90% 100%);
            position: relative;
        }

        .pie_legend {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 15px;
            font-size: 0.9rem;
        }

        .legend_item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <?php include '../partiels/sidebar_teacher.php'; ?>

    <div class="main_content">
        <div class="section_header">
            <div>
                <h1>Statistiques & Analyses</h1>
                <p style="color: #666;">Vue d'ensemble de la performance de vos classes.</p>
            </div>
            <select style="padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                <option>Ce Semestre</option>
                <option>L'année dernière</option>
            </select>
        </div>

        <div class="grid_stats">
            <div class="chart_card">
                <div class="chart_header">
                    <h3>Performance Moyenne par Classe</h3>
                    <i class="fa-solid fa-ellipsis" style="cursor: pointer;"></i>
                </div>
                <div class="chart_placeholder">
                    <div class="bar_chart">
                        <div class="bar" style="height: 60%;"><span>Dev Web</span></div>
                        <div class="bar" style="height: 85%;"><span>BDD</span></div>
                        <div class="bar" style="height: 45%;"><span>Algorithmes</span></div>
                        <div class="bar" style="height: 70%;"><span>Design</span></div>
                    </div>
                </div>
            </div>

            <div class="chart_card">
                <div class="chart_header">
                    <h3>Taux de Soumission des Devoirs</h3>
                    <i class="fa-solid fa-ellipsis" style="cursor: pointer;"></i>
                </div>
                <div class="chart_placeholder">
                    <div>
                        <div class="pie_chart_container">
                            <div class="pie_chart"></div>
                        </div>
                        <div class="pie_legend">
                            <div class="legend_item">
                                <div class="dot" style="background: #5ABDF1;"></div>À l'heure
                            </div>
                            <div class="legend_item">
                                <div class="dot" style="background: #f39c12;"></div>En retard
                            </div>
                            <div class="legend_item">
                                <div class="dot" style="background: #ff6b6b;"></div>Manquant
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart_card" style="grid-column: span 2;">
                <div class="chart_header">
                    <h3>Progression Mensuelle</h3>
                    <i class="fa-solid fa-ellipsis" style="cursor: pointer;"></i>
                </div>
                <div class="chart_placeholder">
                    <!-- Placeholder for Line Chart -->
                    <svg viewBox="0 0 500 100" class="chart">
                        <polyline fill="none" stroke="#5ABDF1" stroke-width="2" points="
                               00,80
                               50,70
                               100,60
                               150,50
                               200,40
                               250,50
                               300,30
                               350,20
                               400,30
                               450,10
                               500,20
                             " />
                    </svg>
                </div>
            </div>
        </div>
    </div>

</body>

</html>