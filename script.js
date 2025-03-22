const bar = document.getElementById('bar');
const close = document.getElementById('close');
const nav = document.getElementById('navbar');

var popup = document.querySelector("#popupcommandeForm");
// smooth scroll to element and align it at the bottom


function openFormCommande() {
    document.getElementById('popupcommandeForm').style.display = "flex";
  }

function closeFormCommande() {
    document.getElementById('popupcommandeForm').style.display = "none";
  }

function lienVersLivre(){
    window.location.href = "livres-tarawih.php";
}
function lienVersLivre2()
{
    window.location.href = "../livres-tarawih.php"
}


if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}


var divLabel = document.querySelector("#conseils-tarawih");
var btnLabel = divLabel.getElementsByClassName("round");

for(var i = 0; i<btnLabel.length; i++){
    btnLabel[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("focus");
        current[0].className = current[0].className.replace(" focus", "");
        this.className += " focus";
    })
}

var divGuide = document.querySelector("#guides-tarawih");
var btnGuide = divGuide.getElementsByClassName("sous-titre");

for(var i = 0; i<btnGuide.length; i++){
    btnGuide[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("focus");
        current[0].className = current[0].className.replace(" focus", "");
        this.className += " focus";
    })
}