<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

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
                            <a href="#users">
                                <span class="icon">👥</span>
                                <span>Utilisateurs</span>
                            </a>
                        </li>
                        <li>
                            <a href="#sessions">
                                <span class="icon">📚</span>
                                <span>Sessions</span>
                            </a>
                        </li>
                        <li>
                            <a href="#reports">
                                <span class="icon">📝</span>
                                <span>Rapports</span>
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <span class="icon">⚙️</span>
                                <span>Paramètres</span>
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
                
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Gestion des utilisateurs</h2>
                        <div class="section-actions">
                            <div class="search-input-wrapper">
                                <input type="text" placeholder="Rechercher un utilisateur...">
                                <button class="search-btn">
                                    <span class="icon">🔍</span>
                                </button>
                            </div>
                            <button class="btn btn-primary">
                                <span class="icon">➕</span> Ajouter un utilisateur
                            </button>
                        </div>
                    </div>
                    <div class="users-table-container">
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Campus</th>
                                    <th>Date d'inscription</th>
                                    <th>Sessions</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td class="user-cell">
                                        <img src="images/user1.svg" alt="Photo de profil">
                                        <span>Sophie Martin</span>
                                    </td>
                                    <td>sophie.martin@email.com</td>
                                    <td>Paris</td>
                                    <td>01/03/2023</td>
                                    <td>24</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td class="user-cell">
                                        <img src="images/user2.svg" alt="Photo de profil">
                                        <span>Thomas Dubois</span>
                                    </td>
                                    <td>thomas.dubois@email.com</td>
                                    <td>Lyon</td>
                                    <td>15/03/2023</td>
                                    <td>18</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#003</td>
                                    <td class="user-cell">
                                        <img src="images/user3.svg" alt="Photo de profil">
                                        <span>Lucas Martin</span>
                                    </td>
                                    <td>lucas.martin@email.com</td>
                                    <td>Paris</td>
                                    <td>22/03/2023</td>
                                    <td>12</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#004</td>
                                    <td class="user-cell">
                                        <img src="images/user4.svg" alt="Photo de profil">
                                        <span>Emma Petit</span>
                                    </td>
                                    <td>emma.petit@email.com</td>
                                    <td>Paris</td>
                                    <td>05/04/2023</td>
                                    <td>8</td>
                                    <td><span class="status-badge suspended">Suspendu</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn activate">
                                            <span class="icon">🔓</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#005</td>
                                    <td class="user-cell">
                                        <img src="images/user5.svg" alt="Photo de profil">
                                        <span>Alexandre Durand</span>
                                    </td>
                                    <td>alexandre.durand@email.com</td>
                                    <td>Marseille</td>
                                    <td>12/04/2023</td>
                                    <td>5</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn prev" disabled>Précédent</button>
                        <div class="pagination-numbers">
                            <button class="pagination-number active">1</button>
                            <button class="pagination-number">2</button>
                            <button class="pagination-number">3</button>
                            <span class="pagination-ellipsis">...</span>
                            <button class="pagination-number">10</button>
                        </div>
                        <button class="pagination-btn next">Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ?php include 'includes/footer.php'; -->
    <script src="js/main.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>

