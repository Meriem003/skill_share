// document.addEventListener("DOMContentLoaded", () => {
//   // Filter functionality
//   const filterItems = document.querySelectorAll(".filter-item")
//   const taskItems = document.querySelectorAll(".task-item")

//   if (filterItems.length > 0) {
//     filterItems.forEach((item) => {
//       item.addEventListener("click", function () {
//         // Remove active class from all filter items
//         filterItems.forEach((filter) => filter.classList.remove("active"))

//         // Add active class to clicked filter
//         this.classList.add("active")

//         // Filter tasks
//         const filter = this.dataset.filter

//         taskItems.forEach((task) => {
//           if (filter === "all") {
//             task.style.display = "flex"
//           } else if (filter === "completed" && task.classList.contains("completed")) {
//             task.style.display = "flex"
//           } else if (filter === "today" && task.dataset.date === "today") {
//             task.style.display = "flex"
//           } else if (filter === "upcoming" && task.dataset.date === "upcoming") {
//             task.style.display = "flex"
//           } else {
//             task.style.display = "none"
//           }
//         })
//       })
//     })
//   }

//   // Category filtering
//   const categoryItems = document.querySelectorAll(".category-item")

//   if (categoryItems.length > 0) {
//     categoryItems.forEach((item) => {
//       item.addEventListener("click", function () {
//         // Toggle active class
//         categoryItems.forEach((category) => category.classList.remove("active"))
//         this.classList.add("active")

//         // Filter tasks by category
//         const category = this.dataset.category

//         taskItems.forEach((task) => {
//           if (category === "all" || task.dataset.category === category) {
//             task.style.display = "flex"
//           } else {
//             task.style.display = "none"
//           }
//         })
//       })
//     })
//   }

//   // Task sorting
//   const sortSelect = document.getElementById("sort-tasks")

//   if (sortSelect) {
//     sortSelect.addEventListener("change", function () {
//       const sortValue = this.value
//       const taskList = document.querySelector(".todo-list")
//       const tasks = Array.from(taskItems)

//       // Sort tasks
//       tasks.sort((a, b) => {
//         if (sortValue === "date") {
//           // Sort by date (today first, then upcoming)
//           if (a.dataset.date === "today" && b.dataset.date !== "today") {
//             return -1
//           } else if (a.dataset.date !== "today" && b.dataset.date === "today") {
//             return 1
//           } else {
//             return 0
//           }
//         } else if (sortValue === "priority") {
//           // Sort by priority (high, medium, low)
//           const priorityOrder = { high: 1, medium: 2, low: 3 }
//           return priorityOrder[a.dataset.priority] - priorityOrder[b.dataset.priority]
//         } else if (sortValue === "category") {
//           // Sort by category
//           if (a.dataset.category < b.dataset.category) {
//             return -1
//           } else if (a.dataset.category > b.dataset.category) {
//             return 1
//           } else {
//             return 0
//           }
//         }
//       })

//       // Reorder tasks in the DOM
//       tasks.forEach((task) => {
//         taskList.appendChild(task)
//       })
//     })
//   }

//   // Task checkboxes
//   const taskCheckboxes = document.querySelectorAll(".task-checkbox input")

//   if (taskCheckboxes.length > 0) {
//     taskCheckboxes.forEach((checkbox) => {
//       checkbox.addEventListener("change", function () {
//         const taskItem = this.closest(".task-item")

//         if (this.checked) {
//           taskItem.classList.add("completed")

//           // Update progress
//           updateProgress()

//           // Move to completed section after a delay
//           setTimeout(() => {
//             const completedTasks = document.querySelectorAll(".task-item.completed")
//             const todoList = document.querySelector(".todo-list")

//             if (todoList && completedTasks.length > 0) {
//               completedTasks.forEach((task) => {
//                 todoList.appendChild(task)
//               })
//             }
//           }, 500)
//         } else {
//           taskItem.classList.remove("completed")

