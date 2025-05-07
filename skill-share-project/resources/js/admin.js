// resources/js/admin.js - Ajouter ce code

document.addEventListener('DOMContentLoaded', function() {
  // Éléments pour le filtrage
  const noteFilter = document.getElementById('note-filter');
  const searchInput = document.querySelector('.search-box input');
  
  // Fonction pour mettre à jour les commentaires
  const updateComments = function() {
      const note = noteFilter.value;
      const search = searchInput.value;
      
      // Construire l'URL avec les paramètres
      let url = new URL(window.location.href);
      
      // Ajouter ou supprimer les paramètres de recherche
      if (note) {
          url.searchParams.set('note', note);
      } else {
          url.searchParams.delete('note');
      }
      
      if (search) {
          url.searchParams.set('search', search);
      } else {
          url.searchParams.delete('search');
      }
      
      // Effectuer la requête AJAX
      fetch(url, {
          headers: {
              'X-Requested-With': 'XMLHttpRequest'
          }
      })
      .then(response => response.text())
      .then(html => {
          document.querySelector('.comments-container').innerHTML = html;
      })
      .catch(error => {
          console.error('Erreur lors de la recherche:', error);
      });
  };
  
  // Ajouter les écouteurs d'événements
  noteFilter.addEventListener('change', updateComments);
  
  // Ajouter un délai pour la recherche en temps réel
  let typingTimer;
  searchInput.addEventListener('input', function() {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(updateComments, 500);
  });
  
  // Pour l'icône de recherche
  document.querySelector('.search-box i').addEventListener('click', updateComments);
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('sessionSearch');
    const sessionCards = document.querySelectorAll('.session-card');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        sessionCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const description = card.querySelector('.session-description').textContent.toLowerCase();
            const details = card.querySelector('.session-details').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm) || details.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});