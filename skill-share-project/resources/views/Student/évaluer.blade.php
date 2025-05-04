<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluer la Session - SkillShare</title>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/evaluation.css'])
</head>
<body>
    @include('includes.header')

    <main class="main-content">
        <div class="evaluation-container">
            <div class="page-header">
                <h1>Évaluer la Session</h1>
                <a href="{{ route('sessions.index') }}" class="back-link">← Retour aux sessions</a>
            </div>

            <!-- Information sur la session -->
            <div class="session-overview">
                <div class="session-card">
                    <div class="session-header">
                        <div class="session-role-badge {{ $session->teacher_id == Auth::user()->etudiant->id ? 'teacher' : 'student' }}">
                            {{ $session->teacher_id == Auth::user()->etudiant->id ? 'Enseignant' : 'Étudiant' }}
                        </div>
                        <div class="session-status-badge terminee">Terminée</div>
                    </div>
                    
                    <div class="session-body">
                        <div class="session-date-time">
                            <div class="session-date">
                                <div class="date-day">{{ \Carbon\Carbon::parse($session->date_session)->format('d') }}</div>
                                <div class="date-month">{{ \Carbon\Carbon::parse($session->date_session)->locale('fr')->isoFormat('MMM') }}</div>
                            </div>
                            <div class="session-time">
                                {{ \Carbon\Carbon::parse($session->date_session)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($session->date_session)->addMinutes($session->duree)->format('H:i') }}
                            </div>
                        </div>
                        
                        <div class="session-info">
                            <h3 class="session-title">{{ $session->titre }}</h3>
                            
                            <div class="session-skill">
                                <span class="skill-icon">🧠</span> 
                                {{ $session->skill ? $session->skill->nom : 'Compétence non spécifiée' }}
                            </div>
                            
                            <div class="session-with">
                                @if($session->teacher_id == Auth::user()->etudiant->id)
                                    <span class="with-label">Avec l'étudiant:</span> {{ $session->student->user->fullname }}
                                @else
                                    <span class="with-label">Avec l'enseignant:</span> {{ $session->teacher->user->fullname }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire d'évaluation -->
            <form method="POST" action="{{ route('evaluation.store', $session->id) }}" class="evaluation-form">
                @csrf
                <input type="hidden" name="session_id" value="{{ $session->id }}">
                
                <div class="form-section">
                    <h2>Évaluation</h2>
                    
                    <div class="rating-section">
                        <label for="note">Note globale</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="note" value="5" />
                            <label for="star5" title="5 étoiles">★</label>
                            <input type="radio" id="star4" name="note" value="4" />
                            <label for="star4" title="4 étoiles">★</label>
                            <input type="radio" id="star3" name="note" value="3" />
                            <label for="star3" title="3 étoiles">★</label>
                            <input type="radio" id="star2" name="note" value="2" />
                            <label for="star2" title="2 étoiles">★</label>
                            <input type="radio" id="star1" name="note" value="1" />
                            <label for="star1" title="1 étoile">★</label>
                        </div>
                        @error('note')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="commentaire">Commentaire</label>
                        <textarea name="commentaire" id="commentaire" rows="5" placeholder="Partagez votre expérience sur cette session...">{{ old('commentaire') }}</textarea>
                        @error('commentaire')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Soumettre l'évaluation</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @include('includes.footer')
    @vite(['resources/js/main.js'])
    @vite(['resources/js/evaluation.js'])
</body>
</html>