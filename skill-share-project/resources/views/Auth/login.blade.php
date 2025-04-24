<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - SkillShare</title>
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
                    <h1>Connexion</h1>
                    <p>Connectez-vous pour accéder à votre compte</p>
                </div>
               
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
               
                <form action="{{ route('login.submit') }}" method="POST" class="auth-form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-wrapper">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Se souvenir de moi</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                </form>
                <div class="auth-footer">
                    <p>Vous n'avez pas de compte ? <a href="{{ route('register') }}">Inscrivez-vous</a></p>
                </div>
            </div>
        </div>
    </main>
    @include('includes.footer')
    <script src="js/main.js"></script>
</body>
</html>