<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sessions - SkillShare</title>
    @vite(['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite(['resources/css/admin.css'])
    @vite(['resources/css/session-admin.css'])
    <!-- Add Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
@include('includes.header-admin')

<main class="main-content" style="padding: 0;">
    <div class="admin-container">
        <div class="admin-content">
        <div class="admin-header">
                <h1>Gestion des Sessions</h1>
                    <div class="header-actions">
                        <div class="search-bar">
                            <input type="text" placeholder="Rechercher un commentaire...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="filter-dropdown">
                            <button class="filter-btn">
                                <i class="fas fa-filter"></i>
                                <span>Filtrer</span>
                            </button>
                        </div>
                    </div>
                </div>
            <div class="admin-section">
                @if($sessions->isEmpty())
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-calendar-xmark"></i>
                        </div>
                        <h3>Aucune session disponible</h3>
                        <p>Il n'y a pas encore de sessions dans le système.</p>
                        <button class="create-btn">
                            <i class="fas fa-plus"></i> Créer une session
                        </button>
                    </div>
                @else
                    <div class="session-cards-container">
                        @foreach($sessions as $session)
                            <div class="session-card">
                                <div class="session-card-header">
                                    <h3>{{ $session->titre }}</h3>
                                    <span class="session-status {{ strtolower($session->statut) }}">
                                        @if(strtolower($session->statut) == 'planifiée')
                                            <i class="fas fa-calendar-check"></i>
                                        @elseif(strtolower($session->statut) == 'en cours')
                                            <i class="fas fa-play-circle"></i>
                                        @elseif(strtolower($session->statut) == 'terminée')
                                            <i class="fas fa-check-circle"></i>
                                        @elseif(strtolower($session->statut) == 'annulée')
                                            <i class="fas fa-times-circle"></i>
                                        @else
                                            <i class="fas fa-question-circle"></i>
                                        @endif
                                        {{ $session->statut }}
                                    </span>
                                </div>
                                <div class="session-card-body">
                                    <p class="session-description">{{ Str::limit($session->description, 100) }}</p>
                                    
                                    <div class="session-details">
                                        <div class="session-detail">
                                            <i class="fas fa-graduation-cap"></i>
                                            <span class="label">Compétence:</span>
                                            <span class="value">{{ $session->skill ? $session->skill->nom : 'Non définie' }}</span>
                                        </div>
                                        <div class="session-detail">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span class="label">Date:</span>
                                            <span class="value">{{ \Carbon\Carbon::parse($session->date_session)->format('d/m/Y H:i') }}</span>
                                        </div>
                                        <div class="session-detail">
                                            <i class="fas fa-clock"></i>
                                            <span class="label">Durée:</span>
                                            <span class="value">{{ $session->duree }} minutes</span>
                                        </div>
                                        <div class="session-detail">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span class="label">Lieu:</span>
                                            <span class="value">{{ $session->lieu_type }} - {{ $session->lieu_details }}</span>
                                        </div>
                                        <div class="session-detail">
                                            <i class="fas fa-user-tie"></i>
                                            <span class="label">Enseignant:</span>
                                            <span class="value">
                                                @if($session->teacher && $session->teacher->user)
                                                    {{ $session->teacher->user->fullname }}
                                                @else
                                                    <span class="missing">Non assigné</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="session-detail">
                                            <i class="fas fa-user-graduate"></i>
                                            <span class="label">Étudiant:</span>
                                            <span class="value">
                                                @if($session->student && $session->student->user)
                                                    {{ $session->student->user->fullname }}
                                                @else
                                                    <span class="missing">Non assigné</span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination">
                    <div class="pagination-numbers">
                        {!! $sessions->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</main>

@vite(['resources/js/main.js'])
@vite(['resources/js/admin.js'])
</body>
</html>
