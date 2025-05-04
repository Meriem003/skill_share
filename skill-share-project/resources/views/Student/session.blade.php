<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Sessions - SkillShare</title>
    @vite(['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite(['resources/css/sessions.css'])
</head>
<body>
    @include('includes.header')

    <main class="main-content">
        <div class="sessions-container">
            <div class="page-header">
                <h1>Mes Sessions</h1>
            </div>
            <!-- Onglets de navigation pour les sessions -->
            <div class="sessions-tabs">
                <button class="tab-btn active" data-tab="upcoming">À venir</button>
                <button class="tab-btn" data-tab="past">Passées</button>
                <button class="tab-btn" data-tab="all">Toutes</button>
            </div>

            <!-- Liste des sessions -->
            <div class="sessions-list" id="sessions-container">
                @forelse($sessions as $session)
                    <div class="session-card {{ $session->teacher_id == Auth::user()->etudiant->id ? 'as-teacher' : 'as-student' }} {{ $session->statut }}" 
                        data-status="{{ $session->statut }}" 
                        data-role="{{ $session->teacher_id == Auth::user()->etudiant->id ? 'teacher' : 'student' }}"
                        data-date="{{ \Carbon\Carbon::parse($session->date_session)->isPast() ? 'past' : 'upcoming' }}">
                        <div class="session-header">
                            <div class="session-role-badge {{ $session->teacher_id == Auth::user()->etudiant->id ? 'teacher' : 'student' }}">
                                {{ $session->teacher_id == Auth::user()->etudiant->id ? 'Enseignant' : 'Étudiant' }}
                            </div>
                            <div class="session-status-badge {{ $session->statut }}">
                                @switch($session->statut)
                                    @case('en_attente')
                                        En attente
                                        @break
                                    @case('accepte')
                                        Acceptée
                                        @break
                                    @case('refuse')
                                        Refusée
                                        @break
                                    @case('terminee')
                                        Terminée
                                        @break
                                    @case('annule')
                                        Annulée
                                        @break
                                @endswitch
                            </div>
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
                                
                                <div class="session-location">
                                    <span class="location-icon">
                                        @if($session->lieu_type == 'campus')
                                            🏫
                                        @elseif($session->lieu_type == 'en_ligne')
                                            💻
                                        @else
                                            📍
                                        @endif
                                    </span>
                                    {{ $session->lieu_details }}
                                </div>
                                
                                @if($session->description)
                                    <div class="session-description">
                                        <p>{{ $session->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="session-actions">
                            @if($session->statut === 'en_attente')
                                @if($session->teacher_id == Auth::user()->etudiant->id)
                                    <!-- Actions pour l'enseignant -->
                                    <div class="action-buttons">
                                        <form method="POST" action="{{ route('session.accept', $session->id) }}" class="action-form">
                                            @csrf
                                            <button type="submit" class="btn-action accept">Accepter</button>
                                        </form>
                                        <form method="POST" action="{{ route('session.reject', $session->id) }}" class="action-form">
                                            @csrf
                                            <button type="submit" class="btn-action reject">Refuser</button>
                                        </form>
                                    </div>
                                @else
                                    <!-- Pour l'étudiant qui attend -->
                                    <div class="waiting-info">
                                        <span class="waiting-text">En attente de confirmation de l'enseignant</span>
                                        <form method="POST" action="{{ route('session.cancel', $session->id) }}" class="action-form">
                                            @csrf
                                            <button type="submit" class="btn-action cancel">Annuler la demande</button>
                                        </form>
                                    </div>
                                @endif
                            @elseif($session->statut === 'accepte')
                                <div class="action-buttons">
                                    <form method="POST" action="{{ route('session.complete', $session->id) }}" class="action-form">
                                        @csrf
                                        <button type="submit" class="btn-action complete">
                                            Marquer comme terminée
                                            @if($session->teacher_id == Auth::user()->etudiant->id)
                                                (Enseignant)
                                            @else
                                                (Étudiant)
                                            @endif
                                        </button>
                                    </form>
                                    
                                    @if(\Carbon\Carbon::parse($session->date_session)->isFuture())
                                        <form method="POST" action="{{ route('session.cancel', $session->id) }}" class="action-form">
                                            @csrf
                                            <button type="submit" class="btn-action cancel">Annuler</button>
                                        </form>
                                    @endif
                                </div>
                            @elseif($session->statut === 'terminee')
                                <!-- Si une évaluation n'a pas encore été faite -->
                                @if(!$session->evaluations->where('auteur_id', Auth::user()->etudiant->id)->count())
                                    <a href="{{ route('evaluation.create', $session->id) }}" class="btn-action evaluate">Évaluer la session</a>
                                @else
                                    <span class="session-evaluated">Session évaluée</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="no-sessions">
                        <p>Aucune session trouvée.</p>
                        <p>Commencez par rechercher des compétences ou des enseignants pour planifier une session.</p>
                        <a href="{{ route('search') }}" class="btn btn-primary">Rechercher</a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite(['resources/js/main.js'])
    @vite(['resources/js/sessions.js'])
</body>
</html>