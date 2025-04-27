<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/edit-profile.css'])
</head>
<body>
@include('includes.header')
<main class="main-content">
    <div class="profile-edit-container">
        <h1>Modifier le profil</h1>

        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif

        <form action="{{ route('etudiant.profile.update') }}" method="POST">
            @csrf

            <!-- Nom complet -->
            <div class="form-group">
                <label for="fullname">Nom complet</label>
                <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
                @error('fullname')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Campus -->
            <div class="form-group">
                <label for="campus">Campus</label>
                <input type="text" id="campus" name="campus" value="{{ old('campus', $user->campus) }}">
                @error('campus')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Compétences à enseigner -->
            <div class="form-group">
                <label for="teaching_skills">Compétences à enseigner</label>
                <div class="checkbox-group">
                    @foreach ($skills as $skill)
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="teaching_skill_{{ $skill->id }}" 
                                name="teaching_skills[]" 
                                value="{{ $skill->id }}" 
                                {{ in_array($skill->id, $user->etudiant->teachingSkills->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="teaching_skill_{{ $skill->id }}">{{ $skill->nom }}</label>
                        </div>
                    @endforeach
                </div>
                @error('teaching_skills')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Compétences à apprendre -->
            <div class="form-group">
                <label for="learning_skills">Compétences à apprendre</label>
                <div class="checkbox-group">
                    @foreach ($skills as $skill)
                        <div class="checkbox-item">
                            <input 
                                type="checkbox" 
                                id="learning_skill_{{ $skill->id }}" 
                                name="learning_skills[]" 
                                value="{{ $skill->id }}" 
                                {{ in_array($skill->id, $user->etudiant->learningSkills->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label for="learning_skill_{{ $skill->id }}">{{ $skill->nom }}</label>
                        </div>
                    @endforeach
                </div>
                @error('learning_skills')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Boutons -->
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('etudiant.profile') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</main>
@include('includes.footer')
    @vite (['resources/js/main.js'])
</body>
</html>