//           // Update progress
//           updateProgress()
//         }
//       })
//     })
//   }

//   // Update progress function
//   function updateProgress() {
//     const totalTasks = taskItems.length
//     const completedTasks = document.querySelectorAll(".task-item.completed").length
//     const progressPercentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0

//     // Update progress circle
//     const progressCircle = document.querySelector(".progress-circle circle:nth-child(2)")
//     const progressText = document.querySelector(".progress-circle text")
//     const progressTextElement = document.querySelector(".progress-text")

//     if (progressCircle && progressText && progressTextElement) {
//       const radius = 54
//       const circumference = 2 * Math.PI * radius
//       const offset = circumference - (progressPercentage / 100) * circumference

//       progressCircle.style.strokeDasharray = `${circumference} ${circumference}`
//       progressCircle.style.strokeDashoffset = offset

//       progressText.textContent = `${progressPercentage}%`
//       progressTextElement.textContent = `${completedTasks} tâches terminées sur ${totalTasks}`
//     }
//   }

//   // Add task modal
//   const addTaskBtn = document.getElementById("add-task-btn")
//   const taskModal = document.getElementById("task-modal")
//   const cancelTaskBtn = document.getElementById("cancel-task-btn")
//   const closeModalBtn = document.querySelector(".modal-close")

//   if (addTaskBtn && taskModal) {
//     addTaskBtn.addEventListener("click", () => {
//       taskModal.classList.add("active")
//       document.body.classList.add("modal-open")
//     })

//     if (cancelTaskBtn) {
//       cancelTaskBtn.addEventListener("click", () => {
//         taskModal.classList.remove("active")
//         document.body.classList.remove("modal-open")
//       })
//     }

//     if (closeModalBtn) {
//       closeModalBtn.addEventListener("click", () => {
//         taskModal.classList.remove("active")
//         document.body.classList.remove("modal-open")
//       })
//     }

//     taskModal.addEventListener("click", (e) => {
//       if (e.target === taskModal) {
//         taskModal.classList.remove("active")
//         document.body.classList.remove("modal-open")
//       }
//     })
//   }

//   // Task form submission
//   const taskForm = document.getElementById("task-form")

//   if (taskForm) {
//     taskForm.addEventListener("submit", (e) => {
//       e.preventDefault()

//       // Get form values
//       const title = document.getElementById("task-title").value
//       const description = document.getElementById("task-description").value
//       const date = document.getElementById("task-date").value
//       const time = document.getElementById("task-time").value
//       const category = document.getElementById("task-category").value
//       const priority = document.querySelector('input[name="task-priority"]:checked').value
//       const reminder = document.getElementById("task-reminder").checked

//       // Create new task
//       const todoList = document.querySelector(".todo-list")

//       if (todoList) {
//         // Determine if task is for today, upcoming, or other
//         const today = new Date()
//         const taskDate = new Date(date)
//         const dateType = isSameDay(today, taskDate) ? "today" : "upcoming"

//         // Get category color
//         let categoryColor = "#F8C8DC"
//         if (category === "learning") {
//           categoryColor = "#E6A4B4"
//         } else if (category === "profile") {
//           categoryColor = "#333333"
//         }

//         // Create task HTML
//         const taskHTML = `
//                     <div class="task-item" data-priority="${priority}" data-category="${category}" data-date="${dateType}">
//                         <div class="task-checkbox">
//                             <input type="checkbox" id="task-new">
//                             <label for="task-new"></label>
//                         </div>
//                         <div class="task-content">
//                             <h4 class="task-title">${title}</h4>
//                             <p class="task-description">${description}</p>
//                             <div class="task-meta">
//                                 <span class="task-date">${formatDate(date)} ${time}</span>
//                                 <span class="task-category" style="background-color: ${categoryColor};">${getCategoryName(category)}</span>
//                                 <span class="task-priority ${priority}">Priorité ${getPriorityName(priority)}</span>
//                             </div>
//                         </div>
//                         <div class="task-actions">
//                             <button class="task-edit-btn">
//                                 <span class="icon">✏️</span>
//                             </button>
//                             <button class="task-delete-btn">
//                                 <span class="icon">🗑️</span>
//                             </button>
//                         </div>
//                     </div>
//                 `

