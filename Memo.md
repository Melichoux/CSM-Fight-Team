# Création du html avec liens css et js

<!-- ```html
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="Assets/CSS/style.css">
</head>
<body>
    <main>
        <div class="container"></div>
    </main>
    <script src="Assets/Javascript/index.js"></script>
</body>
</html>
``` -->

Notes pour moi meme:

    OK mais pas utile dans mon cas - pour le fetch du catalogue: trouver un moyen de mettre tout le texte dans un seule div en utilisant la method append et non pas appendChild
    - mise en forme du texte de chaque card du catalogue
    Bonus - Faire une method pour recup dans l'intro d'un article la premiere phrase de chaque description 
    OK - creer un fichier "robots.txt" (cf guide seo sur teams) pour le SEO
    OK - Ajouter le fichier sitemap apres le deploiement pour le referencement
    - Ajouter un lien vers le site de la fede de judo
    - Changer les fetch.then.then par async.await
    - fichier catalogue: attention aux dernieres cards => pas dans le fond bleu pour la visibilités
    - Ajouter un fond sur les cards pour la lecture
    - filtrer le tableau avant la creation des cards dans le fetch de la barre de filtre
    - créer une fonction pour la création des cards dans l'index pour


## SEO  

    OK - page index.html indisdpensable pour le deploiement
    OK  - faire attention a ce que la balise title soit rempli et pertinente (50 a 60 caracteres)
    - mettre le <meta name="description" content=""> sur toutes les pages (150 a 160 caracteres)
    - presence de balises sémantiques et organisées pour optimisation lecture pour SEO
    - utiliser des balises de titres pour la structure
    - les images:
        *mettre l'attribut alt avec le texte alternatif
        *compression des images pour le tps de chargement rapide
    - liens internes et externes vers des sites de hautes autorités (=netlinking)
    - accessibilités:
        *contraste
        *navigation au clavier (avec les balise "a")
        *utiliser "aria" et "label"
    OK - fichier robots.txt
    OK - fichier sitemap.xml