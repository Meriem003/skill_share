<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillShare - Partagez vos compétences</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/home.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content" style=" padding: 0px;">
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Partagez vos compétences, développez votre réseau</h1>
                    <p>SkillShare est une plateforme qui permet aux étudiants de partager leurs compétences et d'apprendre les uns des autres.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-primary">S'inscrire</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Se connecter</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src=".../../../logo-removebg-preview.png" alt="SkillShare illustration">
                </div>
            </div>
        </section>

        <section class="features">
            <div class="container">
                <h2>Fonctionnalités principales</h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">👥</div>
                        <h3>Profils personnalisés</h3>
                        <p>Créez votre profil avec vos compétences à enseigner et à apprendre</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🔍</div>
                        <h3>Recherche avancée</h3>
                        <p>Trouvez facilement les compétences que vous souhaitez apprendre</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">📅</div>
                        <h3>Planification simple</h3>
                        <p>Réservez des sessions selon vos disponibilités</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">⭐</div>
                        <h3>Système d'évaluation</h3>
                        <p>Laissez des avis après chaque session pour améliorer la communauté</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="testimonials">
            <div class="container">
                <h2>Témoignages d'utilisateurs</h2>
                <div class="testimonials-slider">
                    <div class="testimonial">

                        <div class="testimonial-author">
                            <div>
                                <h4>Sophie Martin</h4>
                                <p>Étudiante en informatique</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>"Grâce à SkillShare, j'ai pu améliorer mes compétences en programmation et aider d'autres étudiants en mathématiques."</p>
                        </div>
                    </div>
                    <div class="testimonial">
                        
                        <div class="testimonial-author">
                            <div>
                                <h4>Thomas Dubois</h4>
                                <p>Étudiant en design</p>
                            </div>
                        </div>
                        <div class="testimonial-content">
                            <p>"La plateforme est intuitive et m'a permis de rencontrer des personnes partageant les mêmes centres d'intérêt que moi."</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <h2>Prêt à partager vos compétences ?</h2>
                <p>Rejoignez notre communauté dès aujourd'hui et commencez à échanger des connaissances.</p>
                <a href="{{ route('register') }}" class="btn btn-primary">Créer un compte</a>
            </div>
        </section>
    </main>

    @include('includes.footer')
    @vite (['resources/css/main.css'])
    @vite (['resources/js/home.js'])




</body>
</html>
