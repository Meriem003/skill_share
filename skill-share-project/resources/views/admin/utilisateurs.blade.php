<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - SkillShare</title>
    @vite(['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite(['resources/css/admin.css'])
    @vite(['resources/css/users.css'])
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
                                <td>{{ $etudiant->sessions_count?? 0 }}</td>
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
                                            <button class="action-btn suspend" type="submit" title="Suspendre l'utilisateur">
                                                <i class="fas fa-lock"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Si l'utilisateur est suspendu, permettre de réactiver --}}
                                    @if ($etudiant->status === 'suspendu')
                                        <form method="POST" action="{{ route('admin.utilisateurs.reactiver', $etudiant->id) }}" style="display: inline-block;">
                                            @csrf
                                            @method('PATCH')
                                            <button class="action-btn reactivate" type="submit" title="Réactiver l'utilisateur">
                                                <i class="fas fa-unlock"></i>
                                            </button>
                                        </form>
                                    @endif                                    
                                    <form method="POST" action="{{ route('admin.utilisateurs.supprimer', $etudiant->id) }}" style="display: inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-btn delete" type="submit" title="Supprimer l'utilisateur">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination">
                    <div class="pagination-numbers">
                        {!! $etudiants->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@vite(['resources/js/main.js'])
@vite(['resources/js/admin.js'])
</body>
</html>