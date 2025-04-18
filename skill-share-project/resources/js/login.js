document.addEventListener("DOMContentLoaded", () => {
  // Login form validation
  const loginForm = document.getElementById("login-form")

  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Get form values
      const email = document.getElementById("email").value
      const password = document.getElementById("password").value
      const remember = document.getElementById("remember").checked

      // Validate email and password (basic validation)
      if (!email || !password) {
        alert("Veuillez remplir tous les champs.")
        return
      }

      // In a real application, this would submit the form to the server
      // For this example, we'll just show a success message and redirect

      // Demo credentials for testing
      if (email === "demo@example.com" && password === "password") {
        alert("Connexion réussie !")

        // Redirect to dashboard
        window.location.href = "user-dashboard.php"
      } else {
        // Show error message
        const errorMessage = document.createElement("div")
        errorMessage.className = "error-message"
        errorMessage.textContent = "Email ou mot de passe incorrect."
        errorMessage.style.color = "#FF5252"
        errorMessage.style.marginTop = "10px"

        // Remove existing error message if any
        const existingError = document.querySelector(".error-message")
        if (existingError) {
          existingError.remove()
        }

        // Add error message to form
        loginForm.appendChild(errorMessage)
      }
    })
  }

  // Forgot password link
  const forgotPasswordLink = document.querySelector(".forgot-password")

  if (forgotPasswordLink) {
    forgotPasswordLink.addEventListener("click", (e) => {
      e.preventDefault()

      // Create a modal for password reset
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
              <div class="modal-content">
                  <div class="modal-header">
                      <h2>Réinitialisation du mot de passe</h2>
                      <button class="modal-close">&times;</button>
                  </div>
                  <div class="modal-body">
                      <p>Veuillez saisir votre adresse email. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
                      <form id="reset-password-form">
                          <div class="form-group">
                              <label for="reset-email">Email</label>
                              <input type="email" id="reset-email" required>
                          </div>
                          <div class="form-actions">
                              <button type="button" class="btn btn-secondary" id="cancel-reset-btn">Annuler</button>
                              <button type="submit" class="btn btn-primary">Envoyer</button>
                          </div>
                      </form>
                  </div>
              </div>
          `

      modal.innerHTML = modalContent
      document.body.appendChild(modal)
      document.body.classList.add("modal-open")

      // Close modal functionality
      const closeBtn = modal.querySelector(".modal-close")
      const cancelBtn = modal.querySelector("#cancel-reset-btn")

      function closeModal() {
        modal.remove()
        document.body.classList.remove("modal-open")
      }

      closeBtn.addEventListener("click", closeModal)
      cancelBtn.addEventListener("click", closeModal)

      modal.addEventListener("click", (e) => {
        if (e.target === modal) {
          closeModal()
        }
      })

      // Form submission
      const form = modal.querySelector("#reset-password-form")
      form.addEventListener("submit", (e) => {
        e.preventDefault()

        const email = document.getElementById("reset-email").value

        // In a real application, this would send a password reset email
        // For this example, we'll just close the modal and show a message

        closeModal()

        alert(`Un email de réinitialisation a été envoyé à ${email}.`)
      })
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

  // Remember me checkbox styling
  const rememberCheckbox = document.getElementById("remember")

  if (rememberCheckbox) {
    const label = rememberCheckbox.nextElementSibling

    if (label) {
      label.addEventListener("click", (e) => {
        // Prevent default to avoid double toggle
        e.preventDefault()

        // Toggle checkbox
        rememberCheckbox.checked = !rememberCheckbox.checked
      })
    }
  }
})

