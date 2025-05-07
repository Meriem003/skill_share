<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite(['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite(['resources/css/admin.css'])
</head>
<body>
<main class="main-content" style="padding: 0;">
        <div class="admin-container">
        <div class="admin-sidebar">
                <div class="admin-profile">
                    <img src=".../../../profil.jpg" alt="Photo de profil" class="admin-avatar">
                    <div class="admin-info">
                        <h3>Admin</h3>
                        <p>Administrateur</p>
                    </div>
                </div>
                <nav class="admin-nav">
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
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
                            <a href="{{ route('admin.Session') }}">
                                <span class="icon">📚</span>
                                <span>Sessions</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.Commentaire') }}">
                                <span class="icon">📝</span>
                                <span>Commentaire</span>
                            </a>
                        </li>
                        <li class="log">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="background: none; border: none; display: flex; align-items: center; width: 100%; padding: 12px 20px; cursor: pointer; color: inherit; text-align: left;">
                                    <span class="icon">🚪</span>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="admin-content">
                <div class="admin-header">
                    <h1>Tableau de bord administrateur</h1>
                </div>
                
                <!-- Statistiques globales -->
                <div class="admin-overview">
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #F8C8DC;">👥</div>
                        <div class="overview-details">
                            <h3 class="overview-change positive">{{ $stats['users_count'] }}</h3>
                            <p>Utilisateurs inscrits</p>
                        </div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #E6A4B4;">📚</div>
                        <div class="overview-details">
                            <h3 class="overview-change positive">{{ $stats['sessions_count'] }}</h3>
                            <p>Sessions réalisées</p>
                        </div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #F8C8DC;">⭐</div>
                        <div class="overview-details">
                            <h3 class="overview-change positive">{{ number_format($stats['average_rating'], 1) }}</h3>
                            <p>Note moyenne</p>
                        </div>
                    </div>
                    <div class="overview-card">
                        <div class="overview-icon" style="background-color: #E6A4B4;">🏆</div>
                        <div class="overview-details">
                            <h3 class="overview-change positive">{{ $stats['badges_count'] }}</h3>
                            <p>Badges attribués</p>
                        </div>
                    </div>
                </div>
                
                <!-- Compétences populaires -->
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Statistiques d'utilisation</h2>
                    </div>
                    <div class="stats-card">
                        <h3>Compétences les plus populaires</h3>
                        <div class="popular-skills">
                            @forelse($stats['popular_skills'] as $skill)
                            <div class="skill-bar">
                                <div class="skill-info">
                                    <span class="skill-name">{{ $skill->nom }}</span>
                                    <span class="skill-count">{{ $skill->sessions_count }} sessions</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress" style="width: {{ $skill->percentage }}%;"></div>
                                </div>
                            </div>
                            @empty
                            <p>Aucune compétence n'a encore été utilisée dans les sessions.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite(['resources/js/main.js'])
</body>
</html>