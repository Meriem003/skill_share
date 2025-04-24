<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite(['resources/css/header.css'])
    @vite (['resources/css/profile.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <div class="profile-info">
                    <div class="profile-avatar">
                        <img src=".../../../profil.jpg" alt="Photo de profil" id="profile-image">
                    </div>
                    <button class="edit-avatar-btn" id="edit-avatar-btn">
                            <span class="icon">Modifier le profil</span>
                        </button>
                    <div class="profile-details">
                        <h1>Marie Dupont</h1>
                        <p class="profile-campus">Campus de Paris</p>
                        <div class="profile-stats">
                            <div class="stat">
                                <span class="stat-value">4.8</span>
                                <span class="stat-label">Note moyenne</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">12</span>
                                <span class="stat-label">Sessions</span>
                            </div>
                            <div class="stat">
                                <span class="stat-value">850</span>
                                <span class="stat-label">Points</span>
                            </div>
                        </div>
                    </div>
                    <button class="edit-profile-btn" id="edit-profile-btn">Modifier le profil</button>
                </div>
            </div>

            <div class="profile-content">
                <div class="profile-tabs">
                    <button class="tab-btn active" data-tab="skills">Compétences</button>
                    <button class="tab-btn" data-tab="reviews">Évaluations</button>
                    <button class="tab-btn" data-tab="badges">Badges</button>
                </div>

                <div class="tab-content active" id="skills-tab">
                    <div class="skills-section">
                        <div class="skills-category">
                            <h3>Compétences à enseigner</h3>
                            <div class="skills-list">
                                <span class="skill-tag">Programmation JavaScript</span>
                                <span class="skill-tag">Design UI/UX</span>
                                <span class="skill-tag">Photographie</span>
                                <span class="skill-tag">Anglais</span>
                            </div>
                        </div>
                        <div class="skills-category">
                            <h3>Compétences à apprendre</h3>
                            <div class="skills-list">
                                <span class="skill-tag">Python</span>
                                <span class="skill-tag">Marketing digital</span>
                                <span class="skill-tag">Espagnol</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="reviews-tab">
                    <div class="reviews-summary">
                        <div class="rating-overview">
                            <div class="rating-number">4.8</div>
                            <div class="rating-stars">★★★★★</div>
                            <div class="rating-count">12 évaluations</div>
                        </div>
                        <div class="rating-bars">
                            <div class="rating-bar">
                                <span class="rating-label">5 ★</span>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 80%;"></div>
                                </div>
                                <span class="rating-count">10</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-label">4 ★</span>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 15%;"></div>
                                </div>
                                <span class="rating-count">2</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-label">3 ★</span>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%;"></div>
                                </div>
                                <span class="rating-count">0</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-label">2 ★</span>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%;"></div>
                                </div>
                                <span class="rating-count">0</span>
                            </div>
                            <div class="rating-bar">
                                <span class="rating-label">1 ★</span>
                                <div class="progress-bar">
                                    <div class="progress" style="width: 0%;"></div>
                                </div>
                                <span class="rating-count">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="reviews-list">
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer">
                                    <img src="images/user2.svg" alt="Photo de profil">
                                    <div>
                                        <h4>Thomas Dubois</h4>
                                        <div class="review-stars">★★★★★</div>
                                    </div>
                                </div>
                                <div class="review-date">15 mai 2023</div>
                            </div>
                            <div class="review-content">
                                <p>Marie est une excellente enseignante ! Elle a su m'expliquer les concepts de JavaScript de manière claire et concise. Je recommande vivement ses sessions.</p>
                            </div>
                            <div class="review-session">
                                <span>Session : Initiation au JavaScript</span>
                            </div>
                        </div>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer">
                                    <img src="images/user4.svg" alt="Photo de profil">
                                    <div>
                                        <h4>Emma Petit</h4>
                                        <div class="review-stars">★★★★★</div>
                                    </div>
                                </div>
                                <div class="review-date">12 mai 2023</div>
                            </div>
                            <div class="review-content">
                                <p>J'ai beaucoup appris lors de notre session sur le design d'interfaces. Marie maîtrise parfaitement son sujet et sait le transmettre avec passion.</p>
                            </div>
                            <div class="review-session">
                                <span>Session : Design d'interfaces</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="badges-tab">
                    <div class="badges-grid">
                        <div class="badge-card">
                            <div class="badge-icon">🏆</div>
                            <h4>Top Mentor</h4>
                            <p>Obtenu pour avoir reçu plus de 10 évaluations 5 étoiles</p>
                        </div>
                        <div class="badge-card">
                            <div class="badge-icon">🚀</div>
                            <h4>Débutant Enthousiaste</h4>
                            <p>Obtenu pour avoir complété 5 sessions d'enseignement</p>
                        </div>
                        <div class="badge-card">
                            <div class="badge-icon">🧠</div>
                            <h4>Apprenant Assidu</h4>
                            <p>Obtenu pour avoir participé à 5 sessions d'apprentissage</p>
                        </div>
                        <div class="badge-card locked">
                            <div class="badge-icon">💯</div>
                            <h4>Expert</h4>
                            <p>Complétez 20 sessions d'enseignement pour débloquer ce badge</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/profile.js'])
</body>
</html>

