<?php
    include_once 'includes/head.php';
?>

    <?php
    include_once 'includes/header.php';
    ?>
    <main>
        <h1 class="ai-c border-b">Home</h1>


    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
    <script src="assets/javascript/index.js">
    </script>
</body>

</html>

































        <!-- <?php

        require_once 'config/Database.php';

        try {
            $db = Database::getInstance();
            $stmt = $db->query('SELECT * FROM article ORDER BY created_at DESC');
            $articles = $stmt->fetchAll();
            //test
            $articles =[
                ["title"=> "lorem ipsum",
                "description"=> "blabla"]
            ];

            if ($articles) {
                foreach ($articles as $article) {
                    echo '<div class="article">';
                    echo '<h2>' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p>' . nl2br(htmlspecialchars($article['description'])) . '</p>';
                    // echo '<small>Publié le ' . date('d/m/Y', strtotime($article['created_at'])) . '</small>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun article trouvé.</p>';
            }
        } catch (PDOException $e) {
            echo '<p>Erreur de connexion à la base de données : ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
        var_dump("test");
        ?> -->
