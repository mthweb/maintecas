// On fait le load des données pour récupérer les données des techniciens
function load_data_disponibilite(page) {
    $.ajax({
        type: "POST",
        url: "./traitement/mt-disponibilite.php",
        data: { action: 'getRow', page: page },
        success: function(data) {
            $('#dynamic_disponibilite').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_disponibilite(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_disponibilite(page);
});
