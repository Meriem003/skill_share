<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<header class="header">
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <span class="logo-text">Skill<span class="logo-highlight">Share</span></span>
                </a>
            </div>
            
            <nav class="main-nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="{{ route('search') }}" class="nav-link">Rechercher</a></li>
                    <li class="nav-item"><a href="{{ route('cours') }}" class="nav-link">les cours</a></li>
                </ul>
            </nav>
            
            <div class="header-actions">
                <div class="user-menu">
                    <button class="user-menu-btn" aria-expanded="false" aria-label="Menu utilisateur">
                        <div class="user-avatar">
                        <img src=".../../../profil.jpg" alt="Avatar utilisateur" class="avatar-img" style="width: 100%; height: 100%; object-fit: cover; transition: var(--transition);">
                        </div>
                    </button>
                    <div class="user-dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('etudiant.profile') }}"><i class="fas fa-user"></i> Mon profil</a></li>
                            <li><a href="{{ route('etudiant.dashboard') }}"><i class="fas fa-chart-line"></i> Tableau de bord</a></li>
                            <li><a href="{{ route('etudiant.todo') }}"><i class="fas fa-bell"></i> todo list</a></li>
                            <li class="divider"></li>
                            <li>
                                <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="logout-btn">
                                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <button class="mobile-menu-btn" aria-label="Menu mobile" aria-expanded="false">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </div>
</header>

<div class="mobile-menu">
    <nav class="mobile-nav">
        <ul class="mobile-nav-list">
            <li class="mobile-nav-item"><a href="{{ route('home') }}" class="nav-link active">Accueil</a></li>
            <li class="mobile-nav-item"><a href="{{ route('search') }}" class="nav-link">Rechercher</a></li>
            <li class="mobile-nav-item"><a href="{{ route('cours') }}" class="nav-link">les cours</a></li>
        </ul>
    </nav>
    
    <div class="mobile-user-info">
        <div class="user-avatar-mobile">
            <img src="/images/avatar-placeholder.png" alt="Avatar utilisateur" class="avatar-img-mobile">
        </div>
    </div>
    
    <div class="mobile-user-actions">
        <a href="{{ route('etudiant.profile') }}" class="btn btn-secondary btn-block"><i class="fas fa-user"></i> Mon profil</a>
        <a href="{{ route('etudiant.dashboard') }}" class="btn btn-secondary btn-block"><i class="fas fa-chart-line"></i> Tableau de bord</a>
        <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary btn-block"><i class="fas fa-bell"></i> todo list </a>
        
        <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline btn-block logout-btn-mobile">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    </div>
</div>