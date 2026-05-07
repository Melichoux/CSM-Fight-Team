<?php
    include_once 'includes/head.php';

    $stmt = Database::getInstance()->prepare("SELECT * FROM csm_article WHERE id_article = :id");
    $stmt->execute([':id' => $_GET['id']]); // id est recup grace a $_GET car on a integré l'id dans l'url dans la requete de la page catalogue
    $element = $stmt->fetch(); // pas de fetchAll car recup 1 seul article

    $page_title = "Article - CSM fight team";
    $meta_description="Actualité du CSM Fight Team, club de judo et jujitsu à Marseille. Résultats, événements et vie associative.";
    include_once 'includes/header.php';
    ?>
    <main>
        <div class="pageArticle dflex  jc-c  ">
            <?php if ($element) : ?>
                <article class="articleSeul">
                    <img src="<?= htmlspecialchars($element['img_event']) ?>" alt="Photo de l'événement">
                    <div>
                        <p class="dateArticle"><?= htmlspecialchars($element['date_event']) ?></p>
                        <h1 class="titreArticle"><?= htmlspecialchars($element['title']) ?></h1>
                        <p class="descrArticle"><?= htmlspecialchars($element['intro']) ?></p>
                    </div>
                </article>
            <?php else : ?>
                <p>Article introuvable.</p>
            <?php endif; ?>
        </div>
    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
     <script src="assets/javascript/index.js"></script>
</body>

</html>