        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <meta name="description" content="Bienvenue sur le site du CSM FIGHT TEAM, club de judo-jujitsu marseillais." />
</head>

<body>
    <header>
        <div class="container">
            <div class="cadreLogo">
                <a href="index.php">
                    <!-- a voir si on place le logo dans une div ou pas besoin -->
                    <img class="logoNav" src="assets/images/Logo CSM Fight Club.png" alt="Logo du club CSM Fight Team - retour a la page d'accueil">
                </a>
            </div>
            <!-- 0.5rem 4rem 2rem 0.5rem; a appliquer sur l'image pour recreer le design chelou du site -->

            <!-- Bouton pour le menu burger -->
            <nav aria-label="Navigation principale dflex fw-w" class="mainNav">
                <!-- aria-label sert a l'accessibilité pour les malvoyants et permet un meilleur parsing par les moteurs comme google -->
                <ul class="dflex fw-w">
                    <li class="navElmt"><a href="index.php">ACCUEIL</a></li>
                    <li class="navElmt"><a href="catalogue-article.php">ACTUALITES</a></li>
                    <li id="dropDown" class="navElmt">
                        <button id="dropDownBtn"> LA VIE DU CLUB ▾</button>
                        <ul id="dropDownList" class="dflex">
                            <li class="dropDownElmt"><a href="#" class="color-bck">Histoire du Club</a></li>
                            <li class="dropDownElmt"><a href="#" class="color-bck">Galeries Photos</a></li>
                            <li class="dropDownElmt"><a href="#" class="color-bck">Résultats</a></li>
                            <li class="dropDownElmt"><a href="#" class="color-bck">Agenda</a></li>
                        </ul>
                    </li>
                    <li class="navElmt"><a href="#">LES COURS</a></li>
                    <li class="navElmt"><a href="contact.php">CONTACTEZ-NOUS</a></li>
                    <li class="navElmt"><a href="login.php">SE CONNECTER</a></li>

                    <!-- <a href> est utilisé pour de la navigation en interne et en externe à un site => bonne pratique + meilleur referencement au level du SEO + meilleur ancres pour les navigateurs et pour le parsing -->
                </ul>
            </nav>
        </div>

    </header>
