<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <span class="logo-text">Skill<span class="logo-highlight">Share</span></span>
                <p class="footer-tagline">Partagez vos compétences, développez votre réseau</p>
            </div>
            <div class="footer-links">
                <div class="footer-column">
                    <h3>Navigation</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('search') }}">Rechercher</a></li>
                        <li><a href="{{ route('etudiant.todo') }}">To-Do Liste</a></li>
                        <li><a href="{{ route('etudiant.dashboard') }}">Tableau de bord</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Compte</h3>
                    <ul>
                        <li><a href="{{ route('login') }}">Connexion</a></li>
                        <li><a href="{{ route('register') }}">Inscription</a></li>
                        <li><a href="{{ route('etudiant.profile') }}">Mon profil</a></li>
                        <li><a href="#">Paramètres</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="faq.php">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="privacy.php">Confidentialité</a></li>
                        <li><a href="#">Conditions d'utilisation</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-newsletter">
                <h3>Restez informé</h3>
                <p>Inscrivez-vous à notre newsletter pour recevoir les dernières actualités</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Votre email" required>
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 SkillShare.</p>
        </div>
    </div>
</footer>

