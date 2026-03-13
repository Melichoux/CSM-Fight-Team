<?php
    include_once 'includes/head.php';
    // require_once 'config/Database.php';
    $errors = [];
    $success = false;

    $last_name ="";
    $first_name = "";
    $email = "";
    $password = "";
    $confirm_password = "";

    //verifier que le formulaire est bien envoyé en POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Vérifier si le paramètre existe et n'est pas vide + "nettoyage" cad mise en forme anti-XSS

      $last_name = (trim($_POST['lastName'] ?? ""));
      $first_name = (trim($_POST['firstName'] ?? ''));
      $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
      $password = (trim($_POST['password'] ?? '')); // htmlspecialchars s'utilise dans le html et pas en php
      $confirm_password = (trim($_POST['confirm_password'] ?? ''));

      /* On crée cette variable pour ne pas lancer la fonction deux fois à l'appel de $name. mb_strlen permet de compter le nombre exact de caractere dans la saisie (a l'inverse de strlen qui compte le poids des caracteres en octets, donc pour l'alphabet francais on priviligie la fonction mb_stlen)*/
      $l_name_lenght = mb_strlen($last_name, "UTF-8");
      $f_name_lenght = mb_strlen($first_name, "UTF-8");
      $password_lenght = mb_strlen($password, "UTF-8");
      $confirm_password_lenght = mb_strlen($confirm_password, "UTF-8");

      // Validation de la saisie => On appliquera toutes les contraintes de saisie (= sécurité) dans le php et pas dans le html

      if (empty($last_name) || $l_name_lenght < 2 || $l_name_lenght > 30) {
        $errors['lastName'] = "le nom est obligatoire."; /* en nommant les clés on créé un tableau associatif avec une clé nommée que l'on pourra appeler plus tard dans le code (sous le champs concerné par le message d'erreur) contrairement à juste "$errors[]" qui correspond a un tableau indexé automatiquement et sur lequel il faudrait faire une boucle pour afficher tous les messages d'erreurs à la suite au meme endroit 
---- ATTENTION ---- le champs renseigné entre les crochets correspond au "name" de l'input html*/
      }

      if (empty($first_name) || $f_name_lenght < 2 || $f_name_lenght > 30) {
        $errors['firstName'] = "le prénom est obligatoire.";
      }

      if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
      }

      if (empty($password) || $password_lenght < 8) {
        $errors['password'] = "Mot de passe de 8 caracteres obligatoire.";
      }
      if (empty($confirm_password) || $password != $confirm_password) { //On verifie directement les saisies utilisateurs et pas les saisies "traitées".
        $errors['confirm_password'] = "La saisie est différente du mot de passe.";
      }

      //Verifier que l'email n'existe pas déja dans la base de données pour eviter les doublons et bloquer l'inscription avant le stockage dans la BDD
  
      if (empty($errors)) {
        $stmt = Database::getInstance()->prepare("SELECT id_user FROM csm_user WHERE email = :email"); // on "annonce" la commande qui va etre utilisée dans la table de la BDD
        $stmt->execute(['email' => $email]); // On demande l'execution de la commande annoncée et on precise la variable a utiliser
        if ($stmt->fetch()) // on pose la condition pour savoir si grace au fetch une valeur est bien récupérée
        {
          $errors[] = "Cet email est déjà utilisé.";
        } // si oui, alors il y aura un message d'erreur et on ne permettra pas l'enregistrement des données dans la BDD
      }
  
      // Enregistrement des données dans la BDD si tout est okay
      if (empty($errors)) { // dans l'ideal, faire un try catch
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); /*meme si password_argonid2 est plus robuste, le password_default laisse php choisir le meilleur algorithme au moment de lancer la requete. De plus pour fonctionner argonid2 a besoin d'une libraire qui n'est pas forcement disponible partout */
        $stmt = Database::getInstance()->prepare("INSERT INTO csm_user (last_name, first_name, email, password) VALUES (:nom, :prenom, :email, :password)");
        $stmt->execute([
          'nom' => $last_name,
          'prenom' => $first_name,
          'email' => $email,
          'password' => $passwordHash,
        ]);
        $success = true;
        $success_message= "Votre formulaire a été envoyé avec succes!<br>" . "Vous etes $last_name $first_name.<br> Votre email -- $email -- <br> Mot de passe : **** <br>";
            // on ne définit le succès que lors du véritable enregistrement plus bas
        // Pas besoin de else car les messages d'erreur s'affichent directement à coté des inputs concernés.
  }
    }
    include_once 'includes/header.php';
    ?>

    <main class="dflex jc-c ai-c ">
      <div class="form-contact dflex fw-w jc-c ai-c minw-100 mt-32">
        <form method="post" action="#" class="dblock fd-c ai-c ta-c mw-800px">
          <p><strong><?=  $success_message ?? "" ;  ?></strong></p>
          <h1 class="p24">Inscrivez-vous</h1>
          <div class="mb-16">
            <label for="lastName">Nom<span class="color-r ">*</span></label><br>
            <input id="lastName" type="text" placeholder="Votre nom" name="lastName" required />
          </div>

          <div class="mb-16">
            <label for="firstName">Prénom<span class="color-r ">*</span></label><br>
            <input id="firstName" type="text" placeholder="Votre prénom" name="firstName" required />
          </div>

          <div class="mb-16">
            <label for="email">Email<span class="color-r">*</span></label><br>
            <input id="email" type="email" name="email" placeholder="username@gmail.com" required />
          </div>

          <div class="mb-16">
            <label for="password">Mot de passe<span class="color-r">*</span></label><br>
            <input id="password" type="password" name="password" placeholder="Abcdé1!" required />
          </div>

          <div class="mb-16">
            <label for="confirm_password">Confirmation mot de passe<span class="color-r">*</span></label><br>
            <input id="confirm_password" type="confirm_password" name="confirm_password" placeholder="Abcdé1!" required />
          </div>

          <div class="mb-32">
            <button type="submit">Envoyer</button>
          </div>
        </form>
      </div>
    </main>
    <?php
    include_once 'includes/footer.php';
    ?>
    <!-- <script src="assets/javascript/index.js">
    </script> -->
    </body>

    </html>