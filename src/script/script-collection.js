
//================== formulation des requêtes ajax pour afficher des valeurs par défaut =======================//

// On fait le load des données pour récupérer les données des techniciens par ville
function load_data_profile_tous(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getProfileTous', page: page },
        success: function(data) {
            $('#result_profile_tous').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_profile_tous(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_profile_tous(page);
});


// On fait le load des données pour récupérer les domaines
function load_data_domaine(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getDomaine', page: page },
        success: function(data) {
            $('#result_domaine').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_domaine(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_domaine(page);
});


// On fait le load des données pour récupérer les catégories
function load_data_categorie_coll(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getCategorieAll', page: page },
        success: function(data) {
            $('#result_categorie_coll').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_categorie_coll(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_categorie_coll(page);
});

// On fait le load des données pour récupérer les catégories
function load_data_note_sel(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getNoteSel', page: page },
        success: function(data) {
            $('#result_note_view').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_note_sel(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_note_sel(page);
});


// On fait le load des données pour récupérer par services
function load_data_profiles_services(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getProfileService', page: page },
        success: function(data) {
            $('#result_profiles_services').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_profiles_services(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_profiles_services(page);
});


// On fait le load des données pour récupérer par catgorie
function load_data_profiles_categories(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-collection.php",
        data: { action: 'getPrestataireCategorie', page: page },
        success: function(data) {
            $('#result_profiles_categorie').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_profiles_categories(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_profiles_categories(page);
});