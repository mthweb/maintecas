// On fait le load des données pour récupérer les données des techniciens
function load_data_service(page) {
    $.ajax({
        type: "POST",
        url: "./traitement/mt-services.php",
        data: { action: 'getRow', page: page },
        success: function(data) {
            $('#dynamic_service_vue').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_service(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_service(page);
});


// alert('ok pour service')