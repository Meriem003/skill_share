document.addEventListener("DOMContentLoaded", () => {
  // Tab functionality
  const tabButtons = document.querySelectorAll(".tab-btn")
  const tabContents = document.querySelectorAll(".tab-content")

  if (tabButtons.length > 0) {
    tabButtons.forEach((button) => {
      button.addEventListener("click", function () {
        // Remove active class from all buttons and contents
        tabButtons.forEach((btn) => btn.classList.remove("active"))
        tabContents.forEach((content) => content.classList.remove("active"))

        // Add active class to clicked button
        this.classList.add("active")

        // Show corresponding content
        const tabId = this.dataset.tab
        const tabContent = document.getElementById(`${tabId}-tab`)

        if (tabContent) {
          tabContent.classList.add("active")
        }
      })
    })
  }

  // Session filters
  const sessionFilterButtons = document.querySelectorAll(".filter-btn")
  const sessionCards = document.querySelectorAll(".session-card")

  if (sessionFilterButtons.length > 0) {
    sessionFilterButtons.forEach((button) => {
      button.addEventListener("click", function () {
        // Remove active class from all buttons
        sessionFilterButtons.forEach((btn) => btn.classList.remove("active"))

        // Add active class to clicked button
        this.classList.add("active")

        // Filter sessions
        const filter = this.dataset.filter

        sessionCards.forEach((card) => {
          if (filter === "all" || card.classList.contains(filter)) {
            card.style.display = "block"
          } else {
            card.style.display = "none"
          }
        })
      })
    })
  }

  // Calendar functionality
  const calendarGrid = document.querySelector(".calendar-grid")
  const calendarHeader = document.querySelector(".calendar-header h4")
  const prevButton = document.querySelector(".calendar-nav.prev")
  const nextButton = document.querySelector(".calendar-nav.next")

  if (calendarGrid && calendarHeader) {
    const currentDate = new Date()
    let currentMonth = currentDate.getMonth()
    let currentYear = currentDate.getFullYear()

    // Generate calendar
    function generateCalendar(month, year) {
      // Clear calendar grid
      calendarGrid.innerHTML = ""

      // Update header
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
      calendarHeader.textContent = `${monthNames[month]} ${year}`

      // Get first day of month and number of days
      const firstDay = new Date(year, month, 1).getDay()
      const daysInMonth = new Date(year, month + 1, 0).getDate()

      // Adjust first day (0 is Sunday in JS, but we want Monday as 0)
      const firstDayAdjusted = firstDay === 0 ? 6 : firstDay - 1

      // Add weekday headers
      const weekdays = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"]
      weekdays.forEach((day) => {
        const dayElement = document.createElement("div")
        dayElement.className = "calendar-day weekday"
        dayElement.textContent = day
        calendarGrid.appendChild(dayElement)
      })

      // Add empty cells for days before first day of month
      for (let i = 0; i < firstDayAdjusted; i++) {
        const emptyDay = document.createElement("div")
        emptyDay.className = "calendar-day empty"
        calendarGrid.appendChild(emptyDay)
      }

      // Add days of month
      for (let i = 1; i <= daysInMonth; i++) {
        const dayElement = document.createElement("div")
        dayElement.className = "calendar-day"
        dayElement.textContent = i

        // Check if this day has availability
        const dayDate = new Date(year, month, i)
        const isAvailable = checkAvailability(dayDate)

        if (isAvailable) {
          dayElement.classList.add("available")
        }

        // Check if this is today
        const today = new Date()
        if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
          dayElement.classList.add("today")
        }

        calendarGrid.appendChild(dayElement)
      }
    }

    // Check if a day has availability (dummy function, replace with real data)
    function checkAvailability(date) {
      // Example: available on Mondays, Wednesdays, and Fridays
      const day = date.getDay()
      return day === 1 || day === 3 || day === 5
    }

    // Initialize calendar
    generateCalendar(currentMonth, currentYear)

    // Previous month button
    if (prevButton) {
      prevButton.addEventListener("click", () => {
        currentMonth--
        if (currentMonth < 0) {
          currentMonth = 11
          currentYear--
        }
        generateCalendar(currentMonth, currentYear)
      })
    }

    // Next month button
    if (nextButton) {
      nextButton.addEventListener("click", () => {
        currentMonth++
        if (currentMonth > 11) {
          currentMonth = 0
          currentYear++
        }
        generateCalendar(currentMonth, currentYear)
      })
    }
  }


  // Edit avatar button
  const editAvatarBtn = document.getElementById("edit-avatar-btn")

  if (editAvatarBtn) {
    editAvatarBtn.addEventListener("click", () => {
      // Create a file input
      const fileInput = document.createElement("input")
      fileInput.type = "file"
      fileInput.accept = "image/*"

      // Trigger click on file input
      fileInput.click()

      // Handle file selection
      fileInput.addEventListener("change", function () {
        if (this.files && this.files[0]) {
          const reader = new FileReader()

          reader.onload = (e) => {
            // Update profile image
            const profileImage = document.getElementById("profile-image")
            if (profileImage) {
              profileImage.src = e.target.result
            }
          }

          reader.readAsDataURL(this.files[0])
        }
      })
    })
  }

  // Edit availability button
  const editAvailabilityBtn = document.getElementById("edit-availability-btn")

  if (editAvailabilityBtn) {
    editAvailabilityBtn.addEventListener("click", () => {
      // Create a modal for editing availability
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Modifier mes disponibilités</h2>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Sélectionnez les jours et heures où vous êtes disponible pour enseigner ou apprendre.</p>
                        <form id="edit-availability-form">
                            <div class="availability-days">
                                <h3>Jours disponibles</h3>
                                <div class="days-grid">
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-mon" checked>
                                        <label for="day-mon">Lundi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-tue">
                                        <label for="day-tue">Mardi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-wed" checked>
                                        <label for="day-wed">Mercredi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-thu">
                                        <label for="day-thu">Jeudi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-fri" checked>
                                        <label for="day-fri">Vendredi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-sat">
                                        <label for="day-sat">Samedi</label>
                                    </div>
                                    <div class="day-checkbox">
                                        <input type="checkbox" id="day-sun">
                                        <label for="day-sun">Dimanche</label>
                                    </div>
                                </div>
                            </div>
                            <div class="availability-hours">
                                <h3>Heures disponibles</h3>
                                <div class="hours-grid">
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-9-10">
                                        <label for="hour-9-10">9:00 - 10:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-10-11">
                                        <label for="hour-10-11">10:00 - 11:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-11-12">
                                        <label for="hour-11-12">11:00 - 12:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-12-13">
                                        <label for="hour-12-13">12:00 - 13:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-13-14" checked>
                                        <label for="hour-13-14">13:00 - 14:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-14-15" checked>
                                        <label for="hour-14-15">14:00 - 15:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-15-16" checked>
                                        <label for="hour-15-16">15:00 - 16:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-16-17" checked>
                                        <label for="hour-16-17">16:00 - 17:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-17-18">
                                        <label for="hour-17-18">17:00 - 18:00</label>
                                    </div>
                                    <div class="hour-checkbox">
                                        <input type="checkbox" id="hour-18-19">
                                        <label for="hour-18-19">18:00 - 19:00</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-secondary" id="cancel-availability-btn">Annuler</button>
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
      const cancelBtn = modal.querySelector("#cancel-availability-btn")

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
      const form = modal.querySelector("#edit-availability-form")
      form.addEventListener("submit", (e) => {
        e.preventDefault()
        // Here you would normally send the data to the server
        // For now, just close the modal
        closeModal()

        // Show a success message
        alert("Disponibilités mises à jour avec succès !")
      })
    })
  }
})

/* Script pour ajouter dynamiquement l'animation du curseur */
document.addEventListener('DOMContentLoaded', function() {
  const cursorFollower = document.createElement('div');
  cursorFollower.classList.add('cursor-follower');
  document.body.appendChild(cursorFollower);
  
  document.addEventListener('mousemove', function(e) {
    cursorFollower.style.left = e.clientX + 'px';
    cursorFollower.style.top = e.clientY + 'px';
  });
  
  // Ajouter les valeurs finales pour l'animation de compteur
  const statValues = document.querySelectorAll('.stat-value');
  statValues.forEach(stat => {
    const finalCount = stat.textContent.trim();
    stat.style.setProperty('--final-count', finalCount);
    stat.textContent = '';
  });
});