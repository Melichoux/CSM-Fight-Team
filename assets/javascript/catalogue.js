// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -   Récupération des données des articles pour la page catalogue
const articleContainer = document.querySelector(".article-container");
if(articleContainer){
fetch(window.location.origin +"/CSM-FIGHT-TEAM/assets/javascript/data/articles.json") //
  .then((response) => response.json())
  .then((data) => {
    for (let index = 0; index < data.length; index++) {
      const element = data[index];

      const article = document.createElement("article");
      article.classList.add("articleCard");
      article.innerHTML = `
            <img src="${element.img}" alt = "Photo de l'événement">`;
      const divText = document.createElement("div");
      divText.innerHTML = `
            <p class="dateCard catalogueCard"> ${element.date} </p>
            <h2 class="titreCard catalogueCard"> ${element.titre} </h2>
            <p class="introCard catalogueCard"> ${element.intro} </p>
            <a href="article.php?id=${element.id}" class="btnCard catalogueCard">En savoir +</a>
            `;
      articleContainer.append(article); // preferer append à appendChild (cf.mdn)
      article.append(divText);
    }
  });
}

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -  Page catalogue: barre de filtre
const filter = document.querySelector("#filter"); // on applique le filtre directement sur le "select" du form
if (filter){
filter.addEventListener("change", (event) => { //
  const userChoice = event.target.value;
  console.log(event.target.value);
  articleContainer.innerHTML="" // permet de vider la page avant de faire le nouvel affichage
  
  fetch(window.location.origin +"/CSM-FIGHT-TEAM/assets/javascript/data/articles.json")
  .then((response) => response.json())
  .then((data) => {
    
     const dataFiltre = data.filter(article =>
        userChoice === "" || article.tags.includes(userChoice)
      ); 

      for (let index = 0; index < dataFiltre.length; index++) {
        const element = dataFiltre[index];

        const article = document.createElement("article");
        article.classList.add("articleCard");
        article.innerHTML = `
            <img src="${element.img}" alt = "Photo de l'événement">`;
        const divText = document.createElement("div");
        divText.innerHTML = `
            <p class="dateCard catalogueCard"> ${element.date} </p>
            <h2 class="titreCard catalogueCard"> ${element.titre}
            <p class="introCard catalogueCard"> ${element.intro} </p>
            <a href="article.php?id=${element.id}" class="btnCard catalogueCard">En savoir +</a>
            `;
        articleContainer.append(article); // preferer append à appendChild (cf.mdn)
        article.append(divText);
      }
    });
});
}


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -  Récupération des données pour la page article
//cf.page article car plus simple de mettre le script qui utlise l'url directement sur la page concernée
