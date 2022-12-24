document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    scrollNav();
    ocultarMenu();
});

function eventListeners() {
    const menu = document.querySelector('.menu')
    menu.addEventListener('click', navResponsive)

}
function ocultarMenu(){
    const apart = document.querySelector('.nav_primary')
    apart.addEventListener('click', navResponsive2)
}
function navResponsive() {
    const navigation = document.querySelector('.nav')
    navigation.classList.toggle('show');
}
function navResponsive2() {
    const navigation = document.querySelector('.nav')
    navigation.classList.remove('show');
}


function scrollNav() { //cuando le demos click al la navegacion nos lleva a ese apartado deslizandose por la pagina
    const enlaces = document.querySelectorAll('.nav_primary')
    enlaces.forEach(enlace => {
        enlace.addEventListener('click', function (e) {
            e.preventDefault();


            const seccionScroll = e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({ behavior: "smooth" });
        });
    });
}