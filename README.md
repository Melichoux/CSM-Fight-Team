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