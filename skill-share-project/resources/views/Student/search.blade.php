<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite (['resources/css/search.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="search-container">
            <div class="search-header">
                <h1>Rechercher des compétences</h1>
                <p>Trouvez des étudiants qui peuvent vous aider à développer vos compétences</p>
            </div>
            
            <div class="search-form-container">
                <form id="search-form" class="search-form">
                    <div class="search-input-wrapper">
                        <input type="text" id="search-input" placeholder="Rechercher une compétence, un utilisateur...">
                        <button type="submit" class="search-btn">
                            <span class="icon">🔍</span>
                        </button>
                    </div>
                    
                    <div class="search-filters">
                        <div class="filter-group">
                            <label>full name</label>
                            <!-- input -->
                            <input type="text" id="name-filter" placeholder="Nom de l'utilisateur">
                        </div>
                        <div class="filter-group">
                            <label>Catégorie</label>
                            <select id="category-filter">
                                <option value="">Toutes les catégories</option>
                                <option value="programmation">Programmation</option>
                                <option value="design">Design</option>
                                <option value="langues">Langues</option>
                                <option value="mathematiques">Mathématiques</option>
                                <option value="marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Campus</label>
                            <select id="campus-filter">
                                <option value="">Tous les campus</option>
                                <option value="paris">Paris</option>
                                <option value="lyon">Lyon</option>
                                <option value="marseille">Marseille</option>
                                <option value="bordeaux">Bordeaux</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>Note minimum</label>
                            <select id="rating-filter">
                                <option value="">Toutes les notes</option>
                                <option value="4">4★ et plus</option>
                                <option value="3">3★ et plus</option>
                                <option value="2">2★ et plus</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="search-results">
                <div class="results-list">
                    <div class="result-card">
                        <div class="result-user">
                            <img src="images/user2.svg" alt="Photo de profil">
                            <div class="user-info">
                                <h3>Thomas Dubois</h3>
                                <p class="user-campus">Campus de Lyon</p>

                            </div>
                        </div>
                        <div class="result-skills">
                            <h4>Compétences à enseigner</h4>
                            <div class="skills-list">
                                <span class="skill-tag">JavaScript</span>
                                <span class="skill-tag">Vue.js</span>
                                <span class="skill-tag">TypeScript</span>
                            </div>
                        </div>
                        <div class="result-skills">
                            <h4>Compétences à apprendre</h4>
                            <div class="skills-list">
                                <span class="skill-tag">JavaScript</span>
                                <span class="skill-tag">Vue.js</span>
                                <span class="skill-tag">TypeScript</span>
                            </div>
                        </div>
                        <div class="result-actions">
                            <button class="btn btn-primary"><a href="{{ route('etudiant.booking') }}">Réserver une session</a></button>
                            <button class="btn btn-secondary"><a href="{{ route('etudiant.profile') }}">Voir le profil</a></button>
                        </div>
                    </div>
                </div>
                <div class="pagination">
                    <button class="pagination-btn prev" disabled>Précédent</button>
                    <div class="pagination-numbers">
                        <button class="pagination-number active">1</button>
                        <button class="pagination-number">2</button>
                        <button class="pagination-number">3</button>
                        <span class="pagination-ellipsis">...</span>
                        <button class="pagination-number">8</button>
                    </div>
                    <button class="pagination-btn next">Suivant</button>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/search.js'])
</body>
</html>

