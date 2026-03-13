<?php
include_once 'includes/head.php';

if(!isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit;
}

$supress_message= "";

if(isset($_GET['delete'])){
$stmt = Database::getInstance()->prepare("DELETE  FROM csm_article WHERE id_article=:id");// : apres le egal correspond a un "prepare"
$stmt->execute([':id'=>$_GET['delete']]);
$supress_message ="L'article a bien été supprimé.";
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

<main class="p16">
  <div class="container mw-950px mil-auto">

<div class="dashboardCard">
    <?php
    if(!empty($supress_message)):?>
    <div>
        <?= $supress_message ?>
    </div>
    <?php endif;?>
<div>
    <h2 class="fs-32 color-w">Créer un nouvel article</h2>
     <a href="add_article.php" class="btn-logout-container"><span class="btn-logout">Créer un article</span></a>
</div>

<div>
    <h2 class="fs-32 color-w">Modifier un article</h2>
    <?php
        $stmt = Database::getInstance()->query("SELECT * FROM csm_article ORDER BY date_event DESC");
        $articles = $stmt->fetchAll();
        foreach ($articles as $element) : ?>

            <article class="articleCard">
                <img src="<?= htmlspecialchars($element['img_event']) ?>" alt="Photo de l'événement">
                <div>
                    <p class="dateCard catalogueCard"><?= htmlspecialchars($element['date_event']) ?></p>
                    <h2 class="titreCard catalogueCard"><?= htmlspecialchars($element['title']) ?></h2>
                    <p class="introCard catalogueCard"><?= htmlspecialchars($element['intro']) ?></p>
                    <a href="update_article.php?aid=<?=$element['id_article']?>" class="btn-logout-container"><span class="btn-logout">Modifier un article</span></a>
                    <a href="?delete=<?=$element['id_article']?>" class="btn-logout-container" onclick="return confirm('Etes-vous sur de vouloir supprimer cet article?')"><span class="btn-logout">Supprimer cet article</span></a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>


</div>
</div>
</main>
<?php include_once 'includes/footer.php'; ?>
</body>
</html>