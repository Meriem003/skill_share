document.addEventListener("DOMContentLoaded", () => {
  // Admin navigation
  const navItems = document.querySelectorAll(".admin-nav li a")

  if (navItems.length > 0) {
    navItems.forEach((item) => {
      item.addEventListener("click", function (e) {
        // In a real application, this would navigate to different sections
        // For this example, we'll just toggle active class

        e.preventDefault()

        // Remove active class from all items
        navItems.forEach((navItem) => {
          navItem.parentElement.classList.remove("active")
        })

        // Add active class to clicked item
        this.parentElement.classList.add("active")

        // Get section ID from href
        const sectionId = this.getAttribute("href").substring(1)

        // Show corresponding section (not implemented in this example)
        console.log(`Navigate to ${sectionId} section`)
      })
    })
  }

  // Stats period selector
  const statsPeriod = document.getElementById("stats-period")

  if (statsPeriod) {
    statsPeriod.addEventListener("change", function () {
      // In a real application, this would fetch data for the selected period
      // For this example, we'll just log the selected period

      console.log(`Selected period: ${this.value}`)
    })
  }

  // User search
  const searchInput = document.querySelector(".search-input-wrapper input")

  if (searchInput) {
    searchInput.addEventListener("input", function () {
      // In a real application, this would filter the users table
      // For this example, we'll just log the search query

      console.log(`Search query: ${this.value}`)
    })
  }

  // User actions
  const editButtons = document.querySelectorAll(".action-btn.edit")
  const suspendButtons = document.querySelectorAll(".action-btn.suspend")
  const activateButtons = document.querySelectorAll(".action-btn.activate")
  const deleteButtons = document.querySelectorAll(".action-btn.delete")

  // Edit user
  if (editButtons.length > 0) {
    editButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const userRow = this.closest("tr")
        const userId = userRow.querySelector("td:first-child").textContent
        const userName = userRow.querySelector(".user-cell span").textContent

        // Create a modal for editing user
        const modal = document.createElement("div")
        modal.className = "modal active"

        const modalContent = `
                  <div class="modal-content">
                      <div class="modal-header">
                          <h2>Modifier l'utilisateur</h2>
                          <button class="modal-close">&times;</button>
                      </div>
                      <div class="modal-body">
                          <form id="edit-user-form">
                              <div class="form-group">
                                  <label for="edit-user-id">ID</label>
                                  <input type="text" id="edit-user-id" value="${userId}" disabled>
                              </div>
                              <div class="form-group">
                                  <label for="edit-user-name">Nom</label>
                                  <input type="text" id="edit-user-name" value="${userName}" required>
                              </div>
                              <div class="form-group">
                                  <label for="edit-user-email">Email</label>
                                  <input type="email" id="edit-user-email" value="${userName.toLowerCase().replace(" ", ".")}@email.com" required>
                              </div>
                              <div class="form-group">
                                  <label for="edit-user-campus">Campus</label>
                                  <select id="edit-user-campus" required>
                                      <option value="paris" selected>Paris</option>
                                      <option value="lyon">Lyon</option>
                                      <option value="marseille">Marseille</option>
                                      <option value="bordeaux">Bordeaux</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label for="edit-user-status">Statut</label>
                                  <select id="edit-user-status" required>
                                      <option value="active" selected>Actif</option>
                                      <option value="suspended">Suspendu</option>
                                  </select>
                              </div>
                              <div class="form-actions">
                                  <button type="button" class="btn btn-secondary" id="cancel-edit-btn">Annuler</button>
                                  <button type="submit" class="btn btn-primary">Enregistrer</button>
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
        const cancelBtn = modal.querySelector("#cancel-edit-btn")

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
        const form = modal.querySelector("#edit-user-form")
        form.addEventListener("submit", (e) => {
          e.preventDefault()

          // In a real application, this would update the user data
          // For this example, we'll just close the modal

          closeModal()

          // Show a success message
          alert(`Utilisateur ${userName} mis à jour avec succès !`)
        })
      })
    })
  }

  // Suspend user
  if (suspendButtons.length > 0) {
    suspendButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const userRow = this.closest("tr")
        const userName = userRow.querySelector(".user-cell span").textContent

        if (confirm(`Êtes-vous sûr de vouloir suspendre l'utilisateur ${userName} ?`)) {
          // In a real application, this would update the user status
          // For this example, we'll just update the UI

          const statusBadge = userRow.querySelector(".status-badge")
          statusBadge.textContent = "Suspendu"
          statusBadge.className = "status-badge suspended"

          // Replace suspend button with activate button
          this.innerHTML = '<span class="icon">🔓</span>'
          this.classList.remove("suspend")
          this.classList.add("activate")

          // Show a success message
          alert(`Utilisateur ${userName} suspendu avec succès !`)
        }
      })
    })
  }

  // Activate user
  if (activateButtons.length > 0) {
    activateButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const userRow = this.closest("tr")
        const userName = userRow.querySelector(".user-cell span").textContent

        if (confirm(`Êtes-vous sûr de vouloir réactiver l'utilisateur ${userName} ?`)) {
          // In a real application, this would update the user status
          // For this example, we'll just update the UI

          const statusBadge = userRow.querySelector(".status-badge")
          statusBadge.textContent = "Actif"
          statusBadge.className = "status-badge active"

          // Replace activate button with suspend button
          this.innerHTML = '<span class="icon">🔒</span>'
          this.classList.remove("activate")
          this.classList.add("suspend")

          // Show a success message
          alert(`Utilisateur ${userName} réactivé avec succès !`)
        }
      })
    })
  }

  // Delete user
  if (deleteButtons.length > 0) {
    deleteButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const userRow = this.closest("tr")
        const userName = userRow.querySelector(".user-cell span").textContent

        if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur ${userName} ? Cette action est irréversible.`)) {
          // In a real application, this would delete the user
          // For this example, we'll just remove the row

          userRow.remove()

          // Show a success message
          alert(`Utilisateur ${userName} supprimé avec succès !`)
        }
      })
    })
  }

  // Add user button
  const addUserBtn = document.querySelector(".section-actions .btn-primary")

  if (addUserBtn) {
    addUserBtn.addEventListener("click", () => {
      // Create a modal for adding user
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
              <div class="modal-content">
                  <div class="modal-header">
                      <h2>Ajouter un utilisateur</h2>
                      <button class="modal-close">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form id="add-user-form">
                          <div class="form-group">
                              <label for="add-user-name">Nom complet</label>
                              <input type="text" id="add-user-name" required>
                          </div>
                          <div class="form-group">
                              <label for="add-user-email">Email</label>
                              <input type="email" id="add-user-email" required>
                          </div>
                          <div class="form-group">
                              <label for="add-user-campus">Campus</label>
                              <select id="add-user-campus" required>
                                  <option value="">Sélectionnez un campus</option>
                                  <option value="paris">Paris</option>
                                  <option value="lyon">Lyon</option>
                                  <option value="marseille">Marseille</option>
                                  <option value="bordeaux">Bordeaux</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="add-user-password">Mot de passe</label>
                              <input type="password" id="add-user-password" required>
                          </div>
                          <div class="form-group">
                              <label for="add-user-confirm-password">Confirmer le mot de passe</label>
                              <input type="password" id="add-user-confirm-password" required>
                          </div>
                          <div class="form-group">
                              <label>Rôle</label>
                              <div class="radio-group">
                                  <label>
                                      <input type="radio" name="add-user-role" value="user" checked>
                                      Utilisateur
                                  </label>
                                  <label>
                                      <input type="radio" name="add-user-role" value="admin">
                                      Administrateur
                                  </label>
                              </div>
                          </div>
                          <div class="form-actions">
                              <button type="button" class="btn btn-secondary" id="cancel-add-btn">Annuler</button>
                              <button type="submit" class="btn btn-primary">Ajouter</button>
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
      const cancelBtn = modal.querySelector("#cancel-add-btn")

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
      const form = modal.querySelector("#add-user-form")
      form.addEventListener("submit", (e) => {
        e.preventDefault()

        // Validate password confirmation
        const password = document.getElementById("add-user-password").value
        const confirmPassword = document.getElementById("add-user-confirm-password").value

        if (password !== confirmPassword) {
          alert("Les mots de passe ne correspondent pas.")
          return
        }

        // In a real application, this would add the user to the database
        // For this example, we'll just close the modal

        closeModal()

        // Show a success message
        alert("Utilisateur ajouté avec succès !")
      })
    })
  }

  // Export data button
  const exportDataBtn = document.querySelector(".admin-actions .btn-secondary")

  if (exportDataBtn) {
    exportDataBtn.addEventListener("click", () => {
      // In a real application, this would generate and download a CSV/Excel file
      // For this example, we'll just show a message

      alert("Export des données en cours...")
    })
  }

  // Send notification button
  const sendNotificationBtn = document.querySelector(".admin-actions .btn-primary")

  if (sendNotificationBtn) {
    sendNotificationBtn.addEventListener("click", () => {
      // Create a modal for sending notification
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
              <div class="modal-content">
                  <div class="modal-header">
                      <h2>Envoyer une notification</h2>
                      <button class="modal-close">&times;</button>
                  </div>
                  <div class="modal-body">
                      <form id="notification-form">
                          <div class="form-group">
                              <label for="notification-recipients">Destinataires</label>
                              <select id="notification-recipients" required>
                                  <option value="all">Tous les utilisateurs</option>
                                  <option value="paris">Campus de Paris</option>
                                  <option value="lyon">Campus de Lyon</option>
                                  <option value="marseille">Campus de Marseille</option>
                                  <option value="bordeaux">Campus de Bordeaux</option>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="notification-title">Titre</label>
                              <input type="text" id="notification-title" required>
                          </div>
                          <div class="form-group">
                              <label for="notification-message">Message</label>
                              <textarea id="notification-message" rows="5" required></textarea>
                          </div>
                          <div class="form-group">
                              <label>Type de notification</label>
                              <div class="radio-group">
                                  <label>
                                      <input type="radio" name="notification-type" value="info" checked>
                                      Information
                                  </label>
                                  <label>
                                      <input type="radio" name="notification-type" value="warning">
                                      Avertissement
                                  </label>
                                  <label>
                                      <input type="radio" name="notification-type" value="urgent">
                                      Urgent
                                  </label>
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="checkbox-wrapper">
                                  <input type="checkbox" id="notification-email" checked>
                                  <label for="notification-email">Envoyer également par email</label>
                              </div>
                          </div>
                          <div class="form-actions">
                              <button type="button" class="btn btn-secondary" id="cancel-notification-btn">Annuler</button>
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
      const cancelBtn = modal.querySelector("#cancel-notification-btn")

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
      const form = modal.querySelector("#notification-form")
      form.addEventListener("submit", (e) => {
        e.preventDefault()

        // In a real application, this would send the notification
        // For this example, we'll just close the modal

        closeModal()

        // Show a success message
        alert("Notification envoyée avec succès !")
      })
    })
  }

  // Pagination
  const paginationNumbers = document.querySelectorAll(".pagination-number")
  const prevButton = document.querySelector(".pagination-btn.prev")
  const nextButton = document.querySelector(".pagination-btn.next")

  if (paginationNumbers.length > 0) {
    paginationNumbers.forEach((number) => {
      number.addEventListener("click", function () {
        // Remove active class from all numbers
        paginationNumbers.forEach((num) => num.classList.remove("active"))

        // Add active class to clicked number
        this.classList.add("active")

        // Enable/disable prev/next buttons
        if (this.textContent === "1") {
          prevButton.disabled = true
        } else {
          prevButton.disabled = false
        }

        if (this.textContent === "10") {
          nextButton.disabled = true
        } else {
          nextButton.disabled = false
        }

        // In a real application, this would fetch the next page of users
        // For this example, we'll just scroll to the top of the table
        const usersTable = document.querySelector(".users-table")
        if (usersTable) {
          usersTable.scrollIntoView({ behavior: "smooth" })
        }
      })
    })
  }

  if (prevButton) {
    prevButton.addEventListener("click", function () {
      if (!this.disabled) {
        // Find current active page
        const activePage = document.querySelector(".pagination-number.active")

        if (
          activePage &&
          activePage.previousElementSibling &&
          activePage.previousElementSibling.classList.contains("pagination-number")
        ) {
          // Click previous page
          activePage.previousElementSibling.click()
        }
      }
    })
  }

  if (nextButton) {
    nextButton.addEventListener("click", function () {
      if (!this.disabled) {
        // Find current active page
        const activePage = document.querySelector(".pagination-number.active")

        if (
          activePage &&
          activePage.nextElementSibling &&
          activePage.nextElementSibling.classList.contains("pagination-number")
        ) {
          // Click next page
          activePage.nextElementSibling.click()
        }
      }
    })
  }
})

