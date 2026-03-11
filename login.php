<?php
include_once 'includes/head.php';
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') { // permet de savoir si l'utilisateur est déjà connecté
  header("Location: dashboard.php"); // si oui, redirection vers la page d'apres connexion
  exit; // permet de stopper le script de cette page apres la redirection (sinon le script continue de s'executer en arriere plan donc faille de sécurité et bugs possibles)
}
// var_dump($_SESSION);
// include_once 'config/Database.php';

$error = ''; // le "$success" n'est pas necessaire car en cas de reussite, il y a une redirection donc pas besoin de définir un message de reussite sur la page si on ne reste pas dessus

// ----Vérification des entrées de connexion ---- 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'] ?? ''; // htmlspecialchars s'utilise dans le html et pas en php, on evite de modifier un mdp avant de le hasher

  $stmt = Database::getInstance()->prepare("SELECT * FROM csm_user WHERE email = :email");
  $stmt->execute(['email' => $email]);
  $users = $stmt->fetch(); // verif et recup d'une adresse mail dans la table

  // var_dump($users);
  if ($users && password_verify($password, $users['password'])) {
    // session_regenerate_id(true);
    $_SESSION['id_user'] = $users['id_user']; // la key de session est inventée et la valeur du param $user correspond au nom de la colonne
    $_SESSION['user_name'] = $users['first_name'] . '' . $users['last_name'];
    $_SESSION['user_role'] = $users['role'];
    header("Location: inscription.php");
  } else {
    $error = "Email ou mot de passe incorrect.";
  }
}
include_once 'includes/header.php';
?>
<main class="dflex jc-c ai-c ">
  <div class="form-contact dflex fw-w jc-c ai-c minw-100 mt-32">
    <form method="post" class="dblock fd-c ai-c ta-c mw-800px">
      <h1 class="p24">Se connecter</h1>

      <div class="mb-16">
        <label for="email">Email</label><br>
        <input id="email" type="email" name="email" placeholder="votreadresse@gmail.com" required />
      </div>

      <div class="mb-16">
        <label for="password">Mot de passe</label><br>
        <input id="password" type="password" name="password" placeholder="Abcdé1!" required />
      </div>

      <div class="mb-32">
        <button type="submit">Envoyer</button>
      </div>

      <div>
        <a href="inscription.php" class="color-w">Pas encore de compte? Inscrivez-vous</a>
      </div>

    </form>
  </div>
</main>
<?php
include_once 'includes/footer.php';
?>
<script src="assets/javascript/index.js">
</script>
</body>

</html>