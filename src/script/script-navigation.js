// alert('OK')

// $(document).on('click','.nav-link', function () {
//     alert('OK oK OK')
// });

$(document).ready(function () {

    // chargement de la page par défaut
    loadPage("categorie-page")

    $('.nav-link-btn').on("click", function (e) {
        // Prevent default est une fonction qui permet 
        // d'empêcher le rafraichissement de la page au click 
        // d'un bouton
        e.preventDefault();

        alert('OK')

        // On déclare une variable page qui récupère le 
        // nom de la page précisée dans le l'attribut
        // data-page dans l'interface
        var page = $(this).data('page');

        // On fait donc l'appel de notre fonction qui appel les
        // différentes pages
        loadPage(page);

    });

    // On crée une fonction qui permet de charger les pages
    // cette fonctoin renvoi l'url de la page demandée
    function loadPage(page) {

        // On définit la durée de l'exécution de notre événement à 300
        $('#content').fadeOut(300, function () {
            // Rédirection vers la page demandée
            $('#content').load("../pages/" + page + '.php', function () {
                // On affiche à nouveau le contenu, tout en définissant 
                // la durée de l'exécution de notre événement à 300
                $('#content').fadeIn(300);

            });
        });
    }
});



/**
 * Le script sur cette page permet la gestion du chargement des pages
 * le mode SPA (Single page application) est utilisé pour charger les 
 * pages et exécuter les requête de chargement
 */