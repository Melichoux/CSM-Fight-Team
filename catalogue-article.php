<?php
include_once 'includes/head.php';
?>
    <?php
      include_once 'includes/header.php';
    ?>
    <main>
        <h1>Toutes nos actualités</h1>

        <form action="#" method="post" id="formFilter" class="dflex jc-c ">
            <label for="filter" class="color-w"> Filtrer les actualités 
                <select name="filter" id="filter" placeholder="--Séléctionner un filtre--">
                    <option value="default">--Séléctionner un filtre--</option>
                    <option value="Judo">Judo</option>
                    <option value="Jujitsu">Jujitsu</option>
                    <option value="Compétition">Compétition</option>
                    <option value="Arbitrage">Arbitrage</option>
                    <option value="Stage">Stage</option>
                </select>            
            </label>                     
            
            <!-- <input type="submit" id="submit" name="submit" value="OK"> -->
                <!-- Pas besoin de label car j'ai uniquement besoin du bouton. Du coup, pas de probleme d'alignement entre la checkbox et le bouton -->   
        </form>
        <div class="article-container mw-950px dflex fw-w gap-24 jc-c mil-auto">
            <?php 
                $stmt = Database::getInstance()->query("SELECT * FROM csm_article ORDER BY date_event DESC");
                $articles = $stmt->fetchAll();
                foreach($articles as $element) : ?>

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
        </div>
    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
    <!-- <script src="assets/javascript/index.js">  
    </script> -->
</body>
</html>