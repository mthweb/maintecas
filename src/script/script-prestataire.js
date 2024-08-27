// Nous formulons une requête ajax pour la création des nouveaux profiles techniciens
$(document).on('submit', '#prestataireCreate', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    alert('OK')

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-prestataire.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            console.log(res);

            if (res.status == 422) {
                $('.message-prestataire').removeClass('alert-success');
                $('.message-prestataire').addClass('alert-danger');
                $('.message-prestataire').text(res.message);

            } else if (res.status == 200) {
                location.href ="../vue/configuration.php"
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});


// Nous formulons une requête ajax pour mettre à jour les données de configuration
$(document).on('submit', '#majConfig', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    alert('OK')

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-prestataire.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            console.log(res);

            if (res.status == 422) {
                $('.message-prestataire').removeClass('alert-success');
                $('.message-prestataire').addClass('alert-danger');
                $('.message-prestataire').text(res.message);

            } else if (res.status == 200) {
                location.href = '../vue/main.php'
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});

// requête ajax pour l'authentification des utilisateurs dans leur compte maintecas for 
// business
$(document).on('submit', '#seConnecterForm', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-prestataire.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            // console.log(res);

            if (res.status == 422) {
                $('.message-prestataire-log').removeClass('alert-success');
                $('.message-prestataire-log').addClass('alert-danger');
                $('.message-prestataire-log').text(res.message);

            } else if (res.status == 200) {
                location.href = '../vue/main.php'
            } else if(res.status == 300){
                $('.message-prestataire-log').html(res.message).fadeIn().delay(3000).fadeOut();
                $('.message-prestataire-log').removeClass('d-none');
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});


// requête ajax pour la configuration des modes de paiement
$(document).on('submit', '#setMarchandInfo', function (e) {
    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-prestataire.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            // console.log(res);

            if (res.status == 422) {
                $('.message-prestataire-log').removeClass('alert-success');
                $('.message-prestataire-log').addClass('alert-danger');
                $('.message-prestataire-log').text(res.message);

            } else if (res.status == 200) {
                $('#modepaiement').modal('hide')
                alertify.success(res.message)

            } else if(res.status == 300){
                $('.message-prestataire-log').html(res.message).fadeIn().delay(3000).fadeOut();
                $('.message-prestataire-log').removeClass('d-none');
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});

// récupération des informaitons sur l'intervention
$(document).on('click','.detailIntervention', function () {
    var inter_id = $(this).val();
    alert(inter_id)

    $.ajax({
        type: "GET",
        url: "./traitement/mt-intervention.php?inter_id=" + inter_id,
        data: { action: "getIntervention" },
        success: function(response) {
            var res = jQuery.parseJSON(response);

            if (res.status == 422) {
                alert(res.message);

            } else if (res.status == 200) {
                console.log('Data fetch success');
                console.log(res.data)
                $('#numinter').val(res.data.numinter);
                $('#datinter').val(res.data.datinter);
                $('#interventionModale').modal("show");
                // $('#interventionModale').show();
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });  
});


$(document).on('click','#interventionValidate', function (e) {
    e.preventDefault()

    $.ajax({
        type: "POST",
        url: "./traitement/mt-prestataire.php",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            // console.log(res);

            if (res.status == 422) {
                $('.message-intervention').removeClass('alert-success');
                $('.message-intervention').addClass('alert-danger');
                $('.message-intervention').text(res.message);

            } else if (res.status == 200) {
                $('.message-intervention').html(res.message).fadeIn().delay(3000).fadeOut();
                $('.message-intervention').removeClass('d-none');
                $('#annuler').addClass('d-none');

            } else if(res.status == 300){
                $('.message-intervention').html(res.message).fadeIn().delay(3000).fadeOut();
                $('.message-intervention').removeClass('d-none');
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});