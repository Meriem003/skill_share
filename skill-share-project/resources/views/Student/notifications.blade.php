<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - SkillShare</title>
    @vite (['resources/css/style.css'])
    @vite (['resources/css/notifications.css'])
</head>
<body>
@include('includes.header')
    <main class="main-content">
        <div class="notifications-container">
            <div class="notifications-header">
                <h1>Notifications</h1>
                <div class="notifications-actions">
                    <button class="btn btn-secondary" id="mark-all-read-btn">Tout marquer comme lu</button>
                    <div class="notifications-filter">
                        <label for="filter-notifications">Filtrer :</label>
                        <select id="filter-notifications">
                            <option value="all">Toutes</option>
                            <option value="unread">Non lues</option>
                            <option value="sessions">Sessions</option>
                            <option value="reviews">Évaluations</option>
                            <option value="badges">Badges</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="notifications-list">
                <div class="notification-item unread" data-type="sessions">
                    <div class="notification-icon" style="background-color: #F8C8DC;">📚</div>
                    <div class="notification-content">
                        <p>Votre session <strong>JavaScript</strong> avec Thomas est confirmée pour demain à 14:30</p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir les détails</button>
                            <button class="btn btn-sm btn-secondary">Ajouter au calendrier</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 10 minutes</span>
                            <button class="notification-mark-read">Marquer comme lu</button>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item unread" data-type="reviews">
                    <div class="notification-icon" style="background-color: #E6A4B4;">⭐</div>
                    <div class="notification-content">
                        <p>Thomas vous a donné une évaluation 5 étoiles pour votre session <strong>Introduction à JavaScript</strong></p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir l'évaluation</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 2 heures</span>
                            <button class="notification-mark-read">Marquer comme lu</button>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item unread" data-type="badges">
                    <div class="notification-icon" style="background-color: #F8C8DC;">🏆</div>
                    <div class="notification-content">
                        <p>Félicitations ! Vous avez obtenu le badge <strong>Top Mentor</strong> pour avoir reçu plus de 10 évaluations 5 étoiles</p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir le badge</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 1 jour</span>
                            <button class="notification-mark-read">Marquer comme lu</button>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item" data-type="sessions">
                    <div class="notification-icon" style="background-color: #E6A4B4;">👥</div>
                    <div class="notification-content">
                        <p>Sophie a réservé une session <strong>Design d'interfaces</strong> avec vous pour le 12 juin à 15:00</p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Accepter</button>
                            <button class="btn btn-sm btn-secondary">Proposer un autre créneau</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 2 jours</span>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item" data-type="sessions">
                    <div class="notification-icon" style="background-color: #F8C8DC;">📅</div>
                    <div class="notification-content">
                        <p>Rappel : Votre session <strong>Bases du Python</strong> avec Lucas est prévue demain à 10:00</p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir les détails</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 3 jours</span>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item" data-type="reviews">
                    <div class="notification-icon" style="background-color: #E6A4B4;">💬</div>
                    <div class="notification-content">
                        <p>Emma a laissé un commentaire sur votre profil : <em>"Marie est une excellente enseignante, très patiente et pédagogue !"</em></p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir le commentaire</button>
                            <button class="btn btn-sm btn-secondary">Répondre</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 5 jours</span>
                        </div>
                    </div>
                </div>
                
                <div class="notification-item" data-type="badges">
                    <div class="notification-icon" style="background-color: #F8C8DC;">🚀</div>
                    <div class="notification-content">
                        <p>Vous avez obtenu le badge <strong>Débutant Enthousiaste</strong> pour avoir complété 5 sessions d'enseignement</p>
                        <div class="notification-actions">
                            <button class="btn btn-sm btn-primary">Voir le badge</button>
                        </div>
                        <div class="notification-meta">
                            <span class="notification-time">Il y a 1 semaine</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="notifications-pagination">
                <button class="pagination-btn prev" disabled>Précédent</button>
                <div class="pagination-numbers">
                    <button class="pagination-number active">1</button>
                    <button class="pagination-number">2</button>
                    <button class="pagination-number">3</button>
                </div>
                <button class="pagination-btn next">Suivant</button>
            </div>
            
            <div class="notifications-preferences">
                <h3>Préférences de notification</h3>
                <p>Personnalisez les types de notifications que vous souhaitez recevoir</p>
                <form class="preferences-form">
                    <div class="preference-group">
                        <h4>Notifications par email</h4>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="email-sessions" checked>
                                <label for="email-sessions">Sessions (confirmations, rappels)</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="email-reviews" checked>
                                <label for="email-reviews">Évaluations et commentaires</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="email-badges" checked>
                                <label for="email-badges">Badges et récompenses</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="email-newsletter">
                                <label for="email-newsletter">Newsletter et actualités</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="preference-group">
                        <h4>Notifications sur la plateforme</h4>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="platform-sessions" checked>
                                <label for="platform-sessions">Sessions (confirmations, rappels)</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="platform-reviews" checked>
                                <label for="platform-reviews">Évaluations et commentaires</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="platform-badges" checked>
                                <label for="platform-badges">Badges et récompenses</label>
                            </div>
                        </div>
                        <div class="preference-item">
                            <div class="checkbox-wrapper">
                                <input type="checkbox" id="platform-todo" checked>
                                <label for="platform-todo">Rappels de tâches</label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enregistrer les préférences</button>
                </form>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/notifications.js'])
</body>
</html>

