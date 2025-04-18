<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="index.php">
                    <span class="logo-text">Skill<span class="logo-highlight">Share</span></span>
                </a>
            </div>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="index.php" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="search.php" class="nav-link">Rechercher</a></li>
                    <li class="nav-item"><a href="todo.php" class="nav-link">To-Do Liste</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Support</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="notifications">
                    <button class="notifications-btn">
                        <span class="icon">🔔</span>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="notifications-dropdown">
                        <div class="dropdown-header">
                            <h3>Notifications</h3>
                            <a href="#" class="mark-all-read">Tout marquer comme lu</a>
                        </div>
                        <div class="notifications-list">
                            <a href="#" class="notification-item unread">
                                <div class="notification-icon" style="background-color: #F8C8DC;">📚</div>
                                <div class="notification-content">
                                    <p>Votre session <strong>JavaScript</strong> avec Thomas est confirmée</p>
                                    <span class="notification-time">Il y a 10 minutes</span>
                                </div>
                            </a>
                            <a href="#" class="notification-item unread">
                                <div class="notification-icon" style="background-color: #E6A4B4;">⭐</div>
                                <div class="notification-content">
                                    <p>Thomas vous a donné une évaluation 5 étoiles</p>
                                    <span class="notification-time">Il y a 2 heures</span>
                                </div>
                            </a>
                            <a href="#" class="notification-item unread">
                                <div class="notification-icon" style="background-color: #F8C8DC;">🏆</div>
                                <div class="notification-content">
                                    <p>Vous avez obtenu le badge <strong>Top Mentor</strong></p>
                                    <span class="notification-time">Il y a 1 jour</span>
                                </div>
                            </a>
                            <a href="#" class="notification-item">
                                <div class="notification-icon" style="background-color: #E6A4B4;">👥</div>
                                <div class="notification-content">
                                    <p>Sophie a réservé une session avec vous</p>
                                    <span class="notification-time">Il y a 2 jours</span>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#" class="view-all">Voir toutes les notifications</a>
                        </div>
                    </div>
                </div>
                <div class="user-menu">
                    <button class="user-menu-btn">
                        <img src="images/default-avatar.svg" alt="Photo de profil" class="user-avatar">
                        <span class="user-name">Marie</span>
                        <span class="icon">▼</span>
                    </button>
                    <div class="user-dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"><span class="icon">👤</span> Mon profil</a></li>
                            <li><a href="user-dashboard.php"><span class="icon">📊</span> Tableau de bord</a></li>
                            <li><a href="#"><span class="icon">⚙️</span> Paramètres</a></li>
                            <li class="divider"></li>
                            <li><a href="login.php"><span class="icon">🚪</span> Déconnexion</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <button class="mobile-menu-btn">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-menu">
    <nav class="mobile-nav">
        <ul class="mobile-nav-list">
            <li class="mobile-nav-item"><a href="index.php" class="mobile-nav-link">Accueil</a></li>
            <li class="mobile-nav-item"><a href="search.php" class="mobile-nav-link">Rechercher</a></li>
            <li class="mobile-nav-item"><a href="todo.php" class="mobile-nav-link">To-Do Liste</a></li>
            <li class="mobile-nav-item"><a href="#" class="mobile-nav-link">Support</a></li>
        </ul>
    </nav>
    <div class="mobile-user-actions">
        <a href="profile.php" class="btn btn-secondary btn-sm">Mon profil</a>
        <a href="login.php" class="btn btn-primary btn-sm">Déconnexion</a>
    </div>
</div>

