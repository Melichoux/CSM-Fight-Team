<?php

// a modifier - juste copié-collé
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: exo16-connexion.php");
    exit;
}
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Connecté </title>
</head>
<body>
  <div class="dashboard">
        <h1>Tableau de bord</h1>
        <p>Bienvenue, <strong><?= htmlspecialchars($_SESSION['user_name']) ?></strong></p>
        <p>Rôle : <strong><?= htmlspecialchars($_SESSION['user_role']) ?></strong></p>
        <p>ID utilisateur : <?= $_SESSION['user_id'] ?></p>
        <p><a href="exo16-logout.php">Se déconnecter</a></p>
    </div>    
</body>
</html>