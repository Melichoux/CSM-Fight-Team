// -----------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Commande du menu deroulant sur l'onglet "Vie du club"
        const dropDownBtn = document.querySelector("#dropDownBtn");
        const dropDownList = document.querySelector("#dropDownList");
        
        dropDownBtn.addEventListener("click", (event) => {
            event.stopPropagation(); // empêche le clic de "remonter" au document et de faire disparaitre le menu tout de suite apres le "click"
            dropDownList.classList.toggle("open")});

  // fermer le menu si on clique ailleurs
  document.addEventListener("click", () => {
    dropDownList.classList.remove("open");
  });
  
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Récupération des données des articles pour la page catalogue

fetch("http://127.0.0.1:5500/assets/javascript/data/articles.json")
.then((response) => response.json())
.then(
    (data)=>{
        for (let index = 0; index < data.length; index++) {
            const articleContainer = document.querySelector(".article-container");
            const element = data[index];
            
            const article = document.createElement("article")
            article.innerHTML= `
            <img src="${element.img}" alt = "Photo de l'événement">
            <p class="dateCard"> ${element.date} </p>
            <h2 class="titreCard"> ${element.titre}
            <p class="introCard"> ${element.intro} </p>
            <a href="article.html?id=${element.id}" class="btnCard">En savoir +</a>
            `
            articleContainer.appendChild(article)

        }
    })

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Récupération des données pour la page article


// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

  // Page catalogue: barre de filtre 
  const formFilter = document.querySelector("#formFilter")
  formFilter.addEventListener("submit", (event) => {
    if (event.value = value) {
      
    }
  })
