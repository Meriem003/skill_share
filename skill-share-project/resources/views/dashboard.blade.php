<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - SkillShare</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main class="main-content">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <div class="dashboard-actions">
                    <button class="btn btn-secondary">
                        <span class="icon">📅</span> Calendrier
                    </button>
                    <button class="btn btn-primary">
                        <span class="icon">➕</span> Nouvelle session
                    </button>
                </div>
            </div>
            
            <div class="dashboard-overview">
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #F8C8DC;">📚</div>
                    <div class="overview-details">
                        <h3>12</h3>
                        <p>Sessions enseignées</p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #E6A4B4;">🧠</div>
                    <div class="overview-details">
                        <h3>8</h3>
                        <p>Sessions apprises</p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #F8C8DC;">⭐</div>
                    <div class="overview-details">
                        <h3>4.8</h3>
                        <p>Note moyenne</p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #E6A4B4;">🏆</div>
                    <div class="overview-details">
                        <h3>850</h3>
                        <p>Points</p>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div class="dashboard-column">
                    <div class="dashboard-card upcoming-sessions">
                        <div class="card-header">
                            <h2>Sessions à venir</h2>
                            <a href="#" class="view-all">Voir tout</a>
                        </div>
                        <div class="card-content">
                            <div class="session-item">
                                <div class="session-date">
                                    <span class="day">06</span>
                                    <span class="month">Juin</span>
                                </div>
                                <div class="session-details">
                                    <h4>Initiation au JavaScript</h4>
                                    <p>14:30 - 16:00 • Bibliothèque du campus</p>
                                    <div class="session-with">
                                        <img src="images/user2.svg" alt="Photo de profil">
                                        <span>Avec Thomas Dubois</span>
                                    </div>
                                </div>
                                <div class="session-type teaching">J'enseigne</div>
                            </div>
                            <div class="session-item">
                                <div class="session-date">
                                    <span class="day">09</span>
                                    <span class="month">Juin</span>
                                </div>
                                <div class="session-details">
                                    <h4>Bases du Python</h4>
                                    <p>10:00 - 11:00 • Salle informatique B12</p>
                                    <div class="session-with">
                                        <img src="images/user3.svg" alt="Photo de profil">
                                        <span>Avec Lucas Martin</span>
                                    </div>
                                </div>
                                <div class="session-type learning">J'apprends</div>
                            </div>
                            <div class="session-item">
                                <div class="session-date">
                                    <span class="day">12</span>
                                    <span class="month">Juin</span>
                                </div>
                                <div class="session-details">
                                    <h4>Design d'interfaces</h4>
                                    <p>15:00 - 16:30 • Salle de design</p>
                                    <div class="session-with">
                                        <img src="images/user4.svg" alt="Photo de profil">
                                        <span>Avec Emma Petit</span>
                                    </div>
                                </div>
                                <div class="session-type teaching">J'enseigne</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card todo-preview">
                        <div class="card-header">
                            <h2>To-Do Liste</h2>
                            <a href="todo.php" class="view-all">Voir tout</a>
                        </div>
                        <div class="card-content">
                            <div class="todo-progress-bar">
                                <div class="progress" style="width: 60%;"></div>
                                <span class="progress-text">12/20 tâches terminées</span>
                            </div>
                            <div class="todo-items">
                                <div class="todo-item">
                                    <div class="todo-checkbox">
                                        <input type="checkbox" id="dashboard-todo-1">
                                        <label for="dashboard-todo-1"></label>
                                    </div>
                                    <div class="todo-content">
                                        <h4>Préparer le cours de JavaScript</h4>
                                        <p>Aujourd'hui, 18:00</p>
                                    </div>
                                    <div class="todo-priority high"></div>
                                </div>
                                <div class="todo-item">
                                    <div class="todo-checkbox">
                                        <input type="checkbox" id="dashboard-todo-2">
                                        <label for="dashboard-todo-2"></label>
                                    </div>
                                    <div class="todo-content">
                                        <h4>Réviser les bases de Python</h4>
                                        <p>Aujourd'hui, 20:00</p>
                                    </div>
                                    <div class="todo-priority medium"></div>
                                </div>
                                <div class="todo-item">
                                    <div class="todo-checkbox">
                                        <input type="checkbox" id="dashboard-todo-3">
                                        <label for="dashboard-todo-3"></label>
                                    </div>
                                    <div class="todo-content">
                                        <h4>Mettre à jour la photo de profil</h4>
                                        <p>Aujourd'hui, 22:00</p>
                                    </div>
                                    <div class="todo-priority low"></div>
                                </div>
                            </div>
                            <a href="todo.php" class="btn btn-secondary btn-sm btn-block">Gérer mes tâches</a>
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-column">
                    <div class="dashboard-card activity-feed">
                        <div class="card-header">
                            <h2>Activité récente</h2>
                        </div>
                        <div class="card-content">
                            <div class="activity-item">
                                <div class="activity-icon" style="background-color: #F8C8DC;">⭐</div>
                                <div class="activity-content">
                                    <p><strong>Thomas Dubois</strong> vous a donné une évaluation 5 étoiles</p>
                                    <p class="activity-meta">Il y a 2 heures</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background-color: #E6A4B4;">📚</div>
                                <div class="activity-content">
                                    <p>Vous avez complété une session <strong>Design d'interfaces</strong> avec Emma Petit</p>
                                    <p class="activity-meta">Il y a 1 jour</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background-color: #F8C8DC;">🏆</div>
                                <div class="activity-content">
                                    <p>Vous avez obtenu le badge <strong>Top Mentor</strong></p>
                                    <p class="activity-meta">Il y a 2 jours</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background-color: #E6A4B4;">🧠</div>
                                <div class="activity-content">
                                    <p>Vous avez réservé une session <strong>Bases du Python</strong> avec Lucas Martin</p>
                                    <p class="activity-meta">Il y a 3 jours</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background-color: #F8C8DC;">👥</div>
                                <div class="activity-content">
                                    <p><strong>Sophie Martin</strong> a réservé une session avec vous</p>
                                    <p class="activity-meta">Il y a 4 jours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card leaderboard">
                        <div class="card-header">
                            <h2>Classement</h2>
                            <a href="#" class="view-all">Voir tout</a>
                        </div>
                        <div class="card-content">
                            <div class="leaderboard-tabs">
                                <button class="leaderboard-tab active" data-tab="campus">Mon campus</button>
                                <button class="leaderboard-tab" data-tab="global">Global</button>
                            </div>
                            <div class="leaderboard-list">
                                <div class="leaderboard-item">
                                    <div class="leaderboard-rank">1</div>
                                    <div class="leaderboard-user">
                                        <img src="images/user1.svg" alt="Photo de profil">
                                        <div>
                                            <h4>Sophie Martin</h4>
                                            <p>Campus de Paris</p>
                                        </div>
                                    </div>
                                    <div class="leaderboard-points">1250 pts</div>
                                </div>
                                <div class="leaderboard-item current-user">
                                    <div class="leaderboard-rank">2</div>
                                    <div class="leaderboard-user">
                                        <img src="images/default-avatar.svg" alt="Photo de profil">
                                        <div>
                                            <h4>Marie Dupont (Vous)</h4>
                                            <p>Campus de Paris</p>
                                        </div>
                                    </div>
                                    <div class="leaderboard-points">850 pts</div>
                                </div>
                                <div class="leaderboard-item">
                                    <div class="leaderboard-rank">3</div>
                                    <div class="leaderboard-user">
                                        <img src="images/user3.svg" alt="Photo de profil">
                                        <div>
                                            <h4>Lucas Martin</h4>
                                            <p>Campus de Paris</p>
                                        </div>
                                    </div>
                                    <div class="leaderboard-points">720 pts</div>
                                </div>
                                <div class="leaderboard-item">
                                    <div class="leaderboard-rank">4</div>
                                    <div class="leaderboard-user">
                                        <img src="images/user2.svg" alt="Photo de profil">
                                        <div>
                                            <h4>Thomas Dubois</h4>
                                            <p>Campus de Lyon</p>
                                        </div>
                                    </div>
                                    <div class="leaderboard-points">680 pts</div>
                                </div>
                                <div class="leaderboard-item">
                                    <div class="leaderboard-rank">5</div>
                                    <div class="leaderboard-user">
                                        <img src="images/user4.svg" alt="Photo de profil">
                                        <div>
                                            <h4>Emma Petit</h4>
                                            <p>Campus de Paris</p>
                                        </div>
                                    </div>
                                    <div class="leaderboard-points">650 pts</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
    <script src="js/main.js"></script>
    <script src="js/dashboard.js"></script>
</body>
</html>

