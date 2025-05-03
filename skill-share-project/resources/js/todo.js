// resources/js/todo.js
document.addEventListener('DOMContentLoaded', function() {
    // Change statut avec checkbox
    const checkboxes = document.querySelectorAll('.task-status-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Soumettre le formulaire parent
            this.closest('.status-form').submit();
        });
    });

    // Filtres de la sidebar
    const filterItems = document.querySelectorAll('.filter-item');
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            // Retirer la classe active de tous les filtres
            document.querySelectorAll('.filter-item').forEach(i => i.classList.remove('active'));
            // Ajouter la classe active à l'élément cliqué
            this.classList.add('active');
            
            // Filtrer les tâches
            const filter = this.getAttribute('data-filter');
            filterTasks(filter);
        });
    });

    // Filtres de catégories
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(item => {
        item.addEventListener('click', function() {
            // Retirer la classe active de toutes les catégories
            document.querySelectorAll('.category-item').forEach(i => i.classList.remove('active'));
            // Ajouter la classe active à l'élément cliqué
            this.classList.add('active');
            
            // Filtrer les tâches par catégorie
            const category = this.getAttribute('data-category');
            filterTasksByCategory(category);
        });
    });

    // Fonction pour filtrer les tâches par statut
    function filterTasks(filter) {
        const tasks = document.querySelectorAll('.task-item');
        
        if (filter === 'all') {
            tasks.forEach(task => task.style.display = '');
            return;
        }
        
        tasks.forEach(task => {
            if (task.getAttribute('data-status') === filter) {
                task.style.display = '';
            } else {
                task.style.display = 'none';
            }
        });
    }

    // Fonction pour filtrer les tâches par catégorie
    function filterTasksByCategory(category) {
        const tasks = document.querySelectorAll('.task-item');
        
        if (category === 'all') {
            tasks.forEach(task => task.style.display = '');
            return;
        }
        
        tasks.forEach(task => {
            if (task.getAttribute('data-categorie') === category) {
                task.style.display = '';
            } else {
                task.style.display = 'none';
            }
        });
    }

    // Mettre à jour les compteurs de tâches
    updateTaskCounters();

    function updateTaskCounters() {
        // Compter toutes les tâches
        const allTasks = document.querySelectorAll('.task-item').length;
        document.querySelector('.filter-item[data-filter="all"] .filter-count').textContent = allTasks;
        
        // Compter les tâches par statut
        const statuts = ['en attente', 'en cours', 'terminée'];
        statuts.forEach(statut => {
            const count = [...document.querySelectorAll('.task-item')].filter(task => {
                return task.getAttribute('data-status') === statut;
            }).length;
            const statusElement = document.querySelector(`.filter-item[data-filter="${statut}"] .filter-count`);
            if (statusElement) {
                statusElement.textContent = count;
            }
        });
        
        // Mettre à jour les compteurs de catégories
        const categories = ['Basse', 'Moyenne', 'Haute'];
        categories.forEach(categorie => {
            const count = [...document.querySelectorAll('.task-item')].filter(task => {
                return task.getAttribute('data-categorie') === categorie;
            }).length;
            const categoryElement = document.querySelector(`.category-item[data-category="${categorie}"] .category-count`);
            if (categoryElement) {
                categoryElement.textContent = count;
            }
        });

        // Mettre à jour le cercle de progression
        const completedTasks = [...document.querySelectorAll('.task-item')].filter(task => {
            return task.getAttribute('data-status') === 'terminée';
        }).length;
        const totalTasks = allTasks;
        const progressPercentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0;
        
        // Mettre à jour le texte du pourcentage
        const progressText = document.querySelector('.progress-circle text');
        if (progressText) {
            progressText.textContent = `${progressPercentage}%`;
        }
        
        // Mettre à jour le cercle SVG
        const progressCircle = document.querySelector('.progress-circle circle:nth-child(2)');
        if (progressCircle) {
            const circumference = 2 * Math.PI * 54; // 2πr
            const dashOffset = circumference * (1 - progressPercentage / 100);
            progressCircle.style.strokeDasharray = circumference;
            progressCircle.style.strokeDashoffset = dashOffset;
        }
        
        // Mettre à jour le texte de progression
        const progressTextElement = document.querySelector('.progress-text');
        if (progressTextElement) {
            progressTextElement.textContent = `${completedTasks} tâches terminées sur ${totalTasks}`;
        }
    }

    // Observateur pour mettre à jour les compteurs lors des changements 
    // (après soumission de formulaires AJAX)
    const todoListObserver = new MutationObserver(function(mutations) {
        updateTaskCounters();
    });

    const todoList = document.querySelector('.todo-list');
    if (todoList) {
        todoListObserver.observe(todoList, { childList: true, subtree: true });
    }
});