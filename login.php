    <?php
    include_once 'includes/head.php';
    ?>
    <?php
      include_once 'includes/header.php';
    ?>
    <main class="dflex jc-c ai-c ">
      <div class="form-contact dflex fw-w jc-c ai-c minw-100 mt-32">
      <form method="post" action="#" class="dblock fd-c ai-c ta-c mw-800px">
        <h1 class="p24">Se connecter</h1>
    
        <div class="mb-16">
          <label for="email">Email</label><br>
          <input id="email" type="email" name="email" placeholder="votreadresse@gmail.com" required/>
        </div>

        <div class="mb-16">
          <label for="password">Mot de passe</label><br>
          <input id="password" type="password" name="password" placeholder="Abcdé1!" required/>
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
