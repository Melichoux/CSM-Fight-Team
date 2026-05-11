        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <link rel="stylesheet" href="assets/css/main.css">    
    <meta name="description" content= "<?=$meta_description?>"/>
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
            <nav aria-label="Navigation principale" class="mainNav">
                <!-- aria-label sert a l'accessibilité pour les malvoyants et permet un meilleur parsing par les moteurs comme google -->
                <ul class="dflex fw-w">
                    <li class="navElmt"><a href="index.php">ACCUEIL</a></li>
                    <li class="navElmt"><a href="catalogue_article.php">ACTUALITES</a></li>
                    <li id="dropDown" class="navElmt">
                        <button id="dropDownBtn"> LA VIE DU CLUB ▾</button>
                        <ul id="dropDownList" class="dflex">
                            <li class="dropDownElmt"><a href="club_history.php" class="color-bck">Histoire du Club</a></li>
                            <li class="dropDownElmt"><a href="gallery.php" class="color-bck">Galeries Photos</a></li>
                            <li class="dropDownElmt"><a href="results.php" class="color-bck">Résultats</a></li>
                            <li class="dropDownElmt"><a href="events.php" class="color-bck">Agenda</a></li>
                        </ul>
                    </li>
                    <li class="navElmt"><a href="training.php">LES COURS</a></li>
                    <li class="navElmt"><a href="contact.php">CONTACTEZ-NOUS</a></li>
                    <li class="navElmt"><a href="login.php">SE CONNECTER</a></li>

                    <!-- <a href> est utilisé pour de la navigation en interne et en externe à un site => bonne pratique + meilleur referencement au level du SEO + meilleur ancres pour les navigateurs et pour le parsing -->
                </ul>
    </nav>
                <!-- Menu burger -->
        <button id="burgerBtn" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

                <div id="sidebarOverlay"></div>
                <nav id="sidebar" aria-label="Menu mobile">
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="catalogue_article.php">Actualités</a></li>
                        <li><a href="club_history.php">La vie du club</a></li>
                        <li class="sidebar-sub"><a href="club_history.php">Histoire du Club</a></li>
                        <li class="sidebar-sub"><a href="gallery.php">Galeries Photos</a></li>
                        <li class="sidebar-sub"><a href="results.php">Résultats</a></li>
                        <li class="sidebar-sub"><a href="events.php">Agenda</a></li>
                        <li><a href="training.php">Les cours</a></li>
                        <li><a href="contact.php">Contactez-nous</a></li>
                        <li><a href="login.php">Se connecter</a></li>
                    </ul>
                    </nav>
                </div>


    </header>
