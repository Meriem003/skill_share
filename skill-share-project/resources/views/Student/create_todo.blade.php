<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/todocreate.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/edit-profile.css'])
</head>
<body>
@include('includes.header')
<main class="main-content">
<h1>Ajouter une tâche</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('etudiant.todo.store') }}" method="POST" class="task-create-form">
            @csrf
            
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre') }}" required>
                @error('titre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description (optionnel)</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="date_limite">Date limite</label>
                <input type="date" id="date_limite" name="date_limite" value="{{ old('date_limite') }}">
                @error('date_limite')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <option value="en attente" {{ old('statut') === 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en cours" {{ old('statut') === 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminée" {{ old('statut') === 'terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
                @error('statut')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Catégorie</label>
                <div class="categorie-options">
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Basse" {{ old('categorie') === 'Basse' ? 'checked' : '' }}>
                        <span class="categorie-label basse">Basse</span>
                    </label>
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Moyenne" {{ old('categorie') === 'Moyenne' || old('categorie') === null ? 'checked' : '' }}>
                        <span class="categorie-label moyenne">Moyenne</span>
                    </label>
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Haute" {{ old('categorie') === 'Haute' ? 'checked' : '' }}>
                        <span class="categorie-label haute">Haute</span>
                    </label>
                </div>
                @error('categorie')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-actions">
                <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
</div>

</main>
@include('includes.footer')
    @vite (['resources/js/main.js'])
</body>
</html>
