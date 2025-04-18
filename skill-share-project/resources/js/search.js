document.addEventListener("DOMContentLoaded", () => {
  // Search form submission
  const searchForm = document.getElementById("search-form")
  const searchInput = document.getElementById("search-input")
  const resultsCount = document.getElementById("results-count")

  if (searchForm) {
    searchForm.addEventListener("submit", (e) => {
      e.preventDefault()

      // Get search query
      const query = searchInput.value.trim()

      if (query) {
        // Update results header
        const resultsHeader = document.querySelector(".results-header h2")
        if (resultsHeader) {
          resultsHeader.textContent = `Résultats pour "${query}"`
        }

        // In a real application, you would fetch results from the server
        // For this example, we'll just simulate a search
        simulateSearch(query)
      }
    })
  }

  // Filter functionality
  const categoryFilter = document.getElementById("category-filter")
  const campusFilter = document.getElementById("campus-filter")
  const availabilityFilter = document.getElementById("availability-filter")
  const ratingFilter = document.getElementById("rating-filter")

  const filters = [categoryFilter, campusFilter, availabilityFilter, ratingFilter]

  filters.forEach((filter) => {
    if (filter) {
      filter.addEventListener("change", () => {
        applyFilters()
      })
    }
  })

  // Simulate search results
  function simulateSearch(query) {
    // In a real application, this would be an API call
    // For this example, we'll just update the UI

    // Show loading state
    const resultsList = document.querySelector(".results-list")
    if (resultsList) {
      resultsList.innerHTML = '<div class="loading">Chargement des résultats...</div>'

      // Simulate API delay
      setTimeout(() => {
        // Remove loading state
        resultsList.innerHTML = ""

        // Add sample results
        const sampleResults = getSampleResults(query)

        sampleResults.forEach((result) => {
          const resultHTML = `
                        <div class="result-card">
                            <div class="result-user">
                                <img src="${result.image}" alt="Photo de profil">
                                <div class="user-info">
                                    <h3>${result.name}</h3>
                                    <p class="user-campus">Campus de ${result.campus}</p>
                                    <div class="user-rating">
                                        <span class="stars">${getStars(result.rating)}</span>
                                        <span class="rating-value">${result.rating.toFixed(1)}</span>
                                        <span class="rating-count">(${result.reviewCount} avis)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="result-skills">
                                <h4>Compétences</h4>
                                <div class="skills-list">
                                    ${result.skills.map((skill) => `<span class="skill-tag">${skill}</span>`).join("")}
                                </div>
                            </div>
                            <div class="result-availability">
                                <h4>Prochaines disponibilités</h4>
                                <div class="availability-slots">
                                    ${result.availability.map((slot) => `<span class="availability-slot">${slot}</span>`).join("")}
                                </div>
                            </div>
                            <div class="result-actions">
                                <button class="btn btn-primary">Réserver une session</button>
                                <button class="btn btn-secondary">Voir le profil</button>
                            </div>
                        </div>
                    `

          resultsList.insertAdjacentHTML("beforeend", resultHTML)
        })

        // Update results count
        if (resultsCount) {
          resultsCount.textContent = sampleResults.length
        }
      }, 500)
    }
  }

  // Apply filters to results
  function applyFilters() {
    const category = categoryFilter ? categoryFilter.value : ""
    const campus = campusFilter ? campusFilter.value : ""
    const availability = availabilityFilter ? availabilityFilter.value : ""
    const rating = ratingFilter ? ratingFilter.value : ""

    // In a real application, this would be an API call with filter parameters
    // For this example, we'll just update the UI

    // Show loading state
    const resultsList = document.querySelector(".results-list")
    if (resultsList) {
      resultsList.innerHTML = '<div class="loading">Filtrage des résultats...</div>'

      // Simulate API delay
      setTimeout(() => {
        // Remove loading state
        resultsList.innerHTML = ""

        // Add filtered results
        const filteredResults = getFilteredResults(category, campus, availability, rating)

        filteredResults.forEach((result) => {
          const resultHTML = `
                        <div class="result-card">
                            <div class="result-user">
                                <img src="${result.image}" alt="Photo de profil">
                                <div class="user-info">
                                    <h3>${result.name}</h3>
                                    <p class="user-campus">Campus de ${result.campus}</p>
                                    <div class="user-rating">
                                        <span class="stars">${getStars(result.rating)}</span>
                                        <span class="rating-value">${result.rating.toFixed(1)}</span>
                                        <span class="rating-count">(${result.reviewCount} avis)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="result-skills">
                                <h4>Compétences</h4>
                                <div class="skills-list">
                                    ${result.skills.map((skill) => `<span class="skill-tag">${skill}</span>`).join("")}
                                </div>
                            </div>
                            <div class="result-availability">
                                <h4>Prochaines disponibilités</h4>
                                <div class="availability-slots">
                                    ${result.availability.map((slot) => `<span class="availability-slot">${slot}</span>`).join("")}
                                </div>
                            </div>
                            <div class="result-actions">
                                <button class="btn btn-primary">Réserver une session</button>
                                <button class="btn btn-secondary">Voir le profil</button>
                            </div>
                        </div>
                    `

          resultsList.insertAdjacentHTML("beforeend", resultHTML)
        })

        // Update results count
        if (resultsCount) {
          resultsCount.textContent = filteredResults.length
        }
      }, 300)
    }
  }

  // Helper functions
  function getStars(rating) {
    const fullStars = Math.floor(rating)
    const halfStar = rating % 1 >= 0.5
    const emptyStars = 5 - fullStars - (halfStar ? 1 : 0)

    let stars = ""

    for (let i = 0; i < fullStars; i++) {
      stars += "★"
    }

    if (halfStar) {
      stars += "★"
    }

    for (let i = 0; i < emptyStars; i++) {
      stars += "☆"
    }

    return stars
  }

  // Sample data
  function getSampleResults(query) {
    // In a real application, this would be filtered based on the query
    return [
      {
        name: "Sophie Martin",
        campus: "Paris",
        rating: 5.0,
        reviewCount: 15,
        image: "images/user1.svg",
        skills: ["JavaScript", "React", "Node.js"],
        availability: ["Aujourd'hui, 14:00 - 16:00", "Demain, 10:00 - 12:00", "Vendredi, 15:00 - 17:00"],
      },
      {
        name: "Thomas Dubois",
        campus: "Lyon",
        rating: 4.7,
        reviewCount: 12,
        image: "images/user2.svg",
        skills: ["JavaScript", "Vue.js", "TypeScript"],
        availability: ["Demain, 14:00 - 16:00", "Jeudi, 10:00 - 12:00"],
      },
      {
        name: "Lucas Martin",
        campus: "Paris",
        rating: 4.5,
        reviewCount: 8,
        image: "images/user3.svg",
        skills: ["JavaScript", "Angular", "Firebase"],
        availability: ["Vendredi, 14:00 - 16:00", "Lundi, 10:00 - 12:00"],
      },
    ]
  }

  function getFilteredResults(category, campus, availability, rating) {
    // In a real application, this would filter the actual data
    // For this example, we'll just return a subset of the sample data

    let results = getSampleResults("")

    // Apply filters
    if (category) {
      results = results.filter((result) =>
        result.skills.some((skill) => skill.toLowerCase().includes(category.toLowerCase())),
      )
    }

    if (campus) {
      results = results.filter((result) => result.campus.toLowerCase() === campus.toLowerCase())
    }

    if (rating) {
      results = results.filter((result) => result.rating >= Number.parseFloat(rating))
    }

    // Availability filter would be more complex in a real application

    return results
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

        if (this.textContent === "8") {
          nextButton.disabled = true
        } else {
          nextButton.disabled = false
        }

        // In a real application, this would fetch the next page of results
        // For this example, we'll just scroll to the top of the results
        const resultsSection = document.querySelector(".search-results")
        if (resultsSection) {
          resultsSection.scrollIntoView({ behavior: "smooth" })
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