//         // Add task to list
//         todoList.insertAdjacentHTML("afterbegin", taskHTML)

//         // Update task count
//         updateTaskCount()

//         // Close modal
//         taskModal.classList.remove("active")
//         document.body.classList.remove("modal-open")

//         // Reset form
//         taskForm.reset()

//         // Add event listeners to new task
//         const newTask = todoList.querySelector(".task-item:first-child")

//         if (newTask) {
//           // Checkbox
//           const checkbox = newTask.querySelector(".task-checkbox input")
//           checkbox.addEventListener("change", function () {
//             if (this.checked) {
//               newTask.classList.add("completed")
//               updateProgress()
//             } else {
//               newTask.classList.remove("completed")
//               updateProgress()
//             }
//           })

//           // Edit button
//           const editBtn = newTask.querySelector(".task-edit-btn")
//           editBtn.addEventListener("click", () => {
//             // Open edit modal (simplified for this example)
//             alert("Édition de tâche non implémentée dans cet exemple")
//           })

//           // Delete button
//           const deleteBtn = newTask.querySelector(".task-delete-btn")
//           deleteBtn.addEventListener("click", () => {
//             if (confirm("Êtes-vous sûr de vouloir supprimer cette tâche ?")) {
//               newTask.remove()
//               updateTaskCount()
//               updateProgress()
//             }
//           })
//         }
//       }
//     })
//   }

//   // Helper functions
//   function isSameDay(date1, date2) {
//     return (
//       date1.getDate() === date2.getDate() &&
//       date1.getMonth() === date2.getMonth() &&
//       date1.getFullYear() === date2.getFullYear()
//     )
//   }

//   function formatDate(dateString) {
//     const date = new Date(dateString)
//     const today = new Date()

//     if (isSameDay(date, today)) {
//       return "Aujourd'hui"
//     }

//     const tomorrow = new Date(today)
//     tomorrow.setDate(tomorrow.getDate() + 1)

//     if (isSameDay(date, tomorrow)) {
//       return "Demain"
//     }

//     return date.toLocaleDateString("fr-FR", { day: "2-digit", month: "2-digit", year: "numeric" })
//   }

//   function getCategoryName(category) {
//     switch (category) {
//       case "teaching":
//         return "Enseignement"
//       case "learning":
//         return "Apprentissage"
//       case "profile":
//         return "Profil"
//       default:
//         return category
//     }
//   }

//   function getPriorityName(priority) {
//     switch (priority) {
//       case "high":
//         return "haute"
//       case "medium":
//         return "moyenne"
//       case "low":
//         return "basse"
//       default:
//         return priority
//     }
//   }

//   function updateTaskCount() {
//     // Update filter counts
//     const allCount = document.querySelectorAll(".task-item").length
//     const todayCount = document.querySelectorAll('.task-item[data-date="today"]').length
//     const upcomingCount = document.querySelectorAll('.task-item[data-date="upcoming"]').length
//     const completedCount = document.querySelectorAll(".task-item.completed").length

//     // Update category counts
//     const teachingCount = document.querySelectorAll('.task-item[data-category="teaching"]').length
//     const learningCount = document.querySelectorAll('.task-item[data-category="learning"]').length
//     const profileCount = document.querySelectorAll('.task-item[data-category="profile"]').length

//     // Update filter count elements
//     document.querySelector('.filter-item[data-filter="all"] .filter-count').textContent = allCount
//     document.querySelector('.filter-item[data-filter="today"] .filter-count').textContent = todayCount
//     document.querySelector('.filter-item[data-filter="upcoming"] .filter-count').textContent = upcomingCount
//     document.querySelector('.filter-item[data-filter="completed"] .filter-count').textContent = completedCount

