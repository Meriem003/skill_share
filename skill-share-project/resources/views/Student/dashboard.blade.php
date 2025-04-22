<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/dashboard.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <div class="dashboard-actions">
                    <button class="btn btn-primary">
                    <a href="{{ route('etudiant.search') }}">ajouté une session</a>
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
                    
                </div>
                
                <div class="dashboard-column">
                <div class="dashboard-card todo-preview">
                        <div class="card-header">
                            <h2>To-Do Liste</h2>
                            <a href="{{ route('etudiant.todo') }}" class="view-all">Voir tout</a>
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
                            <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary btn-sm btn-block">Gérer mes tâches</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (entrypoints: ['resources/js/dashboard.js'])
</body>
</html>

