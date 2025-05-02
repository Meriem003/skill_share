<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une tâche - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/edit-profile.css'])
</head>
<body>
@include('includes.header')
<main class="main-content">
    <div class="container">
        <h1>Modifier une tâche</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('etudiant.todo.update', $tache->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" id="titre" class="form-control" value="{{ $tache->titre }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $tache->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="date_limite">Date limite</label>
                <input type="date" name="date_limite" id="date_limite" class="form-control" value="{{ $tache->date_limite ? $tache->date_limite->format('Y-m-d') : '' }}">
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <select name="statut" id="statut" class="form-control">
                    <option value="en attente" {{ $tache->statut == 'en attente' ? 'selected' : '' }}>En attente</option>
                    <option value="en cours" {{ $tache->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminée" {{ $tache->statut == 'terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</main>
@include('includes.footer')
@vite (['resources/js/main.js'])
</body>
</html>