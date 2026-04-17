<?php 
include_once 'includes/dashboard_head.php';

//recup données en bdd pour afficher les articles
$stmt = Database::getInstance()->query("SELECT * FROM csm_article ORDER BY date_event DESC");
$articles = $stmt->fetchAll();

$page_title = "dashboard";
include_once 'includes/dashboard_header.php';
?>

<main class="p16">
  <div class="container mw-950px mil-auto">

<div class="dashboardCard">
<div class="dflex jc-sb ai-c mb-16">
    <h2 class="fs-32 color-w">Créer un nouvel article</h2>
     <a href="add_article.php" class="btn-logout-container"><span class="btn-logout">Créer un article</span></a>
</div>
</div>

<div class="dashboardCard">
    <h2 class="fs-32 color-w">Modifier un article</h2>
 
        <div class="dashboard-grid">
        <?php foreach ($articles as $element) : ?>
            <article class="articleCard">
                <img src="<?= htmlspecialchars($element['img_event']) ?>" alt="Photo de l'événement">
                <div class="articleCard-body">
                    <p class="dateCard catalogueCard"><?= htmlspecialchars($element['date_event']) ?></p>
                    <h2 class="titreCard catalogueCard"><?= htmlspecialchars($element['title']) ?></h2>
                    <div class="dflex fd-c gap-8 mt-16">
                    <a href="update_article.php?aid=<?=$element['id_article']?>" class="btn-logout-container"><span class="btn-logout">Modifier un article</span></a>
                    <a href="?delete=<?=$element['id_article']?>" class="btn-logout-container" onclick="return confirm('Etes-vous sur de vouloir supprimer cet article?')"><span class="btn-logout">Supprimer cet article</span></a>
                </div>
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