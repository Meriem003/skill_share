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
                <div class="admin-header">
                    <h1>Tableau de bord administrateur</h1>
                    <div class="admin-actions">

                </div>
            </div>
        </div>
    </main>
    @vite (entrypoints: ['resources/js/main.css'])
    @vite (['resources/js/admin.css']) 
</body>
</html>