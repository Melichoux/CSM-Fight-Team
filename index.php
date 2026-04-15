<?php
    include_once 'includes/head.php';
// -------- requete pour carroussel -----------
    $stmt = Database::getInstance()->prepare("SELECT id_article, date_event, img_event, title, intro, description, created_at FROM csm_article 
        ORDER BY date_event DESC
        LIMIT 3");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  -------- fin carroussel ---------------
    $page_title="Acceuil";
    include_once 'includes/header.php';
    ?>
    <main>
        <h1 class="ai-c border-b">Bienvenu au CSM Fight Team</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam natus ab possimus dolores adipisci culpa architecto nostrum molestiae expedi.</p>
<h2>Prochains événements</h2>

<h2>Ce que vous avez raté...</h2>

<div class="carrousel">
  <div class="carrousel__slides">
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

    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
    <script src="assets/javascript/index.js" defer></script>
</body>
</html>
