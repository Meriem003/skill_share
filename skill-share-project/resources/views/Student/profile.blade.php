<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/profile.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
    <div class="profile-container">
    <div class="profile-header">
        <div class="profile-info">
            <div class="profile-details">
                <h1>{{ $user->fullname }}</h1>
                <p class="profile-campus">Campus de {{ ucfirst($user->campus) }}</p>
                <p class="profile-campus"> email :  {{ ucfirst($user->email) }}</p>
                <div class="profile-stats">
                </div>
            </div>
        <button class="edit-profile-btn" id="edit-profile-btn">
            <a href="{{ route('etudiant.profile.edit') }}">Modifier le profil</a>
        </button>        
        </div>
    </div>

    <div class="profile-content">
        <div class="profile-tabs">
            <button class="tab-btn active" data-tab="skills">Compétences</button>
            <button class="tab-btn" data-tab="reviews">Évaluations</button>
            <button class="tab-btn" data-tab="badges">Badges</button>
        </div>

        <div class="tab-content active" id="skills-tab">
            <div class="skills-section">
                <div class="skills-category">
                    <h3>Compétences à enseigner</h3>
                    <div class="skills-list">
                        @forelse ($user->etudiant->teachingSkills as $skill)
                            <span class="skill-tag">{{ $skill->nom }}</span>
                        @empty
                            <span class="skill-tag">Aucune compétence</span>
                        @endforelse
                    </div>
                </div>
                <div class="skills-category">
                    <h3>Compétences à apprendre</h3>
                    <div class="skills-list">
                        @forelse ($user->etudiant->learningSkills as $skill)
                            <span class="skill-tag">{{ $skill->nom }}</span>
                        @empty
                            <span class="skill-tag">Aucune compétence</span>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content" id="reviews-tab">
            <div class="reviews-list">
                @forelse ($user->etudiant->evaluationsRecues as $evaluation)
                    <div class="review-card">
                        <div class="review-header">
                            <div class="reviewer">
                                <img src="{{ asset('images/default-avatar.svg') }}" alt="Photo de profil">
                                <div>
                                    <h4>{{ $evaluation->auteur->user->fullname }}</h4>
                                    <div class="review-stars">
                                        {{ str_repeat('★', $evaluation->note) }}
                                        {{ str_repeat('☆', 5 - $evaluation->note) }}
                                    </div>
                                </div>
                            </div>
                            <div class="review-date">{{ $evaluation->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="review-content">
                            <p>{{ $evaluation->commentaire }}</p>
                        </div>
                        <div class="review-session">
                            <span>Session : {{ $evaluation->session->titre }}</span>
                        </div>
                    </div>
                @empty
                    <p>Aucune évaluation trouvée.</p>
                @endforelse
            </div>
        </div>

        <div class="tab-content" id="badges-tab">
            <div class="badges-grid">
                @forelse ($user->etudiant->badges as $badge)
                    <div class="badge-card">
                        <div class="badge-icon">
                            <img src="{{ asset($badge->image_path) }}" alt="{{ $badge->nom }}">
                        </div>
                        <h4>{{ $badge->nom }}</h4>
                        <p>{{ $badge->description }}</p>
                    </div>
                @empty
                    <p>Aucun badge trouvé.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/profile.js'])
</body>
</html>

