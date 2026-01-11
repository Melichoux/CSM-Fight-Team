// -----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR - Commande du menu deroulant sur l'onglet "Vie du club"
const dropDownBtn = document.querySelector("#dropDownBtn");
const dropDownList = document.querySelector("#dropDownList");

dropDownBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // empêche le clic de "remonter" au document et de faire disparaitre le menu tout de suite apres le "click"
  dropDownList.classList.toggle("open");
});

//ANCHOR - fermer le menu si on clique ailleurs
document.addEventListener("click", () => {
  dropDownList.classList.remove("open");
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -   Récupération des données des articles pour la page catalogue
const articleContainer = document.querySelector(".article-container");

fetch("http://127.0.0.1:5500/assets/javascript/data/articles.json")
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
            <a href="article.html?id=${element.id}" class="btnCard catalogueCard">En savoir +</a>
            `;
      articleContainer.append(article); // preferer append à appendChild (cf.mdn)
      article.append(divText);
    }
  });

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -  Récupération des données pour la page article
//cf.page article car plus simple de mettre le script qui utlise l'url directement sur la page concernée

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR -  Page catalogue: barre de filtre
const filter = document.querySelector("#filter"); // on applique le filtre directement sur le "select" du form
filter.addEventListener("change", (event) => { //
  const userChoice = event.target.value;
  console.log(event.target.value);
  articleContainer.innerHTML="" // permet de vider la page avant de faire le nouvel affichage
  
  fetch("http://127.0.0.1:5500/assets/javascript/data/articles.json")
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
            <a href="article.html?id=${element.id}" class="btnCard catalogueCard">En savoir +</a>
            `;
        articleContainer.append(article); // preferer append à appendChild (cf.mdn)
        article.append(divText);
      }
    });
});

//ANCHOR -  Menu burger
const burger = document.querySelector(".burger");
const nav = document.querySelector(".mainNav");

burger.addEventListener("click", () => {
  nav.classList.toggle("active");

  const img = burger.querySelector("img");
  img.src = nav.classList.contains("active")
    ? "assets/images/close.svg"
    : "assets/images/burger.svg";
});