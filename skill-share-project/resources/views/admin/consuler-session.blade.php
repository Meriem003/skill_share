<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>consuler session - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite (['resources/css/admin.css'])
    @vite (['resources/css/session-admin.css'])
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
        <h1>Gestion des Sessions</h1>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un cours...">
                <button type="submit"><span class="icon">🔍</span>
                </button>
            </div>
    </div>

    <div class="admin-section">
        @if($sessions->isEmpty())
            <p class="empty-message">Aucune session disponible.</p>
        @else
            <div class="session-cards-container">
                @foreach($sessions as $session)
                    <div class="session-card">
                        <div class="session-card-header">
                            <h3>{{ $session->titre }}</h3>
                            <span class="session-status {{ strtolower($session->statut) }}">{{ $session->statut }}</span>
                        </div>
                        <div class="session-card-body">
                            <p class="session-description">{{ Str::limit($session->description, 100) }}</p>
                            
                            <div class="session-details">
                                <div class="session-detail">
                                    <span class="label">Compétence:</span>
                                    <span class="value">{{ $session->skill ? $session->skill->nom : 'Non définie' }}</span>
                                </div>
                                <div class="session-detail">
                                    <span class="label">Date:</span>
                                    <span class="value">{{ \Carbon\Carbon::parse($session->date_session)->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="session-detail">
                                    <span class="label">Durée:</span>
                                    <span class="value">{{ $session->duree }} minutes</span>
                                </div>
                                <div class="session-detail">
                                    <span class="label">Lieu:</span>
                                    <span class="value">{{ $session->lieu_type }} - {{ $session->lieu_details }}</span>
                                </div>
                                <div class="session-detail">
                                    <span class="label">Enseignant:</span>
                                    <span class="value">
                                        @if($session->teacher && $session->teacher->user)
                                            {{ $session->teacher->user->Fullname }}
                                        @else
                                            <span class="missing">Non assigné</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="session-detail">
                                    <span class="label">Étudiant:</span>
                                    <span class="value">
                                        @if($session->student && $session->student->user)
                                            {{ $session->student->user->Fullname }}
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
        @endif
    </div>
</div>
    </main>
    @vite (entrypoints: ['resources/js/main.css'])
    @vite (['resources/js/admin.css']) 
</body>
</html>