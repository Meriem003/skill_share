<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - SkillShare</title>
    @vite (['resources/css/style.css']) 
    @vite (['resources/css/header.css'])
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
        <div class="form-row">
                        <!-- Left column: Name and Email -->
                        <div class="form-column">
                            <div class="form-group">
                                <label for="fullname">Nom complet</label>
                                <div class="input-wrapper">
                                    <input type="text" id="fullname" name="fullname" required>
                                    <span class="input-focus-effect"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-wrapper">
                                    <input type="email" id="email" name="email" required>
                                    <span class="input-focus-effect"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right column: Password fields -->
                        <div class="form-column">
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="input-wrapper">
                                    <input type="password" id="password" name="password" required>
                                    <span class="input-focus-effect"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmer le mot de passe</label>
                                <div class="input-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                                    <span class="input-focus-effect"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campus selection - full width -->
                    <div class="form-group">
                        <label for="campus">Campus</label>
                        <div class="select-wrapper">
                            <select id="campus" name="campus" required>
                                <option value="">Sélectionnez votre campus</option>
                                <option value="nador">nador</option>
                                <option value="safi">safi </option>
                                <option value="youssoufia ">youssoufia </option>
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                    </div>
                   
                   <div class="form-group">
                   <label class="section-label">Compétences à enseigner <span class="label-hint">(sélectionnez au moins une)</span></label>
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
                    
                    <div class="form-group terms-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="terms" name="terms" required>
                            <label for="terms">J'accepte les <a href="privacy.html">conditions d'utilisation</a></label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primaryy">S'inscrire</button>
                </form>
                
                <div class="auth-footer">
                    <p>Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous</a></p>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    

</body>
</html>