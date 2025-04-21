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
                    <li class="nav-item"><a href="{{ route('etudiant.search') }}" class="nav-link">Rechercher</a></li>
                    <li class="nav-item"><a href="{{ route('etudiant.todo') }}" class="nav-link">To-Do Liste</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="user-menu">
                    <button class="user-menu-btn">
                    <span class="icon">☰</span>
                    </button>
                    <div class="user-dropdown">
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('etudiant.profile') }}"><span class="icon">👤</span> Mon profil</a></li>
                            <li><a href="{{ route('etudiant.dashboard') }}"><span class="icon">📊</span> Tableau de bord</a></li>
                            <li><a href="{{ route('etudiant.notification') }}"><span class="icon">🔔</span> notifications</a></li>
                            <li class="divider"></li>
                            <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                            <span class="icon">🚪</span> Déconnexion</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <button class="mobile-menu-btn">
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
            <li class="mobile-nav-item"><a href="{{ route('home') }}" class="nav-link">Accueil</a></li>
            <li class="mobile-nav-item"><a href="{{ route('etudiant.search') }}" class="nav-link">Rechercher</a></li>
            <li class="mobile-nav-item"><a href="{{ route('etudiant.todo') }}" class="nav-link">To-Do Liste</a></li>
        </ul>
    </nav>
    <div class="mobile-user-actions">
        <a href="profile.php" class="btn btn-secondary btn-sm">Mon profil</a>
        <a href="dashboard.php" class="btn btn-secondary btn-sm">Tableau de bord</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <span class="icon">🚪</span> Déconnexion
        </a>
    </div>
</div>

