<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
<h1>Bienvenue sur le Dashboard</h1>
<p>Bonjour <?= htmlspecialchars($user['prenom'] ?? $user['login']) ?> !</p>

</body>
</html> -->



<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <style>
        :root {
            --orange: #f26e21;
            --bleu: #009bbf;
            --vert: #009e60;
            --gris-clair: #f5f6fa;
            --gris: #dfe4ea;
            --blanc: #ffffff;
            --noir: #2f3542;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--gris-clair);
            color: var(--noir);
        }

        .sidebar {
            width: 220px;
            background-color: var(--blanc);
            height: 100vh;
            position: fixed;
            border-right: 1px solid var(--gris);
            padding: 20px 0;
        }

        .sidebar h2 {
            text-align: center;
            color: var(--orange);
            margin-bottom: 30px;
            font-size: 18px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 12px 20px;
            cursor: pointer;
        }

        .sidebar li.active, .sidebar li:hover {
            background-color: var(--orange);
            color: white;
        }

        .main {
            margin-left: 220px;
            padding: 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .search {
            width: 300px;
            padding: 8px;
            border-radius: 20px;
            border: 1px solid var(--gris);
        }

        .topbar .profile {
            display: flex;
            align-items: center;
        }

        .topbar .profile span {
            margin-right: 10px;
        }

        .cards {
            display: flex;
            gap: 20px;
            margin: 20px 0;
            flex-wrap: wrap;
        }

        .card {
            background-color: var(--orange);
            color: white;
            padding: 20px;
            border-radius: 10px;
            flex: 1;
            min-width: 180px;
            text-align: center;
            font-weight: bold;
        }

        .dashboard-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .stat-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            flex: 1;
            min-width: 250px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .stat-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .footer-infos {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .footer-infos div {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            flex: 1;
            margin: 0 10px;
        }

        @media (max-width: 1024px) {
    .cards, .dashboard-stats, .footer-infos {
        flex-direction: column;
        gap: 10px;
    }

    .stat-box, .card, .footer-infos div {
        min-width: unset;
        width: 100%;
    }
}

@media (max-width: 768px) {
    .sidebar {
        position: absolute;
        left: -100%;
        transition: left 0.3s ease;
        z-index: 1000;
    }

    .sidebar.active {
        left: 0;
    }

    .main {
        margin-left: 0;
        padding: 15px;
    }

    .topbar {
        flex-direction: column;
        align-items: flex-start;
    }

    .topbar .search {
        width: 100%;
        margin-bottom: 10px;
    }

    .topbar .profile {
        width: 100%;
        justify-content: space-between;
    }

    .cards, .dashboard-stats, .footer-infos {
        flex-direction: column;
    }

    .card, .stat-box, .footer-infos div {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .topbar .profile span {
        font-size: 14px;
    }

    .card, .stat-box, .footer-infos div {
        padding: 15px;
    }

    .sidebar h2 {
        font-size: 16px;
    }

    .sidebar li {
        padding: 10px;
        font-size: 14px;
    }
}

    </style>
</head>
<body>

<div class="sidebar">
    <h2>Sonatel ODC</h2>
    <ul>
        <li class="active">Tableau de bord</li>
        <li>Promotions</li>
        <li>Référentiels</li>
        <li>Apprenants</li>
        <li>Présences</li>
        <li>Kits & Laptops</li>
        <li>Rapports & Stats</li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
        <input type="text" class="search" placeholder="Rechercher...">
        <div class="profile">
            <span><?= $user['prenom'] ?? '' ?> <?= $user['nom'] ?? '' ?> (<?= $user['role'] ?? 'Utilisateur' ?>)</span>
            <img src="https://via.placeholder.com/40" style="border-radius:50%;" alt="Profile">
        </div>
    </div>

    <div class="cards">
        <div class="card">180 Apprenants</div>
        <div class="card">5 Référentiels</div>
        <div class="card">5 Stagiaires</div>
        <div class="card">13 Permanents</div>
    </div>

    <div class="dashboard-stats">
        <div class="stat-box">
            <div class="stat-title">Présences statistiques</div>
            <div><img src="https://via.placeholder.com/400x150" alt="Graphique"></div>
        </div>
        <div class="stat-box">
            <div class="stat-title">Apprenants</div>
            <div>
                <p>65% Hommes</p>
                <p>35% Femmes</p>
            </div>
        </div>
    </div>

    <div class="footer-infos">
        <div>
            <p><strong>100%</strong></p>
            <p>Taux d'insertion pro</p>
        </div>
        <div>
            <p><strong>56%</strong></p>
            <p>Taux de féminisation</p>
        </div>
        <div>
            <p><strong>1000</strong></p>
            <p>Développeurs</p>
        </div>
        <div>
            <p><strong>4 Centres</strong></p>
            <p>Dakar, Ziguinchor...</p>
        </div>
    </div>
</div>

</body>
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<div class="dashboard-container">
    <aside class="sidebar">
        <div class="logo">
            <img src="/assets/images/logo-removebg-preview.png" alt="Logo Sonatel">
            <p class="promo">Promotion - 2025</p>
        </div>
        <ul class="nav-links">
            <li><a href="#"><span class="icon">📊</span> Tableau de bord</a></li>
            <li><a href="/promotions"><span class="icon"><i class="fa-solid fa-folder" style="color: #ff6600;"></i></span> Promotions</a></li>
            <li><a href="#"><span class="icon"><i class="fa-solid fa-folder" style="color: #ff6600;"></i> </span> Référentiels</a></li>
            <li><a href="#"><span class="icon"><i class="fa-regular fa-user" style="color: #f44a01;"></i></span> Apprenants</a></li>
            <li><a href="#"><span class="icon"><i class="fa-solid fa-folder" style="color: #ff6600;"></i></span> Gestion des présences</a></li>
            <li><a href="#"><span class="icon"><i class="fa-solid fa-folder" style="color: #ff6600;"></i></span> Kits & Laptops</a></li>
            <li><a href="#"><span class="icon"><i class="fa-solid fa-list-check" style="color: #f57105;"></i></span> Rapports & Stats</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <input type="text" placeholder="Search">
            <div class="user-info">
                <span><?= $user['role'] ?? 'Admin' ?></span>
                <img src="/assets/user.jpg" alt="User Profile">
            </div>
        </header>

        <section class="cards1">
        <div class="card1">180 Apprenants</div>
        <div class="card1">5 Référentiels</div>
        <div class="card1">5 Stagiaires</div>
        <div class="card1">13 Permanents</div>
        </section>

        <section class="dashboard-stats">
            <div class="card small-card orange">
                <h3>180 Apprenants</h3>
            </div>
            <div class="card large-card">
                <h3>Présences statistiques</h3>
                <!-- Graphique ici -->
            </div>
        </section>

        <section class="footer-infos">
            <div class="card small-card">
                <h3>180 Apprenants</h3>
                <p>65% hommes, 35% femmes</p>
            </div>
            <div class="card small-card">
                <h3>100%<br>Taux d’insertion</h3>
            </div>
            <div class="card small-card">
                <h3>56%<br>Taux de féminisation</h3>
            </div>
            <div class="card small-card">
                <h3>1000 Développeurs</h3>
                <p>4 Centres : Dakar, Diamiadio...</p>
            </div>
        </section>
    </main>
</div> 
</body>
</html>
