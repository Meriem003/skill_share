document.addEventListener("DOMContentLoaded", () => {
  // Registration form validation
  const registerForm = document.getElementById("register-form")

  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Get form values
      const fullname = document.getElementById("fullname").value
      const email = document.getElementById("email").value
      const campus = document.getElementById("campus").value
      const password = document.getElementById("password").value
      const confirmPassword = document.getElementById("confirm-password").value

      // Validate password match
      if (password !== confirmPassword) {
        alert("Les mots de passe ne correspondent pas.")
        return
      }

      // Validate teaching skills
      const teachingSkills = document.querySelectorAll('input[name="teaching_skills[]"]:checked')

      if (teachingSkills.length === 0) {
        alert("Veuillez sélectionner au moins une compétence à enseigner.")
        return
      }

      // Validate learning skills
      const learningSkills = document.querySelectorAll('input[name="learning_skills[]"]:checked')

      if (learningSkills.length === 0) {
        alert("Veuillez sélectionner au moins une compétence à apprendre.")
        return
      }

      // Validate terms
      const terms = document.getElementById("terms").checked

      if (!terms) {
        alert("Vous devez accepter les conditions d'utilisation.")
        return
      }

      // In a real application, this would submit the form to the server
      // For this example, we'll just show a success message and redirect

      alert(`Inscription réussie ! Bienvenue, ${fullname} !`)

      // Redirect to dashboard
      window.location.href = "user-dashboard.php"
    })
  }

  // Password strength validation
  const passwordInput = document.getElementById("password")

  if (passwordInput) {
    passwordInput.addEventListener("input", function () {
      const password = this.value

      // Check password strength
      let strength = 0

      // Length check
      if (password.length >= 8) {
        strength += 1
      }

      // Uppercase check
      if (/[A-Z]/.test(password)) {
        strength += 1
      }

      // Lowercase check
      if (/[a-z]/.test(password)) {
        strength += 1
      }

      // Number check
      if (/[0-9]/.test(password)) {
        strength += 1
      }

      // Special character check
      if (/[^A-Za-z0-9]/.test(password)) {
        strength += 1
      }

      // Update UI based on strength
      let strengthMessage = ""
      let strengthColor = ""

      switch (strength) {
        case 0:
        case 1:
          strengthMessage = "Faible"
          strengthColor = "#FF5252"
          break
        case 2:
        case 3:
          strengthMessage = "Moyen"
          strengthColor = "#FFC107"
          break
        case 4:
        case 5:
          strengthMessage = "Fort"
          strengthColor = "#4CAF50"
          break
      }

      // Add or update strength indicator
      let strengthIndicator = document.getElementById("password-strength")

      if (!strengthIndicator) {
        strengthIndicator = document.createElement("div")
        strengthIndicator.id = "password-strength"
        strengthIndicator.style.fontSize = "0.75rem"
        strengthIndicator.style.marginTop = "5px"

        this.parentNode.appendChild(strengthIndicator)
      }

      strengthIndicator.textContent = `Force du mot de passe : ${strengthMessage}`
      strengthIndicator.style.color = strengthColor
    })
  }

  // Campus selection
  const campusSelect = document.getElementById("campus")

  if (campusSelect) {
    campusSelect.addEventListener("change", function () {
      // In a real application, this might update available skills based on campus
      console.log(`Campus sélectionné : ${this.value}`)
    })
  }

  // Social login buttons
  const socialButtons = document.querySelectorAll(".btn-social")

  if (socialButtons.length > 0) {
    socialButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const provider = this.textContent.trim()

        // In a real application, this would initiate OAuth flow
        alert(`Connexion avec ${provider} non implémentée dans cet exemple.`)
      })
    })
  }
})

