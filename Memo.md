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

## Partie front
    - faire la maquette sur figma et le faire apparaitre sur le README

    OK mais pas utile dans mon cas - pour le fetch du catalogue: trouver un moyen de mettre tout le texte dans un seule div en utilisant la method append et non pas appendChild
    OK - mise en forme du texte de chaque card du catalogue

    - mise en forme de la barre de filtre

    - mise en forme du formulaire de contact

    Bonus - Faire une method pour recup dans l'intro d'un article la premiere phrase de chaque description 

    OK - creer un fichier "robots.txt" (cf guide seo sur teams) pour le SEO
    OK - Ajouter le fichier sitemap apres le deploiement pour le referencement

    - Ajouter un lien vers le site de la fede de judo

    - Changer les fetch.then.then par async.await

    OK - fichier catalogue: attention aux dernieres cards => pas dans le fond bleu pour la visibilité
    OK - Ajouter un fond sur les cards pour la lecture
    OK - filtrer le tableau avant la creation des cards dans le fetch de la barre de 
    
    - A faire en back=> recup securisé des données des checkbox et de l'envoi du mail => pas obligatoire


## SEO  

    OK - page index.html indisdpensable pour le deploiement
    OK  - faire attention a ce que la balise title soit rempli et pertinente (50 a 60 caracteres)

    - mettre le <meta name="description" content=""> sur toutes les pages (150 a 160 caracteres)

    OK - presence de balises sémantiques et organisées pour optimisation lecture pour SEO
    - utiliser des balises de titres pour la structure
    - les images:
        *mettre l'attribut alt avec le texte alternatif
        *compression des images pour le tps de chargement rapide
    - liens internes et externes vers des sites de hautes autorités (=netlinking)
    OK - accessibilités:
        *contraste
        *navigation au clavier (avec les balises "a")
        *utiliser "aria" et "label"
    OK - fichier robots.txt
    OK - fichier sitemap.xml

## Partie back

    - Faire un dictionnaire de données et le faire apparaitre dans le README
    - creation profil user apres inscription?
    -form preinscription: checkbox mineur, si oui recup des données parents ? si oui, création de compte avant donc pas de gestion des profil par admin?


    
    # PixelBay

Il faut ecrire README en maj car il est lu comme ca sur github.
les autres fichiers MarkDown(=.md) n'ont pas besoin d'etre ecrit en maj.

Ce fichier permet de rédiger un document à destination d'autres users qui pourraient par exemple travailler sur notre projet opensource.

On y indique:


## Objectifs
Ce projet a pour objectif l'entrainement à Javascript.

## Prerequis
- nodejs 22.12.2
- npm 10.0.0

Pour installer le projet vous pouvez executer la commande `npm init -y` et `npm install readline-sync`.

## Creer un timer

<!-- les triples backsticks permettent d'integrer du code dans le .md (en y mettant de la couleur et dans une fenetre), on precisera quand meme le language juste apres les 3 premiers backsticks -->
```js
    <h1></h1>
    <p id="message">Salut !</p>
    <!-- <p id="message" onclick="sayHello()"> Salut! </p> -->

        <!-- <button id="btn" onclick="sayHello()">Ouvrir la boite de dialogue</button> -->
        <button id="btn">
            Ouvrir la <strong>boite de <em>dialogue</em></strong>
        </button>
     </main>
    <script>
        const message = document.querySelector("#message");
                console.dir(message);
        message.innerHTML += " la classe";
        const btn = document.querySelector("#btn")
        console.dir(btn);
        </script>
```

<!-- on peut ajouter des tableaux, des liens, des images ...  -->
 - exemple de tableau
| Syntax | Description |
| ----------- | ----------- |
| Header | Title |
| Paragraph | Text |
 - [le lien](https://www.markdownguide.org/cheat-sheet/)
 - ![pour une image](https://th.bing.com/th/id/R.fa21749d39d8ff8622c2c237ceb5f748?rik=f3h%2b%2fFY2Mm6WVg&riu=http%3a%2f%2fwww.themarysue.com%2fwp-content%2fuploads%2f2015%2f04%2fspider-man.jpg&ehk=rp3sX0qoTecfB0bn3ODwXhKXeCl6JKb%2brMxg59H6n4E%3d&risl=&pid=ImgRaw&r=0)
