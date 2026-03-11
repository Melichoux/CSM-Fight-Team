<?php
    include_once 'includes/head.php';
    ?>
    <?php
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

  <!-- // Initialisation avec ta clé publique EmailJS
  emailjs.init("28Nlfyq7zS4Hhf6hm"); // remplace par ta clé publique -->
<script
  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>

<script>
  (function () {
    emailjs.init({
      publicKey: "28Nlfyq7zS4Hhf6hm", // NOUVELLE SYNTAXE
    });
  })();
</script>
<script>
  const form = document.querySelector("form");

  form.addEventListener("submit", function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Récupérer toutes les options cochées
    const options = Array.from(document.querySelectorAll("input[name='option[]']:checked"))
                         .map(el => el.value)
                         .join(", ");

    // Préparer les données à envoyer
    const templateParams = {
      nom: document.getElementById("nom").value,
      prenom: document.getElementById("prenom").value,
      email: document.getElementById("email").value,
      option: options,
      message: document.getElementById("message").value
    };

    // Envoyer le formulaire via EmailJS
    emailjs.send("service_ul91nnp", "template_0ecflha", templateParams)
      .then(function(response) {
        console.log("Message envoyé!", response.status, response.text);
        alert("Merci, votre message a été envoyé !");
        form.reset(); // vide le formulaire après envoi
      }) 
      .catch((error) => {
    console.error("EmailJS error:", error);
    alert("Erreur");
  });
});
        // function(error) {
      //   console.log("Erreur...", error);
      //   alert("Oups, le message n'a pas pu être envoyé. Réessayez.");
      // });
</script>
  </body>
</html>
