// Script pour gérer l'affichage conditionnel des champs de lieu
document.addEventListener('DOMContentLoaded', function() {
  // Gestion de l'affichage des détails du lieu
  const lieuTypeSelect = document.getElementById('lieu_type');
  const campusDetails = document.getElementById('campus_details');
  const onlineDetails = document.getElementById('online_details');
  const autreLieuDetails = document.getElementById('autre_lieu_details');
  
  // Fonction pour afficher/masquer les champs appropriés
  function toggleLieuDetails() {
      const selectedValue = lieuTypeSelect.value;
      
      // Masquer tous les champs par défaut
      campusDetails.style.display = 'none';
      onlineDetails.style.display = 'none';
      autreLieuDetails.style.display = 'none';
      
      // Afficher le champ correspondant à la sélection
      if (selectedValue === 'campus') {
          campusDetails.style.display = 'block';
      } else if (selectedValue === 'en_ligne') {
          onlineDetails.style.display = 'block';
      } else if (selectedValue === 'autre') {
          autreLieuDetails.style.display = 'block';
      }
  }
  
  // Appliquer au chargement de la page
  toggleLieuDetails();
  
  // Écouter les changements de sélection
  lieuTypeSelect.addEventListener('change', toggleLieuDetails);
  
  // Si la page contient un sélecteur d'enseignant, ajouter l'événement pour charger les compétences
  const teacherSelect = document.getElementById('teacher_id');
  const skillSelect = document.getElementById('skill_id');
  
  if (teacherSelect && skillSelect) {
      teacherSelect.addEventListener('change', function() {
          const teacherId = this.value;
          if (teacherId) {
              // Charger les compétences de l'enseignant sélectionné via AJAX
              fetch(`/api/teachers/${teacherId}/skills`)
                  .then(response => response.json())
                  .then(data => {
                      // Vider la liste actuelle des compétences
                      skillSelect.innerHTML = '<option value="">-- Choisir une compétence --</option>';
                      
                      // Ajouter les nouvelles compétences
                      data.forEach(skill => {
                          const option = document.createElement('option');
                          option.value = skill.id;
                          option.textContent = skill.nom;
                          skillSelect.appendChild(option);
                      });
                  })
                  .catch(error => console.error('Erreur lors du chargement des compétences:', error));
          } else {
              // Réinitialiser la liste des compétences
              skillSelect.innerHTML = '<option value="">-- Choisir une compétence --</option>';
          }
      });
  }
});