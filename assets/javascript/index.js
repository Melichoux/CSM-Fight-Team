// -----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR - Commande du menu deroulant sur l'onglet "Vie du club"
const dropDownBtn = document.querySelector("#dropDownBtn");
const dropDownList = document.querySelector("#dropDownList");
if (dropDownBtn){
dropDownBtn.addEventListener("click", (event) => {
  event.stopPropagation(); // empêche le clic de "remonter" au document et de faire disparaitre le menu tout de suite apres le "click"
  dropDownList.classList.toggle("open");
});

//ANCHOR - fermer le menu si on clique ailleurs
document.addEventListener("click", () => {
  dropDownList.classList.remove("open");
});
}

