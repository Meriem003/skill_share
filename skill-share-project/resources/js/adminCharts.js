import Chart from 'chart.js/auto';

// Exemple de graphique des utilisateurs actifs
const ctxUsers = document.getElementById('chartUtilisateursActifs');
if (ctxUsers) {
    new Chart(ctxUsers, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            datasets: [{
                label: 'Utilisateurs actifs',
                data: [120, 150, 180, 100, 130, 170, 200],
                borderColor: '#E6A4B4',
                backgroundColor: 'rgba(230, 164, 180, 0.2)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true
        }
    });
}

// Exemple de graphique des sessions
const ctxSessions = document.getElementById('chartSessionsSemaine');
if (ctxSessions) {
    new Chart(ctxSessions, {
        type: 'bar',
        data: {
            labels: ['Semaine 1', 'Semaine 2', 'Semaine 3', 'Semaine 4'],
            datasets: [{
                label: 'Sessions réalisées',
                data: [150, 200, 180, 220],
                backgroundColor: '#F8C8DC'
            }]
        },
        options: {
            responsive: true
        }
    });
}
