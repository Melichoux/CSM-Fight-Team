<?php
    include_once 'includes/head.php';
// -------- requete pour carroussel -----------
    $stmt = Database::getInstance()->prepare("SELECT id_article, date_event, img_event, title, intro, description, created_at FROM csm_article 
        ORDER BY date_event DESC
        LIMIT 3");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  -------- fin carroussel ---------------
    $page_title="CSM Fight Team - Accueil";
    $meta_description="Bienvenue sur le site du CSM FIGHT TEAM, club de judo-jujitsu marseillais.";
    include_once 'includes/header.php';
    ?>
    <main>
      <div class="bg-hero">
        <h1 class="ta-c mb-24 ">Bienvenu au CSM Fight Team</h1>
        <div class="hero-grid">
          <div>
            <h2>À la une</h2>
            <p class="italic">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati tempore nisi ab accusantium dolor perferendis recusandae ea iusto placeat pariatur esse incidunt, fugit earum minima iste magni fugiat, cum temporibus.</p>
            <a href="#" class="underline">En savoir +</a>
          </div>
          <div>
            <img src="assets/images/two-judo-wrestlers-showing-their-technical-skills-fight-club.jpg" alt="Photo judo" class="color-w img-hero">
          </div>
        </div>
      </div>
            <div class="home-news">
<h2 class="mb-16">Ce que vous avez raté...</h2>
<div class="carrousel">
  <div class="carrousel__slides">

   <?php if ($articles) : ?>
    <?php foreach ($articles as $index => $article): ?>
      <div class="carrousel__slide <?= $index === 0 ? 'active' : '' ?>">
        <img src="<?= htmlspecialchars($article['img_event']) ?>" alt="<?= htmlspecialchars($article['title']) ?>">
        <div class="carrousel__content">
          <p class="carrousel__date"><?= date('d/m/Y', strtotime($article['date_event'])) ?></p>
          <h2><?= htmlspecialchars($article['title']) ?></h2>
          <p><?= htmlspecialchars($article['intro']) ?></p>
          <a href="article.php?id=<?= htmlspecialchars($article['id_article']) ?>">Lire la suite →</a>
        </div>
      </div>
    <?php endforeach; ?>
    <?php else : ?>
      <p>Aucun article disponible pour le moment.</p>
    <?php endif; ?>

  </div>

  <!-- Boutons navigation -->
  <button class="carrousel__btn prev" onclick="changeSlide(-1)">&#10094;</button>
  <button class="carrousel__btn next" onclick="changeSlide(1)">&#10095;</button>

  <!-- Points indicateurs -->
  <div class="carrousel__dots">
    <?php for ($i = 0; $i < count($articles); $i++): ?>
      <span class="dot <?= $i === 0 ? 'active' : '' ?>" onclick="goToSlide(<?= $i ?>)"></span>
    <?php endfor; ?>
  </div>
</div>
    </div>
    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
    <script src="assets/javascript/index.js" defer></script>
</body>
</html>
