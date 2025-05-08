<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite(['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite(['resources/css/admin.css'])
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
@include('includes.header-admin')
<main class="main-content" style="padding: 0;">
    <div class="admin-container">
        <div class="admin-content">
            <div class="admin-header">
                <h1><i class="fas fa-tachometer-alt"></i> Tableau de bord administrateur</h1>
                <div class="header-actions">
                    <button class="refresh-btn" title="Rafraîchir les données">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
            
            <!-- Statistiques globales -->
            <div class="admin-overview">
                <div class="overview-card">
                    <div class="overview-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="overview-details">
                        <h3 class="overview-value">{{ $stats['users_count'] }}</h3>
                        <p class="overview-label">Utilisateurs inscrits</p>
                    </div>
                    <div class="overview-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>12%</span>
                    </div>
                </div>
                
                <div class="overview-card">
                    <div class="overview-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="overview-details">
                        <h3 class="overview-value">{{ $stats['sessions_count'] }}</h3>
                        <p class="overview-label">Sessions réalisées</p>
                    </div>
                    <div class="overview-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>8%</span>
                    </div>
                </div>
                
                <div class="overview-card">
                    <div class="overview-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="overview-details">
                        <h3 class="overview-value">{{ number_format($stats['average_rating'], 1) }}</h3>
                        <p class="overview-label">Note moyenne</p>
                    </div>
                    <div class="overview-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>3%</span>
                    </div>
                </div>
                
                <div class="overview-card">
                    <div class="overview-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <div class="overview-details">
                        <h3 class="overview-value">{{ $stats['badges_count'] }}</h3>
                        <p class="overview-label">Badges attribués</p>
                    </div>
                    <div class="overview-trend positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>15%</span>
                    </div>
                </div>
            </div>
            
            <!-- Sections de statistiques -->
            <div class="stats-grid">
                <!-- Compétences populaires -->
                <div class="stats-card">
                    <div class="stats-card-header">
                        <h3><i class="fas fa-chart-bar"></i> Compétences les plus populaires</h3>
                        <div class="card-actions">
                            <button class="card-action-btn" title="Plus d'options">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                    <div class="stats-card-body">
                        <div class="popular-skills">
                            @forelse($stats['popular_skills'] as $skill)
                            <div class="skill-bar">
                                <div class="skill-info">
                                    <span class="skill-name">{{ $skill->nom }}</span>
                                    <span class="skill-count">{{ $skill->sessions_count }} sessions</span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar">
                                        <div class="progress" style="width:{{ $skill->percentage }}%;"></div>
                                    </div>
                                    <span class="progress-value">{{ $skill->percentage }}%</span>
                                </div>
                            </div>
                            @empty
                            <div class="empty-state">
                                <i class="fas fa-chart-pie"></i>
                                <p>Aucune compétence n'a encore été utilisée dans les sessions.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <!-- Activité récente -->
                <div class="stats-card">
                    <div class="stats-card-header">
                        <h3><i class="fas fa-history"></i> Activité récente</h3>
                        <div class="card-actions">
                            <button class="card-action-btn" title="Plus d'options">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                    <div class="stats-card-body">
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-details">
                                    <p class="activity-text">Nouvel utilisateur inscrit: <strong>Marie Dupont</strong></p>
                                    <span class="activity-time">Il y a 2 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="activity-details">
                                    <p class="activity-text">Session terminée: <strong>Introduction à JavaScript</strong></p>
                                    <span class="activity-time">Il y a 5 heures</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-comment"></i>
                                </div>
                                <div class="activity-details">
                                    <p class="activity-text">Nouveau commentaire par <strong>Thomas Martin</strong></p>
                                    <span class="activity-time">Il y a 1 jour</span>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div class="activity-details">
                                    <p class="activity-text">Badge attribué à <strong>Sophie Leclerc</strong></p>
                                    <span class="activity-time">Il y a 2 jours</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@vite(['resources/js/main.js'])
</body>
</html>