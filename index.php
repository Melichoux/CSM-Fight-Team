<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <meta name="description" content="Bienvenue sur le site du CSM FIGHT TEAM, club de judo-jujitsu marseillais." />
</head>

<body>
    <?php
    include_once 'includes/header.php';
    ?>
    <main>
        <h1 class="ai-c border-b">Home</h1>

        <?php

        require_once 'config/Database.php';

        try {
            $db = Database::getInstance();
            $stmt = $db->query('SELECT * FROM articles ORDER BY created_at DESC');
            $articles = $stmt->fetchAll();

            if ($articles) {
                foreach ($articles as $article) {
                    echo '<div class="article">';
                    echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p>' . nl2br(htmlspecialchars($article['content'])) . '</p>';
                    echo '<small>Publié le ' . date('d/m/Y', strtotime($article['created_at'])) . '</small>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun article trouvé.</p>';
            }
        } catch (PDOException $e) {
            echo '<p>Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
        var_dump("test");
        ?>

    </main>
    <?php
    include_once 'includes/footer.php';
    ?>
    <script src="assets/javascript/index.js">
    </script>
</body>

</html>