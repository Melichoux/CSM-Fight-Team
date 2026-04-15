<?php 
include_once 'includes/dashboard_head.php';
?>
<?php 
$page_courant = "dashboard";
include_once 'includes/dashboard_header.php';
?>

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