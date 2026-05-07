<?php 
include_once 'includes/dashboard_head.php';

//recup données en bdd pour afficher les articles
$stmt = Database::getInstance()->query("SELECT * FROM csm_article ORDER BY date_event DESC");
$articles = $stmt->fetchAll();

$page_title = "Dashboard - CSM fight team";
$meta_description="Tableau de bord administrateur du CSM Fight Team. Gestion des articles, événements et contenus du site.";
include_once 'includes/dashboard_header.php';
?>

<main class="p16">
  <div class="mw-950px mil-auto">

<div class="bg-catalogue">

    <h2 class="fs-32 color-w mb-24">Créer un nouvel article</h2>
     <a href="add_article.php" class="btn-logout-container"><span class="btn-logout">Créer un article</span></a>

    <h2 class="fs-32 color-w mt-24 mb-24">Modifier un article</h2>
 
        <div class="dashboard-grid">
        <?php if ($articles) : ?>
        <?php foreach ($articles as $element) : ?>
            <article class="articleCard">
                <img src="<?= htmlspecialchars($element['img_event']) ?>" alt="Photo de l'événement">
                <div class="articleCard-body">
                    <p class="dateCard catalogueCard"><?= htmlspecialchars($element['date_event']) ?></p>
                    <h2 class="titreCard catalogueCard"><?= htmlspecialchars($element['title']) ?></h2>
                    <div class="dflex fd-c gap-8 mt-16">
                    <a href="update_article.php?aid=<?=$element['id_article']?>" class="btn-logout-container"><span class="btn-logout">Modifier un article</span></a>
                    <a href="?delete=<?=$element['id_article']?>" class="btn-delete-container" onclick="return confirm('Etes-vous sur de vouloir supprimer cet article?')"><span class="btn-delete">Supprimer cet article</span></a>
                </div>
                </div>
            </article>
        <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun article disponible.</p>
        <?php endif; ?>

    </div>


</div>
</div>
</main>
<?php include_once 'includes/footer.php'; ?>
</body>
</html>