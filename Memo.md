# Création du html avec liens css et js

<!--
 ```html
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
```
 -->

Notes pour moi meme:

- [X] faire la maquette sur figma et le faire apparaitre sur le README
- [X] mais pas utile dans mon cas - pour le fetch du catalogue: trouver un moyen de mettre tout le texte dans un seule div en utilisant la method append et non pas appendChild
- [X] mise en forme du texte de chaque card du catalogue
- mise en forme de la barre de filtre
- mise en forme du formulaire de contact
Bonus Faire une method pour recup dans l'intro d'un article la premiere phrase de chaque description 
- [X] creer un fichier "robots.txt" (cf guide seo sur teams) pour le SEO
- [X] Ajouter le fichier sitemap apres le deploiement pour le referencement
- Ajouter un lien vers le site de la fede de judo
- Changer les fetch.then.then par async.await
- [X] fichier catalogue: attention aux dernieres cards => pas dans le fond bleu pour la visibilité
- [X] Ajouter un fond sur les cards pour la lecture
- [X] filtrer le tableau avant la creation des cards dans le fetch de la barre de filtre
- [x] A faire en back=> recup securisée des données des checkbox et de l'envoi du mail


## SEO  

- [X] page index.html indisdpensable pour le deploiement
- [X] faire attention a ce que la balise title soit rempli et pertinente (50 a 60 caracteres)
- [ ] mettre le <meta name="description" content=""> sur toutes les pages (150 a 160 caracteres)
- [X] presence de balises sémantiques et organisées pour optimisation lecture pour SEO
- [X] utiliser des balises de titres pour la structure
- les images:
        *mettre l'attribut alt avec le texte alternatif
        *compression des images pour le tps de chargement rapide
- liens internes et externes vers des sites de hautes autorités (=netlinking)
- [X] accessibilités:
        *contraste
        *navigation au clavier (avec les balises "a")
        *utiliser "aria" et "label"
- [X] fichier robots.txt
- [X] fichier sitemap.xml
- [ ] Bonus: mettre une colonne "slug" dans la BDD permettant un d'avoir un url propre et lisible en recuprerant le titre de l'article et en remplacant les espacs par des "-" et tout en minuscule en + MEILLEUR REFERENCEMENT SEO!!!!
- [ ] Ajout de cropper.js pour gerer l'ajout d'image a un nouvel article. Permet le crop et d'aleger l'image avant de la stocker => uniformiser les taille et qualité des photos pour les articles.

# Partie Backend

- [x] Faire un dictionnaire de données et le faire apparaitre dans le README
- [x] Créer un formulaire de contact stocké pour gestion sur le profil admin
- [x] Créer un profil admin pour ajouter ou modifier du contenu
- [x] Reprendre le code pour l'affichage page catalogue en php
- [ ] Reprendre le code pour l'affichage d'un article a partir de la page catalogue en php
- [ ] creation profil user apres inscription?
- [ ] form preinscription: checkbox mineur, si oui recup des données parents ? si oui, création de compte avant donc pas de gestion des profil par admin? OU HELLOASSO pour profil + paiement en ligne
- [ ] empecher la copie des photos sauf pour les users enregistrés + donner un acces a toutes la galerie aux users enregistrés
- [ ] ATTENTION la table comment => changer les contrainttes not null sur id, nom et prenom pour qu'un user externe puisse commenter et que le message soit save (pas de soucis dans l'enregistrement car les cardinalitées sont OKAY -> 0,n)
- [ ] Moderation sur l'espace commentaire pour interdire des saisies de mot (insulte etc...)
- [ ] Point sécu sur page add_article: sécuriser la saisie du tags (checkbox) pour eviter les injections de code => verif que les id-tag sont biens des entiers positifs etc cf.claude discussion "encapsulation et visibilité en php

# Sécurité
- [ ] échappement des données lors de la recup pour création des articles (cf. conv chatgpt "explication code html php")

