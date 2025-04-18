document.addEventListener("DOMContentLoaded", () => {
  // FAQ category buttons
  const categoryButtons = document.querySelectorAll(".category-btn")
  const faqSections = document.querySelectorAll(".faq-section")

  if (categoryButtons.length > 0) {
    categoryButtons.forEach((button) => {
      button.addEventListener("click", function () {
        // Remove active class from all buttons
        categoryButtons.forEach((btn) => btn.classList.remove("active"))

        // Add active class to clicked button
        this.classList.add("active")

        // Hide all sections
        faqSections.forEach((section) => section.classList.remove("active"))

        // Show corresponding section
        const category = this.dataset.category
        const section = document.getElementById(`${category}-section`)

        if (section) {
          section.classList.add("active")
        }
      })
    })
  }

  // FAQ questions toggle
  const faqQuestions = document.querySelectorAll(".faq-question")

  if (faqQuestions.length > 0) {
    faqQuestions.forEach((question) => {
      question.addEventListener("click", function () {
        // Toggle active class on parent item
        const faqItem = this.parentElement
        faqItem.classList.toggle("active")

        // Toggle icon
        const toggleIcon = this.querySelector(".toggle-icon")

        if (toggleIcon) {
          toggleIcon.textContent = faqItem.classList.contains("active") ? "-" : "+"
        }

        // Toggle answer visibility
        const answer = faqItem.querySelector(".faq-answer")

        if (answer) {
          if (faqItem.classList.contains("active")) {
            answer.style.display = "block"

            // Animate height
            const height = answer.scrollHeight
            answer.style.height = "0"

            // Trigger reflow
            answer.offsetHeight

            answer.style.transition = "height 0.3s ease"
            answer.style.height = `${height}px`

            // Remove fixed height after transition
            setTimeout(() => {
              answer.style.height = "auto"
            }, 300)
          } else {
            // Set fixed height for animation
            const height = answer.scrollHeight
            answer.style.height = `${height}px`

            // Trigger reflow
            answer.offsetHeight

            // Animate to 0
            answer.style.transition = "height 0.3s ease"
            answer.style.height = "0"

            // Hide after transition
            setTimeout(() => {
              answer.style.display = "none"
            }, 300)
          }
        }
      })
    })
  }

  // Initialize: hide all answers except in active section
  faqSections.forEach((section) => {
    const answers = section.querySelectorAll(".faq-answer")

    answers.forEach((answer) => {
      if (!section.classList.contains("active")) {
        answer.style.display = "none"
      }
    })
  })

  // FAQ search
  const searchInput = document.getElementById("faq-search-input")

  if (searchInput) {
    searchInput.addEventListener("input", function () {
      const query = this.value.trim().toLowerCase()

      if (query.length < 2) {
        // Reset view if query is too short
        categoryButtons[0].click()
        return
      }

      // Show all sections
      faqSections.forEach((section) => section.classList.add("active"))

      // Remove active class from all category buttons
      categoryButtons.forEach((btn) => btn.classList.remove("active"))

      // Search in all questions and answers
      const faqItems = document.querySelectorAll(".faq-item")
      let hasResults = false

      faqItems.forEach((item) => {
        const question = item.querySelector(".faq-question h3").textContent.toLowerCase()
        const answer = item.querySelector(".faq-answer p").textContent.toLowerCase()

        if (question.includes(query) || answer.includes(query)) {
          // Show this item
          item.style.display = "block"

          // Highlight the match
          const toggleIcon = item.querySelector(".toggle-icon")
          toggleIcon.textContent = "-"

          // Show the answer
          const answerElement = item.querySelector(".faq-answer")
          answerElement.style.display = "block"
          answerElement.style.height = "auto"

          // Add active class to item
          item.classList.add("active")

          hasResults = true
        } else {
          // Hide this item
          item.style.display = "none"
        }
      })

      // Show a message if no results
      const noResultsMessage = document.getElementById("no-results-message")

      if (!hasResults) {
        if (!noResultsMessage) {
          const message = document.createElement("div")
          message.id = "no-results-message"
          message.className = "no-results"
          message.textContent = `Aucun résultat trouvé pour "${query}".`

          const firstSection = document.querySelector(".faq-section")
          firstSection.appendChild(message)
        }
      } else if (noResultsMessage) {
        noResultsMessage.remove()
      }
    })
  }

  // Contact options
  const contactOptions = document.querySelectorAll(".contact-option")

  if (contactOptions.length > 0) {
    contactOptions.forEach((option) => {
      option.addEventListener("click", function () {
        const type = this.querySelector("h3").textContent

        if (type === "Email") {
          // Open email client
          window.location.href = "mailto:support@skillshare.com"
        } else if (type === "Chat en direct") {
          // In a real application, this would open a chat widget
          alert("Le chat en direct n'est pas implémenté dans cet exemple.")
        }
      })
    })
  }
})

