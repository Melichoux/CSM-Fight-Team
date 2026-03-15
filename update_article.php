<?php
include_once 'includes/head.php';
// Récupération de l'article grace a son id dans l'url via la superglobale $_get
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

// UPDATE DE L'ARTICLE

//Comme tjs, verification des champs
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $date_event = $_POST['date_event'] ?? '';
    $img_event = htmlspecialchars(trim($_POST['img_event'] ?? ''));
    $intro = htmlspecialchars(trim($_POST['intro'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $tags = $_POST['tags'] ?? [];
    $id_article = $_GET['aid'];

    if(empty($title)) $errors['title'] = "ATTENTION! Il manque le titre.";
    if(empty($date_event)) $errors['date_event'] = "ATTENTION! Il manque la date.";
    if(empty($img_event)) $errors['img_event'] = "ATTENTION! Il manque une image.";
    if(empty($intro)) $errors['intro'] = "ATTENTION! Il manque une introduction.";
    if(empty($description)) $errors['description'] = "ATTENTION! Il n'y a pas de description.";

    // Si okay, MAJ dans la BDD pour la table csm_article
    if(empty($errors)) {
        $pdo = Database::getInstance();

        $stmt = $pdo->prepare("UPDATE csm_article SET 
            title = :title,
            date_event = :date_event,
            img_event = :img_event,
            intro = :intro,
            description = :description
            WHERE id_article = :id_article");
        $stmt->execute([
            'title' => $title,
            'date_event' => $date_event,
            'img_event' => $img_event,
            'intro' => $intro,
            'description' => $description,
            'id_article' => $id_article
        ]);
      // Maj de la table des tags en commencant par effecer les valeurs de la table associative et donc en cascade dans la table csm_tag aussi
        $pdo->prepare("DELETE FROM csm_article_tag WHERE id_article = ?")->execute([$id_article]);

      // insertion des nouveaux tags via la table associative
        if(!empty($tags)) {
            $stmtTag = $pdo->prepare("INSERT INTO csm_article_tag (id_article, id_tag) VALUES (:id_article, :id_tag)");
            foreach($tags as $id_tag) {
                $stmtTag->execute([
                    'id_article' => $id_article,
                    'id_tag' => $id_tag
                ]);
            }
        }

        header("Location: dashboard.php");
        exit;
    }
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