# Notion a presenter a l'examen
- [ ] Responsive + adaptabilité entre navigateur en testant sur chrome/edge(permissif) ET firefox(execution strict du code notament css)
- [ ] Voir cours SEO pour le referencement backlink => mettre en avant dans le dossier et presentation finale le deploiement definitif et la MaJ du site de la FFJDA pour le backlink du site
- [ ] Parler de notion "vanilla" car pas d'utilisation de frameworks dans mon projet
- [ ] Mon site est en monolithique donc pas de moyen de faire une arborescence du site en dossiers "frontend" et "backend" car mes langages se mélange dans le nav et php genere du html, cela se fait sur des projets plus important ou des projets avec des api en back et des frameworks en front pour bien séparer les deux env (ou dans le cas ou des equipes diff s'occupent du back et du front)
- [ ] creation d'un fichier commun (global.js) integré au footer et qui gere le js de la navbar et index.js spé au fichier de la page d'acceuil (index.php)
- [ ] Concernant le SEO et le perf au chargement des pages du site: “J’ai ajouté defer (sur les scripts externes) pour éviter le render blocking”
- [ ] 🧠 GD, c’est quoi ?
👉 GD (ou GD Library) est une bibliothèque PHP pour manipuler des images.
Concrètement, c’est elle qui te permet de faire :
charger une image
la redimensionner
la recadrer (crop)
la convertir (JPG → WebP)
ajouter du texte / filtres
🔧 Dans TON code, GD est utilisé ici
$source = imagecreatefromjpeg(...)
imagecopyresampled(...)
imagewebp(...)
👉 Toutes ces fonctions viennent de GD ( a la diff de move_upload_file qui enregistre sans faire de resize ou autre),
- [ ] enctype="multipart/form-data" sert à :✔️ envoyer des fichiers ✔️ remplir $_FILES ✔️ activer ton upload PHP
- [ ] Page upload_article: On dit bien "vanilla PHP" — c'est correct, ça veut dire sans framework (pas de Laravel, Symfony, etc.). ✓
Globalement c'est un très bon fichier pour un projet étudiant DWWM. Ce qui est bien fait :
Requêtes préparées PDO partout → pas d'injection SQL
Vérification du vrai type MIME avec finfo (pas juste l'extension)
Vérification du poids + getimagesize()
Conversion en WEBP + crop/resize avec GD
Suppression de l'ancienne image avec unlink()
Gestion des tags via table associative proprement (DELETE puis INSERT)
htmlspecialchars sur les inputs
Je peux dire "projet full stack vanilla" — ça veut dire : Full stack → tu gères le front (HTML/CSS/JS) ET le back (PHP/SQL); Vanilla → sans framework ni librairie externe (pas de Laravel, React, Bootstrap, etc.)
- [ ] principe DRY=don't repeat yourself

- [ ] "Pour la navigation du dashboard d'administration, j'ai étudié plusieurs approches.

La première consiste à centraliser toutes les sections dans un seul fichier en utilisant un paramètre GET dans l'URL — comme `dashboard.php?section=articles` ou `dashboard.php?section=albums`. PHP récupère ce paramètre via `$_GET` et affiche le bon bloc de contenu de manière conditionnelle. C'est une approche compacte mais qui présente un inconvénient : le serveur exécute l'intégralité du code, y compris les requêtes SQL de toutes les sections, même si l'utilisateur n'en consulte qu'une seule. On peut l'optimiser en combinant `$_GET` avec `include` dynamique pour ne charger que le fichier de la section demandée.

J'ai retenu la deuxième approche qui consiste à créer un fichier PHP par section — c'est d'ailleurs cohérent avec l'architecture que j'avais déjà mise en place sur le projet. Chaque onglet est un lien vers une page distincte, et j'utilise `$_SERVER['PHP_SELF']` combiné à `basename()` pour détecter le fichier en cours d'exécution et appliquer dynamiquement la classe CSS `active` sur le bon onglet. Cette approche est simple, maintenable, et ne charge que les ressources nécessaires à la section consultée."

- [ ] Composer — ce que c'est et comment l'expliquer
Composer est le gestionnaire de dépendances PHP. Son rôle est de télécharger et d'installer des librairies PHP externes dans ton projet, et de gérer leurs versions.
Concrètement quand tu fais :
bashcomposer require phpmailer/phpmailer
Composer va chercher le package sur packagist.org (le registre officiel PHP), le télécharger dans un dossier vendor/, et générer/mettre à jour composer.json (liste de tes dépendances) et composer.lock (versions exactes installées).
À l'oral tu peux dire : "Composer est l'équivalent PHP de npm pour JavaScript — il gère les dépendances du projet et garantit que tout le monde qui clone le repo installe exactement les mêmes versions."

Sur npm et Node.js — tu ne t'es pas trompé de package, mais la nuance c'est que npm est le gestionnaire de paquets JavaScript/Node.js, pas PHP. Si tu l'as utilisé dans ton projet c'était probablement pour installer des outils front (comme pour générer le docx ici par exemple), pas pour PHPMailer qui lui passe exclusivement par Composer.

- [ ] 


  ## PixelBay

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
=======
 - ![pour une image](https://th.bing.com/th/id/R.fa21749d39d8ff8622c2c237ceb5f748?rik=f3h%2b%2fFY2Mm6WVg&riu=http%3a%2f%2fwww.themarysue.com%2fwp-content%2fuploads%2f2015%2f04%2fspider-man.jpg&ehk=rp3sX0qoTecfB0bn3ODwXhKXeCl6JKb%2brMxg59H6n4E%3d&risl=&pid=ImgRaw&r=0)
>>>>>>> Dev

## Memo code

### sql

 - "unsigned" avec un int => deplace les négatifs vers les positifs, utile pour un id car un id négatif = error,
 - optimiser les chemins dans les fichiers __Dir__


### page d'acceuil
 iframe, 3 actus, prochain event