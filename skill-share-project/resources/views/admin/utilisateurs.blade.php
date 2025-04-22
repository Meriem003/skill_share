<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/admin.css'])
</head>
<body>
@include('includes.header')
<main class="main-content" style="padding: 0;">
        <div class="admin-container">
            <div class="admin-sidebar">
                <div class="admin-profile">
                    <img src="images/admin-avatar.svg" alt="Photo de profil" class="admin-avatar">
                    <div class="admin-info">
                        <h3>Admin</h3>
                        <p>Administrateur</p>
                    </div>
                </div>
                <nav class="admin-nav">
                <ul>
                        <li class="active">
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
                        <a href="{{ route('admin.sessions') }}">
                                <span class="icon">📚</span>
                                <span>Sessions</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('admin.compétences') }}">
                                <span class="icon">📝</span>
                                <span>compétence</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="admin-content">
                <div class="admin-section">
                    <div class="section-header">
                        <h2>Gestion des utilisateurs</h2>
                        <div class="section-actions">
                            <div class="search-input-wrapper">
                                <input type="text" placeholder="Rechercher un utilisateur...">
                                <button class="search-btn">
                                    <span class="icon">🔍</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="users-table-container">
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Campus</th>
                                    <th>Date d'inscription</th>
                                    <th>Sessions</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td class="user-cell">
                                        <img src="images/user1.svg" alt="Photo de profil">
                                        <span>Sophie Martin</span>
                                    </td>
                                    <td>sophie.martin@email.com</td>
                                    <td>Paris</td>
                                    <td>01/03/2023</td>
                                    <td>24</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td class="user-cell">
                                        <img src="images/user2.svg" alt="Photo de profil">
                                        <span>Thomas Dubois</span>
                                    </td>
                                    <td>thomas.dubois@email.com</td>
                                    <td>Lyon</td>
                                    <td>15/03/2023</td>
                                    <td>18</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#003</td>
                                    <td class="user-cell">
                                        <img src="images/user3.svg" alt="Photo de profil">
                                        <span>Lucas Martin</span>
                                    </td>
                                    <td>lucas.martin@email.com</td>
                                    <td>Paris</td>
                                    <td>22/03/2023</td>
                                    <td>12</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#004</td>
                                    <td class="user-cell">
                                        <img src="images/user4.svg" alt="Photo de profil">
                                        <span>Emma Petit</span>
                                    </td>
                                    <td>emma.petit@email.com</td>
                                    <td>Paris</td>
                                    <td>05/04/2023</td>
                                    <td>8</td>
                                    <td><span class="status-badge suspended">Suspendu</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn activate">
                                            <span class="icon">🔓</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#005</td>
                                    <td class="user-cell">
                                        <img src="images/user5.svg" alt="Photo de profil">
                                        <span>Alexandre Durand</span>
                                    </td>
                                    <td>alexandre.durand@email.com</td>
                                    <td>Marseille</td>
                                    <td>12/04/2023</td>
                                    <td>5</td>
                                    <td><span class="status-badge active">Actif</span></td>
                                    <td class="actions-cell">
                                        <button class="action-btn edit">
                                            <span class="icon">✏️</span>
                                        </button>
                                        <button class="action-btn suspend">
                                            <span class="icon">🔒</span>
                                        </button>
                                        <button class="action-btn delete">
                                            <span class="icon">🗑️</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <button class="pagination-btn prev" disabled>Précédent</button>
                        <div class="pagination-numbers">
                            <button class="pagination-number active">1</button>
                            <button class="pagination-number">2</button>
                            <button class="pagination-number">3</button>
                            <span class="pagination-ellipsis">...</span>
                            <button class="pagination-number">10</button>
                        </div>
                        <button class="pagination-btn next">Suivant</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite (['resources/js/main.css'])
    @vite (['resources/js/admin.css']) 
</body>
</html>