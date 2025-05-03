<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/booking.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="booking-container">
            <div class="booking-header">
                <h1>Réserver une session</h1>
                <p>Planifiez une session d'apprentissage avec un autre étudiant</p>
            </div>
            
            <div class="booking-form-container">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('etudiant.booking.store') }}" class="booking-form">
                    @csrf
                    
                    @if(isset($teacher))
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        
                        <div class="form-group">
                            <label>Enseignant sélectionné</label>
                            <div class="selected-teacher">
                                <p><strong>{{ $teacher->user->fullname }}</strong></p>
                                <p>Campus de {{ ucfirst($teacher->user->campus) }}</p>
                                
                                <div class="teacher-skills">
                                    <h4>Compétences proposées</h4>
                                    <div class="skills-list">
                                        @forelse ($teacher->teachingSkills as $skill)
                                            <span class="skill-tag">{{ $skill->nom }}</span>
                                        @empty
                                            <span class="skill-tag">Aucune compétence</span>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="teacher_id">Sélectionnez un enseignant</label>
                            <select name="teacher_id" id="teacher_id" required>
                                <option value="">-- Choisir un enseignant --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->user->fullname }} - Campus de {{ ucfirst($teacher->user->campus) }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    
                    <div class="form-group">
                        <label for="skill_id">Compétence à apprendre</label>
                        <select name="skill_id" id="skill_id" required>
                            <option value="">-- Choisir une compétence --</option>
                            @if(isset($teacher))
                                @foreach($teacher->teachingSkills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nom }}</option>
                                @endforeach
                            @else
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nom }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('skill_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="titre">Titre de la session</label>
                        <input type="text" id="titre" name="titre" required placeholder="Ex: Initiation au PHP Laravel">
                        @error('titre')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description de vos besoins</label>
                        <textarea id="description" name="description" required placeholder="Décrivez ce que vous souhaitez apprendre lors de cette session..."></textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="date_session">Date souhaitée</label>
                        <input type="date" id="date_session" name="date_session" required min="{{ date('Y-m-d') }}">
                        @error('date_session')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="heure_session">Heure souhaitée</label>
                        <input type="time" id="heure_session" name="heure_session" required>
                        @error('heure_session')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="duree">Durée estimée</label>
                        <select id="duree" name="duree" required>
                            <option value="30">30 minutes</option>
                            <option value="60" selected>1 heure</option>
                            <option value="90">1 heure 30</option>
                            <option value="120">2 heures</option>
                            <option value="180">3 heures</option>
                        </select>
                        @error('duree')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="lieu_type">Type de lieu</label>
                        <select id="lieu_type" name="lieu_type" required>
                            <option value="campus">Au campus</option>
                            <option value="en_ligne">En ligne</option>
                            <option value="autre">Autre lieu</option>
                        </select>
                        @error('lieu_type')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group lieu-details" id="campus_details">
                        <label for="campus_salle">Numéro de salle</label>
                        <input type="text" id="campus_salle" name="campus_salle" placeholder="Ex: A305, Laboratoire Info 2, etc.">
                        @error('campus_salle')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group lieu-details" id="online_details" style="display: none;">
                        <label for="online_link">Lien de réunion</label>
                        <input type="url" id="online_link" name="online_link" placeholder="Ex: https://meet.google.com/... ou https://zoom.us/...">
                        @error('online_link')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group lieu-details" id="autre_lieu_details" style="display: none;">
                        <label for="autre_lieu">Précisez le lieu</label>
                        <input type="text" id="autre_lieu" name="autre_lieu" placeholder="Ex: Bibliothèque municipale, Café du coin, etc.">
                        @error('autre_lieu')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Envoyer la demande</button>
                        <a href="{{ route('search') }}" class="btn btn-secondary">Retour à la recherche</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/booking.js'])

</body>
</html>