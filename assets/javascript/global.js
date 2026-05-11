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


// -----------------------------------------------------------------------------------------------------------------------------------------------------------------
//ANCHOR - gestion de la sidebar en mobile
const burgerBtn = document.getElementById('burgerBtn');
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');

burgerBtn.addEventListener('click', function() {
    sidebar.classList.toggle('open');
    overlay.classList.toggle('open');
    // Met à jour l'attribut accessibilité
    const isOpen = sidebar.classList.contains('open');
    burgerBtn.setAttribute('aria-expanded', isOpen);
});

// Permet de fermer la sidebar en cliquant sur l'overlay
overlay.addEventListener('click', function() {
    sidebar.classList.remove('open');
    overlay.classList.remove('open');
    burgerBtn.setAttribute('aria-expanded', false);
});

