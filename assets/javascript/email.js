   // Initialisation avec ta clé publique EmailJS
  emailjs.init("28Nlfyq7zS4Hhf6hm"); // remplace par ta clé publique

  src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">



  (function () {
    emailjs.init({
      publicKey: "28Nlfyq7zS4Hhf6hm", // NOUVELLE SYNTAXE
    });
  })();

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
