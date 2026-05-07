<?php include_once 'includes/head.php';
$page_title = "Mentions légales et Politique de confidentialité - CSM fight team";
$meta_description="Politique de confidentialité et mentions légales du CSM Fight Team. Vos données personnelles sont protégées conformément au RGPD.";
include_once 'includes/header.php'; ?>
 
<main>
  <div class="dflex jc-c">
    <div class="mw-950px w-100 p16">
 
      <h1 class="mt-32 mb-16">Mentions légales & Politique de confidentialité</h1>
 
      <!-- MENTIONS LÉGALES -->
      <section class="rgpd-section">
        <h2>1. Mentions légales</h2>
 
        <h3>Éditeur du site</h3>
        <p>CSM Fight Team<br>
        Association à but non lucratif (loi 1901)<br>
        58 Rue Cavaignac, 13003 Marseille<br>
        Email : <a href="mailto:csmfightteam@gmail.com">csmfightteam@gmail.com</a></p>
 
        <h3>Responsable de la publication</h3>
        <p>Le Président du club CSM Fight Team.</p>
 
        <h3>Hébergement</h3>
        <p>Ce site est hébergé sur un serveur mutualisé. Les informations relatives à l'hébergeur seront communiquées lors de la mise en production.</p>
      </section>
 
      <!-- DONNÉES COLLECTÉES -->
      <section class="rgpd-section">
        <h2>2. Données personnelles collectées</h2>
        <p>Dans le cadre de l'utilisation de ce site, les données suivantes peuvent être collectées :</p>
 
        <h3>Formulaire de contact (visiteurs)</h3>
        <ul class="ulStyle rgpd-list">
          <li>Nom et prénom</li>
          <li>Adresse email</li>
          <li>Message saisi</li>
        </ul>
        <p>Ces données sont transmises par email à l'adresse du club via PHPMailer. Elles ne sont pas stockées en base de données.</p>
 
        <h3>Formulaire de connexion (espace administrateur)</h3>
        <ul class="ulStyle rgpd-list">
          <li>Adresse email</li>
          <li>Mot de passe (hashé en base de données via <code>password_hash</code> — jamais stocké en clair)</li>
        </ul>
        <p>Ces données sont utilisées exclusivement pour l'authentification de l'administrateur du site. Elles ne concernent pas les visiteurs.</p>
 
        <h3>Cookies techniques</h3>
        <p>Ce site utilise un cookie de session PHP (<code>PHPSESSID</code>) lors de la connexion à l'espace administrateur. Ce cookie contient uniquement un identifiant de session aléatoire — aucune donnée personnelle. Il permet au serveur de maintenir la session de l'administrateur connecté via <code>$_SESSION</code>.</p>
      </section>
 
      <!-- FINALITÉ -->
      <section class="rgpd-section">
        <h2>3. Finalité du traitement</h2>
        <p>Les données collectées via le formulaire de contact sont utilisées <strong>uniquement</strong> pour répondre aux demandes des personnes qui nous contactent. Elles ne sont ni revendues, ni transmises à des tiers.</p>
        <p>Les données de connexion (email + mot de passe hashé) sont utilisées exclusivement pour sécuriser l'accès à l'interface d'administration du site.</p>
      </section>
 
      <!-- BASE LÉGALE -->
      <section class="rgpd-section">
        <h2>4. Base légale</h2>
        <p>Le traitement des données du formulaire de contact repose sur le <strong>consentement</strong> de l'utilisateur (article 6.1.a du RGPD), exprimé lors de l'envoi du formulaire.</p>
        <p>Le traitement des données de connexion administrateur repose sur l'<strong>intérêt légitime</strong> du responsable de traitement (article 6.1.f du RGPD) pour sécuriser l'accès au backoffice du site.</p>
      </section>
 
      <!-- DURÉE DE CONSERVATION -->
      <section class="rgpd-section">
        <h2>5. Durée de conservation</h2>
        <p>Les messages transmis via le formulaire de contact sont conservés dans la boîte email du club pendant une durée de <strong>12 mois</strong> à compter de la date de réception, puis supprimés.</p>
        <p>Les données de connexion administrateur sont conservées tant que le compte est actif.</p>
        <p>Le cookie de session (<code>PHPSESSID</code>) est supprimé automatiquement à la fermeture du navigateur ou lors de la déconnexion.</p>
      </section>
 
      <!-- DROITS -->
      <section class="rgpd-section">
        <h2>6. Vos droits</h2>
        <p>Conformément au Règlement Général sur la Protection des Données (RGPD) et à la loi Informatique et Libertés, vous disposez des droits suivants :</p>
        <ul class="ulStyle rgpd-list">
          <li><strong>Droit d'accès</strong> : obtenir une copie des données vous concernant.</li>
          <li><strong>Droit de rectification</strong> : corriger des données inexactes ou incomplètes.</li>
          <li><strong>Droit à l'effacement</strong> : demander la suppression de vos données.</li>
          <li><strong>Droit d'opposition</strong> : vous opposer au traitement de vos données.</li>
        </ul>
        <p>Pour exercer ces droits, contactez-nous à : <a href="mailto:csmfightteam@gmail.com">csmfightteam@gmail.com</a></p>
        <p>En cas de litige, vous pouvez également introduire une réclamation auprès de la <strong>CNIL</strong> : <a href="https://www.cnil.fr" target="_blank" rel="noopener noreferrer">www.cnil.fr</a></p>
      </section>
 
      <!-- COOKIES -->
      <section class="rgpd-section">
        <h2>7. Cookies</h2>
        <p>Ce site utilise uniquement un <strong>cookie technique</strong> strictement nécessaire à son fonctionnement : le cookie de session PHP (<code>PHPSESSID</code>), déposé lors de la connexion à l'espace administrateur.</p>
        <p>Ce cookie ne contient aucune donnée personnelle et ne nécessite pas de consentement préalable au sens de la directive ePrivacy.</p>
        <p>Aucun cookie publicitaire, analytique ou de traçage n'est utilisé sur ce site.</p>
      </section>
 
      <!-- SÉCURITÉ -->
      <section class="rgpd-section">
        <h2>8. Sécurité des données</h2>
        <p>Le site met en œuvre les mesures techniques suivantes pour protéger vos données :</p>
        <ul class="ulStyle rgpd-list">
          <li>Connexion sécurisée via protocole HTTPS (certificat SSL).</li>
          <li>Protection des formulaires contre les soumissions automatisées (honeypot).</li>
          <li>Mot de passe administrateur hashé en base de données (<code>password_hash</code> / <code>password_verify</code>).</li>
          <li>Requêtes SQL préparées via PDO (protection contre les injections SQL).</li>
          <li>Validation et sanitisation des entrées utilisateur (<code>filter_input</code>, <code>strip_tags</code>, <code>htmlspecialchars</code>).</li>
        </ul>
      </section>
 
      <!-- CONTACT -->
      <section class="rgpd-section mb-32">
        <h2>9. Contact</h2>
        <p>Pour toute question relative à la présente politique de confidentialité ou à l'exercice de vos droits :</p>
        <p>
          <strong>CSM Fight Team</strong><br>
          58 Rue Cavaignac, 13003 Marseille<br>
          Email : <a href="mailto:csmfightteam@gmail.com">csmfightteam@gmail.com</a>
        </p>
      </section>
 
    </div>
  </div>
</main>
 
<?php include_once 'includes/footer.php'; ?>
</body>
</html>
