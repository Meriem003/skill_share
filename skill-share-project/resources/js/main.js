document.addEventListener("DOMContentLoaded", () => {
  // Mobile menu toggle
  const mobileMenuBtn = document.querySelector(".mobile-menu-btn")
  const mobileMenu = document.querySelector(".mobile-menu")

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener("click", () => {
      mobileMenu.classList.toggle("active")
      document.body.classList.toggle("menu-open")
    })
  }

  // Notifications dropdown
  const notificationsBtn = document.querySelector(".notifications-btn")
  const notificationsDropdown = document.querySelector(".notifications-dropdown")

  if (notificationsBtn && notificationsDropdown) {
    notificationsBtn.addEventListener("click", (e) => {
      e.stopPropagation()
      notificationsDropdown.classList.toggle("active")
    })

    document.addEventListener("click", (e) => {
      if (!notificationsDropdown.contains(e.target) && !notificationsBtn.contains(e.target)) {
        notificationsDropdown.classList.remove("active")
      }
    })
  }

  // User dropdown
  const userMenuBtn = document.querySelector(".user-menu-btn")
  const userDropdown = document.querySelector(".user-dropdown")

  if (userMenuBtn && userDropdown) {
    userMenuBtn.addEventListener("click", (e) => {
      e.stopPropagation()
      userDropdown.classList.toggle("active")
    })

    document.addEventListener("click", (e) => {
      if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
        userDropdown.classList.remove("active")
      }
    })
  }

  // Modal functionality
  const modals = document.querySelectorAll(".modal")
  const modalTriggers = document.querySelectorAll("[data-modal]")
  const modalCloseButtons = document.querySelectorAll(".modal-close, [data-close-modal]")

  if (modalTriggers.length > 0) {
    modalTriggers.forEach((trigger) => {
      trigger.addEventListener("click", function () {
        const modalId = this.dataset.modal
        const modal = document.getElementById(modalId)

        if (modal) {
          modal.classList.add("active")
          document.body.classList.add("modal-open")
        }
      })
    })
  }

  if (modalCloseButtons.length > 0) {
    modalCloseButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const modal = this.closest(".modal")

        if (modal) {
          modal.classList.remove("active")
          document.body.classList.remove("modal-open")
        }
      })
    })
  }

  if (modals.length > 0) {
    modals.forEach((modal) => {
      modal.addEventListener("click", function (e) {
        if (e.target === this) {
          this.classList.remove("active")
          document.body.classList.remove("modal-open")
        }
      })
    })
  }

  // Form validation
  const forms = document.querySelectorAll("form")

  if (forms.length > 0) {
    forms.forEach((form) => {
      form.addEventListener("submit", (e) => {
        const requiredFields = form.querySelectorAll("[required]")
        let isValid = true

        requiredFields.forEach((field) => {
          if (!field.value.trim()) {
            isValid = false
            field.classList.add("error")

            // Add error message if it doesn't exist
            let errorMessage = field.nextElementSibling
            if (!errorMessage || !errorMessage.classList.contains("error-message")) {
              errorMessage = document.createElement("div")
              errorMessage.classList.add("error-message")
              errorMessage.textContent = "Ce champ est requis"
              field.parentNode.insertBefore(errorMessage, field.nextSibling)
            }
          } else {
            field.classList.remove("error")

            // Remove error message if it exists
            const errorMessage = field.nextElementSibling
            if (errorMessage && errorMessage.classList.contains("error-message")) {
              errorMessage.remove()
            }
          }
        })

        if (!isValid) {
          e.preventDefault()
        }
      })
    })
  }
})

