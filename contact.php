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
        $nom     = htmlspecialchars(trim($_POST['nom'] ?? ''));
        $prenom  = htmlspecialchars(trim($_POST['prenom'] ?? ''));
        $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $options = $_POST['option'] ?? [];
        $message = htmlspecialchars(trim($_POST['message'] ?? ''));

        if (empty($nom))     $errors['nom']     = "Votre nom est requis.";
        if (empty($prenom))  $errors['prenom']  = "Votre prénom est requis.";
        if (!$email)         $errors['email']   = "Email invalide.";
        if (empty($message)) $errors['message'] = "Le message est requis.";

        if (empty($errors)) {
            try {
                require_once 'includes/mailer.php';
                $mail = createMailer();

                $mail->setFrom('', 'CSM Fight Team'); // email du club à remplir
                $mail->addAddress(''); // email destinataire à remplir
                $mail->addReplyTo($email, $nom . ' ' . $prenom); // permet de répondre directement à l'expéditeur

                $mail->isHTML(true);
                $mail->Subject = 'Nouveau message de ' . $nom . ' ' . $prenom;
                $mail->Body = "
                    <h2>Nouveau message depuis le site</h2>
                    <p><b>Nom :</b> $nom $prenom</p>
                    <p><b>Email :</b> $email</p>
                    <p><b>Sujet(s) :</b> " . implode(', ', $options) . "</p>
                    <p><b>Message :</b> $message</p>
                ";

                $mail->send();
                $success = true;

            } catch (Exception $e) {
                $errors['mail'] = "Erreur d'envoi : " . $mail->ErrorInfo;
            }
        }
    }
    
    include_once 'includes/header.php';
    ?>
    <main class="dflex jc-c ai-c ">
      <div class="form-contact dflex fw-w jc-c ai-c minw-100 mt-32">
      <form method="post" action="#" class="dblock fd-c ai-c ta-c mw-800px">
        <h1 class="p24">Contactez-nous</h1>
        <div class="mb-16">
          <label for="nom">Nom<span class="color-r ">*</span></label><br>
          <input id="nom" type="text" placeholder="Votre nom" name="nom" required/>
        </div>

        <div class="mb-16">
          <label for="prenom">Prénom<span class="color-r ">*</span></label><br>
          <input id="prenom" type="text" placeholder="Votre prénom" name="prenom" required/>
        </div>

        <div class="mb-16">
          <label for="email">Email<span class="color-r">*</span></label><br>
          <input id="email" type="email" name="email" placeholder="username@gmail.com" required/>
        </div>

        <fieldset class="mb-16">
          <legend>A propos de quoi nous contactez-vous:</legend>

          <div>
            <label for="judo">Judo</label>
            <input type="checkbox" id="judo" name="option[]" value="judo"/>
          </div>

          <div>
            <label for="jujitsu">Jujitsu</label>
            <input type="checkbox" id="jujitsu" name="option[]" value="jujitsu" />
          </div>
          <div>
            <label for="jujitsu-bresilien">Jujitsu Brésilien</label>
            <input type="checkbox" id="jujitsu-bresilien" name="option[]" value="jujitsu-bresilien"/>
          </div>
          <div>
            <label for="autre">Autre</label>
            <input type="checkbox" id="autre" name="option[]" value="autre" />
          </div>
        </fieldset>
        <div class="mb-16">
          <label for="message">Votre message :<span class="color-r">*</span></label><br />
          <textarea id="message" name="message" placeholder="Écrivez votre message ici..." maxlength="500" required> </textarea><br />
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

  </body>
</html>
