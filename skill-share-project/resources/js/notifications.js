document.addEventListener("DOMContentLoaded", () => {
  // Mark all as read button
  const markAllReadBtn = document.getElementById("mark-all-read-btn")

  if (markAllReadBtn) {
    markAllReadBtn.addEventListener("click", () => {
      // Mark all notifications as read
      const unreadNotifications = document.querySelectorAll(".notification-item.unread")

      unreadNotifications.forEach((notification) => {
        notification.classList.remove("unread")
      })

      // Show a success message
      alert("Toutes les notifications ont été marquées comme lues.")
    })
  }

  // Mark as read buttons
  const markReadButtons = document.querySelectorAll(".notification-mark-read")

  if (markReadButtons.length > 0) {
    markReadButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const notificationItem = this.closest(".notification-item")

        if (notificationItem) {
          notificationItem.classList.remove("unread")
        }
      })
    })
  }

  // Filter notifications
  const filterSelect = document.getElementById("filter-notifications")

  if (filterSelect) {
    filterSelect.addEventListener("change", function () {
      const filter = this.value
      const notificationItems = document.querySelectorAll(".notification-item")

      notificationItems.forEach((item) => {
        if (filter === "all") {
          item.style.display = "flex"
        } else if (filter === "unread" && item.classList.contains("unread")) {
          item.style.display = "flex"
        } else if (filter === item.dataset.type) {
          item.style.display = "flex"
        } else {
          item.style.display = "none"
        }
      })
    })
  }

  // Notification action buttons
  const actionButtons = document.querySelectorAll(".notification-actions .btn")

  if (actionButtons.length > 0) {
    actionButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const notificationItem = this.closest(".notification-item")
        const buttonText = this.textContent.trim()

        // In a real application, this would perform the corresponding action
        // For this example, we'll just show a message

        alert(`Action "${buttonText}" effectuée avec succès.`)

        // Mark notification as read
        if (notificationItem.classList.contains("unread")) {
          notificationItem.classList.remove("unread")
        }
      })
    })
  }

  // Notification preferences form
  const preferencesForm = document.querySelector(".preferences-form")

  if (preferencesForm) {
    preferencesForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // In a real application, this would save the preferences
      // For this example, we'll just show a message

      alert("Préférences de notification enregistrées avec succès.")
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

        if (this.textContent === "3") {
          nextButton.disabled = true
        } else {
          nextButton.disabled = false
        }

        // In a real application, this would fetch the next page of notifications
        // For this example, we'll just scroll to the top of the notifications
        const notificationsList = document.querySelector(".notifications-list")
        if (notificationsList) {
          notificationsList.scrollIntoView({ behavior: "smooth" })
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

