<?php
include_once 'includes/head.php';
$page_title = "Catalogue - CSM fight team";
$meta_description =" Retrouvez toutes les actualités et articles du CSM Fight Team : événements, compétitions et résultats de notre club marseillais.";
include_once 'includes/header.php';
// var_dump($_POST['filter']);
if (isset($_POST['filter']) && $_POST['filter'] !== 'default') {
    $stmt = Database::getInstance()->prepare("SELECT * FROM csm_article as csm_a 
        JOIN csm_article_tag as csm_at ON csm_a.id_article = csm_at.id_article 
        AND id_tag = :filter 
        ORDER BY date_event DESC");
    $stmt->execute([':filter' => $_POST['filter']]);
} else {
    $stmt = Database::getInstance()->query("SELECT * FROM csm_article ORDER BY date_event DESC");
};
$articles = $stmt->fetchAll();
?>
<main> 
    <form action="#" method="post" id="block-blue" class="dflex jc-c">
        <label for="filter" class="color-w"> Filtrer les actualités
            <select name="filter" id="filter" placeholder="--Séléctionner un filtre--" onchange = "this.form.submit()">
                <option value="default">--Séléctionner un filtre--</option>
                <?php
                $tags_list = Database::getInstance()->query("SELECT * FROM csm_tag ORDER BY tag");
                foreach ($tags_list as $tag): /* creation d'une checkbox avec toutes les valeurs de la table tag ce qui permet de recuperer l'id et la valeur associée sans se tromper pour lier id et valeur coté user*/ ?>
                     <option value="<?= $tag['id_tag'] ?>" <?= isset($_POST['filter']) && $_POST['filter'] == $tag['id_tag'] ? 'selected' : '' ?>>
                         <?= htmlspecialchars($tag['tag']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <!-- <input type="submit" id="submit" name="submit" value="OK"> -->
                <!-- Pas besoin de label car j'ai uniquement besoin du bouton. Du coup, pas de probleme d'alignement entre la checkbox et le bouton -->
            </form>
    <div class="bg-catalogue">
        <h1 class="mb-16">Toutes nos actualités</h1>
    <div class="mw-1200px dflex fw-w gap-24 jc-c mil-auto">
        <?php if ($articles) : ?>
        <?php
        foreach ($articles as $element) : ?>

            <article class="articleCard">
                <img src="<?= htmlspecialchars($element['img_event']) ?>" alt="Photo de l'événement">
                <div>
                    <p class="dateCard catalogueCard"><?= htmlspecialchars($element['date_event']) ?></p>
                    <h2 class="titreCard catalogueCard"><?= htmlspecialchars($element['title']) ?></h2>
                    <p class="introCard catalogueCard"><?= htmlspecialchars($element['intro']) ?></p>
                    <a href="article.php?id=<?= $element['id_article'] ?>" class="btnCard catalogueCard">En savoir +</a>
                </div>
            </article>
        <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun article disponible pour le moment.</p>
        <?php endif; ?>
    </div>
        </div>
</main>
<?php
include_once 'includes/footer.php';
?>
</body>

</html>