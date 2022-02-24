$(document).ready(function () {

    // Délai de 2 secondes avant de faire disparaitre le message de reussite
    setTimeout(function () {
        $('#reussite').fadeOut('slow');
    }, 2000);


    // Délai de 5 secondes avant de faire disparaitre le ou les messages d'erreurs
    setTimeout(function () {
        $('#echec').fadeOut('slow');
    }, 5000);
})