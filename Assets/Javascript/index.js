// Récupération des données des articles pour la page catalogue

fetch("http://127.0.0.1:5500/Assets/Javascript/Data/articles.json")
.then((response) => response.json())
.then(
    (data)=>{
        for (let index = 0; index < data.length; index++) {
            const articleContainer = document.querySelector(".article-container");
            const element = data[index];
            
            const article = document.createElement("article")
            article.innerHTML= `
            <p> ${element.date} </p>
            <img src="${element.img}" alt = "Photo de l'événement">
            <h2> ${element.titre}
            <p> ${element.intro} </p>
            <a href="article.html"
            `
            articleContainer.appendChild(article)

        }
    })