//     // Update category count elements
//     document.querySelector('.category-item[data-category="teaching"] .category-count').textContent = teachingCount
//     document.querySelector('.category-item[data-category="learning"] .category-count').textContent = learningCount
//     document.querySelector('.category-item[data-category="profile"] .category-count').textContent = profileCount
//   }

//   // Delete task buttons
//   const deleteButtons = document.querySelectorAll(".task-delete-btn")

//   if (deleteButtons.length > 0) {
//     deleteButtons.forEach((button) => {
//       button.addEventListener("click", function () {
//         const taskItem = this.closest(".task-item")

//         if (confirm("Êtes-vous sûr de vouloir supprimer cette tâche ?")) {
//           taskItem.remove()
//           updateTaskCount()
//           updateProgress()
//         }
//       })
//     })
//   }

//   // Edit task buttons
//   const editButtons = document.querySelectorAll(".task-edit-btn")

//   if (editButtons.length > 0) {
//     editButtons.forEach((button) => {
//       button.addEventListener("click", () => {
//         // Open edit modal (simplified for this example)
//         alert("Édition de tâche non implémentée dans cet exemple")
//       })
//     })
//   }

//   // Initialize progress
//   updateProgress()

//   // Initialize task count
//   updateTaskCount()
// })

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

    // Fonction pour filtrer les tâches
    function filterTasks(filter) {
        const tasks = document.querySelectorAll('.task-item');
        const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD
        
        tasks.forEach(task => {
            switch(filter) {
                case 'all':
                    task.style.display = '';
                    break;
                case 'today':
                    const taskDate = task.getAttribute('data-date');
                    if (taskDate && taskDate.includes(today)) {
                        task.style.display = '';
                    } else {
                        task.style.display = 'none';
                    }
                    break;
                case 'upcoming':
                    const date = task.getAttribute('data-date');
                    if (date && date > today) {
                        task.style.display = '';
                    } else {
                        task.style.display = 'none';
                    }
                    break;
                case 'completed':
                    if (task.getAttribute('data-priority') === 'terminée') {
                        task.style.display = '';
                    } else {
                        task.style.display = 'none';
                    }
                    break;
                default:
                    task.style.display = '';
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
            if (task.getAttribute('data-priority') === category) {
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
        
        // Compter les tâches d'aujourd'hui
        const today = new Date().toISOString().split('T')[0];
        const todayTasks = [...document.querySelectorAll('.task-item')].filter(task => {
            const taskDate = task.getAttribute('data-date');
            return taskDate && taskDate.includes(today);
        }).length;
        document.querySelector('.filter-item[data-filter="today"] .filter-count').textContent = todayTasks;
        
        // Compter les tâches à venir
        const upcomingTasks = [...document.querySelectorAll('.task-item')].filter(task => {
            const taskDate = task.getAttribute('data-date');
            return taskDate && taskDate > today;
        }).length;
        document.querySelector('.filter-item[data-filter="upcoming"] .filter-count').textContent = upcomingTasks;
        
        // Compter les tâches terminées
        const completedTasks = [...document.querySelectorAll('.task-item')].filter(task => {
            return task.getAttribute('data-priority') === 'terminée';
        }).length;
        document.querySelector('.filter-item[data-filter="completed"] .filter-count').textContent = completedTasks;
        
        // Mettre à jour les compteurs de catégories
        const priorities = ['Basse', 'Moyenne', 'Haute'];
        priorities.forEach(priority => {
            const count = [...document.querySelectorAll('.task-item')].filter(task => {
                return task.getAttribute('data-priority') === priority.toLowerCase();
            }).length;
            const categoryElement = document.querySelector(`.category-item[data-category="${priority}"] .category-count`);
            if (categoryElement) {
                categoryElement.textContent = count;
            }
        });

        // Mettre à jour le cercle de progression
        const totalTasks = allTasks + completedTasks; // Total de toutes les tâches (actives + terminées)
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
});