// Nous formulons une requête ajax pour la création des nouveaux profiles techniciens
$(document).on('submit', '#interventionForm', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-intervention.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            console.log(res);

            if (res.status == 422) {
                $('.message-intervention').removeClass('alert-success');
                $('.message-intervention').addClass('alert-danger');
                $('.message-intervention').text(res.message);

            } else if (res.status == 200) {
                $('.message-intervention').text(res.message);
                $('#modal').modal('hide')
                $('#success_modale').modal('show')
                console.log(res.message)
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});