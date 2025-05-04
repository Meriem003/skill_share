<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite(['resources/css/header.css'])
    @vite (['resources/css/dashboard.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h1>Tableau de bord</h1>
                <div class="dashboard-actions">
                    <a href="{{ route('search') }}" class="btn btn-primary">Ajouter une session</a>
                </div>
            </div>
            
            <div class="dashboard-overview">
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #F8C8DC;">📚</div>
                    <div class="overview-details">
                        <h3>{{ $stats['sessions_enseignees'] }}</h3>
                        <p>Sessions enseignées</p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #E6A4B4;">🧠</div>
                    <div class="overview-details">
                        <h3>{{ $stats['sessions_apprises'] }}</h3>
                        <p>Sessions apprises</p>
                    </div>
                </div>
                <div class="overview-card">
                    <div class="overview-icon" style="background-color: #F8C8DC;">⭐</div>
                    <div class="overview-details">
                        <h3>{{ $stats['evaluations_pendantes'] }}</h3>
                        <p>Évaluations en attente</p>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-content">
                <div class="dashboard-column">
                    <div class="dashboard-card upcoming-sessions">
                        <div class="card-header">
                            <h2>Sessions à venir</h2>
                            <a href="{{ route('sessions.index') }}" class="view-all">Voir tout</a>
                        </div>
                        <!-- Modification de la section des sessions à venir dans le dashboard -->
                        <div class="card-content">
                            @forelse($sessions as $session)
                                <div class="session-item">
                                    <div class="session-date">
                                        <span class="day">{{ \Carbon\Carbon::parse($session->date_session)->format('d') }}</span>
                                        <span class="month">{{ \Carbon\Carbon::parse($session->date_session)->locale('fr')->isoFormat('MMM') }}</span>
                                    </div>
                                    <div class="session-details">
                                        <h4>{{ $session->titre }}</h4>
                                        <p>{{ \Carbon\Carbon::parse($session->date_session)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($session->date_session)->addMinutes($session->duree)->format('H:i') }} • {{ $session->lieu_details }}</p>
                                        <div class="session-with">
                                            @if($session->teacher_id == Auth::user()->etudiant->id)
                                                <span>Avec {{ $session->student->user->fullname }} (Vous êtes l'enseignant)</span>
                                            @else
                                                <span>Avec {{ $session->teacher->user->fullname }} (Vous êtes l'étudiant)</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Actions de session conditionnelles selon le rôle et le statut -->
                                    @if($session->statut === 'en_attente')
                                        @if($session->teacher_id == Auth::user()->etudiant->id)
                                            <!-- Actions pour l'enseignant -->
                                            <div class="session-actions">
                                                <form method="POST" action="{{ route('session.accept', $session->id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn-action accept">Accepter</button>
                                                </form>
                                                <form method="POST" action="{{ route('session.reject', $session->id) }}" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn-action reject">Refuser</button>
                                                </form>
                                            </div>
                                        @else
                                            <!-- Pour l'étudiant qui attend -->
                                            <span class="session-type">En attente de confirmation</span>
                                        @endif
                                    @elseif($session->statut === 'accepte')
                                        @if($session->teacher_id == Auth::user()->etudiant->id)
                                            <!-- Enseignant peut marquer comme terminée -->
                                            <form method="POST" action="{{ route('session.complete', $session->id) }}">
                                                @csrf
                                                <button type="submit" class="session-type confirmer">Marquer comme terminée (Enseignant)</button>
                                            </form>
                                        @else
                                            <!-- Étudiant peut marquer comme terminée -->
                                            <form method="POST" action="{{ route('session.complete', $session->id) }}">
                                                @csrf
                                                <button type="submit" class="session-type confirmer">Marquer comme terminée (Étudiant)</button>
                                            </form>
                                        @endif
                                    @elseif($session->statut === 'refuse')
                                        <span class="session-type refused">Session refusée</span>
                                    @endif
                                </div>
                            @empty
                                <p>Aucune session à venir.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
                
                <div class="dashboard-column">
                    <div class="dashboard-card todo-preview">
                        <div class="card-header">
                            <h2>To-Do Liste</h2>
                            <a href="{{ route('etudiant.todo') }}" class="view-all">Voir tout</a>
                        </div>
                        <div class="card-content">
                            <div class="todo-items">
                                @forelse ($taches as $tache)
                                    <div class="todo-item">
                                        <div class="todo-checkbox">
                                            <input type="checkbox" id="dashboard-todo-{{ $tache->id }}" {{ $tache->statut === 'completed' ? 'checked' : '' }}>
                                            <label for="dashboard-todo-{{ $tache->id }}"></label>
                                        </div>
                                        <div class="todo-content">
                                            <h4>{{ $tache->titre }}</h4>
                                            <p>{{ $tache->date_limite ? \Carbon\Carbon::parse($tache->date_limite)->format('d/m/Y H:i') : 'Pas de date limite' }}</p>
                                        </div>
                                        <div class="todo-priority {{ $tache->statut }}"></div>
                                    </div>
                                @empty
                                    <p>Aucune tâche trouvée.</p>
                                @endforelse
                            </div>
                            <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary btn-sm btn-block">Gérer mes tâches</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (entrypoints: ['resources/js/dashboard.js'])
</body>
</html>