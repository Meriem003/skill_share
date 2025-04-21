<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite (['resources/css/style.css'])
    @vite (['resources/css/privacy.css'])
</head>
<body>
@include('includes.header')

    <main class="main-content">
        <div class="privacy-container">
            <div class="privacy-header">
                <h1>Politique de confidentialité</h1>
                <p>Dernière mise à jour : 1 juin 2023</p>
            </div>
            
            <div class="privacy-content">
                <section class="privacy-section">
                    <h2>1. Introduction</h2>
                    <p>Bienvenue sur SkillShare. Nous nous engageons à protéger votre vie privée et à traiter vos données personnelles avec transparence. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations lorsque vous utilisez notre plateforme.</p>
                </section>
                
                <section class="privacy-section">
                    <h2>2. Informations que nous collectons</h2>
                    <p>Nous collectons les types d'informations suivants :</p>
                    <ul>
                        <li><strong>Informations de compte :</strong> Lorsque vous vous inscrivez, nous collectons votre nom, adresse e-mail, mot de passe et campus.</li>
                        <li><strong>Informations de profil :</strong> Vos compétences, photo de profil, biographie et autres informations que vous choisissez de partager.</li>
                        <li><strong>Données d'utilisation :</strong> Informations sur la façon dont vous utilisez notre plateforme, y compris les sessions réservées, les évaluations et les interactions avec d'autres utilisateurs.</li>
                        <li><strong>Informations techniques :</strong> Adresse IP, type de navigateur, appareil utilisé et données de connexion.</li>
                    </ul>
                </section>
                
                <section class="privacy-section">
                    <h2>3. Comment nous utilisons vos informations</h2>
                    <p>Nous utilisons vos informations pour :</p>
                    <ul>
                        <li>Fournir, maintenir et améliorer notre plateforme</li>
                        <li>Faciliter les réservations de sessions entre utilisateurs</li>
                        <li>Personnaliser votre expérience et vous proposer du contenu pertinent</li>
                        <li>Communiquer avec vous concernant votre compte, les sessions et les mises à jour</li>
                        <li>Assurer la sécurité de notre plateforme et prévenir les fraudes</li>
                        <li>Analyser l'utilisation de notre plateforme pour l'améliorer</li>
                    </ul>
                </section>
                
                <section class="privacy-section">
                    <h2>4. Partage de vos informations</h2>
                    <p>Nous ne vendons pas vos données personnelles. Nous pouvons partager vos informations dans les situations suivantes :</p>
                    <ul>
                        <li><strong>Avec d'autres utilisateurs :</strong> Votre profil, vos compétences et vos évaluations sont visibles par les autres utilisateurs de la plateforme.</li>
                        <li><strong>Avec des prestataires de services :</strong> Nous travaillons avec des tiers qui nous aident à fournir nos services (hébergement, analyse, etc.).</li>
                        <li><strong>Pour des raisons légales :</strong> Si nous sommes légalement tenus de le faire ou pour protéger nos droits.</li>
                    </ul>
                </section>
                
                <section class="privacy-section">
                    <h2>5. Vos droits et choix</h2>
                    <p>Vous disposez de plusieurs droits concernant vos données personnelles :</p>
                    <ul>
                        <li>Accéder à vos données personnelles</li>
                        <li>Rectifier vos données si elles sont inexactes</li>
                        <li>Supprimer vos données dans certaines circonstances</li>
                        <li>Limiter ou vous opposer au traitement de vos données</li>
                        <li>Exporter vos données dans un format structuré</li>
                    </ul>
                    <p>Pour exercer ces droits, contactez-nous à privacy@skillshare.com.</p>
                </section>
                
                <section class="privacy-section">
                    <h2>6. Sécurité des données</h2>
                    <p>Nous mettons en œuvre des mesures de sécurité techniques et organisationnelles pour protéger vos données contre tout accès non autorisé, perte ou altération. Cependant, aucune méthode de transmission sur Internet ou de stockage électronique n'est totalement sécurisée.</p>
                </section>
                
                <section class="privacy-section">
                    <h2>7. Conservation des données</h2>
                    <p>Nous conservons vos données personnelles aussi longtemps que nécessaire pour fournir nos services et respecter nos obligations légales. Si vous supprimez votre compte, nous supprimerons ou anonymiserons vos données personnelles, sauf si nous devons les conserver pour des raisons légales.</p>
                </section>
                
                <section class="privacy-section">
                    <h2>8. Modifications de cette politique</h2>
                    <p>Nous pouvons mettre à jour cette politique de confidentialité de temps à autre. Nous vous informerons de tout changement important par e-mail ou par une notification sur notre plateforme.</p>
                </section>
                
                <section class="privacy-section">
                    <h2>9. Nous contacter</h2>
                    <p>Si vous avez des questions concernant cette politique de confidentialité ou la façon dont nous traitons vos données, veuillez nous contacter à :</p>
                    <p>Email : privacy@skillshare.com</p>
                    <p>Adresse : 123 Avenue de l'Innovation, 75001 Paris, France</p>
                </section>
            </div>
        </div>
    </main>

    @include('includes.footer')
    @vite (['resources/js/main.js'])
    @vite (['resources/js/privacy.js'])
</body>
</html>

