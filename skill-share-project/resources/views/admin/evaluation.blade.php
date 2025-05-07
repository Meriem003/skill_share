<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires - SkillShare</title>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/admin.css'])
    @vite(['resources/css/comments.css'])
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
                        <li class="active">
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
                    <h1>Consulter les Commentaires</h1>
                    <div class="search-bar">
                <input type="text" placeholder="Rechercher un cours...">
                <button type="submit"><span class="icon">🔍</span>
                </button>
            </div>
                </div>

                
                <div class="comments-container">
                @forelse ($evaluations as $evaluation)
    <div class="comment-card">
        <div class="comment-header">
            <div class="comment-rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $evaluation->note)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                ({{ $evaluation->note }}/5)
            </div>
            <div class="comment-date">
                {{ $evaluation->created_at->format('d/m/Y') }}
            </div>
        </div>
        
        <div class="comment-session">
            {{ $evaluation->session->titre }}
        </div>
        
        <div class="comment-users">
            <div>De: {{ $evaluation->auteur->user->Fullname }}</div>
            <div>Pour: {{ $evaluation->evalue->user->Fullname }}</div>
        </div>
        
        <div class="comment-content">
            {{ $evaluation->commentaire }}
        </div>
        
        <div class="comment-actions" style="margin-top: 10px; text-align: right;">
            <form action="{{ route('admin.Commentaire.delete', $evaluation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?')">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: #f44336; cursor: pointer;">
                    <i style="margin-right: 3px;">🗑️</i> Supprimer
                </button>
            </form>
        </div>
    </div>
@empty
    <div class="empty-state">
        <p>Aucune évaluation trouvée.</p>
    </div>
@endforelse
                </div>
                
                <div class="pagination">
                    {{ $evaluations->links() }}
                </div>
            </div>
        </div>
    </main>
    @vite(['resources/js/main.js'])
    @vite(['resources/js/admin.js'])
</body>
</html>