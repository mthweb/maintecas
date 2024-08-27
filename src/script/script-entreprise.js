// insertion des données, cette requête permet d'enregistrer 
// une nouvelle entreprise sur la palteforme
$(document).on('submit', '#entrepriseCreate', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    alert('OK')

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-entreprise.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            console.log(res);

            if (res.status == 422) {
                $('.message').removeClass('alert-success');
                $('.message').addClass('alert-danger');
                $('.message').text(res.message);

            } else if (res.status == 200) {
                $('#entrepriseCreate')[0].reset();
                $('#overlay').fadeOut();
                alertify.success(res.message)
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});


function load_data_produit_selection(page) {
    $.ajax({
        type: "POST",
        url: "./traitement/mt-entreprise.php",
        data: { action: 'getRow', page: page },
        success: function(data) {
            $('#dynamic_entreprise_vue_1').html(data);
            $('#dynamic_entreprise_vue_2').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_produit_selection(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_produit_selection(page);
});


$(document).on('click','.modale-open-profile', function () {
    var prestataire_id = $(this).val();
    alert(prestataire_id)

    $('#modal').modal("show");

});