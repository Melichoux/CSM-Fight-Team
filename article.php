<?php 
    session_start();
    require_once 'Database.php';
?>
 <?php
    include_once 'includes/head.php';
    ?>
    <?php
      include_once 'includes/header.php';
    ?>
    <main>
        <h1>Articles</h1>
        <div class="pageArticle dflex  jc-c ">

        </div>
    </main>
    <?php
      include_once 'includes/footer.php';
    ?>
    <!-- Ajout du script directement sur la page plutot que sur le fichier js car on ne peut pas faire 2 fetchs sans d'importante adaptation du code  -->
     <script src="assets/javascript/index.js"></script>
    <script>
        console.log(window.location) //pour verif qu'on recup les donnees de l'url
        const params = new URLSearchParams(window.location.search);
        console.log(params.get("id"));
        const currentId = params.get("id");
        console.log(currentId)


        fetch(window.location.origin + "/CSM-FIGHT-TEAM/assets/javascript/data/articles.json")
        // Pour le deploiement, on ecrira dans le fetch(window.location.origin + `/assets/javascript/data/articles.json`) pour que l'adresse se mette a jour
            .then((response) => response.json())
            .then(
                (data) => {
                    const pageArticle = document.querySelector(".pageArticle");

                    const single = data.filter(
                        (item) => {
                            return item.id == currentId
                        }
                    )

                        for (let index = 0; index < single.length; index++) {
                            const element = single[index];

                            const article = document.createElement("article")
                            article.classList.add("articleSeul")
                            article.innerHTML = `
            <img src="${element.img}" alt = "Photo de l'événement" class="imgArticle">`
             const divText = document.createElement("div")
            divText.innerHTML=`
            <p class="dateArticle"> ${element.date} </p>
            <h2 class="titreArticle"> ${element.titre} </h2>
            <p class="descrArticle"> ${element.description} </p>
            `
                            pageArticle.append(article) // preferer append à appendChild (cf.mdn)
                            article.append(divText)
                            document.title = `Article ${element.titre}` // Fais apparaitre le nom de l'article dans la balise title de la page
                        }})
    </script>

</body>

</html>