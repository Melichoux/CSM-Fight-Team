<?php
include_once 'includes/head.php';

$errors = [];
$success = false;

$title = "";
$date_event = "";
$img_event = "";
$intro = "";
$description = "";
$tags = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $date_event = $_POST['date_event'] ?? '';
    $img_event = htmlspecialchars(trim($_POST['img_event'] ?? ''));
    $intro = htmlspecialchars(trim($_POST['intro'] ?? ''));
    $description = htmlspecialchars(trim($_POST['description'] ?? ''));
    $tags = $_POST['tags'] ?? [];

    // Validation du formulaire
    if (empty($title)) {
        $errors['title'] = "ATTENTION! Il manque le titre.";
    }
    if (empty($date_event)) {
        $errors['date_event'] = "ATTENTION! Il manque la date.";
    }
    if (empty($img_event)) {
        $errors['img_event'] = "ATTENTION! Il manque une image.";
    }
    if (empty($intro)) {
        $errors['intro'] = "ATTENTION! Il manque une introduction.";
    }
    if (empty($description)) {
        $errors['description'] = "ATTENTION! Il n'y a pas de description.";
    }

    // Insertion dans la BDD apres que la verif soit ok
    /* Logique insertion bdd dans 2 tables many-to-many: on insert dans la table principale PUIS on appelle l'id du dernier element créé dans la table principale que l'on va utiliser pour le lier a la 2ieme table en enregistrant les id es deux tables dans la table associative*/
    if(empty($errors)) {
        $pdo = Database::getInstance();
        
        $stmt = $pdo->prepare("INSERT INTO csm_article (title, date_event, img_event, intro, description) 
                               VALUES (:title, :date_event, :img_event, :intro, :description)");
        $stmt->execute([
            'title' => $title,
            'date_event' => $date_event,
            'img_event' => $img_event,
            'intro' => $intro,
            'description' => $description,
        ]);

        $id_article = $pdo->lastInsertId();

        // Insertion des tags et du dernier article dans la table associative
        if(!empty($tags)) {
            $stmtTag = $pdo->prepare("INSERT INTO csm_article_tag (id_article, id_tag) VALUES (:id_article, :id_tag)");
            foreach($tags as $id_tag) {
                $stmtTag->execute([
                    'id_article' => $id_article,
                    'id_tag' => $id_tag
                ]);
            }
        }

        header("Location: dashboard.php"); // retour au dashboard si enregistrement ok
        exit;
    }
}

include_once 'includes/header.php';
?>

<main class="p16">
  <div class="container mw-950px mil-auto">

    <div class="ta-e mt-16">
      <a class="btn-logout-container" href="dashboard.php">
        <span class="btn-logout">Retour au dashboard</span>
      </a>
    </div>

    <div class="dflex jc-c ai-c mb-32 mt-32">
      <h1 class="fs-32">Ajout d'un nouvel article</h1>
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
          $tags_list = Database::getInstance()->query("SELECT * FROM csm_tag ORDER BY tag");
          foreach($tags_list as $tag): /* creation d'une checkbox avec toutes les valeurs de la table tag ce qui permet de recuperer l'id et la valeur associée sans se tromper pour lier id et valeur coté user*/?>
            <div class="dflex ai-c gap-8">
              <input type="checkbox" id="tag_<?= $tag['id_tag'] ?>" name="tags[]" value="<?= $tag['id_tag'] ?>" 
                <?= in_array($tag['id_tag'], $tags) ? 'checked' : '' ?>/>
              <label for="tag_<?= $tag['id_tag'] ?>" class="color-w"><?= htmlspecialchars($tag['tag']) ?></label>
            </div>
          <?php endforeach; ?>
        </fieldset>

        <div class="mb-32">
          <button type="submit">Publier</button>
        </div>

      </form>
    </div>

  </div>
</main>

<?php include_once 'includes/footer.php'; ?>
</body>
</html>