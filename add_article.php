<?php
include_once 'includes/dashboard_head.php';

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
    $img_event = ''; 
      if (!empty($_FILES['img_event']['name'])) {

          $allowed_types = ['image/jpeg', 'image/png', 'image/webp']; // pour def les formats acceptés

          $finfo = finfo_open(FILEINFO_MIME_TYPE); //verification du type de fichier et pas seulement l'extension => securité supp contre les virus
          $real_type = finfo_file($finfo, $_FILES['img_event']['tmp_name']);
          // finfo_close supprimé car inutile en PHP 8

          if (!in_array($real_type, $allowed_types)) {
              $errors['img_event'] = "Format non accepté.";
          }

          // verification du poids de l'image (adapté a des photos pros donc taille acceptée raisonnablement importante)
          if ($_FILES['img_event']['size'] > 10 * 1024 * 1024) {
              $errors['img_event'] = "Image trop lourde (max 10MB)";
          }

          // verification que le fichier est bien une image en analysant la structure interne du fichier
          $img_info = getimagesize($_FILES['img_event']['tmp_name']);
          if (!$img_info) {
              $errors['img_event'] = "Fichier invalide.";
          }

          if (empty($errors['img_event'])) {

              // Chargement de l'image source selon son type
              if ($real_type === 'image/jpeg') $source = imagecreatefromjpeg($_FILES['img_event']['tmp_name']);
              elseif ($real_type === 'image/png') $source = imagecreatefrompng($_FILES['img_event']['tmp_name']);
              elseif ($real_type === 'image/webp') $source = imagecreatefromwebp($_FILES['img_event']['tmp_name']);

              if (!$source) {
                  $errors['img_event'] = "Erreur chargement image.";
              } else {

                  $crop_x = (int)($_POST['crop_x'] ?? 0);
                  $crop_y = (int)($_POST['crop_y'] ?? 0);
                  $crop_w = (int)($_POST['crop_w'] ?? imagesx($source));
                  $crop_h = (int)($_POST['crop_h'] ?? imagesy($source));

                  // Canvas de destination aux dimensions finales
                  $target_w = 800;
                  $target_h = 450;
                  $resized = imagecreatetruecolor($target_w, $target_h);

                  // Crop + redimensionnement en une seule opération
                  imagecopyresampled($resized, $source, 0, 0, $crop_x, $crop_y, $target_w, $target_h, $crop_w, $crop_h);

                  // Sauvegarde en WEBP avec 75% de qualité
                  $filename = uniqid() . '.webp';
                  $destination = 'uploads/articles/' . $filename;
                  imagewebp($resized, $destination, 75); // valeur 75 = bon compromis peut etre augmetée jusqu'a 80% max pour rester optimale

                  $img_event = $destination;
              }
          }
      }  
    $intro = trim($_POST['intro'] ?? '');
    $description = trim($_POST['description'] ?? '');
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
?>

<?php
$page_title= "Ajouter un article";
include_once 'includes/dashboard_header.php';
?>
<main class="p16">
  <div class="mw-950px mil-auto">

    <div class="ta-e mt-16">
      <a class="btn-logout-container" href="dashboard.php">
        <span class="btn-logout">Retour au dashboard</span>
      </a>
    </div>

    <div class="form-contact p24 mb-32">
      <form method="post" action="" enctype="multipart/form-data" class="dflex fd-c gap-16">

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
          <label for="img_event" class="color-w">Image</label>
          <input id="img_event" type="file" name="img_event" accept="image/jpeg, image/png, image/webp" onchange="previewImage(this)" />
          <?php if(isset($errors['img_event'])): ?>
            <p class="color-r"><?= $errors['img_event'] ?></p>
          <?php endif; ?>

          <!-- Zone de crop invisible tant qu'il n'y a pas d'img-->
          <div id="crop-container" style="display:none; max-width:800px; margin-top:16px;">
            <img id="preview" src="" alt="preview" style="max-width:300px;">
          </div>

          <!-- Coordonnées transmises au php apres le crop, n'a pas besoin d'etre visible d'ou le hidden -->
          <input type="hidden" name="crop_x" id="crop_x">
          <input type="hidden" name="crop_y" id="crop_y">
          <input type="hidden" name="crop_w" id="crop_w">
          <input type="hidden" name="crop_h" id="crop_h">
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
              <?= in_array($tag['id_tag'], $tags) ? 'checked' : ''/* sert a conserver la valeur si form invalide*/?>> 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
let cropper = null;

function previewImage(input) {
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(e) {
        const preview = document.getElementById('preview');
        const container = document.getElementById('crop-container');

        if (cropper !== null) {
            cropper.destroy();
            cropper = null;
        }

        preview.src = "";
        preview.src = e.target.result;
        container.style.display = 'block';

        preview.onload = function() {
            cropper = new Cropper(preview, {
                aspectRatio: 16 / 9,
                viewMode: 1,
                autoCropArea: 1
            });
        };
    };

    reader.readAsDataURL(file);
}

// Remplit les inputs hidden avec les coordonnées du crop au moment du submit
document.querySelector('form').addEventListener('submit', function() {
    if (cropper !== null) {
        const data = cropper.getData(true);
        document.getElementById('crop_x').value = data.x;
        document.getElementById('crop_y').value = data.y;
        document.getElementById('crop_w').value = data.width;
        document.getElementById('crop_h').value = data.height;
    }
});
</script>
</body>
</html>