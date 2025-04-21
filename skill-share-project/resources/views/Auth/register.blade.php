<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/auth.css'])
</head>
<body>
@include('includes.header')
<main class="main-content">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <h1>Créer un compte</h1>
                    <p>Rejoignez notre communauté et commencez à partager vos compétences</p>
                </div>
    <form action="{{ route('register.submit') }}" method="POST" id="register-form" class="auth-form">
        @csrf
        <div class="form-group">
                        <label for="fullname">Nom complet</label>
                        <input type="text" id="fullname" name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="campus">Campus</label>
                        <select id="campus" name="campus" required>
                            <option value="">Sélectionnez votre campus</option>
                            <option value="paris">Paris</option>
                            <option value="lyon">Lyon</option>
                            <option value="marseille">Marseille</option>
                            <option value="bordeaux">Bordeaux</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                   </div>
                   <div class="form-group">
    <label>Compétences à enseigner (sélectionnez au moins une)</label>
    <div class="skills-grid">
        @foreach ($skills as $skill)
            <div class="skill-checkbox">
                <input type="checkbox" id="teaching-skill-{{ $skill->id }}" name="teaching_skills[]" value="{{ $skill->id }}">
                <label for="teaching-skill-{{ $skill->id }}">{{ $skill->nom }}</label>
            </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <label>Compétences à apprendre (sélectionnez au moins une)</label>
    <div class="skills-grid">
        @foreach ($skills as $skill)
            <div class="skill-checkbox">
                <input type="checkbox" id="learning-skill-{{ $skill->id }}" name="learning_skills[]" value="{{ $skill->id }}">
                <label for="learning-skill-{{ $skill->id }}">{{ $skill->nom }}</label>
            </div>
        @endforeach
    </div>
</div>
                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">J'accepte les <a href="privacy.php">conditions d'utilisation</a></label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
    </form>
                <div class="auth-footer">
                    <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></p>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    

</body>
</html>
