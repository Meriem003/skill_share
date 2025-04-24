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
                                <span class="filter-count">8</span>
                            </li>
                            <li class="filter-item" data-filter="today">
                                <span class="filter-icon">📅</span>
                                <span class="filter-name">Aujourd'hui</span>
                                <span class="filter-count">3</span>
                            </li>
                            <li class="filter-item" data-filter="upcoming">
                                <span class="filter-icon">⏰</span>
                                <span class="filter-name">À venir</span>
                                <span class="filter-count">5</span>
                            </li>
                            <li class="filter-item" data-filter="completed">
                                <span class="filter-icon">✅</span>
                                <span class="filter-name">Terminées</span>
                                <span class="filter-count">12</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="todo-categories">
                        <h3>Catégories</h3>
                        <ul class="category-list">
                            <li class="category-item" data-category="teaching">
                                <span class="category-color" style="background-color: #F8C8DC;"></span>
                                <span class="category-name">Enseignement</span>
                                <span class="category-count">3</span>
                            </li>
                            <li class="category-item" data-category="learning">
                                <span class="category-color" style="background-color: #E6A4B4;"></span>
                                <span class="category-name">Apprentissage</span>
                                <span class="category-count">4</span>
                            </li>
                            <li class="category-item" data-category="profile">
                                <span class="category-color" style="background-color: #333333;"></span>
                                <span class="category-name">Profil</span>
                                <span class="category-count">1</span>
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
                        <button class="btn btn-primary" id="add-task-btn">
                            <span class="icon">+</span> Ajouter une tâche
                        </button>
                        <div class="todo-sort">
                            <label for="sort-tasks">Trier par:</label>
                            <select id="sort-tasks">
                                <option value="date">Date</option>
                                <option value="priority">Priorité</option>
                                <option value="category">Catégorie</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="todo-list">
                        <div class="task-item" data-priority="high" data-category="teaching" data-date="today">
                            <div class="task-checkbox">
                                <input type="checkbox" id="task-1">
                                <label for="task-1"></label>
                            </div>
                            <div class="task-content">
                                <h4 class="task-title">Préparer le cours de JavaScript</h4>
                                <p class="task-description">Créer des exemples de code et des exercices pour la session de demain</p>
                                <div class="task-meta">
                                    <span class="task-date">Aujourd'hui, 18:00</span>
                                    <span class="task-category" style="background-color: #F8C8DC;">Enseignement</span>
                                    <span class="task-priority high">Priorité haute</span>
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="task-edit-btn">
                                    <span class="icon">✏️</span>
                                </button>
                                <button class="task-delete-btn">
                                    <span class="icon">🗑️</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="task-item" data-priority="medium" data-category="learning" data-date="today">
                            <div class="task-checkbox">
                                <input type="checkbox" id="task-2">
                                <label for="task-2"></label>
                            </div>
                            <div class="task-content">
                                <h4 class="task-title">Réviser les bases de Python</h4>
                                <p class="task-description">Revoir les concepts fondamentaux avant la session de vendredi</p>
                                <div class="task-meta">
                                    <span class="task-date">Aujourd'hui, 20:00</span>
                                    <span class="task-category" style="background-color: #E6A4B4;">Apprentissage</span>
                                    <span class="task-priority medium">Priorité moyenne</span>
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="task-edit-btn">
                                    <span class="icon">✏️</span>
                                </button>
                                <button class="task-delete-btn">
                                    <span class="icon">🗑️</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="task-item" data-priority="low" data-category="profile" data-date="today">
                            <div class="task-checkbox">
                                <input type="checkbox" id="task-3">
                                <label for="task-3"></label>
                            </div>
                            <div class="task-content">
                                <h4 class="task-title">Mettre à jour la photo de profil</h4>
                                <p class="task-description">Télécharger une nouvelle photo de profil plus professionnelle</p>
                                <div class="task-meta">
                                    <span class="task-date">Aujourd'hui, 22:00</span>
                                    <span class="task-category" style="background-color: #333333; color: white;">Profil</span>
                                    <span class="task-priority low">Priorité basse</span>
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="task-edit-btn">
                                    <span class="icon">✏️</span>
                                </button>
                                <button class="task-delete-btn">
                                    <span class="icon">🗑️</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="task-item" data-priority="high" data-category="teaching" data-date="upcoming">
                            <div class="task-checkbox">
                                <input type="checkbox" id="task-4">
                                <label for="task-4"></label>
                            </div>
                            <div class="task-content">
                                <h4 class="task-title">Préparer la session de design UI/UX</h4>
                                <p class="task-description">Créer des maquettes et des exemples pour la session de la semaine prochaine</p>
                                <div class="task-meta">
                                    <span class="task-date">Demain, 14:00</span>
                                    <span class="task-category" style="background-color: #F8C8DC;">Enseignement</span>
                                    <span class="task-priority high">Priorité haute</span>
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="task-edit-btn">
                                    <span class="icon">✏️</span>
                                </button>
                                <button class="task-delete-btn">
                                    <span class="icon">🗑️</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="task-item completed" data-priority="medium" data-category="learning" data-date="completed">
                            <div class="task-checkbox">
                                <input type="checkbox" id="task-5" checked>
                                <label for="task-5"></label>
                            </div>
                            <div class="task-content">
                                <h4 class="task-title">Terminer le tutoriel HTML/CSS</h4>
                                <p class="task-description">Compléter le tutoriel en ligne sur les bases du HTML et CSS</p>
                                <div class="task-meta">
                                    <span class="task-date">Terminé le 02/06/2023</span>
                                    <span class="task-category" style="background-color: #E6A4B4;">Apprentissage</span>
                                    <span class="task-priority medium">Priorité moyenne</span>
                                </div>
                            </div>
                            <div class="task-actions">
                                <button class="task-delete-btn">
                                    <span class="icon">🗑️</span>
                                </button>
                            </div>
                        </div>
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

