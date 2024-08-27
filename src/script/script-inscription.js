// ce fichier exécute coté serveur toutes les différentes requêtes via 
// AJAX, nous allons donc géré toutes les interactions du formulaire
// sur ce fichier, tout ce qui concerne les différents processus que 
// gère l'application

//Ce script permettra l'envoi des données dans le serveur
// tout d'abord la méthode d'envoie des données doit être 
// "submit" et définir le nom du formulaire qui traite les 
// données

// alert('HIOOO')
$(document).on('submit', '#inscriptionUsager', function (e) {

    // la fonction prevent Default empêche de rafraichir le formulaire
    e.preventDefault()

    // ce code gère le traitement des données qui seront envoyées dans 
    // le serveur en vu du traitement des informations
    $.ajax({
        url: "./traitement/mt-inscription.php",
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
                $('#inscriptionUsager')[0].reset();
                $('#overlay').fadeOut();
                alertify.success(res.message)
            }
        },
        error: function () {
            console.log("Oops!")
        }
    });
});

//Ce code permet la suppression
// $(document).on('click', '.deleteBtnCat', function() {
//     var cat_id = $(this).val();
//     if (confirm('Voulez-vous supprimer cet enregistrement ?')) {
//         $.ajax({
//             type: "POST",
//             url: "../traitement/ajaxcategorie.php",
//             data: {
//                 'delete_cat': true,
//                 'cat_id': cat_id,
//                 action: "DeleteCat"
//             },
//             success: function(response) {
//                 var res = jQuery.parseJSON(response);
//                 console.log('ok');
//                 if (res.status == 500) {
//                     alert(res.message);
//                 } else {
//                     console.log('ok data remove');
//                     alert(res.message);
//                     alertify.success(res.message)
//                     load_data_categorie(1);
//                 }
//             }
//         });
//     }
// });

// //Cette partie permet simplement d'ouvrir l'enregistrement à modifier via une requête de sélection
// $(document).on('click', '.editBtnCat', function() {
//     var cat_id = $(this).val();
//     // alert(cat_id)
//     // alert("oo")
//     $.ajax({
//         type: "GET",
//         url: "../traitement/ajaxcategorie.php?cat_id=" + cat_id,
//         data: { action: "getCats" },
//         success: function(response) {
//             var res = jQuery.parseJSON(response);

//             if (res.status == 422) {
//                 alert(res.message);

//             } else if (res.status == 200) {
//                 console.log('Data fetch success');
//                 console.log(res.data)
//                 $('#lib_cat').val(res.data.libcat);
//                 $('#cod_cat').val(res.data.codcat);
//                 $('#editCategorie').modal("show");
//                 //load_data(1);
//             }
//         }
//     });
// });

// // Modification des données
// $(document).on('submit', '#updateformCategorie', function(event) {
//     event.preventDefault();
//     //var alertmsg = "Opération effectuée avec succès";

//     $.ajax({
//         url: "../traitement/ajaxcategorie.php",
//         type: "POST",
//         data: new FormData(this),
//         processData: false,
//         contentType: false,
//         BeforeSend: function() {
//             $('#overlay').fadeIn();
//         },
//         success: function(response) {
//             //console.log(response);
//             var res = jQuery.parseJSON(response);

//             if (res.status == 422) {
//                 $('.message').removeClass('alert-success');
//                 $('.message').addClass('alert-danger');
//                 $('.message').text(res.message);

//             } else if (res.status == 200) {
//                 // $('#updateformCategorie')[0].reset();
//                 $('.message').html(res.message).fadeIn().delay(3000).fadeOut();
//                 $('#overlay').fadeOut();
//                 alertify.success(res.message)
//                 load_data_categorie(1);
//             }
//         },
//         error: function() {
//             console.log("Oops!")
//         }
//     });
// });