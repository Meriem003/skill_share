<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite (['resources/css/admin.css'])
</head>
<body>
@include('includes.header')
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
                        <a href="{{ route('admin.session') }}">
                                <span class="icon">📚</span>
                                <span>Sessions</span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('admin.competence') }}">
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
                                    <th>Email</th>
                                    <th>Campus</th>
                                    <th>Date d'inscription</th>
                                    <th>Sessions</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
    @foreach ($etudiants as $etudiant)
        <tr>
            <td>#{{ $etudiant->id }}</td>
            <td>{{ $etudiant->email }}</td>
            <td>{{ $etudiant->campus }}</td>
            <td>{{ $etudiant->created_at->format('d/m/Y') }}</td>
            <td>{{ $etudiant->sessions_count ?? 0 }}</td>
            <td>
                <span class="status-badge {{ $etudiant->status == 'active' ? 'active' : 'inactive' }}">
                    {{ ucfirst($etudiant->status) }}
                </span>
            </td>
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
    @endforeach
</tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        {{-- Liens de pagination --}}
                        <div class="pagination-numbers">
                            {!! $etudiants->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite (['resources/js/main.css'])
    @vite (['resources/js/admin.css']) 
</body>
</html>