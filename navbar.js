// Fonction pour charger le contenu du fichier texte
function loadTags() {
    //Change des paramètres css par défaut de Bootstrap, qui ne conviennent pas
    var e = document.getElementById('navBar');
    e.style.setProperty('background-color', 'var(--darkblue)');
    e = document.querySelector('.container-fluid');
    e.style.setProperty('padding-left', '0px');
    e = document.querySelector('.navbar');
    e.style.setProperty('--bs-navbar-padding-y', '0px');
    e.style.setProperty('--bs-navbar-brand-padding-y', '0px');
    //
}


function on_page(){ 
    let elem_id = document.body.children[1].id;
    let elems = document.body.children[0].querySelectorAll('[href]');
    elems.forEach(elem => {
        if (elem.href.includes(elem_id) && elem.parentElement.parentElement.className.includes("dropdown")) {
            elem.parentElement.parentElement.parentElement.classList.add('onpage');
        }
        if(elem.href.includes(elem_id)) {
            elem.classList.add('onpage');
            return;
            }
        }
    );
}

document.querySelector(".text").addEventListener("click", () => {
    document.querySelector(".add_appointment_container").style.display = "flex";
});

window.addEventListener("click", (event) => {
    if (event.target === document.querySelector(".add_appointment_container")) {
        document.querySelector(".add_appointment_container").style.display = "none";
    }
});

document.querySelector(".validate_add_appointment").addEventListener("click", () => {
    document.querySelector(".add_appointment_container").style.display = "none";
    
});

loadTags();
on_page();




