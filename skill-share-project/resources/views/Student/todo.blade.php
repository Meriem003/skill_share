<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do Liste - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/todo.css'])
    
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="todo-container">
            <div class="todo-header">
                <h1>Ma To-Do Liste</h1>
                <p>Gérez vos tâches et suivez votre progression</p>
            </div>
            
            <div class="todo-content">
                <div class="todo-sidebar">
                    <div class="todo-filters">
                        <h3>Filtres</h3>
                        <ul class="filter-list">
                            <li class="filter-item active" data-filter="all">
                                <span class="filter-icon">📋</span>
                                <span class="filter-name">Toutes les tâches</span>
                                <span class="filter-count"></span>
                            </li>
                            <li class="filter-item" data-filter="today">
                                <span class="filter-icon">📅</span>
                                <span class="filter-name">En attente</span>
                                <span class="filter-count"></span>
                            </li>
                            <li class="filter-item" data-filter="upcoming">
                                <span class="filter-icon">⏰</span>
                                <span class="filter-name">En cours</span>
                                <span class="filter-count"></span>
                            </li>
                            <li class="filter-item" data-filter="completed">
                                <span class="filter-icon">✅</span>
                                <span class="filter-name">Terminée</span>
                                <span class="filter-count"></span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="todo-categories">
                        <h3>Catégories</h3>
                        <ul class="category-list">
                            <li class="category-item" data-category="Basse">
                                <span class="category-color" style="background-color:rgb(54, 202, 103);"></span>
                                <span class="category-name">Basse</span>
                            </li>
                            <li class="category-item" data-category="Moyenne">
                                <span class="category-color" style="background-color:rgb(225, 180, 83);"></span>
                                <span class="category-name">Moyenne</span>
                            </li>
                            <li class="category-item" data-category="Haute">
                                <span class="category-color" style="background-color:rgb(198, 41, 41);"></span>
                                <span class="category-name">Haute</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="todo-progress">
                        <h3>Progression</h3>
                        <div class="progress-circle">
                            <svg width="120" height="120" viewBox="0 0 120 120">
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#f0f0f0" stroke-width="12" />
                                <circle cx="60" cy="60" r="54" fill="none" stroke="#F8C8DC" stroke-width="12" stroke-dasharray="339.292" stroke-dashoffset="135.7168" />
                                <text x="60" y="65" text-anchor="middle" font-size="20" font-weight="bold">60%</text>
                            </svg>
                        </div>
                        <p class="progress-text">12 tâches terminées sur 20</p>
                    </div>
                </div>
                
                <div class="todo-main">
                    <div class="todo-actions">
                        <button id="add-task-btn">
                        <a href="{{ route('etudiant.todo.create') }}" class="btn btn-primary">
                        <span class="icon">+</span> Ajouter une tâche
                        </a>
                        </button>
                    </div>
                    
                    <div class="todo-list">
    @forelse ($taches as $tache)
        <div class="task-item" data-priority="{{ $tache->statut }}" data-date="{{ $tache->date_limite }}">
            <div class="task-checkbox">
                <form action="{{ route('etudiant.todo.status', $tache->id) }}" method="POST" class="status-form">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="statut" value="{{ $tache->statut == 'terminée' ? 'en attente' : 'terminée' }}">
                    <input type="checkbox" id="task-{{ $tache->id }}" class="task-status-checkbox" {{ $tache->statut === 'terminée' ? 'checked' : '' }}>
                    <label for="task-{{ $tache->id }}"></label>
                </form>
            </div>
            <div class="task-content">
                <h4 class="task-title {{ $tache->statut === 'terminée' ? 'completed' : '' }}">{{ $tache->titre }}</h4>
                <p class="task-description">{{ $tache->description }}</p>
                <div class="task-meta">
                    <span class="task-date">{{ $tache->date_limite ? $tache->date_limite->format('d/m/Y H:i') : 'Pas de date limite' }}</span>
                    <span class="task-status {{ strtolower($tache->statut) }}">{{ $tache->statut }}</span>
                </div>
            </div>
            <div class="task-actions">
                <a href="{{ route('etudiant.todo.edit', $tache->id) }}" class="task-edit-btn">
                    <span class="icon">✏️</span>
                </a>
                <form action="{{ route('etudiant.todo.destroy', $tache->id) }}" method="POST" class="delete-form" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="task-delete-btn">
                        <span class="icon">🗑️</span>
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>Aucune tâche trouvée.</p>
    @endforelse
</div>
                </div>
            </div>
        </div>
        
        <!-- Modal pour ajouter/modifier une tâche -->
        <div class="modal" id="task-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Ajouter une tâche</h2>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="task-form">
                        <div class="form-group">
                            <label for="task-title">Titre</label>
                            <input type="text" id="task-title" required>
                        </div>
                        <div class="form-group">
                            <label for="task-description">Description (optionnel)</label>
                            <textarea id="task-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="task-date">Date</label>
                            <input type="date" id="task-date" required>
                        </div>
                        <div class="form-group">
                            <label for="task-time">Heure</label>
                            <input type="time" id="task-time" required>
                        </div>
                        <div class="form-group">
                            <label for="task-category">Catégorie</label>
                            <select id="task-category" required>
                                <option value="">Sélectionnez une catégorie</option>
                                <option value="teaching">Enseignement</option>
                                <option value="learning">Apprentissage</option>
                                <option value="profile">Profil</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priorité</label>
                            <div class="priority-options">
                                <label class="priority-option">
                                    <input type="radio" name="task-priority" value="low">
                                    <span class="priority-label low">Basse</span>
                                </label>
                                <label class="priority-option">
                                    <input type="radio" name="task-priority" value="medium" checked>
                                    <span class="priority-label medium">Moyenne</span>
                                </label>
                                <label class="priority-option">
                                    <input type="radio" name="task-priority" value="high">
                                    <span class="priority-label high">Haute</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="task-reminder">
                                <label for="task-reminder">Recevoir un rappel</label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" id="cancel-task-btn">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/todo.js'])
</body>
</html>

