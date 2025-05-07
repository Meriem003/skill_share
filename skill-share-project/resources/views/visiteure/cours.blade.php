<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>les cours - SkillShare</title>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/search.css'])
    @vite(['resources/css/courses.css'])
</head>
<body>
    @include('includes.header')
    
    <main class="courses-container">
        <div class="section-title">
            <h1>Nos cours disponibles</h1>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un cours...">
                <button type="submit"><span class="icon">🔍</span>
                </button>
            </div>
        </div>

        <div class="courses-grid">
            <!-- Carte de cours 1 -->
            <div class="course-card">
                <div class="course-image">
                    <img src=".../../../courses.jpg" alt="Photographie pour débutants">
                </div>
                <h3 class="course-title">Photographie pour débutants</h3>
                <p class="course-description">Apprenez les bases de la photographie et maîtrisez votre appareil photo en 10 leçons.</p>
                <div class="course-teacher">Par Sophie Durand</div>
                <a href="#" class="course-button">Voir le cours</a>
            </div>

            <!-- Carte de cours 2 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="courses.jpg" alt="Cuisine française authentique">
                </div>
                <h3 class="course-title">Cuisine française authentique</h3>
                <p class="course-description">Découvrez les secrets des grands chefs et apprenez à préparer des plats traditionnels français.</p>
                <div class="course-teacher">Par Pierre Martin</div>
                <a href="#" class="course-button">Voir le cours</a>
            </div>

            <!-- Carte de cours 3 -->
            <div class="course-card">
                <div class="course-image">
                    <img src="courses.jpg" alt="JavaScript moderne">
                </div>
                <h3 class="course-title">JavaScript moderne</h3>
                <p class="course-description">Maîtrisez JavaScript et les frameworks modernes pour développer des applications web dynamiques.</p>
                <div class="course-teacher">Par Thomas Leroy</div>
                <a href="#" class="course-button">Voir le cours</a>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite(['resources/js/main.js'])
</body>
</html>