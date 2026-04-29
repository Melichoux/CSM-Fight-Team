<?php
    include_once 'includes/head.php';
 
    $errors = [];
    $success = false;

    $nom = "";
    $prenom = "";
    $email = "";
    $options = [];
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
              // Honeypot anti-spam
        if (!empty($_POST['honeypot'])) {
            exit;
        }

        $nom     = strip_tags(trim($_POST['nom'] ?? ''));
        $prenom  = strip_tags(trim($_POST['prenom'] ?? ''));
        $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $options = $_POST['option'] ?? [];
        $message = strip_tags(trim($_POST['message'] ?? ''));

        if (empty($nom))     {$errors['nom']     = "Votre nom est requis.";}
        if (empty($prenom))  {$errors['prenom']  = "Votre prénom est requis.";}
        if (!$email)         {$errors['email']   = "Email invalide.";}
        if (empty($message)) {$errors['message'] = "Le message est requis.";}

        if (empty($errors)) {
            try {
                require_once 'includes/mailer.php';
                $mail = createMailer();

                $mail->setFrom(MAIL_FROM, 'CSM Fight Team'); // email du club à remplir
                $mail->addAddress(MAIL_TO); // email destinataire à remplir
                $mail->addReplyTo($email, $nom . ' ' . $prenom); // permet de répondre directement à l'expéditeur

                $mail->isHTML(true);
                $mail->Subject = 'Nouveau message de ' . $nom . ' ' . $prenom;
                $mail->Body = "
                    <h2>Nouveau message depuis le site CSM Fight Team</h2>
                    <p><b>Nom :</b> $nom $prenom</p>
                    <p><b>Email :</b> $email</p>
                    <p><b>Sujet(s) :</b> " . implode(', ', $options) . "</p>
                    <p><b>Message :</b> $message</p>
                ";

                $mail->send();
                $success = true;

            } catch (Exception $e) {
                $errors['mail'] = true;
                 error_log($e->getMessage());
            }
        }
    }
    $page_title="Contactez-nous";
    include_once 'includes/header.php';
    ?>
    <main class="dflex jc-c ai-c ">  <!-- modale envoi mail avec succes -->
      <?php if ($success): ?>
        <div id="succes-modal" class="modale">
            <div class="modaleCard">
                <h2>Message envoyé !</h2>
                <p>Merci de nous avoir contacté, nous ferons tout pour vous répondre dans les plus brefs délais. <br>
                  Vous allez etre redirigé vers la page d'accueil.
                </p>
            </div>
        </div>
      <?php endif; ?>

      <?php if (isset($errors['mail'])): ?>  <!-- modale erreur d'envoi mail -->
        <div id="error-modal" class="modale" >
            <div class="modaleCard">
                <h2 class="color-r">Erreur d'envoi</h2>
                <p>Une erreur est survenue, veuillez réessayer.</p>
                <button onclick="document.getElementById('error-modal').remove()">Fermer</button>
            </div>
        </div>
      <?php endif; ?>

      <div class="form-contact dflex fw-w jc-c ai-c minw-100 mt-32">
      <form method="post" action="#" class="dblock fd-c ai-c ta-c mw-800px">
        <h1 class="p24">Contactez-nous</h1>
        <div class="mb-16">
          <label for="nom">Nom<span class="color-r ">*</span></label><br>
          <input id="nom" type="text" placeholder="Votre nom" name="nom" value="<?= $nom ?>" required/>
          <?php if (isset($errors['nom'])): ?>
            <p class="color-r"><?= $errors['nom'] ?></p>
          <?php endif; ?>
        </div>

        <div class="mb-16">
          <label for="prenom">Prénom<span class="color-r ">*</span></label><br>
          <input id="prenom" type="text" placeholder="Votre prénom" name="prenom" value="<?= $prenom ?>" required/>
          <?php if (isset($errors['prenom'])): ?>
            <p class="color-r"><?= $errors['prenom'] ?></p>
          <?php endif; ?>
        </div>

        <div class="mb-16">
          <label for="email">Email<span class="color-r">*</span></label><br>
          <input id="email" type="email" name="email" placeholder="username@gmail.com" value="<?= $email ?>" required/>
          <?php if (isset($errors['email'])): ?>
            <p class="color-r"><?= $errors['email'] ?></p>
          <?php endif; ?>
        </div>

        <fieldset class="mb-16">
          <legend>A propos de quoi nous contactez-vous:</legend>

          <div>
            <label for="judo">Judo</label>
            <input type="checkbox" id="judo" name="option[]" value="judo" <?= in_array('judo', $options) ? 'checked' : '' ?>/>
          </div>

          <div>
            <label for="jujitsu">Jujitsu</label>
            <input type="checkbox" id="jujitsu" name="option[]" value="jujitsu" <?= in_array('jujitsu', $options) ? 'checked' : '' ?>/>
          </div>
          <div>
            <label for="jujitsu-bresilien">Jujitsu Brésilien</label>
            <input type="checkbox" id="jujitsu-bresilien" name="option[]" value="jujitsu-bresilien" <?= in_array('jujitsu-bresilien', $options) ? 'checked' : '' ?>/>
          </div>
          <div>
            <label for="autre">Autre</label>
            <input type="checkbox" id="autre" name="option[]" value="autre" <?= in_array('autre', $options) ? 'checked' : '' ?>/>
          </div>
        </fieldset>

        <div class="mb-16">
          <label for="message">Votre message :<span class="color-r">*</span></label><br />
          <textarea id="message" name="message" placeholder="Écrivez votre message ici..." maxlength="500" required><?= $message ?></textarea><br />
          <?php if (isset($errors['message'])): ?>
            <p class="color-r"><?= $errors['message'] ?></p>
          <?php endif; ?>
        </div>

        <div>
        <!-- Honeypot anti-spam -->
        <input type="text" name="honeypot" style="display:none" tabindex="-1" autocomplete="off">
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
    <?php if ($success): ?>
      <script>
          setTimeout(() => {
              window.location.href = "index.php";
          }, 5000);
      </script>
    <?php endif; ?>
  </body>
</html>
