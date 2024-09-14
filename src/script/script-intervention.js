$('message-intervention').hide();

// Nous formulons une requête ajax pour la création des nouveaux profiles techniciens
$(document).on('submit', '#setIntervention', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    alert('Intervention soumission')

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "../traitement/mt-intervention.php",
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
                $('.message-intervention').html(res.message).fadeIn().delay(3000).fadeOut();
                console.log(res.message)
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});