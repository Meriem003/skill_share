document.addEventListener("DOMContentLoaded", () => {
  // Leaderboard tabs
  const leaderboardTabs = document.querySelectorAll(".leaderboard-tab")

  if (leaderboardTabs.length > 0) {
    leaderboardTabs.forEach((tab) => {
      tab.addEventListener("click", function () {
        // Remove active class from all tabs
        leaderboardTabs.forEach((t) => t.classList.remove("active"))

        // Add active class to clicked tab
        this.classList.add("active")

        // In a real application, this would fetch different leaderboard data
        // For this example, we'll just simulate a tab change

        const tabType = this.dataset.tab

        if (tabType === "global") {
          // Update leaderboard with global data
          updateLeaderboard([
            {
              rank: 1,
              name: "Sophie Martin",
              campus: "Paris",
              points: 1250,
              image: "images/user1.svg",
              isCurrentUser: false,
            },
            {
              rank: 2,
              name: "Alexandre Durand",
              campus: "Marseille",
              points: 1120,
              image: "images/user5.svg",
              isCurrentUser: false,
            },
            {
              rank: 3,
              name: "Thomas Dubois",
              campus: "Lyon",
              points: 980,
              image: "images/user2.svg",
              isCurrentUser: false,
            },
            {
              rank: 4,
              name: "Emma Petit",
              campus: "Paris",
              points: 920,
              image: "images/user4.svg",
              isCurrentUser: false,
            },
            {
              rank: 5,
              name: "Marie Dupont",
              campus: "Paris",
              points: 850,
              image: "images/default-avatar.svg",
              isCurrentUser: true,
            },
          ])
        } else {
          // Update leaderboard with campus data
          updateLeaderboard([
            {
              rank: 1,
              name: "Sophie Martin",
              campus: "Paris",
              points: 1250,
              image: "images/user1.svg",
              isCurrentUser: false,
            },
            {
              rank: 2,
              name: "Marie Dupont",
              campus: "Paris",
              points: 850,
              image: "images/default-avatar.svg",
              isCurrentUser: true,
            },
            {
              rank: 3,
              name: "Lucas Martin",
              campus: "Paris",
              points: 720,
              image: "images/user3.svg",
              isCurrentUser: false,
            },
            {
              rank: 4,
              name: "Thomas Dubois",
              campus: "Lyon",
              points: 680,
              image: "images/user2.svg",
              isCurrentUser: false,
            },
            {
              rank: 5,
              name: "Emma Petit",
              campus: "Paris",
              points: 650,
              image: "images/user4.svg",
              isCurrentUser: false,
            },
          ])
        }
      })
    })
  }

  // Update leaderboard function
  function updateLeaderboard(data) {
    const leaderboardList = document.querySelector(".leaderboard-list")

    if (leaderboardList) {
      // Clear existing items
      leaderboardList.innerHTML = ""

      // Add new items
      data.forEach((item) => {
        const itemHTML = `
                  <div class="leaderboard-item ${item.isCurrentUser ? "current-user" : ""}">
                      <div class="leaderboard-rank">${item.rank}</div>
                      <div class="leaderboard-user">
                          <img src="${item.image}" alt="Photo de profil">
                          <div>
                              <h4>${item.name}${item.isCurrentUser ? " (Vous)" : ""}</h4>
                              <p>Campus de ${item.campus}</p>
                          </div>
                      </div>
                      <div class="leaderboard-points">${item.points} pts</div>
                  </div>
              `

        leaderboardList.insertAdjacentHTML("beforeend", itemHTML)
      })
    }
  }

  // Todo checkboxes
  const todoCheckboxes = document.querySelectorAll(".todo-checkbox input")

  if (todoCheckboxes.length > 0) {
    todoCheckboxes.forEach((checkbox) => {
      checkbox.addEventListener("change", function () {
        const todoItem = this.closest(".todo-item")

        if (this.checked) {
          todoItem.classList.add("completed")

          // Update progress
          updateTodoProgress()
        } else {
          todoItem.classList.remove("completed")

          // Update progress
          updateTodoProgress()
        }
      })
    })
  }

  // Update todo progress
  function updateTodoProgress() {
    const totalTasks = document.querySelectorAll(".todo-item").length
    const completedTasks = document.querySelectorAll(".todo-item.completed").length
    const progressPercentage = totalTasks > 0 ? Math.round((completedTasks / totalTasks) * 100) : 0

    // Update progress bar
    const progressBar = document.querySelector(".todo-progress-bar .progress")
    const progressText = document.querySelector(".todo-progress-bar .progress-text")

    if (progressBar && progressText) {
      progressBar.style.width = `${progressPercentage}%`
      progressText.textContent = `${completedTasks}/${totalTasks} tâches terminées`
    }
  }

  // Calendar button
  const calendarBtn = document.querySelector(".dashboard-actions .btn-secondary")

  if (calendarBtn) {
    calendarBtn.addEventListener("click", () => {
      // Create a modal for calendar view
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
              <div class="modal-content">
                  <div class="modal-header">
                      <h2>Calendrier des sessions</h2>
                      <button class="modal-close">&times;</button>
                  </div>
                  <div class="modal-body">
                      <div class="calendar-view">
                          <div class="calendar-header">
                              <button class="calendar-nav prev">◀</button>
                              <h3>Juin 2023</h3>
                              <button class="calendar-nav next">▶</button>
                          </div>
                          <div class="calendar-weekdays">
                              <span>Lun</span>
                              <span>Mar</span>
                              <span>Mer</span>
                              <span>Jeu</span>
                              <span>Ven</span>
                              <span>Sam</span>
                              <span>Dim</span>
                          </div>
                          <div class="calendar-days">
                              <!-- Calendar will be generated by JS -->
                          </div>
                          <div class="calendar-legend">
                              <div class="legend-item">
                                  <span class="legend-color teaching"></span>
                                  <span>J'enseigne</span>
                              </div>
                              <div class="legend-item">
                                  <span class="legend-color learning"></span>
                                  <span>J'apprends</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          `

      modal.innerHTML = modalContent
      document.body.appendChild(modal)
      document.body.classList.add("modal-open")

      // Generate calendar
      generateCalendar()

      // Close modal functionality
      const closeBtn = modal.querySelector(".modal-close")

      closeBtn.addEventListener("click", () => {
        modal.remove()
        document.body.classList.remove("modal-open")
      })

      modal.addEventListener("click", (e) => {
        if (e.target === modal) {
          modal.remove()
          document.body.classList.remove("modal-open")
        }
      })

      // Calendar navigation
      const prevBtn = modal.querySelector(".calendar-nav.prev")
      const nextBtn = modal.querySelector(".calendar-nav.next")
      const calendarHeader = modal.querySelector(".calendar-header h3")

      const currentDate = new Date()
      let currentMonth = currentDate.getMonth()
      let currentYear = currentDate.getFullYear()

      function updateCalendarHeader() {
        const monthNames = [
          "Janvier",
          "Février",
          "Mars",
          "Avril",
          "Mai",
          "Juin",
          "Juillet",
          "Août",
          "Septembre",
          "Octobre",
          "Novembre",
          "Décembre",
        ]

        calendarHeader.textContent = `${monthNames[currentMonth]} ${currentYear}`
      }

      prevBtn.addEventListener("click", () => {
        currentMonth--
        if (currentMonth < 0) {
          currentMonth = 11
          currentYear--
        }
        updateCalendarHeader()
        generateCalendar()
      })

      nextBtn.addEventListener("click", () => {
        currentMonth++
        if (currentMonth > 11) {
          currentMonth = 0
          currentYear++
        }
        updateCalendarHeader()
        generateCalendar()
      })

      // Generate calendar function
      function generateCalendar() {
        const calendarDays = modal.querySelector(".calendar-days")
        calendarDays.innerHTML = ""

        // Get first day of month and number of days
        const firstDay = new Date(currentYear, currentMonth, 1).getDay()
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate()

        // Adjust first day (0 is Sunday in JS, but we want Monday as 0)
        const firstDayAdjusted = firstDay === 0 ? 6 : firstDay - 1

        // Add empty cells for days before first day of month
        for (let i = 0; i < firstDayAdjusted; i++) {
          const emptyDay = document.createElement("div")
          emptyDay.className = "calendar-day empty"
          calendarDays.appendChild(emptyDay)
        }

        // Add days of month
        for (let i = 1; i <= daysInMonth; i++) {
          const dayElement = document.createElement("div")
          dayElement.className = "calendar-day"

          // Check if this day has sessions
          const sessions = getSessionsForDay(i, currentMonth, currentYear)

          if (sessions.length > 0) {
            dayElement.classList.add("has-sessions")

            // Create session indicators
            const indicators = document.createElement("div")
            indicators.className = "session-indicators"

            sessions.forEach((session) => {
              const indicator = document.createElement("span")
              indicator.className = `session-indicator ${session.type}`
              indicators.appendChild(indicator)
            })

            dayElement.appendChild(indicators)
          }

          // Add day number
          const dayNumber = document.createElement("span")
          dayNumber.className = "day-number"
          dayNumber.textContent = i
          dayElement.appendChild(dayNumber)

          // Check if this is today
          const today = new Date()
          if (i === today.getDate() && currentMonth === today.getMonth() && currentYear === today.getFullYear()) {
            dayElement.classList.add("today")
          }

          // Add click event to show sessions
          dayElement.addEventListener("click", () => {
            if (sessions.length > 0) {
              showSessionsForDay(i, currentMonth, currentYear, sessions)
            }
          })

          calendarDays.appendChild(dayElement)
        }
      }

      // Get sessions for a specific day (dummy function, replace with real data)
      function getSessionsForDay(day, month, year) {
        // Example data
        const sessions = [
          {
            day: 6,
            month: 5,
            year: 2023,
            title: "Initiation au JavaScript",
            with: "Thomas Dubois",
            time: "14:30 - 16:00",
            location: "Bibliothèque du campus",
            type: "teaching",
          },
          {
            day: 9,
            month: 5,
            year: 2023,
            title: "Bases du Python",
            with: "Lucas Martin",
            time: "10:00 - 11:00",
            location: "Salle informatique B12",
            type: "learning",
          },
          {
            day: 12,
            month: 5,
            year: 2023,
            title: "Design d'interfaces",
            with: "Emma Petit",
            time: "15:00 - 16:30",
            location: "Salle de design",
            type: "teaching",
          },
          {
            day: 15,
            month: 5,
            year: 2023,
            title: "Marketing digital",
            with: "Alexandre Durand",
            time: "13:00 - 14:30",
            location: "Salle de réunion C",
            type: "learning",
          },
          {
            day: 20,
            month: 5,
            year: 2023,
            title: "Photographie",
            with: "Sophie Martin",
            time: "16:00 - 17:30",
            location: "Studio photo",
            type: "teaching",
          },
        ]

        return sessions.filter((session) => session.day === day && session.month === month && session.year === year)
      }

      // Show sessions for a specific day
      function showSessionsForDay(day, month, year, sessions) {
        // Create a modal for sessions
        const sessionsModal = document.createElement("div")
        sessionsModal.className = "modal active"

        const date = new Date(year, month, day)
        const formattedDate = date.toLocaleDateString("fr-FR", {
          weekday: "long",
          day: "numeric",
          month: "long",
          year: "numeric",
        })
        const capitalizedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1)

        let sessionsHTML = ""

        sessions.forEach((session) => {
          sessionsHTML += `
                      <div class="session-item">
                          <div class="session-type ${session.type}">${session.type === "teaching" ? "J'enseigne" : "J'apprends"}</div>
                          <div class="session-content">
                              <h4>${session.title}</h4>
                              <p>${session.time} • ${session.location}</p>
                              <div class="session-with">
                                  <img src="images/user2.svg" alt="Photo de profil">
                                  <span>Avec ${session.with}</span>
                              </div>
                          </div>
                          <div class="session-actions">
                              <button class="btn btn-secondary btn-sm">Annuler</button>
                              <button class="btn btn-primary btn-sm">Détails</button>
                          </div>
                      </div>
                  `
        })

        const modalContent = `
                  <div class="modal-content">
                      <div class="modal-header">
                          <h2>Sessions du ${capitalizedDate}</h2>
                          <button class="modal-close">&times;</button>
                      </div>
                      <div class="modal-body">
                          <div class="sessions-list">
                              ${sessionsHTML}
                          </div>
                      </div>
                  </div>
              `

        sessionsModal.innerHTML = modalContent
        document.body.appendChild(sessionsModal)

        // Close modal functionality
        const closeBtn = sessionsModal.querySelector(".modal-close")

        closeBtn.addEventListener("click", () => {
          sessionsModal.remove()
        })

        sessionsModal.addEventListener("click", (e) => {
          if (e.target === sessionsModal) {
            sessionsModal.remove()
          }
        })
      }
    })
  }

  // New session button
  const newSessionBtn = document.querySelector(".dashboard-actions .btn-primary")

  if (newSessionBtn) {
    newSessionBtn.addEventListener("click", () => {
      // Redirect to booking page
      window.location.href = "booking.php"
    })
  }

  // Initialize todo progress
  updateTodoProgress()
})

