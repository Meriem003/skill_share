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

<form action="{{ route('etudiant.todo.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="date_limite">Date limite</label>
            <input type="date" name="date_limite" id="date_limite" class="form-control">
        </div>
        <div class="form-group">
            <label for="statut">Statut</label>
            <select name="statut" id="statut" class="form-control">
                <option value="en attente">En attente</option>
                <option value="en cours">En cours</option>
                <option value="terminée">Terminée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <!-- <a href="{{ route('etudiant.todo') }}" class="btn btn-secondary">Annuler</a> -->
    </form>
</div>

</main>
@include('includes.footer')
    @vite (['resources/js/main.js'])
</body>
</html>

















quand j ai clique a Enregistrer il ma fiche 404
Not Found http://127.0.0.1:8000/dashboard/todo