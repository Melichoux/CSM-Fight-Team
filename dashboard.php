<?php
include_once 'includes/head.php';

if(!isset($_SESSION['user_role'])){
    header("Location: login.php");
    exit;
}
include_once 'includes/header.php';
?>

<main class="p16">
  <div class="container mw-950px mil-auto">

<div class="ta-e mt-16">
    <div class="btn-logout-container">
        <a class="btn-logout" href="logout.php">Déconnexion</a>
    </div>
</div>
<div class="dashboardCard">
    <div class="dflex jc-c ai-c mb-32 mt-32">
      <h1 class="fs-32">Bienvenue sur ton espace administrateur !</h1>
    </div>
<div>
    <h2 class="fs-32 color-w">Créer un nouvel article</h2>
     <a href="add_article.php" class="btn-logout-container"><span class="btn-logout">Créer un article</span></a>
</div>

<div>
    <h2 class="fs-32 color-w">Modifier un article</h2>
     <a href="upload_article.php" class="btn-logout-container"><span class="btn-logout">Créer un article</span></a>

</div>
</div>
</main>
<?php include_once 'includes/footer.php'; ?>
</body>
</html>