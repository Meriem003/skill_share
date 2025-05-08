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
                <div class="comments-container">
                    @forelse ($evaluations as $evaluation)
                        <div class="comment-card" data-rating="{{ $evaluation->note }}">
                            <div class="comment-header">
                                <div class="comment-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $evaluation->note)
                                            <span class="star"><i class="fas fa-star"></i></span>
                                        @else
                                            <span class="star"><i class="far fa-star"></i></span>
                                        @endif
                                    @endfor                                </div>
                                <div class="comment-date">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $evaluation->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                            
                            <div class="comment-body">                                
                                <div class="comment-users">
                                    <div class="comment-user">
                                        <span class="label">Évaluateur</span>
                                        <span class="value">{{ $evaluation->auteur->user->fullname }}</span>
                                    </div>
                                    <div class="comment-user">
                                        <span class="label">Évalué</span>
                                        <span class="value">{{ $evaluation->evalue->user->fullname }}</span>
                                    </div>
                                </div>
                                
                                <div class="comment-content">
                                    {{ $evaluation->commentaire }}
                                </div>
                                
                                <div class="comment-actions">
                                    <form action="{{ route('admin.Commentaire.delete', $evaluation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-comment-slash"></i>
                            </div>
                            <h3>Aucune évaluation trouvée</h3>
                            <p>Il n'y a pas encore d'évaluations dans le système.</p>
                        </div>
                    @endforelse
                </div>
                
                <div class="pagination-container">
                    {{ $evaluations->links() }}
                </div>
            </div>
        </div>
    </main>
    @vite(['resources/js/main.js'])
    @vite(['resources/js/admin.js'])
</body>
</html>