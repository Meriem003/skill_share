document.addEventListener("DOMContentLoaded", () => {
  // Testimonials slider
  const testimonials = document.querySelectorAll(".testimonial")
  const dots = document.querySelectorAll(".dot")
  let currentSlide = 0

  // Function to show a specific slide
  function showSlide(index) {
    // Hide all testimonials
    testimonials.forEach((testimonial) => {
      testimonial.style.display = "none"
    })

    // Remove active class from all dots
    dots.forEach((dot) => {
      dot.classList.remove("active")
    })

    // Show the selected testimonial
    testimonials[index].style.display = "block"

    // Add active class to the corresponding dot
    dots[index].classList.add("active")

    // Update current slide
    currentSlide = index
  }

  // Initialize: show the first slide
  showSlide(0)

  // Add click event to dots
  if (dots.length > 0) {
    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => {
        showSlide(index)
      })
    })
  }

  // Auto-advance slides every 5 seconds
  setInterval(() => {
    // Calculate next slide index
    const nextSlide = (currentSlide + 1) % testimonials.length

    // Show next slide
    showSlide(nextSlide)
  }, 5000)

  // Hero section animation
  const heroContent = document.querySelector(".hero-content")
  const heroImage = document.querySelector(".hero-image")

  if (heroContent && heroImage) {
    // Add animation classes
    heroContent.classList.add("animate-fade-in")
    heroImage.classList.add("animate-slide-in")

    // Define animation styles
    const style = document.createElement("style")
    style.textContent = `
          @keyframes fadeIn {
              from { opacity: 0; transform: translateY(20px); }
              to { opacity: 1; transform: translateY(0); }
          }
          
          @keyframes slideIn {
              from { opacity: 0; transform: translateX(50px); }
              to { opacity: 1; transform: translateX(0); }
          }
          
          .animate-fade-in {
              animation: fadeIn 1s ease-out forwards;
          }
          
          .animate-slide-in {
              animation: slideIn 1s ease-out forwards;
          }
      `

    document.head.appendChild(style)
  }

  // Feature cards hover effect
  const featureCards = document.querySelectorAll(".feature-card")

  if (featureCards.length > 0) {
    featureCards.forEach((card) => {
      card.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-10px)"
        this.style.boxShadow = "0 15px 30px rgba(0, 0, 0, 0.1)"
      })

      card.addEventListener("mouseleave", function () {
        this.style.transform = "translateY(0)"
        this.style.boxShadow = "0 2px 10px rgba(0, 0, 0, 0.1)"
      })
    })
  }

  // CTA button effect
  const ctaButton = document.querySelector(".cta .btn-primary")

  if (ctaButton) {
    ctaButton.addEventListener("mouseenter", function () {
      this.style.transform = "scale(1.05)"
    })

    ctaButton.addEventListener("mouseleave", function () {
      this.style.transform = "scale(1)"
    })
  }

  // Scroll to features section
  const heroButtons = document.querySelector(".hero-buttons")
  const featuresSection = document.querySelector(".features")

  if (heroButtons && featuresSection) {
    const scrollButton = document.createElement("a")
    scrollButton.href = "#features"
    scrollButton.className = "btn btn-tertiary"
    scrollButton.textContent = "En savoir plus"
    scrollButton.style.marginLeft = "10px"

    heroButtons.appendChild(scrollButton)

    // Add ID to features section
    featuresSection.id = "features"

    // Smooth scroll
    scrollButton.addEventListener("click", (e) => {
      e.preventDefault()

      featuresSection.scrollIntoView({ behavior: "smooth" })
    })
  }

  // Newsletter form
  const newsletterForm = document.querySelector(".newsletter-form")

  if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (e) {
      e.preventDefault()

      const emailInput = this.querySelector('input[type="email"]')
      const email = emailInput.value

      if (email) {
        // In a real application, this would submit the form to the server
        // For this example, we'll just show a success message

        // Create success message
        const successMessage = document.createElement("div")
        successMessage.className = "newsletter-success"
        successMessage.textContent = `Merci ! Votre email ${email} a été ajouté à notre liste de diffusion.`
        successMessage.style.color = "#4CAF50"
        successMessage.style.marginTop = "10px"

        // Replace form with success message
        this.innerHTML = ""
        this.appendChild(successMessage)
      }
    })
  }

  // Social links
  const socialLinks = document.querySelectorAll(".social-link")

  if (socialLinks.length > 0) {
    socialLinks.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault()

        const platform = this.textContent.trim()

        // In a real application, this would open the social media page
        alert(`Redirection vers ${platform} non implémentée dans cet exemple.`)
      })
    })
  }
})

