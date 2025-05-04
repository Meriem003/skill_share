// JavaScript pour la page des sessions
document.addEventListener('DOMContentLoaded', function() {
    // Références aux éléments du DOM
    const filterType = document.getElementById('filter-type');
    const filterStatus = document.getElementById('filter-status');
    const filterDate = document.getElementById('filter-date');
    const tabButtons = document.querySelectorAll('.tab-btn');
    const sessionsContainer = document.getElementById('sessions-container');
    
    // Fonction pour filtrer les sessions
    function filterSessions() {
        const typeFilter = filterType.value;
        const statusFilter = filterStatus.value;
        const dateFilter = filterDate.value;
        
        // Récupérer toutes les sessions
        const sessions = document.querySelectorAll('.session-card');
        
        sessions.forEach(session => {
            // Récupérer les attributs de données
            const role = session.dataset.role;
            const status = session.dataset.status;
            const date = session.dataset.date;
            
            // Appliquer les filtres
            let showSession = true;
            
            // Filtre par type (rôle)
            if (typeFilter !== 'all' && role !== typeFilter) {
                showSession = false;
            }
            
            // Filtre par statut
            if (statusFilter !== 'all' && status !== statusFilter) {
                showSession = false;
            }
            
            // Filtre par date
            if (dateFilter !== 'all') {
                const sessionDate = new Date(session.querySelector('.date-day').textContent);
                const now = new Date();
                
                if (dateFilter === 'upcoming' && date !== 'upcoming') {
                    showSession = false;
                } else if (dateFilter === 'past' && date !== 'past') {
                    showSession = false;
                } else if (dateFilter === 'today') {
                    // Vérifier si c'est aujourd'hui
                    const isToday = sessionDate.getDate() === now.getDate() &&
                                   sessionDate.getMonth() === now.getMonth() &&
                                   sessionDate.getFullYear() === now.getFullYear();
                    if (!isToday) {
                        showSession = false;
                    }
                } else if (dateFilter === 'week') {
                    // Vérifier si c'est cette semaine
                    const startOfWeek = new Date(now);
                    startOfWeek.setDate(now.getDate() - now.getDay());
                    const endOfWeek = new Date(startOfWeek);
                    endOfWeek.setDate(startOfWeek.getDate() + 6);
                    
                    if (sessionDate < startOfWeek || sessionDate > endOfWeek) {
                        showSession = false;
                    }
                } else if (dateFilter === 'month') {
                    // Vérifier si c'est ce mois
                    const isThisMonth = sessionDate.getMonth() === now.getMonth() &&
                                       sessionDate.getFullYear() === now.getFullYear();
                    if (!isThisMonth) {
                        showSession = false;
                    }
                }
            }
            
            // Afficher ou masquer la session
            session.style.display = showSession ? 'flex' : 'none';
        });
        
        // Vérifier si aucune session n'est visible après filtrage
        checkNoVisibleSessions();
    }
    
    // Fonction pour vérifier s'il n'y a aucune session visible
    function checkNoVisibleSessions() {
        const visibleSessions = Array.from(document.querySelectorAll('.session-card')).filter(session => {
            return session.style.display !== 'none';
        });
        
        // Récupérer ou créer le message "aucune session"
        let noSessionsMessage = document.querySelector('.no-sessions-filter');
        
        if (visibleSessions.length === 0) {
            if (!noSessionsMessage) {
                noSessionsMessage = document.createElement('div');
                noSessionsMessage.className = 'no-sessions no-sessions-filter';
                noSessionsMessage.innerHTML = `
                    <p>Aucune session ne correspond à vos critères de recherche.</p>
                    <button class="btn btn-secondary reset-filters">Réinitialiser les filtres</button>
                `;
                sessionsContainer.appendChild(noSessionsMessage);
                
                // Ajouter un gestionnaire d'événements pour réinitialiser les filtres
                const resetButton = noSessionsMessage.querySelector('.reset-filters');
                resetButton.addEventListener('click', resetFilters);
            }
        } else if (noSessionsMessage) {
            noSessionsMessage.remove();
        }
    }
    
    // Fonction pour réinitialiser les filtres
    function resetFilters() {
        filterType.value = 'all';
        filterStatus.value = 'all';
        filterDate.value = 'all';
        
        // Réinitialiser les onglets
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabButtons[2].classList.add('active'); // Onglet "Toutes"
        
        // Appliquer les filtres réinitialisés
        filterSessions();
    }
    
    // Gestionnaires d'événements pour les filtres
    filterType.addEventListener('change', filterSessions);
    filterStatus.addEventListener('change', filterSessions);
    filterDate.addEventListener('change', filterSessions);
    
    // Gestionnaires d'événements pour les onglets
    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Mettre à jour la classe active
            tabButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            // Filtrer selon l'onglet
            const tabValue = btn.dataset.tab;
            
            if (tabValue === 'upcoming') {
                filterDate.value = 'upcoming';
                filterStatus.value = 'all';
            } else if (tabValue === 'past') {
                filterDate.value = 'past';
                filterStatus.value = 'all';
            } else if (tabValue === 'all') {
                filterDate.value = 'all';
                filterStatus.value = 'all';
            }
            
            filterSessions();
        });
    });
    
    // Appliquer les filtres au chargement
    filterSessions();
});