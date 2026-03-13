<?php
include_once 'includes/head.php';
$tags_update = [];
$stmt = Database::getInstance()->prepare("SELECT * FROM csm_article WHERE id_article=:id ");// : apres le egal correspond a un "prepare"
$stmt->execute([':id'=>$_GET['aid']]);
$result= $stmt->fetch();
$title = $result['title'];
$date_event=$result['date_event'];
$img_event=$result['img_event'];
$intro=$result['intro'];
$description=$result['description'];

$tags = Database::getInstance()->prepare("SELECT * FROM `csm_article_tag` WHERE id_article =:id");
$tags->execute([':id'=>$_GET['aid']]);
$result_tags= $tags->fetchAll();
// var_dump($result_tags);
// var_dump($tags_update);

foreach ($result_tags as $value) {// recuperation des valeurs de la table tag associé a l'article
    $tags_update[]= $value['id_tag']; // ne pas oublier les crochets apres $tags_update sinon retourne un int
}
// var_dump($tags_update);
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
                <h1 class="fs-32">Modifier un article</h1>
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

    <div class="ta-e mt-16">
      <a class="btn-logout-container" href="dashboard.php">
        <span class="btn-logout">Retour au dashboard</span>
      </a>
    </div>
    <div class="form-contact p24 mb-32">
      <form method="post" action="" class="dflex fd-c gap-16">

        <div class="dflex fd-c gap-8">
          <label for="title" class="color-w">Titre </label>
          <input id="title" type="text" placeholder="Votre titre" name="title" value="<?= $title ?>" required />
          <?php if(isset($errors['title'])): ?>
            <p class="color-r"><?= $errors['title'] ?></p>
          <?php endif; ?>
        </div>

        <div class="dflex fd-c gap-8">
          <label for="date_event" class="color-w">Date de l'événement </label>
          <input id="date_event" type="date" name="date_event" value="<?= $date_event ?>" required />
          <?php if(isset($errors['date_event'])): ?>
            <p class="color-r"><?= $errors['date_event'] ?></p>
          <?php endif; ?>
        </div>

        <div class="dflex fd-c gap-8">
          <label for="img_event" class="color-w">Image </label>
          <input id="img_event" type="text" name="img_event" placeholder="assets/images/articles/mon-image.jpg" value="<?= $img_event ?>" required />
          <?php if(isset($errors['img_event'])): ?>
            <p class="color-r"><?= $errors['img_event'] ?></p>
          <?php endif; ?>
        </div>

        <div class="dflex fd-c gap-8">
          <label for="intro" class="color-w">Introduction </label>
          <input id="intro" type="text" name="intro" placeholder="Votre intro!" value="<?= $intro ?>" required />
          <?php if(isset($errors['intro'])): ?>
            <p class="color-r"><?= $errors['intro'] ?></p>
          <?php endif; ?>
        </div>

        <div class="dflex fd-c gap-8">
          <label for="description" class="color-w">Détail de l'article </label>
          <textarea id="description" name="description" placeholder="Texte de l'article"><?= $description ?></textarea>
          <?php if(isset($errors['description'])): ?>
            <p class="color-r"><?= $errors['description'] ?></p>
          <?php endif; ?>
        </div>

        <fieldset class="mb-16">
          <legend class="color-w">Tags</legend>
          <?php
          $stmt = Database::getInstance()->query("SELECT * FROM csm_tag ORDER BY tag");
          $tags_list = $stmt->fetchAll();
          foreach($tags_list as $tag): /* creation d'une checkbox avec toutes les valeurs de la table tag ce qui permet de recuperer l'id et la valeur associée sans se tromper pour lier id et valeur coté user*/?>
            <div class="dflex ai-c gap-8">
              <input type="checkbox" id="tag_<?= $tag['id_tag'] ?>" name="tags[]" value="<?= $tag['id_tag'] ?>" 
                <?= in_array($tag['id_tag'], $tags_update) ? 'checked' : '' ?>
              <label for="tag_<?= $tag['id_tag'] ?>" class="color-w"><?= htmlspecialchars($tag['tag']) ?></label>
            </div>
          <?php endforeach; ?>
        </fieldset>

        <div class="mb-32">
          <button type="submit">Modifier</button>
        </div>

      </form>
    </div>

  </div>
</main>

<?php include_once 'includes/footer.php'; ?>
</body>
</html>