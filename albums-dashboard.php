<?php
include_once 'includes/head.php';

if(!isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit;
}
?>
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
                <a href="dashboard.php">
                    <!-- a voir si on place le logo dans une div ou pas besoin -->
                    <img class="logoNav" src="assets/images/Logo CSM Fight Club.png" alt="Logo du club CSM Fight Team - retour a la page d'accueil">
                </a>
            </div>
                <div class="dflex jc-c ai-c mb-32 mt-32">
                <h1 class="fs-32">Bienvenue sur ton espace administrateur !</h1>
                </div>
            </div>
            <div class="ta-e mt-16">
                <div class="btn-logout-container">
                    <a class="btn-logout" href="logout.php">Déconnexion</a>
                </div>
            </div>
    </header>
<?php include_once 'includes/subnav.php'; ?>
<main class="p16">
</main>
<?php include_once 'includes/footer.php'; ?>
</body>
</html>