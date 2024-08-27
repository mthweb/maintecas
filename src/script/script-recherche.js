
//================== formulation des requêtes ajax pour afficher des valeurs par défaut =======================//

// On fait le load des données pour récupérer les données des techniciens par ville
function load_data_ville(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'getRowVille', page: page },
        success: function(data) {
            $('#result_ville').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_ville(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_ville(page);
});
// Fin ville transaction



// On fait le load des données pour récupérer les données des techniciens par commune
function load_data_commune(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'getRowCommune', page: page },
        success: function(data) {
            $('#result_commune').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_commune(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_commune(page);
});
// Fin commune transaction


// On fait le load des données pour récupérer les données des techniciens par disponibilité
function load_data_disponibilite(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'getRowDispo', page: page },
        success: function(data) {
            $('#result_dispo').html(data);
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
// Fin disponibilité transactions


// On fait le load des données pour récupérer les données des techniciens par note
function load_data_note(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'getRowNote', page: page },
        success: function(data) {
            $('#result_note').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_note(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_note(page);
});
// Fin note transactions

// On fait le load des données pour récupérer les données des techniciens par catégorie
function load_data_categorie(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'getRowCat', page: page },
        success: function(data) {
            $('#result_categorie').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_categorie(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_categorie(page);
});
// Fin catégorie transactions


// On fait le load des données pour récupérer les données des techniciens par catégorie
function load_data_categorie(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-recherche.php",
        data: { action: 'categorieGetAll', page: page },
        success: function(data) {
            $('#result_categorie_all').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_categorie(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_categorie(page);
});
// Fin catégorie transactions


//================== formulation des requêtes pour fetcher les données en fonction des valeurs de filtre =======================//

// affichage des données de recherche par commune, nous formulons 
// une requête ajax pour récupérer les données
$(document).ready(function() {
    $('#commune').change(function() {
        var commune = $(this).val();
        // alert(commune)

        if (commune) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { commune: commune, action:"communeGet" },
                success: function(response) {
                    $('#result_commune').html(response);
                },
                error: function() {
                    $('#result_commune').html('Une erreur s\'est produite.');
                }
            });
        } else {
            $('#result').html('');
        }
    });
});


// Nous formulons une requête pour afficher les données par ville, afin de pouvoir
// les données de chaque compte
$(document).ready(function() {
    $('#ville').change(function() {
        var ville = $(this).val();
        // alert(ville)

        if (ville) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { ville: ville, action:"villeGet" },
                success: function(response) {
                    $('#result_ville').html(response);
                },
                error: function() {
                    $('#result_ville').html('Une erreur s\'est produite.');
                }
            });
        } else {
            load_data_ville(1);
        }
    });
});

// Nous récupérons les données des prestataires disponibles par leur disponibilité
$(document).ready(function() {
    $('#dispo').change(function() {
        var dispo = $(this).val();
        // alert(dispo)

        if (dispo) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { dispo: dispo, action:"dispoGet" },
                success: function(response) {
                    $('#result_dispo').html(response);
                },
                error: function() {
                    $('#result_dispo').html('Une erreur s\'est produite.');
                }
            });
        } else {
            $('#result_dispo').html('');
        }
    });
});


// Nous récupérons les données des prestataires disponibles par les notes
$(document).ready(function() {
    $('#note').change(function() {
        var note = $(this).val();
        // alert(note)

        if (note) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { note: note, action:"noteGet" },
                success: function(response) {
                    $('#result_note').html(response);
                },
                error: function() {
                    $('#result_note').html('Une erreur s\'est produite.');
                }
            });
        } else {
            $('#result_note').html();
        }
    });
});

// Nous récupérons les données des prestataires disponibles par catégorie
$(document).ready(function() {
    $('#categorie').change(function() {
        var cat = $(this).val();
        // alert(categorie)

        if (cat) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { cat: cat, action:"categorieGet" },
                success: function(response) {
                    $('#result_categorie').html(response);
                },
                error: function() {
                    $('#result_categorie').html('Une erreur s\'est produite.');
                }
            });
        } else {
            $('#result_categorie').html();
        }
    });
});


// Nous récupérons les données des prestataires disponibles par catégorie
$(document).ready(function() {
    $('#service_all').change(function() {
        var serv = $(this).val();
        alert(serv)

        if (cat) {
            $.ajax({
                url: '../traitement/mt-recherche.php',
                type: 'POST',
                data: { serv: serv, action:"serviceGetAll" },
                success: function(response) {
                    $('#result_service_all').html(response);
                },
                error: function() {
                    $('#result_service_all').html('Une erreur s\'est produite.');
                }
            });
        } else {
            $('#result_service_all').html();
        }
    });
});


// On fait le load des données pour récupérer les données des techniciens
function load_data_prestataire(page) {
    $.ajax({
        type: "POST",
        url: "../traitement/mt-prestataire.php",
        data: { action: 'getRow', page: page },
        success: function(data) {
            $('#dynamic_technicien_vue').html(data);
            console.log(data.message);
        }
    });
}

//on affiche le tableau
load_data_prestataire(1);

//Ce code gère la pagination
$(document).on('click', '.page-link', function() {
    var page = $(this).data('page_number');
    load_data_prestataire(page);
});

// affichage des données de recherche par commune, nous formulons 
// une requête ajax pour récupérer les données
$(document).ready(function() {
    $('#service').change(function() {
        var service = $(this).val();
        // alert(service)

        if (service) {
            $.ajax({
                url: '../traitement/mt-prestataire.php',
                type: 'POST',
                data: { service: service, action:"prestataireGet" },
                success: function(response) {
                    $('#dynamic_technicien_vue').html(response);
                },
                error: function() {
                    $('#dynamic_technicien_vue').html('Une erreur s\'est produite.');
                }
            });
        } else {
            // $('#dynamic_technicien_vue').html('');
            
        }
    });
});


$(document).on('submit','#trouveTechnicienForm', function (e) {
    e.preventDefault()

    $.ajax({
        type: "POST",
        url: "../target/technicien.php",
        data: new FormData(this),
        processData: false,
        contentType: false,

        success: function (response) {
            console.log(response);
            var res = jQuery.parseJSON(response);

            // console.log(res);

            if (res.status == 422) {
                $('.message-recherche').removeClass('alert-success');
                $('.message-recherche').addClass('alert-danger');
                $('.message-recherche').text(res.message);

            } else if (res.status == 200) {
                location.href = '../vue/main.php'
            } else if(res.status == 300){
                $('.message-recherche').html(res.message).fadeIn().delay(3000).fadeOut();
                $('.message-recherche').removeClass('d-none');
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });

    // alert('ok')
    // $('.message-recherche').removeClass('d-none')
    // $('.message-recherche').html(res.message).fadeIn().delay(3000).fadeOut();
});