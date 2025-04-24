<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
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
            <form id="search-form" class="search-form" method="GET" action="{{ route('etudiant.search') }}">
    <div class="search-input-wrapper">
        <input type="text" id="search-input" name="name" placeholder="Rechercher une compétence, un utilisateur..." value="{{ request('name') }}">
        <button type="submit" class="search-btn">
            <span class="icon">🔍</span>
        </button>
    </div>
    
    <div class="search-filters">
        <div class="filter-group">
            <label>Nom de l'utilisateur</label>
            <input type="text" id="name-filter" name="name" placeholder="Nom de l'utilisateur" value="{{ request('name') }}">
        </div>
        <div class="filter-group">
            <label>Compétences à enseigner</label>
            <select id="Compétences-enseigner-filter" name="teachSkill">
                <option value="">Toutes les catégories</option>
                @foreach ($teachingSkills as $skill)
                    <option value="{{ $skill->nom }}" {{ request('teachSkill') == $skill->nom ? 'selected' : '' }}>
                        {{ $skill->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Compétences à apprendre</label>
            <select id="Compétences-apprendre-filter" name="learnSkill">
                <option value="">Toutes les catégories</option>
                @foreach ($learningSkills as $skill)
                    <option value="{{ $skill->nom }}" {{ request('learnSkill') == $skill->nom ? 'selected' : '' }}>
                        {{ $skill->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <label>Campus</label>
            <select id="campus-filter" name="campus">
                <option value="">Tous les campus</option>
                <option value="paris" {{ request('campus') == 'paris' ? 'selected' : '' }}>Paris</option>
                <option value="lyon" {{ request('campus') == 'lyon' ? 'selected' : '' }}>Lyon</option>
                <option value="marseille" {{ request('campus') == 'marseille' ? 'selected' : '' }}>Marseille</option>
                <option value="bordeaux" {{ request('campus') == 'bordeaux' ? 'selected' : '' }}>Bordeaux</option>
            </select>
        </div>
    </div>
</form>
            </div>

            <div class="search-results">
            <div class="results-list">
    @forelse ($etudiants as $etudiant)
        <div class="result-card">
            <div class="result-user">
                <div class="user-info">
                    <h3>{{ $etudiant->fullname }}</h3>
                    <p class="user-campus">Campus de {{ ucfirst($etudiant->campus) }}</p>
                </div>
            </div>
            <div class="result-skills">
                <h4>Compétences à enseigner</h4>
                <div class="skills-list">
                    @forelse ($etudiant->etudiant->teachingSkills as $skill)
                        <span class="skill-tag">{{ $skill->nom }}</span>
                    @empty
                        <span class="skill-tag">Aucune compétence</span>
                    @endforelse
                </div>
            </div>
            <div class="result-skills">
                <h4>Compétences à apprendre</h4>
                <div class="skills-list">
                    @forelse ($etudiant->etudiant->learningSkills as $skill)
                        <span class="skill-tag">{{ $skill->nom }}</span>
                    @empty
                        <span class="skill-tag">Aucune compétence</span>
                    @endforelse
                </div>
            </div>
            <div class="result-actions">
                <button class="btn btn-primary"><a href="{{ route('etudiant.booking') }}">Réserver une session</a></button>
                <button class="btn btn-secondary"><a href="{{ route('etudiant.profile') }}">Voir le profil</a></button>
            </div>
        </div>
    @empty
        <p>Aucun utilisateur trouvé.</p>
    @endforelse
</div>
<div class="pagination">
<div class="pagination-numbers">
    {!! $etudiants->links('pagination::bootstrap-4') !!}
    </div>
</div>
            </div>
        </div>
    </main>
    @include('includes.footer')
    @vite (['resources/js/main.js'])
    <!-- @vite (['resources/js/search.js']) -->
</body>
</html>

