$('.message-usager').hide();


$(document).on('submit', '#inscriptionUsager', function (event) {
    event.preventDefault();
    // var nom = $('#client_nom').val();

    console.log('ok');
    // var alertmsg = "Opération effectuée avec succès";

    // alert("alertmsg")

    $.ajax({
        url: "src/traitement/mt-inscription-usager.php",
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function (response) {
            //console.log(response);
            var res = jQuery.parseJSON(response);

            if (res.status == 422) {
                $('.message-usager').removeClass('alert-success');
                $('.message-usager').addClass('alert-danger');
                $('.message-usager').text(res.message);

            } else if (res.status == 200) {
                console.log(res)
                $('#inscriptionUsager')[0].reset();
                $('.message-usager').addClass('alert-sucess')
                $('.message-usager').html(res.message).fadeIn().delay(3000).fadeOut();
                // location.href='login.php';
            }
        },
        complete: function () {

        },
        error: function () {
            console.log("Oops!")
        }
    });
});