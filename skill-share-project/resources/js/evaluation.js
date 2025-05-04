// evaluation.js

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étoiles d'évaluation
    const starInputs = document.querySelectorAll('.star-rating input');
    
    starInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Mise à jour visuelle de l'évaluation par étoiles
            const value = this.value;
            
            // Animation simple pour la sélection d'étoiles
            const stars = document.querySelectorAll('.star-rating label');
            stars.forEach(star => {
                star.classList.add('rating-animate');
                setTimeout(() => {
                    star.classList.remove('rating-animate');
                }, 300);
            });
        });
    });
    
    // Gestion des échelles d'évaluation 1-5
    const ratingScales = document.querySelectorAll('.rating-scale input');
    
    ratingScales.forEach(input => {
        input.addEventListener('change', function() {
            // Mise en évidence de la note sélectionnée
            const criterion = this.closest('.criterion');
            const name = this.getAttribute('name');
            
            // Réinitialiser les classes pour ce critère
            criterion.querySelectorAll('input').forEach(inp => {
                inp.nextElementSibling.classList.remove('selected');
            });
            
            // Ajouter la classe à l'élément sélectionné
            this.nextElementSibling.classList.add('selected');
        });
    });
    
    // Validation du formulaire
    const evaluationForm = document.querySelector('.evaluation-form');
    
    if (evaluationForm) {
        evaluationForm.addEventListener('submit', function(event) {
            // Vérifier si une note a été donnée
            const ratingSelected = document.querySelector('.star-rating input:checked');
            
            if (!ratingSelected) {
                event.preventDefault();
                // Afficher un message d'erreur
                let errorMsg = document.querySelector('.rating-section .error-message');
                
                if (!errorMsg) {
                    errorMsg = document.createElement('span');
                    errorMsg.classList.add('error-message');
                    errorMsg.textContent = 'Veuillez attribuer une note globale';
                    document.querySelector('.rating-section').appendChild(errorMsg);
                }
                
                // Faire défiler jusqu'à l'erreur
                errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Animation d'erreur sur les étoiles
                const stars = document.querySelectorAll('.star-rating label');
                stars.forEach(star => {
                    star.classList.add('error-shake');
                    setTimeout(() => {
                        star.classList.remove('error-shake');
                    }, 500);
                });
            }
            
            // Ajoutez d'autres validations selon vos besoins
        });
    }
    
    // Prévisualisation du commentaire
    const commentInput = document.getElementById('commentaire');
    
    if (commentInput) {
        commentInput.addEventListener('input', function() {
            // Vous pourriez ajouter une fonction de prévisualisation ici si nécessaire
            
            // Compteur de caractères (optionnel)
            const charCount = this.value.length;
            let charCounter = this.nextElementSibling;
            
            if (!charCounter || !charCounter.classList.contains('char-counter')) {
                charCounter = document.createElement('div');
                charCounter.classList.add('char-counter');
                this.parentNode.insertBefore(charCounter, this.nextSibling);
            }
            
            charCounter.textContent = charCount + '/500';
            
            if (charCount > 400) {
                charCounter.classList.add('warning');
            } else {
                charCounter.classList.remove('warning');
            }
        });
    }
    
    // Animation lors du chargement de la page
    document.querySelector('.evaluation-container').classList.add('fade-in');
});

// Classe CSS à ajouter
document.head.insertAdjacentHTML('beforeend', `
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .rating-animate {
            animation: pulse 0.3s ease-in-out;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .error-shake {
            animation: shake 0.5s ease-in-out;
            color: #ff5252 !important;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        .char-counter {
            text-align: right;
            font-size: 0.8rem;
            color: #777;
            margin-top: 0.25rem;
        }
        
        .char-counter.warning {
            color: #f57c00;
        }
    </style>
`);