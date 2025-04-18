document.addEventListener("DOMContentLoaded", () => {
  // Calendar functionality
  const calendarDays = document.querySelector(".calendar-days")
  const calendarHeader = document.querySelector(".calendar-header h3")
  const prevButton = document.querySelector(".calendar-nav.prev")
  const nextButton = document.querySelector(".calendar-nav.next")
  const selectedDate = document.querySelector(".selected-date")

  if (calendarDays && calendarHeader) {
    const currentDate = new Date()
    let currentMonth = currentDate.getMonth()
    let currentYear = currentDate.getFullYear()
    let selectedDay = null

    // Generate calendar
    function generateCalendar(month, year) {
      // Clear calendar days
      calendarDays.innerHTML = ""

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
        dayElement.textContent = i

        // Check if this day has availability
        const dayDate = new Date(year, month, i)
        const isAvailable = checkAvailability(dayDate)

        if (isAvailable) {
          dayElement.classList.add("available")

          // Add click event to select date
          dayElement.addEventListener("click", function () {
            // Remove selected class from all days
            const allDays = document.querySelectorAll(".calendar-day")
            allDays.forEach((day) => day.classList.remove("selected"))

            // Add selected class to clicked day
            this.classList.add("selected")

            // Update selected date
            selectedDay = i
            updateSelectedDate(i, month, year)

            // Update time slots
            updateTimeSlots(dayDate)
          })
        } else {
          dayElement.classList.add("disabled")
        }

        // Check if this is today
        const today = new Date()
        if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
          dayElement.classList.add("today")
        }

        // Check if this is the selected day
        if (i === selectedDay && month === currentMonth && year === currentYear) {
          dayElement.classList.add("selected")
        }

        calendarDays.appendChild(dayElement)
      }
    }

    // Check if a day has availability (dummy function, replace with real data)
    function checkAvailability(date) {
      // Example: available on weekdays (Monday to Friday)
      const day = date.getDay()
      return day >= 1 && day <= 5
    }

    // Update selected date display
    function updateSelectedDate(day, month, year) {
      const date = new Date(year, month, day)
      const options = { weekday: "long", day: "numeric", month: "long", year: "numeric" }
      const formattedDate = date.toLocaleDateString("fr-FR", options)

      // Capitalize first letter
      const capitalizedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1)

      if (selectedDate) {
        selectedDate.textContent = capitalizedDate
      }

      // Update summary
      const summaryDate = document.querySelector(".summary-item:nth-child(2) .summary-value")
      if (summaryDate) {
        summaryDate.textContent = capitalizedDate
      }
    }

    // Update time slots based on selected date
    function updateTimeSlots(date) {
      // In a real application, this would fetch available time slots for the selected date
      // For this example, we'll just simulate different availability

      const timeSlotsGrid = document.querySelector(".time-slots-grid")

      if (timeSlotsGrid) {
        // Clear existing time slots
        timeSlotsGrid.innerHTML = ""

        // Generate time slots
        const timeSlots = getTimeSlots(date)

        timeSlots.forEach((slot) => {
          const timeSlotHTML = `
                        <label class="time-slot ${slot.disabled ? "disabled" : ""}">
                            <input type="radio" name="time-slot" value="${slot.value}" ${slot.checked ? "checked" : ""} ${slot.disabled ? "disabled" : ""}>
                            <span class="slot-time">${slot.label}</span>
                        </label>
                    `

          timeSlotsGrid.insertAdjacentHTML("beforeend", timeSlotHTML)
        })

        // Add event listeners to time slots
        const timeSlotInputs = document.querySelectorAll(".time-slot input")
        timeSlotInputs.forEach((input) => {
          input.addEventListener("change", function () {
            if (this.checked) {
              // Update summary
              const summaryTime = document.querySelector(".summary-item:nth-child(3) .summary-value")
              if (summaryTime) {
                summaryTime.textContent = this.value.replace("-", " - ")
              }
            }
          })
        })

        // Trigger change event on checked input
        const checkedInput = document.querySelector(".time-slot input:checked")
        if (checkedInput) {
          checkedInput.dispatchEvent(new Event("change"))
        }
      }
    }

    // Get time slots for a date (dummy function, replace with real data)
    function getTimeSlots(date) {
      // Example: different time slots based on day of week
      const day = date.getDay()

      // Monday and Wednesday: morning slots
      if (day === 1 || day === 3) {
        return [
          { label: "09:00 - 10:30", value: "09:00-10:30", checked: true, disabled: false },
          { label: "10:30 - 12:00", value: "10:30-12:00", checked: false, disabled: false },
          { label: "13:00 - 14:30", value: "13:00-14:30", checked: false, disabled: false },
          { label: "14:30 - 16:00", value: "14:30-16:00", checked: false, disabled: true },
          { label: "16:00 - 17:30", value: "16:00-17:30", checked: false, disabled: true },
          { label: "17:30 - 19:00", value: "17:30-19:00", checked: false, disabled: true },
        ]
      }
      // Tuesday and Thursday: afternoon slots
      else if (day === 2 || day === 4) {
        return [
          { label: "09:00 - 10:30", value: "09:00-10:30", checked: false, disabled: true },
          { label: "10:30 - 12:00", value: "10:30-12:00", checked: false, disabled: true },
          { label: "13:00 - 14:30", value: "13:00-14:30", checked: false, disabled: false },
          { label: "14:30 - 16:00", value: "14:30-16:00", checked: true, disabled: false },
          { label: "16:00 - 17:30", value: "16:00-17:30", checked: false, disabled: false },
          { label: "17:30 - 19:00", value: "17:30-19:00", checked: false, disabled: false },
        ]
      }
      // Friday: all slots
      else if (day === 5) {
        return [
          { label: "09:00 - 10:30", value: "09:00-10:30", checked: false, disabled: false },
          { label: "10:30 - 12:00", value: "10:30-12:00", checked: false, disabled: false },
          { label: "13:00 - 14:30", value: "13:00-14:30", checked: false, disabled: false },
          { label: "14:30 - 16:00", value: "14:30-16:00", checked: true, disabled: false },
          { label: "16:00 - 17:30", value: "16:00-17:30", checked: false, disabled: false },
          { label: "17:30 - 19:00", value: "17:30-19:00", checked: false, disabled: false },
        ]
      }
      // Weekend: no slots (should not happen due to checkAvailability)
      else {
        return []
      }
    }

    // Initialize calendar
    generateCalendar(currentMonth, currentYear)

    // Set initial selected date (today or first available day)
    const today = new Date()
    if (checkAvailability(today)) {
      selectedDay = today.getDate()
      updateSelectedDate(selectedDay, currentMonth, currentYear)

      // Select today in calendar
      const todayElement = document.querySelector(".calendar-day.today")
      if (todayElement) {
        todayElement.classList.add("selected")
      }

      // Update time slots
      updateTimeSlots(today)
    } else {
      // Find first available day
      for (let i = 1; i <= 31; i++) {
        const date = new Date(currentYear, currentMonth, i)

        if (date.getMonth() !== currentMonth) {
          break
        }

        if (checkAvailability(date)) {
          selectedDay = i
          updateSelectedDate(selectedDay, currentMonth, currentYear)

          // Select day in calendar
          const dayElement = document.querySelector(
            `.calendar-day:not(.empty):nth-child(${i + document.querySelectorAll(".calendar-day.empty").length})`,
          )
          if (dayElement) {
            dayElement.classList.add("selected")
          }

          // Update time slots
          updateTimeSlots(date)
          break
        }
      }
    }

    // Previous month button
    if (prevButton) {
      prevButton.addEventListener("click", () => {
        currentMonth--
        if (currentMonth < 0) {
          currentMonth = 11
          currentYear--
        }
        generateCalendar(currentMonth, currentYear)
        selectedDay = null
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
        selectedDay = null
      })
    }
  }

  // Location selection
  const locationSelect = document.getElementById("location")

  if (locationSelect) {
    locationSelect.addEventListener("change", function () {
      // Update summary
      const summaryLocation = document.querySelector(".summary-item:nth-child(4) .summary-value")
      if (summaryLocation) {
        if (this.value) {
          const selectedOption = this.options[this.selectedIndex]
          summaryLocation.textContent = selectedOption.text
        } else {
          summaryLocation.textContent = "À sélectionner"
        }
      }
    })
  }

  // Skill selection
  const skillOptions = document.querySelectorAll(".skill-option input")

  if (skillOptions.length > 0) {
    skillOptions.forEach((option) => {
      option.addEventListener("change", function () {
        if (this.checked) {
          // Update summary
          const summarySkill = document.querySelector(".summary-item:nth-child(1) .summary-value")
          if (summarySkill) {
            const skillName = this.nextElementSibling.textContent
            summarySkill.textContent = skillName
          }
        }
      })
    })
  }

  // Confirm booking button
  const confirmBookingBtn = document.getElementById("confirm-booking-btn")

  if (confirmBookingBtn) {
    confirmBookingBtn.addEventListener("click", () => {
      // Validate form
      const locationSelect = document.getElementById("location")

      if (!locationSelect.value) {
        alert("Veuillez sélectionner un lieu pour la session.")
        locationSelect.focus()
        return
      }

      // In a real application, this would submit the booking to the server
      // For this example, we'll just show a success message

      // Create a modal for booking confirmation
      const modal = document.createElement("div")
      modal.className = "modal active"

      const modalContent = `
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Réservation confirmée</h2>
                        <button class="modal-close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="confirmation-message">
                            <div class="confirmation-icon">✅</div>
                            <h3>Votre session a été réservée avec succès !</h3>
                            <p>Un email de confirmation a été envoyé à votre adresse email.</p>
                        </div>
                        <div class="confirmation-details">
                            <h4>Détails de la session</h4>
                            <ul>
                                <li><strong>Compétence :</strong> ${document.querySelector(".summary-item:nth-child(1) .summary-value").textContent}</li>
                                <li><strong>Date :</strong> ${document.querySelector(".summary-item:nth-child(2) .summary-value").textContent}</li>
                                <li><strong>Heure :</strong> ${document.querySelector(".summary-item:nth-child(3) .summary-value").textContent}</li>
                                <li><strong>Lieu :</strong> ${document.querySelector(".summary-item:nth-child(4) .summary-value").textContent}</li>
                            </ul>
                        </div>
                        <div class="confirmation-actions">
                            <button class="btn btn-secondary" id="add-to-calendar-btn">Ajouter au calendrier</button>
                            <button class="btn btn-primary" id="go-to-dashboard-btn">Aller au tableau de bord</button>
                        </div>
                    </div>
                </div>
            `

      modal.innerHTML = modalContent
      document.body.appendChild(modal)
      document.body.classList.add("modal-open")

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

      // Add to calendar button
      const addToCalendarBtn = modal.querySelector("#add-to-calendar-btn")

      if (addToCalendarBtn) {
        addToCalendarBtn.addEventListener("click", () => {
          alert("Fonctionnalité d'ajout au calendrier non implémentée dans cet exemple.")
        })
      }

      // Go to dashboard button
      const goToDashboardBtn = modal.querySelector("#go-to-dashboard-btn")

      if (goToDashboardBtn) {
        goToDashboardBtn.addEventListener("click", () => {
          window.location.href = "user-dashboard.php"
        })
      }
    })
  }
})

