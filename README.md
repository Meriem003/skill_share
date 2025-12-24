# 🎓 SkillShare - Plateforme de Partage de Compétences

## 📋 Description

SkillShare est une plateforme web innovante qui permet aux étudiants de partager leurs compétences et d'apprendre les uns des autres. La plateforme facilite l'échange de connaissances à travers un système de cours, de sessions, de badges et de gestion de tâches.

## ✨ Fonctionnalités Principales

### Pour les Étudiants
- 📚 **Enseigner des compétences** : Partager ses connaissances en créant des cours
- 🎯 **Apprendre de nouvelles compétences** : S'inscrire aux cours d'autres étudiants
- 🏆 **Système de badges** : Gagner des badges pour valider ses accomplissements
- 📝 **Gestion de tâches** : Organiser son apprentissage avec des todo-listes
- 📊 **Évaluations** : Évaluer et être évalué après chaque session
- 🔔 **Suivi de sessions** : Suivre l'historique de ses sessions d'apprentissage

### Pour les Administrateurs
- 👥 **Gestion des utilisateurs** : Gérer les étudiants et leurs activités
- 📈 **Suivi des performances** : Analyser les statistiques de la plateforme
- 🎓 **Validation des compétences** : Approuver et gérer les compétences proposées

## 🛠️ Technologies Utilisées

### Backend
- **Framework** : Laravel 10.x
- **PHP** : ^8.1
- **Base de données** : MySQL
- **API** : Laravel Sanctum pour l'authentification

### Frontend
- **Build Tool** : Vite 5.0
- **Graphiques** : Chart.js 4.4
- **HTTP Client** : Axios

### Outils de Développement
- **Testing** : PHPUnit
- **Code Quality** : Laravel Pint

## 📦 Installation

### Prérequis
- PHP >= 8.1
- Composer
- Node.js >= 18.x
- MySQL
- Git

### Étapes d'installation

1. **Cloner le projet**
```bash
git clone <https://github.com/Meriem003/skill_share.git>
cd skill-share-project
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances JavaScript**
```bash
npm install
```

4. **Configuration de l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**
Éditer le fichier `.env` et configurer les paramètres de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=skillshare
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

6. **Exécuter les migrations**
```bash
php artisan migrate
```

7. **Lancer les seeders (optionnel)**
```bash
php artisan db:seed
```

8. **Compiler les assets**
```bash
npm run build
# ou pour le développement
npm run dev
```

9. **Lancer le serveur**
```bash
php artisan serve
```

L'application sera accessible à l'adresse : `http://localhost:8000`

## 🐳 Utilisation avec Laravel Sail (Docker)

```bash
# Installation
./vendor/bin/sail up -d

# Migrations
./vendor/bin/sail artisan migrate

# Assets
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

## 📁 Structure du Projet

```
skill-share-project/
├── app/
│   ├── Http/Controllers/    # Contrôleurs de l'application
│   ├── Models/               # Modèles Eloquent
│   │   ├── User.php          # Modèle utilisateur de base
│   │   ├── Etudiant.php      # Profil étudiant
│   │   ├── Administrateur.php # Profil administrateur
│   │   ├── Skill.php         # Compétences
│   │   ├── courses.php       # Cours
│   │   ├── Session.php       # Sessions de cours
│   │   ├── Badge.php         # Badges de récompense
│   │   ├── ToDoListe.php     # Listes de tâches
│   │   ├── Tache.php         # Tâches individuelles
│   │   └── Evaluation.php    # Évaluations
│   └── Providers/            # Service Providers
├── database/
│   ├── migrations/           # Migrations de base de données
│   ├── seeders/              # Seeders pour données de test
│   └── factories/            # Factories pour les tests
├── public/                   # Fichiers publics (assets compilés)
├── resources/
│   ├── views/                # Vues Blade
│   ├── css/                  # Styles CSS
│   └── js/                   # JavaScript
├── routes/
│   ├── web.php               # Routes web
│   ├── api.php               # Routes API
│   └── console.php           # Commandes artisan personnalisées
└── tests/                    # Tests automatisés
```

## 🗄️ Modèle de Données

### Entités Principales

- **Users** : Utilisateurs de base avec système de rôles
- **Étudiants** : Profil étudiant étendu
- **Administrateurs** : Profil administrateur
- **Skills** : Compétences (enseignées et apprises)
- **Cours** : Cours créés par les étudiants
- **Sessions** : Sessions de cours programmées
- **Badges** : Récompenses pour les accomplissements
- **Évaluations** : Système d'évaluation des sessions
- **ToDoListes & Tâches** : Gestion des tâches d'apprentissage

## 🧪 Tests

```bash
# Exécuter tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage

# Tests spécifiques
php artisan test --filter NomDuTest
```

## 🚀 Déploiement

### Production

1. **Optimiser l'application**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

2. **Configurer les permissions**
```bash
chmod -R 755 storage bootstrap/cache
```

3. **Variables d'environnement**
Assurer que `APP_ENV=production` et `APP_DEBUG=false` dans le fichier `.env`

## 📝 Commandes Artisan Utiles

```bash
# Nettoyer le cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Créer un contrôleur
php artisan make:controller NomController

# Créer un modèle avec migration
php artisan make:model NomModele -m

# Créer une migration
php artisan make:migration create_nom_table
```

## 🤝 Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request


**Note** : Ce projet est développé dans un cadre éducatif pour démontrer les capacités de Laravel dans la création d'une plateforme d'échange de compétences.