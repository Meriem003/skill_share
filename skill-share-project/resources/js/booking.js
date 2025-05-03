// resources/js/booking.js

document.addEventListener('DOMContentLoaded', function() {
  // Gérer l'affichage des champs de lieu en fonction du type sélectionné
  const lieuTypeSelect = document.getElementById('lieu_type');
  const campusDetails = document.getElementById('campus_details');
  const onlineDetails = document.getElementById('online_details');
  const autreLieuDetails = document.getElementById('autre_lieu_details');
  
  const campusSalleInput = document.getElementById('campus_salle');
  const onlineLinkInput = document.getElementById('online_link');
  const autreLieuInput = document.getElementById('autre_lieu');
  
  if (lieuTypeSelect) {
      lieuTypeSelect.addEventListener('change', function() {
          // Cacher tous les champs de détails
          campusDetails.style.display = 'none';
          onlineDetails.style.display = 'none';
          autreLieuDetails.style.display = 'none';
          
          // Supprimer l'attribut required de tous les champs
          campusSalleInput.removeAttribute('required');
          onlineLinkInput.removeAttribute('required');
          autreLieuInput.removeAttribute('required');
          
          // Afficher le champ correspondant au type sélectionné
          switch(this.value) {
              case 'campus':
                  campusDetails.style.display = 'block';
                  break;
              case 'en_ligne':
                  onlineDetails.style.display = 'block';
                  onlineLinkInput.setAttribute('required', 'required');
                  break;
              case 'autre':
                  autreLieuDetails.style.display = 'block';
                  autreLieuInput.setAttribute('required', 'required');
                  break;
          }
      });
      
      // Déclencher l'événement au chargement pour initialiser l'état
      const event = new Event('change');
      lieuTypeSelect.dispatchEvent(event);
  }
  
  // Validation dynamique du formulaire
  const bookingForm = document.querySelector('.booking-form');
  
  if (bookingForm) {
      bookingForm.addEventListener('submit', function(e) {
          // Vérifier que la date n'est pas dans le passé
          const dateInput = document.getElementById('date_session');
          const today = new Date().toISOString().split('T')[0];
          
          if (dateInput.value < today) {
              e.preventDefault();
              alert('La date de session ne peut pas être dans le passé.');
              dateInput.focus();
              return false;
          }
          
          // Vérifier que l'heure est valide
          const timeInput = document.getElementById('heure_session');
          const selectedDate = new Date(dateInput.value + 'T' + timeInput.value);
          const now = new Date();
          
          if (dateInput.value === today && selectedDate < now) {
              e.preventDefault();
              alert('L\'heure de session est déjà passée pour aujourd\'hui.');
              timeInput.focus();
              return false;
          }
          
          // Validation des champs de lieu en fonction du type
          const lieuType = lieuTypeSelect.value;
          
          switch(lieuType) {
              case 'en_ligne':
                  // Valider que le lien est bien formé
                  const linkInput = document.getElementById('online_link');
                  if (linkInput.value && !isValidUrl(linkInput.value)) {
                      e.preventDefault();
                      alert('Veuillez entrer un lien de réunion valide.');
                      linkInput.focus();
                      return false;
                  }
                  break;
          }
      });
  }
  
  // Fonction pour valider une URL
  function isValidUrl(string) {
      try {
          new URL(string);
          return true;
      } catch (_) {
          return false;
      }
  }
  
  // Gérer la mise à jour dynamique des compétences en fonction de l'enseignant sélectionné
  const teacherSelect = document.getElementById('teacher_id');
  const skillSelect = document.getElementById('skill_id');
  
  if (teacherSelect && skillSelect) {
      const teacherSkills = {};
      
      // Fonction pour mettre à jour les compétences
      function updateSkills() {
          const teacherId = teacherSelect.value;
          
          // Vider le select des compétences
          skillSelect.innerHTML = '<option value="">-- Choisir une compétence --</option>';
          
          // Si un enseignant est sélectionné et que nous avons ses compétences
          if (teacherId && teacherSkills[teacherId]) {
              // Ajouter les compétences de l'enseignant
              teacherSkills[teacherId].forEach(function(skill) {
                  const option = document.createElement('option');
                  option.value = skill.id;
                  option.textContent = skill.nom;
                  skillSelect.appendChild(option);
              });
          }
      }
      
      // Écouter les changements d'enseignant
      teacherSelect.addEventListener('change', updateSkills);
      
      // Charger les compétences des enseignants via une requête AJAX
      // Cette partie serait à adapter en fonction de votre architecture
      if (teacherSelect.options.length > 0) {
          // Exemple simple: charger les compétences au chargement de la page
          fetch('/api/teachers/skills')
              .then(response => response.json())
              .then(data => {
                  teacherSkills = data;
                  updateSkills();
              })
              .catch(error => {
                  console.error('Erreur lors du chargement des compétences:', error);
              });
      }
  }
});