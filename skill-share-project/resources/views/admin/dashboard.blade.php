<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/admin.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="admin-container">
            <div class="admin-sidebar">
                <div class="admin-profile">
                    <img src="images/admin-avatar.svg" alt="Photo de profil" class="admin-avatar">
                    <div class="admin-info">
                        <h3>Admin</h3>
                        <p>Administrateur</p>
                    </div>
                </div>
                <nav class="admin-nav">
                    <ul>
                        <li class="active">
                            <a href="#dashboard">
                                <span class="icon">📊</span>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('admin.utilisateurs') }}">
                            <span class="icon">👥</span>
                            <span>Utilisateurs</span>
                        </a>
                        </li>
                        <li>
                        <a href="{{ route('admin.sessiuns') }}">
                                <span class="icon">📚</span>
                                <span>Sessions</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('admin.compétence') }}">
                                <span class="icon">📝</span>
                                <span>compétence</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="admin-content">
                <div class="admin-header">
                    <h1>Tableau de bord administrateur</h1>
                    <div class="admin-actions">
                        <button class="btn btn-secondary">
                            <span class="icon">📥</span> Exporter les données
                        </button>
                        <button class="btn btn-primary">
                            <span class="icon">✉️</span> Envoyer une notification
                        </button>
                    </div>
                </div>
                
                <div class="admin-overview">
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #F8C8DC;">👥</div>
                        <div class="overview-details">
                            <h3>1,245</h3>
                            <p>Utilisateurs inscrits</p>
                        </div>
                        <div class="overview-change positive">+12% <span>ce mois</span></div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #E6A4B4;">📚</div>
                        <div class="overview-details">
                            <h3>856</h3>
                            <p>Sessions réalisées</p>
                        </div>
                        <div class="overview-change positive">+8% <span>ce mois</span></div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #F8C8DC;">⭐</div>
                        <div class="overview-details">
                            <h3>4.7</h3>
                            <p>Note moyenne</p>
                        </div>
                        <div class="overview-change positive">+0.2 <span>ce mois</span></div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #E6A4B4;">🏆</div>
                        <div class="overview-details">
                            <h3>325</h3>
                            <p>Badges attribués</p>
                        </div>
                        <div class="overview-change positive">+15% <span>ce mois</span></div>
                    </div>
                </div>
                
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Statistiques d'utilisation</h2>
                        <div class="section-actions">
                            <select id="stats-period">
                                <option value="week">Cette semaine</option>
                                <option value="month" selected>Ce mois</option>
                                <option value="quarter">Ce trimestre</option>
                                <option value="year">Cette année</option>
                            </select>
                        </div>
                    </div>
                    <div class="stats-grid">
                        <div class="stats-card">
                            <h3>Utilisateurs actifs</h3>
                            <div class="stats-chart">
                                <div class="chart-placeholder" style="height: 200px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                                    Graphique des utilisateurs actifs
                                </div>
                            </div>
                        </div>
                        <div class="stats-card">
                            <h3>Sessions par catégorie</h3>
                            <div class="stats-chart">
                                <div class="chart-placeholder" style="height: 200px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                                    Graphique des sessions par catégorie
                                </div>
                            </div>
                        </div>
                        <div class="stats-card">
                            <h3>Compétences les plus populaires</h3>
                            <div class="popular-skills">
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">JavaScript</span>
                                        <span class="skill-count">156 sessions</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 85%;"></div>
                                    </div>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">Python</span>
                                        <span class="skill-count">124 sessions</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 70%;"></div>
                                    </div>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">Design UI/UX</span>
                                        <span class="skill-count">98 sessions</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 55%;"></div>
                                    </div>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">Anglais</span>
                                        <span class="skill-count">87 sessions</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 45%;"></div>
                                    </div>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-info">
                                        <span class="skill-name">Marketing digital</span>
                                        <span class="skill-count">65 sessions</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 35%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="stats-card">
                            <h3>Répartition par campus</h3>
                            <div class="stats-chart">
                                <div class="chart-placeholder" style="height: 200px; background-color: #f9f9f9; display: flex; align-items: center; justify-content: center;">
                                    Graphique de répartition par campus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite (['resources/js/main.css'])
    @vite (['resources/js/admin.css']) 
</body>
</html>