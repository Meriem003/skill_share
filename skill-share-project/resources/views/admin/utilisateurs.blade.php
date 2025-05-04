<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite (['resources/css/admin.css'])
    @vite(['resources/css/users.css'])
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
                        <a href="">
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
                        <li>
                        <a href="{{ route('logout') }}">
                                <span class="icon">📝</span>
                                <span>logout</span>
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
                            <form method="GET" action="{{ route('admin.utilisateurs') }}">
                            <input type="text" name="q" placeholder="Rechercher un utilisateur..." value="{{ request('q') }}">
                            <button type="submit" class="search-btn">
                                <span class="icon">🔍</span>
                            </button>
                        </form>
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
                        {{-- Si l'utilisateur est actif, permettre de suspendre --}}
                        @if ($etudiant->status === 'actif')
                            <form method="POST" action="{{ route('admin.utilisateurs.suspendre', $etudiant->id) }}" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="action-btn suspend" type="submit">
                                    <span class="icon">🔓</span> 
                                </button>
                            </form>
                        @endif

                        {{-- Si l'utilisateur est suspendu, permettre de réactiver --}}
                        @if ($etudiant->status === 'suspendu')
                            <form method="POST" action="{{ route('admin.utilisateurs.reactiver', $etudiant->id) }}" style="display: inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="action-btn reactivate" type="submit">
                                    <span class="icon">🔒</span> 
                                </button>
                            </form>
                        @endif
                        <form method="POST" action="{{ route('admin.utilisateurs.supprimer', $etudiant->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="action-btn delete" type="submit">
                                <span class="icon">🗑️</span> 
                            </button>
                        </form>
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