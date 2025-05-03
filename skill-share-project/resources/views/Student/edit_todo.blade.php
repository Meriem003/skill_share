<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le profil - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/todoedit.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/edit-profile.css'])
</head>
<body>
@include('includes.header')
<main class="main-content">
<div class="form-header">
            <h1>Modifier une tâche</h1>
            <p>Mettez à jour les détails de votre tâche</p>
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
<form action="{{ route('etudiant.todo.update', $tache->id) }}" method="POST" class="task-edit-form">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ $tache->titre }}" required>
                @error('titre')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="description">Description (optionnel)</label>
                <textarea id="description" name="description">{{ $tache->description }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="date_limite">Date limite</label>
                <input type="date" id="date_limite" name="date_limite" value="{{ $tache->date_limite ? $tache->date_limite->format('Y-m-d') : '' }}">
                @error('date_limite')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <option value="en attente" {{ $tache->statut === 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en cours" {{ $tache->statut === 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminée" {{ $tache->statut === 'terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
                @error('statut')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Catégorie</label>
                <div class="categorie-options">
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Basse" {{ $tache->categorie === 'Basse' ? 'checked' : '' }}>
                        <span class="categorie-label basse">Basse</span>
                    </label>
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Moyenne" {{ $tache->categorie === 'Moyenne' ? 'checked' : '' }}>
                        <span class="categorie-label moyenne">Moyenne</span>
                    </label>
                    <label class="categorie-option">
                        <input type="radio" name="categorie" value="Haute" {{ $tache->categorie === 'Haute' ? 'checked' : '' }}>
                        <span class="categorie-label haute">Haute</span>
                    </label>
                </div>
                @error('categorie')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-actions">
                <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
        </main>

@include('includes.footer')
@vite (['resources/js/main.js'])
</body>
</html>